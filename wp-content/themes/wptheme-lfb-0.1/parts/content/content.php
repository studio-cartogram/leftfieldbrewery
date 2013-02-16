<?php
/**
* The default template for displaying content
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/

//Getting this stuff here first because of weird
//embedded query behaviour.
$page_content = get_the_content( );
$page_title = str_replace(" ", "-", get_the_title());

?>

<div class="row collapse">
	<div class="columns four">
		<?php get_template_part('parts/content/sidecontent/sidecontent', $page_title);?>
	</div>
	<div class="columns eight">	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h3 class="entry-title"><?php echo $page_title; ?></a></h3>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<?php echo $page_content ?>
				<?php //wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>