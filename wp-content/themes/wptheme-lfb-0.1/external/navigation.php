<?php
	/* ========================================================================================================================
	
	Cartogram Navigation v.1.0
	
	======================================================================================================================== */

	add_theme_support('menus');

	/**
	 * Button Shortcode
	 *
	 */
	function cartogram_button($a) {
		extract(shortcode_atts(array(
			'label' 	=> 'Button Text',
			'id' 	=> '1',
			'url'	=> '',
			'target' => '_parent',		
			'size'	=> '',
			'ptag'	=> false
		), $a));
		
		$link = $url ? $url : get_permalink($id);	
		
		if($ptag) :
			return  wpautop('<a href="'.$link.'" target="'.$target.'" class="button '.$size.'">'.$label.'</a>');
		else :
			return '<a href="'.$link.'" target="'.$target.'" class="button '.$size.'">'.$label.'</a>';
		endif;
	
	}

	/**
	 * Foundation Navigation Walker for dropdown flyout navigation
	 *
	 */
	class foundation_nav extends Walker_Nav_Menu{
		function start_lvl(&$output, $depth) {
		    $indent = str_repeat("\t", $depth);
		    $output .= "\n$indent<ul class=\"flyout\">\n";
		  }
		
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

			if ( !$element )
				return;

			$id_field = $this->db_fields['id'];

			//display this element
			if ( is_array( $args[0] ) )
				$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );

			//Adds the 'parent' class to the current item if it has children
			if( ! empty( $children_elements[$element->$id_field] ) )
				array_push($element->classes,'has-flyout');

			$cb_args = array_merge( array(&$output, $element, $depth), $args);

			call_user_func_array(array(&$this, 'start_el'), $cb_args);

			$id = $element->$id_field;

			// descend only when the depth is right and there are childrens for this element
			if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

				foreach( $children_elements[ $id ] as $child ){

					if ( !isset($newlevel) ) {
						$newlevel = true;
						//start the child delimiter
						$cb_args = array_merge( array(&$output, $depth), $args);
						call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
					}
					$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
				}
				unset( $children_elements[ $id ] );
			}

			if ( isset($newlevel) && $newlevel ){
				//end the child delimiter
				$cb_args = array_merge( array(&$output, $depth), $args);
				call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
			}

			//end this element
			$cb_args = array_merge( array(&$output, $element, $depth), $args);
			call_user_func_array(array(&$this, 'end_el'), $cb_args);
		}
	}

	add_filter('nav_menu_css_class','add_parent_css',10,2);

	function  add_parent_css($classes, $item){
	     global  $dd_depth, $dd_children;
	     $classes[] = 'depth'.$dd_depth;
	     if($dd_children)
	         $classes[] = 'has-flyout';
	    return $classes;
	}


	/**
	 * Filter Navigation Walker for dropdown isotope filtering via description field in the wordpress backend
	 *
	 */
	class filter_nav extends Walker_Nav_Menu {
	    /**
	     * Start the element output.
	     *
	     * @param  string $output Passed by reference. Used to append additional content.
	     * @param  object $item   Menu item data object.
	     * @param  int $depth     Depth of menu item. May be used for padding.
	     * @param  array $args    Additional strings.
	     * @return void
	     */
	    function start_el(&$output, $item, $depth, $args)
	    {
	        $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

	        $class_names = join(
	            ' '
	        ,   apply_filters(
	                'nav_menu_css_class'
	            ,   array_filter( $classes ), $item
	            )
	        );

	        ! empty ( $class_names )
	            and $class_names = ' class="'. esc_attr( $class_names ) . '"';

	        $output .= "<li id='menu-item-$item->ID' $class_names>";

	        $attributes  = '';
	        
	        ! empty( $item->attr_title )
	            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
	        ! empty( $item->target )
	            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
	        ! empty( $item->xfn )
	            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
	        ! empty( $item->url )
	            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

	        // insert description for top level elements only
	        // you may change this
	        $description = ( ! empty ( $item->description ))
	            ?  $attributes .= ' data-filter="'  . esc_attr( $item->description ) .'"' : '';

	        $title = apply_filters( 'the_title', $item->title, $item->ID );

	        $item_output = $args->before
	            . "<a $attributes>"
	            . $args->link_before
	            . $title
	            . '</a> '
	            . $args->link_after
	            . $args->after;

	        // Since $output is called by reference we don't need to return anything.
	        $output .= apply_filters(
	            'walker_nav_menu_start_el'
	        ,   $item_output
	        ,   $item
	        ,   $depth
	        ,   $args
	        );
	    }
	}

	/**
	 * Proper Nav Fall Back
	 *
	 */
	function default_nav() {
		require_once (TEMPLATEPATH . '/parts/navigation/fallback.php');
	}


?>