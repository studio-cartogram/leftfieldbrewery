<?php
/**
 * Template Name: Page
 */
?>

<?php $slug = basename(get_permalink()); ?>
<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header(); ?> 
<div class="container" id="container-slider">
	<div class="row">
	    <?php get_template_part('parts/loops/loop', 'archive') ?> 	
	</div>	
</div>
<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>