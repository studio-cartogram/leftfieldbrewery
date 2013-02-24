<?php
	/* ========================================================================================================================
	
	Cartogram Utility Functions v.1.0

	We've included a number of helper functions that we use in every theme we produce. 

	The main one is 'add_slug_to_body_class', this will add the page or post slug to the body class
	
	======================================================================================================================== */

	/**
	 * Print a pre formatted array to the browser - very useful for debugging
	 *
	 **/
	function print_a( $a ) {
		print( '<pre>' );
		print_r( $a );
		print( '</pre>' );
	}

	/**
	 * Simple wrapper for native get_template_part()
	 * Allows you to pass in an array of parts and output them in your theme
	 * e.g. <?php get_template_parts(array('part-1', 'part-2')); ?>
	 *
	 **/
	function get_template_parts( $parts = array() ) {
		foreach( $parts as $part ) {
			get_template_part( $part );
		};
	}

	/**
	 * Pass in a path and get back the page ID
	 * e.g. get_page_id_from_path('about/terms-and-conditions');
	 *
	 **/
	function get_page_id_from_path( $path ) {
		$page = get_page_by_path( $path );
		if( $page ) {
			return $page->ID;
		} else {
			return null;
		};
	}

	/**
	 * Append page slugs to the body class
	 * NB: Requires init via add_filter('body_class', 'add_slug_to_body_class');
	 *
	 */
	function add_slug_to_body_class( $classes ) {
		global $post;
	   
		if( is_home() ) {			
			$key = array_search( 'blog', $classes );
			if($key > -1) {
				unset( $classes[$key] );
			};
		} elseif( is_page() ) {
			$classes[] = sanitize_html_class( $post->post_name );
		} elseif(is_singular()) {
			$classes[] = sanitize_html_class( $post->post_name );
		};

		return $classes;
	}
	
	/**
	 * Get the category id from a category name
	 *
	 */
	function get_category_id( $cat_name ){
		$term = get_term_by( 'name', $cat_name, 'category' );
		return $term->term_id;
	}

	/**
	 * Check for pagination
	 *
	 */
	function is_paginated(){
		global $wp_query;
		$total = $wp_query->max_num_pages ; 
	    if ($total > 1) : 
	        return true;
	    endif;
	}

	/**
	 * Change the ellipsis, remove square brackets
	 *
	 */
	function excerpt_ellipsis($text) {
		return str_replace('[...]', '<a href="'. get_permalink($post->ID) . '">' . '&raquo; Read More.' . '</a>', $text);
	}

	/**
	 * Remove the more link hash from defaul more link
	 *
	 */
	 function cartogram_remove_more_link($content) {
		global $id;
		return str_replace('#more-'.$id.'"', '"', $content);
	}

	/**
	 * Custom More Link
	 *
	 */
	 function more_link() {
		global $post;	
		$more_link = '<p class="moreLink"><a href="'.get_permalink().'" title="'.get_the_title().'">';
		$more_link .= '<span>Read More</span>';
		$more_link .= '</a></p>';
		echo $more_link;	
	}
	
	/**
	 * Custom Share Links
	 *
	 */
	function cartogram_share() { 
	global $post;
		//http://atlchris.com/1665/how-to-create-custom-share-buttons-for-all-the-popular-social-services/
		$twitter = '<a target="_blank" href="http://twitter.com/home?status=' . get_the_title() . '+' . get_permalink() . '"><i class="foundsocialicon-twitter"></i></a>';
		$facebook = '<a target="_blank" href="http://www.facebook.com/share.php?u=' . get_permalink() . '&title='  . get_the_title() . '"><i class="foundsocialicon-facebook"></i></a>';
		$mail = '<a href="mailto:?subject=' . get_the_title() . ' at ' . get_permalink() . '"><i class="foundicon-mail"></i></a>';
		$content .= '<ul class="link-list social icons"><li>' . $twitter . '</li><li>' . $facebook . '</li><li>' . $mail . '</li></ul>';
		echo $content;
	}
	/**
	 * Add custom taxonomies to the post class
	 *
	 */

    add_filter( 'post_class', 'custom_taxonomy_post_class', 10, 3 );

    if( !function_exists( 'custom_taxonomy_post_class' ) ) {

        function custom_taxonomy_post_class( $classes, $class, $ID ) {

			$taxonomies = array('type');

			foreach ($taxonomies as $taxonomy) {	 

	            $terms = get_the_terms( (int) $ID, $taxonomy );

	            if( !empty( $terms ) ) {

	                foreach( (array) $terms as $order => $term ) {

	                    if( !in_array( $term->slug, $classes ) ) {

	                        $classes[] = $term->slug;

	                    }

	                }

	            }
	        }

            return $classes;

        }

    }
	
