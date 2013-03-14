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
        wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
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

		$urlArray = explode("_", $_POST["url"]);
		//Rooting is different for beers.
		switch($urlArray[0]) {
			case "beers":
				$id = bwp_url_to_postid($urlArray[0] . "/" . $urlArray[1]);
				$beers = new WP_Query(array("post_type" => "beers", "p" => $id));
				while ($beers->have_posts()): $beers->the_post();
					get_template_part('parts/content/content', "beers");
				endwhile;
				break;
			case "home":
			case "about-us":
			case "highlights":
			case "fan-shop":
			case "contact-us":
				$id = url_to_postid($urlArray[0]);
				if ($id === 0) {
					$id = 4;
				}
				$query = new WP_Query("page_id=" . $id);
				while ($query->have_posts()): $query->the_post();
					get_template_part('parts/content/content');
				endwhile;	
			break;
			case "tag":
				global $page_number, $query_part, $offset, $rootURL, $rootURL2;
				$rootURL = '/tag/' . $urlArray[1];
				$rootURL2 = '/tag/' . $urlArray[1] . "/";
				$query_part = 'tag=' . $urlArray[1] . '&offset=';
				if (isset($urlArray[2])) {
					$page_number = intval($urlArray[2]);
				} else {
					$page_number = 1;
				}
				$offset = 0 + 6*($page_number - 1);
				get_template_part('parts/content/content', 'pages');
				break;
			break;
			case "category":	
				global $page_number, $query_part, $offset, $rootURL, $rootURL2;
				$rootURL = '/category/' . $urlArray[1];
				$rootURL2 = '/category/' . $urlArray[1]. "/";
				$query_part = 'category_name=' . $urlArray[1] . '&offset=';
				if (isset($urlArray[2])) {
					$page_number = intval($urlArray[2]);
				} else {
					$page_number = 1;
				}
				$offset = 0 + 6*($page_number - 1);
				get_template_part('parts/content/content', 'pages');
				break;
			case "page":
				global $page_number, $query_part, $offset, $rootURL, $rootURL2;
				$rootURL = '/highlights';
				$rootURL2 = '/page/';
				$query_part = 'showposts=2&offset=';
				$page_number = intval($urlArray[1]);
				$offset = 3 + 6*($page_number - 2);
				get_template_part('parts/content/content', 'pages');
				break;
			//Defaults is a single post view
			default:
				if (isset($urlArray[1])) {
					$id = url_to_postid($urlArray[0] . "/" . $urlArray[1]);
					$query2 = new WP_Query("p=" . $id);
					while ($query2->have_posts()): $query2->the_post();
						get_template_part('parts/content/content', 'single-post');
					endwhile;	
				}		
			break;
		}	
		die();
	}
