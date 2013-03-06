<?php
/**
 * Template Name: Home
 */
?>

<?php $slug = basename(get_permalink()); ?>
<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header(); ?>
<div class="container" id="container-site">
	<?php if(is_paged()) {
		get_template_part('parts/loops/loop', 'archive');
	} else {
		get_template_part('parts/loops/loop', 'home');
	} ?> 	
</div>
<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>