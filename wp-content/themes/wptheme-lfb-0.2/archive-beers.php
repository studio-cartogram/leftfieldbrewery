<?php

/**
 * Template Name: Home
 */

$slug = 'beers';

get_template_part('parts/shared/html-header');

get_header();

echo '<div class="container ' . $slug  . '" id="container-site">';

get_template_part('partials/content-archive', $slug);

echo '</div>';

get_footer();

get_template_part('parts/shared/html-footer');
