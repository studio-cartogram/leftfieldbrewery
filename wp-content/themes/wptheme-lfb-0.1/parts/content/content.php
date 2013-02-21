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
global $page_content;
$page_content = get_the_content( );
$page_title = str_replace(" ", "-", get_the_title());

?>

<div class="row collapse <?php echo strtolower($page_title); ?>">
	<div class="columns four">
		<?php get_sidebar(strtolower($page_title)); ?>
	</div>
	<div class="columns eight">	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h3 class="entry-title"><?php echo $page_title; ?></h3>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<?php get_template_part('parts/content/maincontent/maincontent', strtolower($page_title));?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>