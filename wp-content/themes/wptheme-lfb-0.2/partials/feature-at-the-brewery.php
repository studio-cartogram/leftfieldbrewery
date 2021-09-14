<?php

$posts = get_field('beers_at_the_brewery', 'option');

if ($posts) :

  // echo '<span class="soft border-left border-right text-center heading heading--2 ">At the Brewery</span>';

  echo '<div class="row atthebrewery__table text-center collapse">';

  echo '<div class="atthebrewery__heading-row grid border-right border-left border-bottom">';

  $headings = ['Beer', 'Style', ' Bottle Shop', 'Fan Shop', 'On Tap'];
  $count = 0;

  foreach ($headings as $value) {

    $align = $count === 0 ? 'left' : 'center';

    echo '<div class="text-' . $align . ' col atb__col--' . $count++ . '">';

    echo '<span class="delta soft-half--right soft-half--left">' . $value . '</span>';

    echo '</div>';
  }

  echo '</div>';

  while (the_repeater_field('beers_at_the_brewery', 'option')) :
    $count = 0;
    $beer = get_sub_field('beer');
    $beer_icon = get_sub_field('beer_icon');
    $link = get_sub_field('link') ? get_sub_field('link') : get_permalink($beer->ID);
    $icon_image = get_field('icon', $beer_icon);
    $beer_color = get_field('color', $beer->ID);
    $short_description = get_field('short_description', $beer->ID);

    echo '<a href="' . $link . '" class="grid border-left atthebrewery__row collapse">';

    echo '<div style="color:' . $beer_color . '" class="col atb__col--' . $count++ . ' text-left rule-right">';

      echo '<span class="beta soft-half beer-title heading heading--3">' . get_the_title($beer->ID) . '</span>';

    echo '</div>';

    echo '<div class="col atb__col--' . $count++ . '  rule-right">';

      echo '<span class="centered zeta">' . $short_description . '</span>';

    echo '</div>';

    echo '<div class="col atb__col--' . $count++ . '  rule-right">';

      echo (get_sub_field('bottleshop') ? '<span class="check-text">In Cans</span><span class="check"></span>' : '&nbsp;');

    echo '</div>';

    echo '<div class="col atb__col--' . $count++ . '  rule-right">';

      echo (get_sub_field('fanshop') ? '<span class="check-text">In Bottles</span><span class="check"></span>' : '&nbsp;');

    echo '</div>';

    echo '</a>';

  endwhile;

  echo '</div>';

endif; ?>