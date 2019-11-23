<?php
$item = get_query_var('item');
$icon_image = get_field('icon');
$icon = (!$icon_image && get_post_meta($item->ID, '_cartogram_icon_value', true) ? get_post_meta($item->ID, '_cartogram_icon_value', true) : $item->post_name);
$short_description = get_field('short_description');
$color = get_field('color');
$defaultColorText = '#0c223f';
$colorText = get_field('color_text') ? get_field('color_text') : $defaultColorText;
$link = get_field('bottle_shop');
$label = get_field('label');
$artwork = get_field('artwork');
$info = get_field('info');
$alcvol = get_field('alcvol');

if ($link) :

    echo '<a target="_blank" style="color: ' . $colorText . ' !important;"  class="beercard col col-12 col-6-mobile" href="' . $link . '">';

else :

    echo '<div style="color: ' . $colorText . ' !important;"  class="beercard col col-12 col-6-mobile">';

endif;

    echo '<div class="beercard__label" style="background-color:' . $color . '; background-image: url(' . wp_get_attachment_image_url($artwork, array('300', '1000')) . ');" >';

    if (!$artwork) :

        if($icon_image) :

            echo '<img src="' . wp_get_attachment_image_src( $icon_image )[0] . '" />';

        elseif($icon):

            echo '<svg class="centered icon--large"><use xlink:href="#' . $icon . '"></use></svg>';
            
        endif;

    endif;

    echo '</div>';


    echo '<div class="beercard__content">';

        echo '<span class="beercard__heading">';

            echo '<h2 class="heading--1">' . get_the_title($item->ID) . '</h2>';
            
            echo '<h3 class="heading--2 heading--bordered">' . $short_description . '</h3>';

        echo '</span>';


        if ($link) :

            echo '<span class="beercard__button button button--inverted button--secondary">Buy online</span>';
    
        endif;

        echo '<span class="heading heading--5 ">';

        echo $alcvol . ' ABV';

        if ($alcvol && $info) : echo ' • '; endif;

        echo $info;

            
    echo '</div>';

    echo '<div class="beercard__background" style="background:' . $color . '" ></div>';

if ($link) :

    echo '</a>';

 else :

    echo '</div>';

endif;
