<?php
/**
* The default template for displaying content
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/

?>

<div class="row collapse">
	<div class="columns four">
		<?php get_sidebar('beers');?>
	</div>
	<div class="columns eight">	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h3 class="entry-title"><?php echo $page_title; ?></h3>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<?php get_template_part('parts/content/maincontent/maincontent', 'beers');?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>