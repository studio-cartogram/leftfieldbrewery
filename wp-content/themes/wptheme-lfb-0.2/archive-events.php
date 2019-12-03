<?php

/**
 * Template Name: Home
 */

$slug = 'events';

get_template_part('parts/shared/html-header');

get_header();

echo '<div class="container ' . $slug  . '" id="container-site">';

get_template_part('partials/page', $slug);

echo '</div>';

get_footer();

get_template_part('parts/shared/html-footer');
