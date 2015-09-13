<div id="nav-social-wrap" class="columns three rule">
	<div class="row">
		<div class="columns nine">	
			<?php $globalnav = array(
				'theme_location'  => 'social',
				'container'       => 'false', 
				'menu_class'      => 'nav-skew', 
				'menu_id'         => 'nav-social',
				'echo'            => true,
				'fallback_cb'     => ''
				); 
				wp_nav_menu( $globalnav ); 
			?>
		</div>
	</div>
	<div class="row pattern">
	</div>
</div>
<div id="nav-global-wrap" class="columns six">
    <?php $globalnav = array(
		'theme_location'  => 'global',
		'container'       => 'true', 
		'menu_class'      => 'nav nav-global block-grid six-up', 
		'menu_id'         => 'nav-global',
		'echo'            => true,
		'fallback_cb'     => ''
		); 
		wp_nav_menu( $globalnav );
	?>
</div>
















