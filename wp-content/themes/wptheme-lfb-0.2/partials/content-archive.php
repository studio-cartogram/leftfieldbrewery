<?php 
global $wp_query;
global $post;
global $paged;
global $slug;
$yesterday = date('Ymd') - 1;

$common = array(
  'posts_per_page' => 100
);

$args = array_merge(
  $wp_query->query_vars,
  $common
);

$the_query = new WP_Query($args);
$count = 0;

echo '<div class="grid">';

  echo '<div class="col col-12">';

  get_template_part('parts/navigation/nav-tabs', $slug);

    if ( $the_query->have_posts() ) : 

      echo '<div class="grid grid--justify-center grid--align-stretch">';

        while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;

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