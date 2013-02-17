<?php
	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/custom_post_types_taxonomies.php' );
	require_once( 'external/media.php' );
	require_once( 'external/multiple_featured_images.php' );
	require_once( 'external/widgets.php' );
	require_once( 'external/navigation.php' );
	require_once( 'external/utilities.php' );
	require_once( 'external/metaboxes.php' );
	require_once( 'external/comments.php' );
	require_once( 'external/theme_options.php' );
	require_once( 'external/gravity_forms.php' );

	/* ========================================================================================================================
	
	Navigation Menus
	
	======================================================================================================================== */

	register_nav_menus( array(
		'social' => 'Social Navigation Menu',
		'global' => 'Global Navigation Menu'	
		) );

	/* ========================================================================================================================
	
	Sidebar Areas
	
	======================================================================================================================== */

	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'description' => __('This is the default widget area for the sidebar. This will be displayed if the other sidebars have not been populated with widgets.', 'cartogram'),
		'before_widget' => '<div class="sidebar">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));

	/* Allow widgets to use shortcodes */
	add_filter('widget_text', 'do_shortcode');



	/* ========================================================================================================================
	
	Establish Post Formats
	
	======================================================================================================================== */

	// add_theme_support( 'post-formats', array( 'quote', 'gallery' ) );
	// add_post_type_support( 'reference', 'post-formats' );

	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 */
	function cartogram_scripts() {
        wp_deregister_script('jquery');
        wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js');
	    wp_enqueue_script( 'jquery' );


		wp_register_script( 'modernizr', get_template_directory_uri() . '/javascripts/foundation/modernizr.foundation.js', NULL, NULL, NULL);
		wp_enqueue_script( 'modernizr' );

		wp_register_script( 'app', get_template_directory_uri().'/javascripts/index-ck.js', array('jquery') );
		wp_enqueue_script( 'app', array('jquery')  );
		/* Give index-ck.js access to the variable AjaxResources containg the given info in the array */
		wp_localize_script('app', 'AjaxResources', array('ajax_url'=> get_site_url() . '/wp-admin/admin-ajax.php',
		'post_id' => get_the_ID(), 'request_url' => get_permalink(get_the_ID())));

		wp_register_style( 'screen', get_template_directory_uri().'/stylesheets/app.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}	

	/* ========================================================================================================================
	
	Images

	- Set thumbnail sizes and add any additional featured images.
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');

	set_post_thumbnail_size(450, 450, true);

	add_image_size('cartogram_post_thumb_big',450, 450, true);
	// add_image_size('cartogram_post_thumb_big_cropped',470, 340, true);

	// add_image_size('cartogram_post_thumb_small', 310, 180, true);
	// add_image_size('cartogram_post_thumb_tiny', 220, 140, true);
	// add_image_size('cartogram_slideshow_image_full', 1000, 444, true);

	// new MultiPostThumbnails(array(
	// 	'label' => 'Slideshow Image',
	// 	'id' => 'slideshow_image',
	// 	'post_type' => 'products'
	// 	)
	// );

	/* ========================================================================================================================
	
	Call Everthing!

	- Put all Hooks (actions/filters/etc) in one place.
	
	======================================================================================================================== */

	/**
	 * Scripts
	 *
	 **/
	add_action( 'wp_enqueue_scripts', 'cartogram_scripts' );

	/**
	 * Post types and taxonomies
	 *
	 **/
	add_action( 'init', 'create_post_types' );
	add_action( 'init', 'create_taxonomies' );

	/**
	 * Classes
	 *
	 **/
	add_filter( 'body_class', 'add_slug_to_body_class' );

	/**
	 * Content
	 *
	 **/
	add_filter('the_excerpt', 'excerpt_ellipsis');
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	add_filter('the_content', 'cartogram_remove_more_link');
	add_action('the_content', 'add_video_containers');
		/**
		 * Shortcodes
		 *
		 **/
		add_shortcode('button', 'cartogram_button');
		add_shortcode('flex-video', 'cartogram_flexVideo');
		add_shortcode('slideshow', 'cartogram_slideshow');

		/**
		 * Other
		 *
		 **/	
		//remove_filter('term_description','wpautop');	
	/**
	 * Gravity Forms
	 *
	 **/
	add_filter("gform_submit_button", "form_submit_button", 10, 2);
	
	/**
	 * Comments
	 *
	 **/
	add_action('comment_post', 'ajaxify_comments',20, 2);

	/********************************************************************
	 * Adding actions to response to ajax requests.
	 *
	 * Structure the hook as wp_ajax_{url of push state}
	 * with function gtp_{urlpushstate with _ instead of /}
	 * example wp_ajax_beer_dark for beer/dark callw gtp_beer_dark
	 * (gtp: get template part)
	 *******************************************************************/
	function gtp_page() {

		$id = url_to_postid($_POST["url"]);

		$pages = new WP_Query("page_id=" . $id);
		while ($pages->have_posts()): $pages->the_post();
			get_template_part('parts/content/content');
		endwhile;		
		die();
	}
	add_action('wp_ajax_nopriv_page', 'gtp_page');
	add_action('wp_ajax_page', 'gtp_page');

	/*******************************************************************
	 *
	 * Tweaking custom post type: "establishments."
	 ******************************************************************/

	function change_default_title( $title ){
	     $screen = get_current_screen();
	 	switch($screen->post_type){
	 		case 'establishments':
	 			$title = 'Enter establishment name here';
	 		break;
	 		case 'players':
	 			$title = "Enter Player's name here.";
	 		break;
	 		default:
	 		break;
	 	}
	 
	     return $title;
	}
	 
	add_filter( 'enter_title_here', 'change_default_title' );



	/*******************************************************************
	 *
	 * Tweaking custom post type default bodies:
	 * 		-Establishments: Enter address here.
	 ******************************************************************/
	function my_editor_content( $content, $post ) {

	    switch( $post->post_type ) {
	        case 'establishments':
	            $content = 'Enter address here';
	        break;
	        case 'players':
	        	$content = 'Enter bio here.';
	        break;
	        default:
	        break;
	    }

	    return $content;
	}

	add_filter( 'default_content', 'my_editor_content', 10, 2 );



?>