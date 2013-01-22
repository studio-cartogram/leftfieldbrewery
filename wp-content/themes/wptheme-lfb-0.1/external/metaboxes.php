<?php
 
	/* ========================================================================================================================
	
	Cartogram MetaBoxes v.1.0
	
	======================================================================================================================== */

	$prefix = "_cartogram_";

	$home_slideshow_options = array(
		
			"in_slideshow" => array(
	    	"type" => "checkbox",
			"name" => $prefix."in_home_slideshow",
	    	"std" => "",
	    	"title" => __('Include in Home Page Slideshow','cartogram'),
	    	"description" => __('Display this in the home page slideshow.','cartogram'))	
	);


	$product_options = array(
	    	"on_hompage" => array(
	    	"type" => "checkbox",
			"name" => $prefix."on_hompage",
	    	"std" => "",
	    	"title" => __('Homepage Bottom','cartogram'),
	    	"description" => __('Display on the Homepage.','cartogram')),

			"tagline" => array(
	    	"type" => "textfield",
			"name" => $prefix."tagline",
	    	"std" => "",
	    	"title" => __('Tagline','cartogram'),
	    	"description" => __('Enter the tagline of this product.','cartogram')),

	    	"in_clearance" => array(
	    	"type" => "checkbox",
			"name" => $prefix."in_clearance",
	    	"std" => "",
	    	"title" => __('Clearance','cartogram'),
	    	"description" => __('Display in the Clearance section.','cartogram'))
	);
	$database_options = array(
	    	"architonic_source" => array(
	    	"type" => "textfield",
			"name" => $prefix."architonic_source",
	    	"std" => "",
	    	"title" => __('Architonic Source','cartogram'),
	    	"description" => __('Paste the Architonic Source into the field above.','cartogram'))
	);
		////////////// galleries metaboxes //////////////
	$gallery_options = array (


	    	"recently_updated" => array(
		    	"type" => "checkbox",
				"name" => $prefix."recently_updated",
		    	"std" => "",
		    	"title" => __('Recently Updated:','cartogram'),
		    	"description" => __('Check if recently updated.','cartogram')),

	    	"just_added" => array(
		    	"type" => "checkbox",
				"name" => $prefix."just_added",
		    	"std" => "true",
		    	"title" => __('Just added/New:','cartogram'),
		    	"description" => __('Uncheck this gallery if no longer new.','cartogram')),
	    	);
	$program_options = array(

////////////// info for browsing programs page //////////////
			"fashion_level_description" => array(
		    	"type" => "textfield",
				"name" => $prefix."fashion_level_description",
		    	"std" => "",
		    	"title" => __('Fashion Level Description:','cartogram'),
		    	"description" => __('This will be the first header when you view a program. Ex. "Fashion Level 1"','cartogram')),

	    	"spaces_available" => array(
		    	"type" => "checkbox",
				"name" => $prefix."spaces_available",
		    	"std" => "",
		    	"title" => __('Spaces Available:','cartogram'),
		    	"description" => __('Check if spaces are available.','cartogram')),

	    	"just_added" => array(
		    	"type" => "checkbox",
				"name" => $prefix."just_added",
		    	"std" => "true",
		    	"title" => __('Just added/New:','cartogram'),
		    	"description" => __('Uncheck this box once this progarm is no longer new.','cartogram')),




////////////// Monday //////////////
	    	"monday_start" => array(
		    	"type" => "textfield",
				"name" => $prefix."monday_start",
		    	"std" => "",
		    	"title" => __('Monday Start Time:','cartogram'),
		    	"description" => __('monday start time','cartogram')),
	    	"monday_end" => array(
		    	"type" => "textfield",
				"name" => $prefix."monday_end",
		    	"std" => "",
		    	"title" => __('Monday End Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"monday_closed" => array(
		    	"type" => "checkbox",
				"name" => $prefix."monday_closed",
		    	"std" => "",
		    	"title" => __('Monday Closed:','cartogram'),
		    	"description" => __('Check this off is you are closed Monday.','cartogram')),
	    	

////////////// Tuesday //////////////
	    	"tuesday_start" => array(
		    	"type" => "textfield",
				"name" => $prefix."tuesday_start",
		    	"std" => "",
		    	"title" => __('Tuesday Start Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"tuesday_end" => array(
		    	"type" => "textfield",
				"name" => $prefix."tuesday_end",
		    	"std" => "",
		    	"title" => __('Tuesday End Time:','cartogram'),
		    	"description" => __('','cartogram')),
			"tuesday_closed" => array(
		    	"type" => "checkbox",
				"name" => $prefix."tuesday_closed",
		    	"std" => "",
		    	"title" => __('Tuesday Closed:','cartogram'),
		    	"description" => __('Check this off is you are closed Tuesday.','cartogram')),
	    	

////////////// Wednesday //////////////
	    	"wednesday_start" => array(
		    	"type" => "textfield",
				"name" => $prefix."wednesday_start",
		    	"std" => "wednesday",
		    	"title" => __('Wednesday Start Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"wednesday_end" => array(
		    	"type" => "textfield",
				"name" => $prefix."wednesday_end",
		    	"std" => "wednesday",
		    	"title" => __('Wednesday End Time:','cartogram'),
		    	"description" => __('','cartogram')),
			"wednesday_closed" => array(
		    	"type" => "checkbox",
				"name" => $prefix."wednesday_closed",
		    	"std" => "",
		    	"title" => __('Wednesday Closed:','cartogram'),
		    	"description" => __('Check this off is you are closed Wednesday.','cartogram')),
	    	

////////////// Thursday //////////////
	    	"thursday_start" => array(
		    	"type" => "textfield",
				"name" => $prefix."thursday_start",
		    	"std" => "",
		    	"title" => __('Thursday Start Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"thursday_end" => array(
		    	"type" => "textfield",
				"name" => $prefix."thursday_end",
		    	"std" => "",
		    	"title" => __('Thursday End Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"thursday_closed" => array(
		    	"type" => "checkbox",
				"name" => $prefix."thursday_closed",
		    	"std" => "",
		    	"title" => __('Thursday Closed:','cartogram'),
		    	"description" => __('Check this off is you are closed Thursday.','cartogram')),
	    	
////////////// Friday //////////////
	    	"friday_start" => array(
		    	"type" => "textfield",
				"name" => $prefix."friday_start",
		    	"std" => "",
		    	"title" => __('Friday Start Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"friday_end" => array(
		    	"type" => "textfield",
				"name" => $prefix."friday_end",
		    	"std" => "",
		    	"title" => __('Friday End Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"friday_closed" => array(
		    	"type" => "checkbox",
				"name" => $prefix."friday_closed",
		    	"std" => "",
		    	"title" => __('Friday Closed:','cartogram'),
		    	"description" => __('Check this off is you are closed Friday.','cartogram')),
	    	

////////////// Saturday //////////////
	    	"saturday_start" => array(
		    	"type" => "textfield",
				"name" => $prefix."saturday_start",
		    	"std" => "",
		    	"title" => __('Saturday Start Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"saturday_end" => array(
		    	"type" => "textfield",
				"name" => $prefix."saturday_end",
		    	"std" => "",
		    	"title" => __('Saturday End Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"saturday_closed" => array(
		    	"type" => "checkbox",
				"name" => $prefix."saturday_closed",
		    	"std" => "",
		    	"title" => __('Saturday Closed:','cartogram'),
		    	"description" => __('Check this off is you are closed Saturday.','cartogram')),
	    	

////////////// Sunday //////////////
	    	"sunday_start" => array(
		    	"type" => "textfield",
				"name" => $prefix."sunday_start",
		    	"std" => "",
		    	"title" => __('Sunday Start Time:','cartogram'),
		    	"description" => __('','cartogram')),	    	
	    	"sunday_end" => array(
		    	"type" => "textfield",
				"name" => $prefix."sunday_end",
		    	"std" => "",
		    	"title" => __('Sunday End Time:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"sunday_closed" => array(
		    	"type" => "checkbox",
				"name" => $prefix."sunday_closed",
		    	"std" => "",
		    	"title" => __('Sunday Closed:','cartogram'),
		    	"description" => __('Check this off is you are closed Sunday.','cartogram')),
	    	
////////////// Important Dates //////////////
	    	"important_date_1" => array(
		    	"type" => "textfield",
				"name" => $prefix."important_date_1",
		    	"std" => "",
		    	"title" => __('Important Date:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"important_date_2" => array(
		    	"type" => "textfield",
				"name" => $prefix."important_date_2",
		    	"std" => "",
		    	"title" => __('Important Date:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"important_date_3" => array(
		    	"type" => "textfield",
				"name" => $prefix."important_date_3",
		    	"std" => "",
		    	"title" => __('Important Date:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"important_date_4" => array(
		    	"type" => "textfield",
				"name" => $prefix."important_date_4",
		    	"std" => "",
		    	"title" => __('Important Date:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"important_date_5" => array(
		    	"type" => "textfield",
				"name" => $prefix."important_date_5",
		    	"std" => "",
		    	"title" => __('Important Date:','cartogram'),
		    	"description" => __('','cartogram')),
	    	"important_date_6" => array(
		    	"type" => "textfield",
				"name" => $prefix."important_date_6",
		    	"std" => "",
		    	"title" => __('Important Date:','cartogram'),
		    	"description" => __('','cartogram')),

	);

	$program_schedule = array(
	    	
	);
	$meta_box_groups = array($home_slideshow_options, $product_options, $database_options, $program_options);

	function new_meta_box($post, $metabox) {	
		
		$meta_boxes_inputs = $metabox['args']['inputs'];

		foreach($meta_boxes_inputs as $meta_box) {
		
			$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
			if($meta_box_value == "") $meta_box_value = $meta_box['std'];
			
			echo'<div class="meta-field">';
			
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			
			echo'<p><strong>'.$meta_box['title'].'</strong></p>';
			
			if(isset($meta_box['type']) && $meta_box['type'] == 'checkbox') {
			
				if($meta_box_value == 'true') {
					$checked = "checked=\"checked\"";
				} elseif($meta_box['std'] == "true") {	
						$checked = "checked=\"checked\"";	
				} else {
						$checked = "";
				}
			
				echo'<p><input type="checkbox" class="meta-radio" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="true" '.$checked.' /> ';		
				echo'<label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';		
			
			} elseif(isset($meta_box['type']) && $meta_box['type'] == 'textarea')  {			
				
				echo'<textarea rows="4" style="width:98%" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';			
				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
			
			} elseif(isset($meta_box['type']) && $meta_box['type'] == 'textfield')  {			
				
				echo'<input type="textfield"'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'"></input>';			
			
			} else {
				
				echo'<p><input style="width:70%"type="text" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" />';		
				echo'<label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
			
			}
			
			echo'</div>';
			
		} // end foreach
			
		echo'<br style="clear:both" />';
		
	} // end meta boxes

	function create_meta_box() {	
		global $home_slideshow_options, $product_options, $database_options, $program_options, $gallery_options;	
		
		if ( function_exists('add_meta_box') ) {				
			add_meta_box( 'new-meta-boxes-home-slideshow', __('Home Slideshow Options','cartogram'), 'new_meta_box', 'products', 'normal', 'high', array('inputs'=>$home_slideshow_options) );
			add_meta_box( 'new-meta-boxes-video', __('Product Options','cartogram'), 'new_meta_box', 'products', 'normal', 'high', array('inputs'=>$product_options) );
			add_meta_box( 'new-meta-boxes-video', __('Architonic Options','cartogram'), 'new_meta_box', 'page', 'normal', 'high', array('inputs'=>$database_options) );
			add_meta_box( 'new-meta-boxes-video', __('Program Options','cartogram'), 'new_meta_box', 'Programs', 'normal', 'high', array('inputs'=>$program_options) );
			add_meta_box( 'new-meta-boxes-video', __('Gallery Options','cartogram'), 'new_meta_box', 'Galleries', 'normal', 'high', array('inputs'=>$gallery_options) );

		}
	}



	function save_postdata( $post_id ) {
	global $post, $new_meta_boxes, $meta_box_groups;

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if( defined('DOING_AJAX') && DOING_AJAX ) { //Prevents the metaboxes from being overwritten while quick editing.
		return $post_id;
	}

	if( ereg('/\edit\.php', $_SERVER['REQUEST_URI']) ) { //Detects if the save action is coming from a quick edit/batch edit.
		return $post_id;
	}

	foreach($meta_box_groups as $group) {
		foreach($group as $meta_box) {

			// Verify
			if(isset($_POST[$meta_box['name'].'_noncename'])){
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
					return $post_id;
				}
			}

			if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ))
					return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
			}

			$data = "";
			if(isset($_POST[$meta_box['name'].'_value'])){
				$data = $_POST[$meta_box['name'].'_value'];
			}

			if(get_post_meta($post_id, $meta_box['name'].'_value') == "") 
				add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
				update_post_meta($post_id, $meta_box['name'].'_value', $data);
			elseif($data == "" || $data == $meta_box['std'] )
				delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));

			} // end foreach
		} // end foreach
	} // end save_postdata


	add_action('admin_menu', 'create_meta_box');
	add_action('save_post', 'save_postdata');
	
