<section class="container">
	<header class="row text-center">
		<div class="columns four">
			<h2>Breweing Since 2013</h2>
		</div>
		<hgroup class="columns four">
			<h1><a href=<?php bloginfo( 'url' ); ?>><?php bloginfo( 'name' ); ?></a></h1>
		</hgroup>
		<div class="columns four">
			<h2>Toronto &bull; Canada</h2>
		</div>
	</header>
	<div class="row">	
		<div class="columns twelve">
			<nav class="top-bar">
				<ul class="show-for-small">
					<li class="name"><h1><a href="#">Left Field</a></h1></li>
					<li class="toggle-topbar"><a href="#"></a></li>
				 </ul>
				  <section>
					<?php $headernav = array(
						'theme_location'  => 'global',
						'container'       => false, 
						'menu_class'      => 'right', 
						'menu_id'         => 'global',
						'echo'            => true,
						'fallback_cb'     => '',
						'walker' => new foundation_nav
					); 
						wp_nav_menu( $headernav ); 
					?>
					<?php $socialnav = array(
						'theme_location'  => 'social',
						'container'       => false, 
						'menu_class'      => 'left', 
						'menu_id'         => 'social',
						'echo'            => true,
						'fallback_cb'     => '',
						'walker' => new foundation_nav
					); 
						wp_nav_menu( $socialnav ); 
					?>
				</section>	
			</nav>	
		</div>	
	</div>
</section>