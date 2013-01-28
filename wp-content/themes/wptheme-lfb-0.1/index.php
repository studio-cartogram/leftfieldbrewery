<?php
/**
 * Template Name: Home
 */
?>

<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header() ?> 
<div class="container">
	<div class="row">
		<div class="columns twelve">
			<div class="flexslider">
				<ul class="slides">
			    	<?php get_template_part('parts/loops/loop', 'page') ?> 	
			  	</ul>
			</div>
		</div>
	</div>	
</div>

<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>