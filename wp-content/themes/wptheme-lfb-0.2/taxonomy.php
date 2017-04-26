<?php
/**
 * Template Name: Page
 */
?>

<?php global $wp_query;?>
<?php global $post;?>
<?php global $paged;?>
<?php $slug = basename(get_permalink()); ?>
<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header(); ?> 
<div class="container" id="container-slider">
	<?php get_template_part('parts/loops/loop', 'beers') ?> 	
</div>
<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>
