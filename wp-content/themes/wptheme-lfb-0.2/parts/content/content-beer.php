<?php
$item = get_query_var('item');
$icon_image = get_field('icon');
$icon = (!$icon_image && get_post_meta($item->ID, '_cartogram_icon_value', true) ? get_post_meta($item->ID, '_cartogram_icon_value', true) : $item->post_name);
$short_description = get_field('short_description');
$color = get_field('color');
$defaultColorText = '#0c223f';
$colorText = get_field('color_text') ? get_field('color_text') : $defaultColorText;
$default_link = 'https://fanshop.leftfieldbrewery.ca/products';
$link = get_field('bottle_shop') ? get_field('bottle_shop') : $default_link;
$label = get_field('label');

echo '<a target="_blank" style="color: ' . $colorText . ' !important;"  class="beercard col col-12 col-6-mobile col-4-tablet" href="' . $link . '">';

    echo '<div class="beercard__label" style="background-color:' . $color . '; background-image: url(' . get_bloginfo('template_directory') . '/dist/images/label-sasko.svg)"></div>';

    echo '<div class="beercard__content">';

        echo '<h2 class="beta">' . get_the_title($item->ID) . '</h2>';

        echo '<h5>' . $short_description . '</h5>';

        echo '<span class="beercard__button button button--secondary">Buy online</span>';

    echo '</div>';

    echo '<div class="beercard__background" style="background:' . $color . '" ></div>';

echo '</a>';
