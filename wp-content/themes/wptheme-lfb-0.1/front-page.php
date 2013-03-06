<?php
/**
 * Template Name: Home
 */
?>

<?php $slug = basename(get_permalink()); ?>
<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header(); ?> 
<div class="container" id="container-site">
	<?php get_template_part('parts/loops/loop', 'front-page') ?> 	
</div>
<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>