<?php
/**
 * Template Name: Home
 */

get_template_part('parts/shared/html-header');

get_header();

echo '<div class="container" id="container-site">';
	
	get_template_part('partials/page', 'events');

echo '</div>';

get_footer();

get_template_part('parts/shared/html-footer');

?>