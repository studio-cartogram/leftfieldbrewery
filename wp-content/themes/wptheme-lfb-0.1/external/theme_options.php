<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'rsof_options', 'rsof_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'cartogram' ), __( 'Theme Options', 'cartogram' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create arrays for our select and radio options
 */
$select_options = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'Zero', 'cartogram' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'One', 'cartogram' )
	),
	'2' => array(
		'value' => '2',
		'label' => __( 'Two', 'cartogram' )
	),
	'3' => array(
		'value' => '3',
		'label' => __( 'Three', 'cartogram' )
	),
	'4' => array(
		'value' => '4',
		'label' => __( 'Four', 'cartogram' )
	),
	'5' => array(
		'value' => '3',
		'label' => __( 'Five', 'cartogram' )
	)
);

$radio_options = array(
	'yes' => array(
		'value' => 'yes',
		'label' => __( 'Yes', 'cartogram' )
	),
	'no' => array(
		'value' => 'no',
		'label' => __( 'No', 'cartogram' )
	),
	'maybe' => array(
		'value' => 'maybe',
		'label' => __( 'Maybe', 'cartogram' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'cartogram' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'cartogram' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'rsof_options' ); ?>
			<?php $options = get_option( 'rsof_theme_options' ); ?>

			<table class="form-table">
				<?php 
				//Elements in the options array are "lower_case_pothole" => array("title"=>"Nice Name for Client With Capitals",
				//																	"description"=>"Describe this field")
				$textfield_options = array ("email" => array(
												"title" => "Primary Email",
												"description" => "Enter your email."
												),
											"phone" => array(
												"title" => " Phone",
												"description" => "Enter your phone number."
												),
											);

				//Name is the string to use to reference the value int he backend
				//(inspired by forms and postings - you get the value by $_POST["name"])
				//title is the formal title for the field seen by the client
				foreach ($textfield_options as $name => $options_details) {
					$title = $options_details["title"];
					$description = $options_details["description"];
				?>
				<tr valign="top">
					<th scope="row"><?php _e( $title, 'cartogram' ); ?></th>
					<td>
						<input id="rsof_theme_options[<?php echo $name?>]" class="regular-text" type="text" name="rsof_theme_options[<?php echo $name?>]" value="<?php esc_attr_e( $options[$name] ); ?>" />
						<label class="description" for="rsof_theme_options[<?php echo $name?>]"><?php _e( $description, 'cartogram' ); ?></label>
					</td>
				</tr>
				<?php }?>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'cartogram' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['email'] = wp_filter_nohtml_kses( $input['email'] );
	$input['email2'] = wp_filter_nohtml_kses( $input['email2'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/