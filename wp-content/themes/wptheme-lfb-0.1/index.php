<?php
/**
 * Template Name: Home
 */
?>

<?php $slug = basename(get_permalink()); ?>
<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header(); ?> 
<div class="container" id="container-slider">
	<div class="row">
		<div class="columns twelve double-bordered-outside">
			<div class="flexslider double-bordered">
				<ul class="slides">
			    	<?php // get_template_part('parts/loops/loop', 'archive') ?> 	
			  	</ul>
			</div>
		</div>
	</div>	
</div>
<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>