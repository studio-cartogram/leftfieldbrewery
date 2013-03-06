<?php
/**
 * Template Name: Page
 */
?>

<?php $slug = basename(get_permalink()); ?>
<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header(); ?> 
paged
<div class="container" id="container-slider">
	<div class="row">
		<div class="columns twelve double-bordered-outside">
			<div class="flexslider double-bordered">
				<ul class="slides">
			  	</ul>
			</div>
		</div>
	</div>	
</div>
<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>