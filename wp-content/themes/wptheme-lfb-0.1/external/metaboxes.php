<?php
 
	/* ========================================================================================================================
	
	Cartogram MetaBoxes v.1.0
	
	======================================================================================================================== */

	$prefix = "_cartogram_";


	$vendor_options = array(
	    	"map" => array(
	    	"type" => "textfield",
			"name" => $prefix."email",
			"name" => $prefix."map",
	    	"std" => "",
	    	"title" => __('Vendor Map URL','cartogram'),
	    	"description" => __('Enter the link to the Google Map URL for this Vendor.','cartogram')
	    	),

	    	"address" => array(
	    	"type" => "textfield",
			"name" => $prefix."address",
	    	"std" => "",
	    	"title" => __('Address','cartogram'),
	    	"description" => __('Enter the quick one line address of this vendor.','cartogram')
	    	)
	);
	$players_options = array(
	
		"email" => array(
	    	"type" => "textfield",
			"name" => $prefix."email",
	    	"std" => "",
	    	"title" => __('Players contact info.','cartogram'),
	    	"description" => __('Enter email. ','cartogram')
	    ),
	    "icon" => array(
	    	"type" => "textfield",
			"name" => $prefix."icon",
	    	"std" => "",
	    	"title" => __('Player Icon.','cartogram'),
	    	"description" => __('Enter icon name. ','cartogram')
	    )
	);
	$beers_options = array(
	
		"short_description" => array(
	    	"type" => "textfield",
			"name" => $prefix."short_description",
	    	"std" => "",
	    	"title" => __('Short Description.','cartogram'),
	    	"description" => __('Enter the short description for the beer such as "Oatmeal brown ale"','cartogram')
	    ),
	    "color" => array(
	    	"type" => "textfield",
			"name" => $prefix."color",
	    	"std" => "",
	    	"title" => __('Beer Color','cartogram'),
	    	"description" => __('Enter the short description for the beer such as "Oatmeal brown ale"','cartogram')
	    ),
	    "icon" => array(
	    	"type" => "textfield",
			"name" => $prefix."icon",
	    	"std" => "",
	    	"title" => __('Beer Icon','cartogram'),
	    	"description" => __('Enter the short description for the beer such as "Oatmeal brown ale"','cartogram')
	    ),
		"alc" => array(
	    	"type" => "textfield",
			"name" => $prefix."alc",
	    	"std" => "",
	    	"title" => __('ALC./VOL.','cartogram'),
	    	"description" => __('ALC./VOL.','cartogram')
	    ),
	    "IBU" => array(
	    	"type" => "textfield",
			"name" => $prefix."IBU",
	    	"std" => "",
	    	"title" => __('IBU','cartogram'),
	    	"description" => __('IBU','cartogram')
	    ),
	    "SRM" => array(
	    	"type" => "textfield",
			"name" => $prefix."SRM",
	    	"std" => "",
	    	"title" => __('SRM','cartogram'),
	    	"description" => __('SRM','cartogram')
	    ),
	    "food_pairings" => array(
	    	"type" => "textfield",
			"name" => $prefix."food_pairings",
	    	"std" => "",
	    	"title" => __('Food Pairings','cartogram'),
	    	"description" => __('Enter food pairings.','cartogram')
	    ),
	    "mvp" => array(
	    	"type" => "checkbox",
			"name" => $prefix."mvp",
	    	"std" => "",
	    	"title" => __('MVP','cartogram'),
	    	"description" => __('Check this box if this beer is to be featured on the home page.','cartogram')
	    ),
	);

	$meta_box_groups = array($vendor_options, $players_options, $beers_options);

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
				
				echo'<input style="width:95%" type="textfield"'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'">';			
				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
			} else {
				
				echo'<p><input style="width:70%"type="text" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" />';		
				echo'<label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p><br />';			
			
			}
			
			echo'</div>';
			
		} // end foreach
			
		echo'<br style="clear:both" />';
		
	} // end meta boxes

	function create_meta_box() {	
		global $vendor_options, $players_options, $beers_options;	
		
		if ( function_exists('add_meta_box') ) {				
			add_meta_box( 'new-meta-boxes-vendors', __('Vendor Options','cartogram'), 'new_meta_box', 'vendors', 'normal', 'high', array('inputs'=>$vendor_options) );
			add_meta_box( 'new-meta-boxes-players', __('Players Options','cartogram'), 'new_meta_box', 'players', 'normal', 'high', array('inputs'=>$players_options) );
			add_meta_box( 'new-meta-boxes-beers', __('Beers Options','cartogram'), 'new_meta_box', 'beers', 'normal', 'high', array('inputs'=>$beers_options) );
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
?>