<?php 
global $wp_query;
global $post;
global $paged;
global $slug;

$modifications = array(
  'posts_per_page' => 100,
);

$args = array_merge(
  $wp_query->query_vars,
  $modifications 
);

$the_query = new WP_Query($args);
$count = 0;

echo '<div class="grid">';

  echo '<div class="col col-4">';

    echo '<h3 class="text-center">' . 'Events' . '</h3>';

    if ( $the_query->have_posts() ) : 
    
        while ( $the_query->have_posts() ) : $the_query->the_post(); $count++;

          if ($count === 1) :

            $main = $post;

          else :
    
            set_query_var( 'item', $post );

            get_template_part('partials/item', 'events');

          endif;
    
        endwhile;
    
    endif;

  echo '</div>';

  echo '<div class="col col-8">';

    echo get_the_title($main->ID);

  echo '</div>';

echo '</div>';

?>

<?php

