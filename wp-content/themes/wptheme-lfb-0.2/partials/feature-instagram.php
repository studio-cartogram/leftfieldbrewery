<?php 


$args = array(
  'post_type' => 'instagrams',
  'posts_per_page' => 4
);

$the_query = new WP_Query( $args );

echo '<div class="instagrams" id="instafeed">';

  if ( $the_query->have_posts() ) :

    echo '<div class="instagram_gallery">';
    
    while ( $the_query->have_posts() ) :

      $the_query->the_post();

      echo '<a href="' . get_field('link', get_the_ID()) . '" class="instagram-sidecar" rel="noopener" target="_blank">';

      echo get_the_post_thumbnail( get_the_ID(), 'large' );

      echo '<img alt="' . get_the_title() . '" />';

      echo "</a>";

    endwhile;
      
    echo '</div>';

  endif;
  
  wp_reset_postdata();

echo '</div>';

?>