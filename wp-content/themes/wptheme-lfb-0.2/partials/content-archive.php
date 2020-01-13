<?php 
global $wp_query;
global $post;
global $paged;
global $slug;
$yesterday = date('Ymd') - 1;

$modifications = array(
  'posts_per_page' => 100,
  'meta_key'  => 'date',
  'orderby'   => 'meta_value_num',
  'order'     => 'ASC',
  'meta_query' => array(
    array(
        'key'     => 'date',
        'compare' => '>=',
        'value'   => $yesterday - 1,
        'type' => 'DATE',
    ),
  ),
);

$args = array_merge(
  $wp_query->query_vars,
  $modifications 
);

$the_query = new WP_Query($args);
$count = 0;

echo '<div class="grid">';

  echo '<div class="col col-12">';

  get_template_part('parts/navigation/nav-tabs', 'beers');

    if ( $the_query->have_posts() ) : 

      echo '<div class="grid grid--justify-center grid--align-stretch">';

        while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;

          set_query_var( 'item', $post );

          set_query_var('cols', 'col-12 col-6-mobile');

          get_template_part('partials/item', $slug);

        endwhile;

        echo '</div>';
    
    endif;

  echo '</div>';

echo '</div>';