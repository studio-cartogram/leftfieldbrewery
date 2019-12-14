<?php

/**
 * Template Name: Home
 */

$slug = cartogram_get_slug();
$shit_list = array('about-us', 'contact-us');

get_template_part('parts/shared/html-header');

get_header();

echo '<div class="container ' . $slug  . '" id="container-site">';

if ( have_posts() ) :

  while ( have_posts() ) : the_post();

    if (in_array($slug, $shit_list)) :

      get_template_part('parts/content/content', $slug);

    else :

      get_template_part('partials/content', $slug);

    endif;

  endwhile;

endif;

echo '</div>';

get_footer();

get_template_part('parts/shared/html-footer');
