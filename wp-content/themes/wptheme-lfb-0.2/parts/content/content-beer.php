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
$artwork = get_field('artwork');

echo '<a target="_blank" style="color: ' . $colorText . ' !important;"  class="beercard col col-12 col-6-mobile" href="' . $link . '">';

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

        echo '<span class="beercard__info">';

          echo '<span class="beercard__button button button--secondary">Buy online</span>';

        echo '</span>';
        
    echo '</div>';

    echo '<div class="beercard__background" style="background:' . $color . '" ></div>';

echo '</a>';
