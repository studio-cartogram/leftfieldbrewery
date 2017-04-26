<?php

$nav_tabs = array(
  'theme_location'  => 'beers',
  'container'       => false,
  'items_wrap'      => '%3$s',
);

echo '<nav class="tabsnav">';

  echo '<ul class="tabsnav__nav">';

    wp_nav_menu( $nav_tabs );

  echo '</ul>';

echo '</nav>';

?>
