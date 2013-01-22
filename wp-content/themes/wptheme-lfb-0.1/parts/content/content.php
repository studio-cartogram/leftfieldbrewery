<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('space-top'); ?>>
		<header class="entry-header">
			<?php if (is_home() || is_search() || is_archive()) {
				echo '<h5>' . get_the_time('D M Y') . '</h5>';
			} ?>
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php the_content( ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

	</article><!-- #post-<?php the_ID(); ?> -->
