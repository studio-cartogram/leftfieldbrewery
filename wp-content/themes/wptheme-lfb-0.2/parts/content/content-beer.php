<?php

$item = get_query_var('item');
$icon_image = get_field('icon');
$icon = (!$icon_image && get_post_meta( $item->ID, '_cartogram_icon_value', TRUE ) ? get_post_meta( $item->ID, '_cartogram_icon_value', TRUE ) : $item->post_name);
$short_description = get_field('short_description');
$color = get_field('color');


echo '<a class="beercard col col-12 col-6-mobile col-4-tablet col-3-laptop" href="' . get_permalink($item->ID) . '">';

  echo '<div class="back-logo big-icon multi-svg">';

      if($icon_image) :
          echo '<img src="' . wp_get_attachment_image_src( $icon_image )[0] . '" />';
      else :
          echo '<svg class="centered icon--large"><use xlink:href="#' . $icon . '"></use</svg>';
      endif;

  echo '</div>';

  echo '<h2>' . get_the_title($item->ID) . '</h2>';
	
  echo '<h5>' . get_post_meta( $id, '_cartogram_short_description_value', TRUE ) . '</h5>';

  echo '<div class="beercard__background" style="background:' . $color . '" ></div>';

echo '</a>';


?>
