<?php

$modifications = array(
  'posts_per_page' => 100,
);

$args = array_merge(
  $wp_query->query_vars,
  $modifications 
);

$the_query = new WP_Query($args);

echo '<div class="grid">';

  echo '<div class="columns twelve tabs-container">';

    get_template_part('parts/navigation/nav-tabs', 'beers');

  echo '</div>';

echo '</div>';

if ( $the_query->have_posts() ) :

echo '<div class="beercards">';

  echo '<div class="grid grid--justify-center grid--align-stretch">';

    while ( $the_query->have_posts() ) : $the_query->the_post();

      set_query_var( 'item', $post );
      get_template_part('parts/content/content', 'beer');

    endwhile;

  echo '</div>';

echo '</div>';

endif;

