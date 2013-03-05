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
		<div class="columns twelve double-bordered-outside">
			<div class="flexslider double-bordered">
				<ul class="slides">
			    	<?php get_template_part('parts/loops/loop', 'page') ?> 	
			  	</ul>
			</div>
			<ul class="cartogram-slider-direction-nav"><li><a class="cartogram-slider-prev" href="#"><i class="icon-arrow-left"></i></a></li><li><a class="cartogram-slider-next" href="#"><i class="icon-arrow-right"></i></a></li></ul>
		</div>
	</div>	
</div>
<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>