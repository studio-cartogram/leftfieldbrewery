<?php
global $slug;

$nav_tabs = array(
  'theme_location' => $slug,
  'container' => false,
  'items_wrap' => '<nav class="tabsnav"><ul class="tabsnav__nav">%3$s</ul></nav>',
  'fallback_cb' => function() {
    global $slug;

    echo '<span class="heading heading--3 soft border-left border-right text-center">' . $slug . '</span>';
  }
);

wp_nav_menu( $nav_tabs );

?>