<?php
$item = get_query_var('item');
$icon_image = get_field('icon', $item->ID);
$icon = (!$icon_image && get_post_meta($item->ID, '_cartogram_icon_value', true) ? get_post_meta($item->ID, '_cartogram_icon_value', true) : $item->post_name);
$short_description = get_field('short_description', $item->ID);
$color = get_field('color', $item->ID);
$defaultColorText = '#0c223f';
$colorText = get_field('color_text', $item->ID) ? get_field('color_text', $item->ID) : $defaultColorText;
$link = get_field('bottle_shop', $item->ID);
$label = get_field('label', $item->ID);
$artwork = get_field('artwork', $item->ID);
$info = get_field('info', $item->ID);
$alcvol = get_field('alcvol', $item->ID);
$buttonText = $link ? 'Buy Now' : 'ꓘ STRUCK OUT';

$cols = get_query_var('cols');
$additional_classes = get_query_var('additional_classes');
if ($link) :

    echo '<a target="_blank" style="color: ' . $colorText . ' !important;"  class="beercard col ' . $cols . ' ' . $additional_classes . '" href="' . $link . '">';

else :

    echo '<div style="color: ' . $colorText . ' !important;"  class="beercard col ' . $cols . ' ' . $additional_classes . '">';

endif;

echo '<div class="beercard__label" style="background-color:' . $color . '; background-image: url(' . wp_get_attachment_image_url($artwork, array('300', '1000')) . ');" >';

if (!$artwork) :

    if ($icon_image) :

        echo '<img src="' . wp_get_attachment_image_src($icon_image)[0] . '" />';

    elseif ($icon) :

        echo '<svg class="centered icon--large"><use xlink:href="#' . $icon . '"></use></svg>';

    endif;

endif;

echo '</div>';


echo '<div class="beercard__content">';

echo '<span class="beercard__heading">';

echo '<h2 class="heading--1">' . get_the_title($item->ID) . '</h2>';

echo '<h3 class="heading--2 heading--bordered">' . $short_description . '</h3>';

echo '</span>';

echo '<div>';

echo '<span class="heading heading--5 block">' . $info . '</span>';
echo '<span class="heading heading--5 block ">' . $alcvol . ' ABV' . '</span>';

echo '</div>';

echo '<span class="beercard__button button button--secondary ' . ($link ? '' : 'button--disabled') . '">' . $buttonText . '</span>';

echo '</div>';

echo '<div class="beercard__background" style="background:' . $color . '" ></div>';

if ($link) :

    echo '</a>';

else :

    echo '</div>';

endif;
