<section class="container hide-for-small bordered-main banner">
  <div class="row ">
    <div class="columns bg-main twelve"></div>
  </div>
</section>
<section class="container hide-for-small" id="container-header">
  <header class="row text-center">
    <div class="columns four mobile-two text-right">
      <h2 class="header-text">
        36 WAGSTAFF DRIVE<br/>
        TORONTO&mdash;CANADA
      </h2>
    </div>
    <hgroup class="columns four ">
      <h1>
        <a class="logo" href=<?php bloginfo( 'url' ); ?>>
          <img class="logo__image"  src="<?php bloginfo('template_directory') ?>/dist/images/logo-bg.svg" />
        </a>
      </h1>
    </hgroup>
    <div class="columns four mobile-two text-left">
    <h2 class="header-text">
      <!-- Open Daily<br/> -->
      THURS &mdash; SAT 11AM&mdash;11PM<br/>
      SUN&mdash;WED 11AM&mdash;9PM
    </h2>
    </div>
  </header>
</section>	
<section class="container " id="container-navigation">
  <div class="row">	
    <div class="columns twelve ">
      <nav class="top-bar ">
        <ul class="show-for-small">
          <li class="name"><h1 class="collapse-inner"><a class="icon-wordmark" href="<?php bloginfo( 'url' ); ?>"></a></h1></li>
          <li class="toggle-topbar"><a href="#"></a></li>
         </ul>
          <section class="">
          <?php $headernav = array(
            'theme_location'  => 'global',
            'container'       => false, 
            'menu_class'      => 'right', 
            'menu_id'         => 'global',
            'echo'            => true,
            'fallback_cb'     => ''
          ); 
            wp_nav_menu( $headernav ); 
          ?>
          <?php $socialnav = array(
            'theme_location'  => 'social',
            'container'       => false, 
            'menu_class'      => 'left', 
            'menu_id'         => 'social',
            'echo'            => true,
            'fallback_cb'     => ''
          ); 
            wp_nav_menu( $socialnav ); 
          ?>
        </section>	
      </nav>	
    </div>	
  </div>
</section>
