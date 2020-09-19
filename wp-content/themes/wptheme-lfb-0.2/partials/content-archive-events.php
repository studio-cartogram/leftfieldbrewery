<?php 
global $wp_query;
global $post;
global $paged;
global $slug;
$yesterday = date('Ymd') - 1;

$common = array(
  'posts_per_page' => 100,
);

$query_one_args = array_merge(
  $wp_query->query_vars,
  $common,
  array(
    'meta_key'  => 'date',
    'orderby'   => 'meta_value_num',
    'order'     => 'ASC',
    'meta_query' => array(
      "relation" => "OR",
      array(
        'key'     => 'date',
        'compare' => '>=',
        'value'   => $yesterday,
        'type' => 'DATE',
      ),
      array(
        'key'     => 'date',
        'compare' => '=',
        'value'   => '',
      ),
    ),
  )
);

$query_one = new WP_Query($query_one_args);
$count = 0;

echo '<div class="grid">';

  echo '<div class="col col-12">';

  get_template_part('parts/navigation/nav-tabs', $slug);

    if ( $query_one->have_posts() ) : 

      echo '<div class="grid grid--justify-center grid--align-stretch">';

        while ( $query_one->have_posts() ) : $query_one->the_post(); $count++;

          set_query_var( 'item', $post );

          set_query_var('cols', 'col-12 col-6-mobile');

          get_template_part('partials/item', $slug);

        endwhile;

        echo '</div>';
    else:

      echo '<div class="empty-state">';
      
        echo '<span class="heading heading--5 block">No ' . $slug . ' at this time. Please check back again soon.</span>';
      
      echo '</div>';

    endif;

  echo '</div>';

echo '</div>';