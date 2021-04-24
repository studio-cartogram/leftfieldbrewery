<?php

echo '<div class="grid grid--reverse">';

echo '<div class="col col-8-tablet">';

echo '<a href="https://www.instagram.com/leftfieldbrewery/" class="heading heading--3 soft border-left border-right mobile-divide text-center">' . 'Instagram' . '</a>';

get_template_part('partials/feature-instagram');

get_template_part('partials/feature-at-the-brewery');

echo '</div>';

echo '<div class="col col-4-tablet border-left">';

get_template_part('partials/sidebar', 'home');

echo '</div>';

echo '</div>';
