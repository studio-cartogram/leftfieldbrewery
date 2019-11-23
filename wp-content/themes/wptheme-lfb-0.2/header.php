<?php
$announcement_visible = get_field('announcement_visible', 'options');
$announcement_text = get_field('announcement_text', 'options');
$announcement_link = get_field('announcement_link', 'options');
$announcement_button_text = get_field('announcement_button_text', 'options');

if ($announcement_visible) :
  echo '<a href="' . $announcement_link . '" class="heading heading--3 container hide-for-small announcement">';
    echo '<span class="announcement__text">';
      echo $announcement_text;
      echo '<span class="button button--small announcement__button">' . $announcement_button_text . '</span>';
    echo '</span>';
  echo '</a>';
else:
  echo '<section class="container hide-for-small bordered-main banner">';
    echo '<div class="row">';
      echo '<div class="columns bg-main twelve"></div>';
    echo '</div>';
  echo '</section>';
endif;

?>

<section class="container hide-for-small" id="container-header">
  <header class="row text-center">
    <div class="columns four mobile-two text-right">
      <h2 class="header-text">
        36 WAGSTAFF DRIVE<br/>
        TORONTO&mdash;CANADA
      </h2>
    </div>
    <hgroup class="columns four ">
      <a class="logo" href=<?php bloginfo( 'url' ); ?>>
        <img class="logo__image"  src="<?php bloginfo('template_directory') ?>/dist/images/logo-bg.svg" />
      </a>
    </hgroup>
    <div class="columns four mobile-two text-left">
    <h2 class="header-text">
      <!-- Open Daily<br/> -->
      THURS&mdash;SAT&nbsp;&nbsp;11AM&mdash;11PM<br/>
      SUN&mdash;WED&nbsp;&nbsp;11AM&mdash;9PM
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
