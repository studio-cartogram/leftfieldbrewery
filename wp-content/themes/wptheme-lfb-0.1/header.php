<section class="container">
	<header class="row">
		<hgroup class="columns four">
			<h1><a href=<?php bloginfo( 'url' ); ?>><?php bloginfo( 'name' ); ?></a></h1>
		</hgroup>
		<div class="columns eight">
			<h2><?php bloginfo( 'description' ); ?></h2>
		</div>
	</header>
	<div class="row">	
		<div class="columns nine">
			<?php $headernav = array(
				'theme_location'  => 'main',
				'container'       => 'nav', 
				'container_class' => 'nav', 
				'menu_class'      => 'nav-bar', 
				'menu_id'         => 'main',
				'echo'            => true,
				'fallback_cb'     => '',
				'walker' => new foundation_nav
			); 
				wp_nav_menu( $headernav ); 
			?>
		</div>	
	</div>
</section>