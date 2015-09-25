<?php
/**
 * Template Name: Page
 */
?>

<?php $slug = basename(get_permalink()); ?>
<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header(); ?> 
<div class="container" id="container-site">
	<?php get_template_part('parts/content/content', get_post_type()) ?> 	
</div>
<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>