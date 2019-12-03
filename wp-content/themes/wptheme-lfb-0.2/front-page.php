<?php

/**
 * Template Name: Home
 */

$slug = is_front_page() ? 'home' : basename(get_permalink());

get_template_part('parts/shared/html-header');

get_header();

echo '<div class="container ' . $slug  . '" id="container-site">';

get_template_part('partials/page', $slug);

echo '</div>';

get_footer();

get_template_part('parts/shared/html-footer');
