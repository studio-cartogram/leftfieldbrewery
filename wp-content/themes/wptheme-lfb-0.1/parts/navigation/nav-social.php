
	<?php $globalnav = array(
		'theme_location'  => 'social',
		'container'       => 'nav', 
		'container_class' => 'columns four', 
		'menu_class'      => 'no-bullet link-list', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => ''
	); 

	wp_nav_menu( $globalnav ); 
