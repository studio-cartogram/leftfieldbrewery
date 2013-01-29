<?php
/**
 * Template Name: Splash Page
 */
?>
<?php get_template_part('parts/shared/html-header'); ?>
<div id="modal-splash" class="reveal-modal transparent">
	<?php while ( have_posts() ) : the_post(); ?>
		<h1><a href=<?php bloginfo( 'url' ); ?>><img class="logo-svg" src="<?php bloginfo('template_directory') ?>/images/logo.svg"></a></h1>
		<?php 
		the_title('<h1 class="title">','</h1>');
		the_content();
		?>
	<?php endwhile; // end of the loop. ?>
</div>

<?php get_template_part('parts/shared/html-footer'); ?>