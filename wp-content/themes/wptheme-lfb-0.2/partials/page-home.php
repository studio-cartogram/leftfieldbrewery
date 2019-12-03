<?php

echo '<div class="grid grid--reverse">';

echo '<div class="col col-8-tablet">';

echo '<span class="heading heading--3 soft border-left border-right mobile-divide text-center">' . 'Instagram' . '</span>';

get_template_part('partials/feature-instagram');

get_template_part('partials/feature-at-the-brewery');

echo '</div>';

echo '<div class="col col-4-tablet">';

get_template_part('partials/sidebar', 'home');

echo '</div>';

echo '</div>';
