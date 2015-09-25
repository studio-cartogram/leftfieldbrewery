<?php
/**
* Cartogram API
*
* @package   cartogram-api
* @author    Matthew Seccafien <matt@studiocartogram.com>
* @license   GPL-2.0+
* @link      http://cartogram.ca
* @copyright 7-3-2014 Cartogram
*/

/**
* Cartogram API class.
*
* @package CartogramAPI
* @author  Matthew Seccafien <matt@studiocartogram.com>
*/


class Cartogram_API {
	/**
	* Base route
	*
	* @var string
	*/
	protected $base = '/cartogram-api';


	public function register_routes( $routes ) {

		$routes[ $this->base .  '/module/(?P<page>.+)/(?P<module>.+)'] = array(
			array( array( $this, 'cartogram_get_module'), WP_JSON_Server::READABLE ),
		);

		$routes[ $this->base .  '/(?P<type>.+)/(?P<path>.+)'] = array(
			array( array( $this, 'cartogram_get_item_by_path'), WP_JSON_Server::READABLE ),
		);

		$routes[ $this->base .  '-menu/(?P<menu>.+)'] = array(
			array( array( $this, 'cartogram_get_navigation'), WP_JSON_Server::READABLE ),
		);

		// Add more custom routes here

		return $routes;
	}


	/**
	* Get Menus Items
	*
	* @param string $menu menu slug
	* @return array Menu data
	*/

