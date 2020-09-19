<?php

global $slug;

$item = get_query_var('item');
$icon_image = get_field('icon', $item->ID);
$icon = (!$icon_image && get_post_meta($item->ID, '_cartogram_icon_value', true) ? get_post_meta($item->ID, '_cartogram_icon_value', true) : $item->post_name);
$short_description = get_field('short_description', $item->ID);
$default_background_color = 'white';
$background_color = get_field('color', $item->ID) ? get_field('color', $item->ID) : $default_background_color ;
$default_text_color = '#0c223f';
$text_color = get_field('color_text', $item->ID) ? get_field('color_text', $item->ID) : $default_text_color;
$link =  get_field('link', $item->ID) ? get_field('link', $item->ID) : get_field('bottle_shop', $item->ID);
$label = get_field('label', $item->ID);
$artwork = get_field('artwork', $item->ID) ? get_field('artwork', $item->ID) : get_post_thumbnail_id($item->ID);
$info = get_field('info', $item->ID);
$alcvol = get_field('alcvol', $item->ID);
$date = $slug == 'events' && get_field('date', $item->ID) ? date('M j', strtotime(get_field('date', $item->ID))) : null;
$start_time = $slug == 'events' ? get_field('start_time', $item->ID) : null;
$final_link = $slug == 'events' && !$link ? get_permalink($item->ID) : $link;
$target = $link ? ' target="_blank" ' : '';
$button_text = cartogram_get_button_text($slug, $final_link);

$cols = get_query_var('cols');
$additional_classes = get_query_var('additional_classes');

if ($final_link) :

  echo '<a ' . $target . ' style="color: ' . $text_color . ' !important;"  class="item item--' . $slug . ' col ' . $cols . ' ' . $additional_classes . '" href="' . $final_link . '">';

else :

  echo '<div style="color: ' . $text_color . ' !important;"  class="item item--' . $slug . ' col ' . $cols . ' ' . $additional_classes . '">';

endif;

echo '<div class="item__artwork" style="background-color:' . $background_color . '; background-image: url(' . wp_get_attachment_image_url($artwork, array('300', '1000')) . ');" >';

if (!$artwork) :

  if ($icon_image) :

    echo '<img src="' . wp_get_attachment_image_src($icon_image)[0] . '" />';

  elseif ($icon) :

    echo '<svg class="centered icon--large"><use xlink:href="#' . $icon . '"></use></svg>';

  endif;

endif;

echo '</div>';


echo '<div class="item__content">';

echo '<span class="item__heading">';

echo '<h2 class="heading--1">' . get_the_title($item->ID) . '</h2>';

echo $short_description ? '<h3 class="heading--2 heading--bordered">' . $short_description . '</h3>' : '';

echo $date ? '<h3 class="heading--2 heading--bordered">' . $date . ' • ' . $start_time . '</h3>' : '';

echo '</span>';

echo '<div>';

echo $info ? '<span class="heading heading--5 block">' . $info . '</span>' : '';

echo $alcvol ? '<span class="heading heading--5 block ">' . $alcvol . ' ABV' . '</span>' : '';

echo '</div>';

echo '<span class="item__button button button--secondary ' . ($final_link ? '' : 'button--disabled') . '">' . $button_text . '</span>';

echo '</div>';

echo '<div class="item__background" style="background:' . $background_color . '" ></div>';

if ($final_link) :

  echo '</a>';

else :

  echo '</div>';

endif;
