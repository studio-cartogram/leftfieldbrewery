<?php

$slug = cartogram_get_slug();

echo '<div class="grid grid--reverse">';

echo '<div class="col col-8-tablet">';

echo the_title('<span class="heading heading--3 soft border-left border-right text-center">','</span>');

the_content();

echo '</div>';

echo '<div class="col col-4-tablet border-left">';

get_template_part('partials/sidebar', $slug);

echo '</div>';

echo '</div>';
