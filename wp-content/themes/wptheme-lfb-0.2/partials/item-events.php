<?php

$item = get_query_var('item');

echo '<h4 class="heading--4 heading">';

  echo '<a href="'. get_the_permalink() . '">' . get_the_title($item->ID) . '</a>';
  
echo '</h4>';

?>