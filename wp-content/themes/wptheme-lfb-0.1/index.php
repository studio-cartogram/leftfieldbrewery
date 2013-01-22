<?php
/**
 * Template Name: Home
 */
?>

<?php get_template_part('parts/shared/html-header'); ?>
<?php get_header() ?> 
<div class="container">
	<div class="row">
		<div class="columns four">
			<?php get_sidebar(); ?>
		</div>
		<div class="columns eight">
			<?php get_template_part('parts/loop'); ?>
		</div>
	</div>
</div>

<?php get_footer() ?>
<?php get_template_part('parts/shared/html-footer'); ?>