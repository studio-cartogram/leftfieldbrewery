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

		$routes[ $this->base .  '/menu/(?P<menu>.+)'] = array(
			array( array( $this, 'cartogram_get_navigation'), WP_JSON_Server::READABLE ),
		);

		$routes[ $this->base .  '/page/(?P<page>.+)/(?P<module>.+)'] = array(
			array( array( $this, 'cartogram_get_module'), WP_JSON_Server::READABLE ),
		);

		$routes[ $this->base .  '/(?P<type>.+)'] = array(
			array( array( $this, 'cartogram_get_posts'), WP_JSON_Server::READABLE ),
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
	* Prepare Post Custom Fields
	*
	* @access public
	* @param int $id Post ID
	*/

	public function cartogram_prepare_acf(  $id ) {

        $location = get_field('location');

            $acf = array(
                'address'             => $location[address],
                'latitude'            => floatval($location[lat]),
                'longitude'           => floatval($location[lng]),
                'neighborhood'       => get_field('neighborhood')
    		);


		return $acf;
	}

	/**
	* Prepare Post Custom Fields Raw
	*
	* @access public
	* @param int $id Post ID
	*/

	public function cartogram_prepare_acf_raw(  $id ) {
		if( get_fields($id) ) {
			$acf = get_fields($id);

			return $acf;
		}
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
     * Retrieve posts.
     *
     * @since 3.4.0
     *
     * The optional $filter parameter modifies the query used to retrieve posts.
     * Accepted keys are 'post_type', 'post_status', 'number', 'offset',
     * 'orderby', and 'order'.
     *
     * The optional $fields parameter specifies what fields will be included
     * in the response array.
     *
     * @uses wp_get_recent_posts()
     * @see WP_JSON_Posts::get_post() for more on $fields
     * @see get_posts() for more on $filter values
     *
     * @param array $filter Parameters to pass through to `WP_Query`
     * @param string $context
     * @param string|array $type Post type slug, or array of slugs
     * @param int $page Page number (1-indexed)
     * @return stdClass[] Collection of Post entities
     */
    public function cartogram_get_posts( $filter = array(), $context = 'view', $type = 'post', $page = 1 ) {
        $query = array();

        // Validate post types and permissions
        $query['post_type'] = array();

        foreach ( (array) $type as $type_name ) {
            $post_type = get_post_type_object( $type_name );

            if ( ! ( (bool) $post_type ) || ! $post_type->show_in_json ) {
                return new WP_Error( 'json_invalid_post_type', sprintf( __( 'The post type "%s" is not valid' ), $type_name ), array( 'status' => 403 ) );
            }

            $query['post_type'][] = $post_type->name;
        }

        global $wp;

        // Allow the same as normal WP
        $valid_vars = apply_filters('query_vars', $wp->public_query_vars);

        // If the user has the correct permissions, also allow use of internal
        // query parameters, which are only undesirable on the frontend
        //
        // To disable anyway, use `add_filter('json_private_query_vars', '__return_empty_array');`

        if ( current_user_can( $post_type->cap->edit_posts ) ) {
            $private = apply_filters( 'json_private_query_vars', $wp->private_query_vars );
            $valid_vars = array_merge( $valid_vars, $private );
        }

        // Define our own in addition to WP's normal vars
        $json_valid = array( 'posts_per_page' );
        $valid_vars = array_merge( $valid_vars, $json_valid );

        // Filter and flip for querying
        $valid_vars = apply_filters( 'json_query_vars', $valid_vars );
        $valid_vars = array_flip( $valid_vars );

        // Exclude the post_type query var to avoid dodging the permission
        // check above
        unset( $valid_vars['post_type'] );

        foreach ( $valid_vars as $var => $index ) {
            if ( isset( $filter[ $var ] ) ) {
                $query[ $var ] = apply_filters( 'json_query_var-' . $var, $filter[ $var ] );
            }
        }

        // Special parameter handling
        $query['paged'] = absint( $page );
        $query['posts_per_page'] = -1;

        $post_query = new WP_Query();
        $posts_list = $post_query->query( $query );
        $response   = new WP_JSON_Response();
        $response->query_navigation_headers( $post_query );

        if ( ! $posts_list ) {
            $response->set_data( array() );
            return $response;
        }

        // holds all the posts data
        $struct = array();

        $response->header( 'Last-Modified', mysql2date( 'D, d M Y H:i:s', get_lastpostmodified( 'GMT' ), 0 ).' GMT' );

        foreach ( $posts_list as $post ) {
            $post = get_object_vars( $post );

            $response->link_header( 'item', json_url( '/posts/' . $post['ID'] ), array( 'title' => $post['post_title'] ) );
            $post_data = $this->cartogram_prepare_post( $post, $context );
            if ( is_wp_error( $post_data ) ) {
                continue;
            }

            $struct[] = $post_data;
        }
        $response->set_data( $struct );
        $result = array(
            'result' => $response
        );
        return $result;
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
		$_post = array( 'id' => (int) $post['ID'] );

		$post_type = get_post_type_object( $post['post_type'] );

		$previous_post = null;
		if ( ! empty( $GLOBALS['post'] ) ) {
			$previous_post = $GLOBALS['post'];
		}
		$post_obj = get_post( $post['ID'] );

		$GLOBALS['post'] = $post_obj;
		setup_postdata( $post_obj );

		// prepare common post fields
		$post_fields = array(
			'name'           => get_the_title( $post['ID'] ), // $post['post_title'],
			'slug'            => $post['post_name'], // $post['post_title'],
		);

		$_post = array_merge( $_post, $post_fields );
		$acf = $this->cartogram_prepare_acf($post['ID']);
		$_post = array_merge( $_post, $acf );

		return apply_filters( 'cartogram_prepare_post', $_post);
	}


}
