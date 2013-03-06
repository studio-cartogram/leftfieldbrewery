<section class="container hide-for-small bordered-main banner">
  <div class="row ">
    <div class="columns bg-main twelve"></div>
  </div>
</section>
<section class="container hide-for-small" id="container-header">
	<header class="row text-center">
		<div class="columns four mobile-two text-right">
			<h2 class="header-text">Toronto <span class="split">◆</span> Canada</h2>
		</div>
		<hgroup class="columns four ">
			<h1><a class="icon-logo" href=<?php bloginfo( 'url' ); ?>></a></h1>
		</hgroup>
		<div class="columns four mobile-two text-left">
			<h2 class="header-text">Est. 2013</h2>
		</div>
	</header>
</section>	
<section class="container " id="container-navigation">
	<div class="row">	
		<div class="columns twelve ">
			<nav class="top-bar ">
				<ul class="show-for-small">
					<li class="name"><h1 class="collapse-inner"><a class="icon-wordmark" href="#"></a></h1></li>
					<li class="toggle-topbar"><a href="#"></a></li>
				 </ul>
				  <section class="">
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