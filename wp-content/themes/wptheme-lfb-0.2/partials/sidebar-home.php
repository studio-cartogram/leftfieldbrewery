<?php
$mvp = get_field('mvp');

if (have_rows('callout')) :
  while (have_rows('callout')) : the_row();
    $heading = get_sub_field('callout_heading');
    $image = get_sub_field('callout_image');
    $text = get_sub_field('callout_text');
    $link = get_sub_field('callout_link');

    echo '<span class="heading heading--3 soft text-center">' . $heading . '</span>';

    echo '<section style="background-image: url(' . $image . ');" class="callout__inner bg-cream">';
      echo '<a href="' . $link . '" class="link--bordered link--brew-finder link--callout-module">';
        echo $text;
      echo '</a>';
    echo '</section>';
    
  endwhile;
endif;

if ($mvp) :
  echo '<h3 class=" mobile-divide text-center">MVP</h3>';
  set_query_var('item', $mvp);
  set_query_var('cols', 'col-12');
  set_query_var('additional_classes', 'item--sidebar');
  get_template_part('parts/content/content', 'beer');
endif;
?>