	public function cartogram_get_navigation( $menu ) {

		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu ] ) ) {
			$_menu = wp_get_nav_menu_object( $locations[ $menu ] );
			$menu_items = wp_get_nav_menu_items($_menu->term_id);
		}
		if ( empty( $_menu ) ) {
			return new WP_Error( 'json_menu_invalid', __( 'Invalid Menu.' ), array( 'status' => 404 ) );
		}

		return $this->prepare_navigation_items( $menu_items );

	}

	/**
	* Prepare a menu object for serialization
	*
	* @param stdClass $menu Menu data
	* @return array Taxonomy data
	*/
	protected function prepare_navigation_items( $menu_items ) {

		$menu_data = array();

		foreach ( $menu_items as $menu_item ) {
			$menu_data[] = $this->prepare_menu_item( $menu_item );
		}

		return apply_filters( 'json_prepare_menu', $menu_data, $menu_items );
	}

	/**
	* Prepare menu data for serialization
	*
	* @param array|object $term The unprepared term data
	* @return array The prepared term data
	*/

	protected function prepare_menu_item( $menu_item ) {

		$data = array(
			'ID'          => (int) $menu_item->ID,
			'name'        => $menu_item->title,
			'slug'        => basename($menu_item->url),
			'title'	  	  => $menu_item->attr_title,
			'target'	  => $menu_item->target,
			'description' => $menu_item->description,
			'classes'	  => $menu_item->classes,
		);

		return apply_filters( 'json_prepare_menu_item', $data, $menu_item );
	}


	/**
	* Retrieve a page by path name
	*
	* @param string $path
	* @param string $type
	*/
	public function cartogram_get_item_by_path( $path, $type, $context = 'view' ) {
		$post = get_page_by_path( $path, ARRAY_A, $type );

		if ( empty( $post ) ) {
			return new WP_Error( 'json_post_invalid_id', __( 'Invalid post ID.' ), array( 'status' => 404 ) );
		}

		return $this->get_post( $post['ID'], $context );
	}

	/**
	* Prepare images
	*
	* @access public
	* @uses prepare_images()
	* @param int $id Post ID
	*/

	public function prepare_images( $id ) {

		global $_wp_additional_image_sizes;

		$sizes = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach( $get_intermediate_image_sizes as $_size ) {

			if ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

				$sizes[ $_size ]['sizes'] = array(
					'width' => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
				);

				$sizes[ $_size ]['src'] = $this->prepare_image_src($id, $_size);

			}

		}

		return $sizes;
	}

	/**
	* Prepare Image
	*
	* @access public
	* @param int $id Post ID
	* @param string $size Post ID
	*/

	public function prepare_image_src( $id, $size = 'img-large') {

		$srcArray = wp_get_attachment_image_src( $id, $size);
		return $srcArray[0];

	}


	/**
	* Prepare Siblings
	*
	* @access public
	* @uses prepare_next()
	* @param int $id Post ID
	*/

	public function prepare_next( $id ) {

		$next_post = get_next_post();

		if ($next_post) {
			$next = (object) array(
				'slug' => $next_post->post_name
			);
			return $next;
		}


	}


	/**
	* Prepare previous
	*
	* @access public
	* @uses prepare_previous()
	* @param int $id Post ID
	*/

	public function prepare_previous(  $id ) {

		$previous_post = get_previous_post();

		if ($previous_post) {
			$previous = (object) array(
				'slug' => $previous_post->post_name
			);
			return $previous;
		}
	}

	/**
	* Prepare Points
	*
	* @access public
	* @param int points repeater
	*/

	public function cartogram_prepare_points( $points ) {

		$_points = array();

		foreach ($points as $point) {
			if($point ){
				array_push($_points, $point);
			}
		}

		return $_points;

	}


	/**
	* Prepare Button
	*
	* @access public
	*/

	public function cartogram_prepare_button( ) {

		if(get_sub_field('button_link') && get_sub_field('button_text')) {
			$button = (object) array(
				'link' => get_sub_field('button_link'),
				'text' => get_sub_field('button_text')
			);
		} else {
			$button = null;
		}
		return $button;

	}

	/**
	* Prepare Video
	*
	* @access public
	*/

	public function cartogram_prepare_video( ) {

		if(get_sub_field('wistia_video_embed')) {
			$video = (object) array(
				'embed' => get_sub_field('wistia_video_embed')
			);
		} else {
			$video = null;
		}


		return $video;

	}

	/**
	* Prepare Artists
	*
	* @access public
	* @param int $artistid Artist Post ID
	*/

	public function cartogram_prepare_artists( $artists ) {
		$_artists = array();

		foreach ($artists as $artist) {
			if($artist ){
				$_artist = $this->cartogram_prepare_artist_slide( $artist->ID );
				array_push($_artists, $_artist);
			}
		}

		return $_artists;
	}

	/**
	* Prepare Artist Slide
	*
	* @access public
	* @param int $artistid Artist Post ID
	*/

	public function cartogram_prepare_artist_slide( $artistid ) {

		$artist = array(
			'id' 		=> 	 $artistid,
			'name' 		=> 	 get_the_title($artistid),
			'image'		=>   $this->prepare_image_src(get_post_thumbnail_id($artistid)),
			'link'		=>   get_permalink($artistid),
			'content'   =>   get_the_content($artistid),

		);

		return $artist;
	}

	/**
	* Prepare Slides
	*
	* @access public
	*/

	public function cartogram_prepare_slides( $slides ) {

		$_slides = array();

		foreach ($slides as $slide) {
			$_slide = $this->cartogram_prepare_slide( $slide );
			array_push($_slides, $_slide);
		}

		return $_slides;
	}

	/**
	* Prepare Slide
	*
	* @access public
	*/

	public function cartogram_prepare_slide( $slide ) {

		$_slide = array(
			'text'		=> 	 $slide['text'],
			'image'		=> 	 $this->prepare_image_src($slide['image'], 'img-large'),
			'link_text'	=> 	 $slide['link_text'],
			'link' 		=> 	 $slide['link_destination'],
		);

		return $_slide;
	}

	/**
	* Prepare Post Custom Fields
	*
	* @access public
	* @param int $id Post ID
	*/

	public function cartogram_prepare_acf_modules(  $id ) {

		$modules = array();

		if( have_rows('modules', $id) ):

			while ( have_rows('modules', $id) ) : the_row();

			$module = array(
				'layout'           => get_row_layout(),
				'image'            => $this->prepare_image_src(get_sub_field('image'), 'img-large'),
				'heading'	       => get_sub_field('heading'),
				'subheading'	   => get_sub_field('subheading'),
				'blockquote'	   => get_sub_field('blockquote'),
				'text'	           => get_sub_field('text'),

			);

			if(get_row_layout() == 'introduction') :

				$module_extra = array(
					'heading_below_image' => get_sub_field('heading_below_image')
				);

			elseif(get_row_layout() == 'banner') :

				$type = get_sub_field('type');

				$module_extra = array(
					'full_width'	=> get_sub_field('full_width'),
					'icon'     		=> get_sub_field('icon'),
					'orientation'   => get_sub_field('orientation'),
					'button'   		=> $this->cartogram_prepare_button(),
					'type'     		=> $type,
					'color'			   => get_sub_field('color_scheme'),
				);

				if($type == 'video') {

					$type_extra = array (
						'video'   		=> $this->cartogram_prepare_video(),
					);

				} elseif($type == 'slider') {

					$type_extra = array (
						'slides'    => $this->cartogram_prepare_slides(get_sub_field('slides')),
					);

				} else {

					$type_extra = array();

				}

				$module_extra = array_merge( $module_extra, $type_extra );


			elseif(get_row_layout() == 'artists') :

				$module_extra = array(
					'artists'     => $this->cartogram_prepare_artists(get_sub_field('artists')),
				);

			elseif(get_row_layout() == 'diagram') :
				$module_extra = array(
					'points'     => $this->cartogram_prepare_points(get_sub_field('points')),
				);

			else :

				$module_extra = array();

			endif;

			$_module = array_merge( $module, $module_extra );
			array_push($modules, $_module);

		endwhile;

		else :

			// $modules = array(
			// 	'error' => true,
			// 	'message' => 'no modules found',
			// 	'id' => $id,
			// 	'fields' => get_field('modules')
			// );

		endif;

		return $modules;


	}


	/**
	* Prepare Built in Modules
	*
	* @access public
	* @param int $id Post ID
	*/

	public function cartogram_prepare_modules(  $post ) {

		$modules = array();

		$slug = $post['post_name'];

		$args = array(
			'post_type' => $slug
		);

		$posts = get_posts( $args );

		if($slug && $posts):

			foreach ( $posts as $post ) : setup_postdata( $post );

				$module = array(
					'layout' => 'team',
					'team_name' => $post->post_title,
					'team_description' => $post->content,
					'team_slug' => $post->post_name,
					'team_link' => get_permalink($post->ID),
					'team_id' => $post->ID,
					'artists' => $this->cartogram_prepare_artists(get_field('artists', $post->ID)),

				);

				//$_module = array_merge( $module, $module_extra );
				$_module = $module;
				array_push($modules, $_module);

			endforeach;

		elseif($post['post_type'] == 'teams') :

			$module = array(
				'layout' 		  => 'page',
				'title'           => get_the_title( $post['ID'] ), // $post['post_title'],
				'slug'            => $post['post_name'], // $post['post_title'],
				'type'            => $post['post_type'],
				'content'         => apply_filters( 'the_content', $post['post_content'] ),
				'parent'          => (int) $post['post_parent'],
				'link'            => get_permalink( $post['ID'] ),
				'images'		  => $this->prepare_images(get_post_thumbnail_id($post['ID'])),
				'next'		  	  => $this->prepare_next($post['ID']),
				'previous'		  => $this->prepare_previous($post['ID']),
				'viewed'		  => false,
				'artists' 		  => $this->cartogram_prepare_artists(get_field('artists', $post['ID'])),
				'newest_member'   => $this->cartogram_prepare_artists(get_field('newest_member', $post['ID'])),
			);

			$_module = $module;
			array_push($modules, $_module);

		else :
		endif;

		return $modules;


	}

	/**
	* Retrieve a post.
	*
	* @uses get_post()
	* @param int $id Post ID
	* @param array $fields Post fields to return (optional)
	* @return array Post entity
	*/

	public function get_post( $id, $context = 'view' ) {
		$id = (int) $id;

		if ( empty( $id ) ) {
			return new WP_Error( 'json_post_invalid_id', __( 'Invalid post ID.' ), array( 'status' => 404 ) );
		}

		$post = get_post( $id, ARRAY_A );

		if ( empty( $post['ID'] ) ) {
			return new WP_Error( 'json_post_invalid_id', __( 'Invalid post ID.' ), array( 'status' => 404 ) );
		}



		// Link headers (see RFC 5988)

		$response = new WP_JSON_Response();
		$response->header( 'Last-Modified', mysql2date( 'D, d M Y H:i:s', $post['post_modified_gmt'] ) . 'GMT' );

		$post = $this->cartogram_prepare_post( $post, $context );

		if ( is_wp_error( $post ) ) {
			return $post;
		}



		$response->link_header( 'alternate',  get_permalink( $id ), array( 'type' => 'text/html' ) );
		$response->set_data( $post );

		return $response;
	}



	/**
	* Prepares post data for return in an XML-RPC object.
	*
	* @access protected
	*
	* @param array $post The unprepared post data
	* @param string $context The context for the prepared post. (view|view-revision|edit|embed)
	* @return array The prepared post data
	*/

	protected function cartogram_prepare_post( $post, $context = 'view' ) {
		// holds the data for this post. built up based on $fields
		$_post = array( 'ID' => (int) $post['ID'] );

		$post_type = get_post_type_object( $post['post_type'] );

		$previous_post = null;
		if ( ! empty( $GLOBALS['post'] ) ) {
			$previous_post = $GLOBALS['post'];
		}
		$post_obj = get_post( $post['ID'] );

		$GLOBALS['post'] = $post_obj;
		setup_postdata( $post_obj );

		$acf_modules = $this->cartogram_prepare_acf_modules($post['ID']);
		$modules = $this->cartogram_prepare_modules($post);

		$modules = array_merge( $acf_modules, $modules );

		// prepare common post fields
		$post_fields = array(
			'modules'		  => $modules,
			'title'           => get_the_title( $post['ID'] ), // $post['post_title'],
			'slug'            => $post['post_name'], // $post['post_title'],
			'type'            => $post['post_type'],
			'content'         => apply_filters( 'the_content', $post['post_content'] ),
			'parent'          => (int) $post['post_parent'],
			'link'            => get_permalink( $post['ID'] ),
			'images'		  => $this->prepare_images(get_post_thumbnail_id($post['ID'])),
			'next'		  	  => $this->prepare_next($post['ID']),
			'previous'		  => $this->prepare_previous($post['ID']),
			'viewed'		  => false,

		);

		$post_fields_extended = array(
			'slug'           => $post['post_name'],
			'guid'           => apply_filters( 'get_the_guid', $post['guid'] ),
			'menu_order'     => (int) $post['menu_order'],
			'comment_status' => $post['comment_status'],
			'ping_status'    => $post['ping_status'],
			'sticky'         => ( $post['post_type'] === 'post' && is_sticky( $post['ID'] ) ),
		);


		// Merge requested $post_fields fields into $_post
		$_post = array_merge( $_post, $post_fields );

		return apply_filters( 'cartogram_prepare_post', $_post);
	}


	/**
	* Retrieve a page by path name
	*
	* @param string $path
	* @param string $type
	*/
	public function cartogram_get_module( $page, $module, $context = 'view' ) {
		$post = get_page_by_path( $page, ARRAY_A, 'page' );

		if ( empty( $post ) ) {
			return new WP_Error( 'json_post_invalid_id', __( 'Invalid post ID.' ), array( 'status' => 404 ) );
		}

		return $this->get_module( $post['ID'], $module);
	}



	/**
	* Retrieve a post.
	*
	* @uses get_post()
	* @param int $id Post ID
	* @param array $fields Post fields to return (optional)
	* @return array Post entity
	*/

	public function get_module( $id, $module, $context = 'view' ) {
		$id = (int) $id;

		if ( empty( $id ) ) {
			return new WP_Error( 'json_post_invalid_id', __( 'Invalid post ID.' ), array( 'status' => 404 ) );
		}

		$_modules = get_field('modules', $id);
		$modules = array();

		foreach($_modules as $_module):
			if($_module['acf_fc_layout'] == $module) :

				$modules = $_module;

			endif;

		endforeach;

		// Link headers (see RFC 5988)

		$response = new WP_JSON_Response();


		$response->link_header( 'alternate',  get_permalink( $id ), array( 'type' => 'text/html' ) );
		$response->set_data( $modules );

		return $response;
	}

}