//	add_action('wp_ajax_nopriv_page', 'gtp_page');
//	add_action('wp_ajax_page', 'gtp_page');

	/*******************************************************************
	 *
	 * Tweaking custom post type: "establishments."
	 ******************************************************************/

	function change_default_title( $title ){
	     $screen = get_current_screen();
	 	switch($screen->post_type){
	 		case 'players':
	 			$title = "Enter Player's name here.";
	 		break;
	 		case 'beers':
	 			$title = "Enter beer name here.";
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
	        case 'players':
	        	$content = 'Enter bio here.';
	        break;
	        case 'beers':
	        	$content = 'Enter beer information here.';
	        default:
	        break;
	    }

	    return $content;
	}

	add_filter( 'default_content', 'my_editor_content', 10, 2 );

	/*******************************************************************
	 *
	 * url_to_postid modified for custom post types found on:
	 * http://betterwp.net/wordpress-tips/url_to_postid-for-custom-post-types/
	 ******************************************************************/
	
	/* Post URLs to IDs function, supports custom post types - borrowed and modified from url_to_postid() in wp-includes/rewrite.php */
	function bwp_url_to_postid($url) {
	    global $wp_rewrite;
	 
	    $url = apply_filters('url_to_postid', $url);
	 
	    // First, check to see if there is a 'p=N' or 'page_id=N' to match against
	    if ( preg_match('#[?&](p|page_id|attachment_id)=(\d+)#', $url, $values) )   {
	        $id = absint($values[2]);
	        if ($id)
	            return $id;
	    }
	 
	    // Check to see if we are using rewrite rules
	    $rewrite = $wp_rewrite->wp_rewrite_rules();
	 
	    // Not using rewrite rules, and 'p=N' and 'page_id=N' methods failed, so we're out of options
	    if ( empty($rewrite) )
	        return 0;
	 
	    // Get rid of the #anchor
	    $url_split = explode('#', $url);
	    $url = $url_split[0];
	 
	    // Get rid of URL ?query=string
	    $url_split = explode('?', $url);
	    $url = $url_split[0];
	 
	    // Add 'www.' if it is absent and should be there
	    if ( false !== strpos(home_url(), '://www.') && false === strpos($url, '://www.') )
	        $url = str_replace('://', '://www.', $url);
	 
	    // Strip 'www.' if it is present and shouldn't be
	    if ( false === strpos(home_url(), '://www.') )
	        $url = str_replace('://www.', '://', $url);
	 
	    // Strip 'index.php/' if we're not using path info permalinks
	    if ( !$wp_rewrite->using_index_permalinks() )
	        $url = str_replace('index.php/', '', $url);
	 
	    if ( false !== strpos($url, home_url()) ) {
	        // Chop off http://domain.com
	        $url = str_replace(home_url(), '', $url);
	    } else {
	        // Chop off /path/to/blog
	        $home_path = parse_url(home_url());
	        $home_path = isset( $home_path['path'] ) ? $home_path['path'] : '' ;
	        $url = str_replace($home_path, '', $url);
	    }
	 
	    // Trim leading and lagging slashes
	    $url = trim($url, '/');
	 
	    $request = $url;
	    // Look for matches.
	    $request_match = $request;
	    foreach ( (array)$rewrite as $match => $query) {
	        // If the requesting file is the anchor of the match, prepend it
	        // to the path info.
	        if ( !empty($url) && ($url != $request) && (strpos($match, $url) === 0) )
	            $request_match = $url . '/' . $request;
	 
	        if ( preg_match("!^$match!", $request_match, $matches) ) {
	            // Got a match.
	            // Trim the query of everything up to the '?'.
	            $query = preg_replace("!^.+\?!", '', $query);
	 
	            // Substitute the substring matches into the query.
	            $query = addslashes(WP_MatchesMapRegex::apply($query, $matches));
	 
	            // Filter out non-public query vars
	            global $wp;
	            parse_str($query, $query_vars);
	            $query = array();
	            foreach ( (array) $query_vars as $key => $value ) {
	                if ( in_array($key, $wp->public_query_vars) )
	                    $query[$key] = $value;
	            }
	 
	        // Taken from class-wp.php
	        foreach ( $GLOBALS['wp_post_types'] as $post_type => $t )
	            if ( $t->query_var )
	                $post_type_query_vars[$t->query_var] = $post_type;
	 
	        foreach ( $wp->public_query_vars as $wpvar ) {
	            if ( isset( $wp->extra_query_vars[$wpvar] ) )
	                $query[$wpvar] = $wp->extra_query_vars[$wpvar];
	            elseif ( isset( $_POST[$wpvar] ) )
	                $query[$wpvar] = $_POST[$wpvar];
	            elseif ( isset( $_GET[$wpvar] ) )
	                $query[$wpvar] = $_GET[$wpvar];
	            elseif ( isset( $query_vars[$wpvar] ) )
	                $query[$wpvar] = $query_vars[$wpvar];
	 
	            if ( !empty( $query[$wpvar] ) ) {
	                if ( ! is_array( $query[$wpvar] ) ) {
	                    $query[$wpvar] = (string) $query[$wpvar];
	                } else {
	                    foreach ( $query[$wpvar] as $vkey => $v ) {
	                        if ( !is_object( $v ) ) {
	                            $query[$wpvar][$vkey] = (string) $v;
	                        }
	                    }
	                }
	 
	                if ( isset($post_type_query_vars[$wpvar] ) ) {
	                    $query['post_type'] = $post_type_query_vars[$wpvar];
	                    $query['name'] = $query[$wpvar];
	                }
	            }
	        }
	 
	            // Do the query
	            $query = new WP_Query($query);
	            if ( !empty($query->posts) && $query->is_singular )
	                return $query->post->ID;
	            else
	                return 0;
	        }
	    }
    	return 0;
	}



	//Customizing the blog here

	//Length of the excerpt
	function custom_excerpt_length($length) {
		global $myExcerptLength;
		if ($myExcerptLength) {
		    return $myExcerptLength;
		} else {
		    return 100; //default value
	    }
	}
	
	/*******************************************************************
	 * Filter for Age Verify
	 ******************************************************************/
	function cartogram_av_filter($form){
		$options = get_option('lfb_theme_options');
		$prepend = '<form id="av_verify_form" action="' . home_url( '/' ) . '" method="post">';
		$error = ( isset( $_GET['verify-error'] ) ) ? $_GET['verify-error'] : false;
		if ( $error ) :
		
			// Catch-all error
			$error_string = apply_filters( 'av_error_text_general', __( 'Sorry, something must have gone wrong. Please try again', 'age_verify' ) );
			
			// Visitor didn't check the box (only for the simple checkbox form)
			if ( $error == 2 )
				$error_string = apply_filters( 'av_error_text_not_checked', __( 'Check the box to confirm your age before continuing', 'age_verify' ) );
			
			// Visitor isn't old enough
			if ( $error == 3 )

				header("Location: " . $options['redirect']);
				exit;
			// Visitor entered an invalid date
			if ( $error == 4 )
				$error_string = apply_filters( 'av_error_text_bad_date', __( 'Please enter a valid date', 'age_verify' ) );
			
			$prepend .= '<p class="error">' . $error_string . '</p>';
			
		endif;
		$prepend .= wp_nonce_field( 'verify-age', 'av-nonce' );
		$prepend .= '<div class="row">
							<div class="columns three" id="av-digits-m"></div>
							<div class="columns three" id="av-digits-d"></div>
							<div class="columns six" id="av-digits-y"></div>
						</div>';

		$newForm = '	<div class="row">						
							<div class="columns three">
								<input type="text" name="av_verify_m" id="av_verify_m" maxlength="2" value="" placeholder="MM" />
							</div>
							<div class="columns three">
								<input type="text" name="av_verify_d" id="av_verify_d" maxlength="2" value="" placeholder="DD" />
							</div>
							<div class="columns six">
								<input type="text" name="av_verify_y" id="av_verify_y" maxlength="4" value="" placeholder="YYYY" />
							</div>';
		$newForm .= '		<p class="submit">
								<label for="av_verify_remember">
									<input type="checkbox" name="av_verify_remember" id="av_verify_remember" value="1" /> Remember me
								</label> 
								<input type="submit" name="av_verify" id="av_verify" value="Enter Site »" />
							</p>';
		
		$append = '		</div>
					</form>';
		return $prepend . $newForm . $append;
	}
	add_filter('av_verify_form', 'cartogram_av_filter');
	add_action('init', 'do_output_buffer');
	function do_output_buffer() {
	        ob_start();
	}

?>