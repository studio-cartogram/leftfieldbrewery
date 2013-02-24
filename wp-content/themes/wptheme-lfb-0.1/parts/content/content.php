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

<div class="row <?php echo strtolower($page_title); ?>">
	<div class="columns four">
		<?php get_sidebar(strtolower($page_title)); ?>
	</div>
	<div class="columns eight" id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>	
		<h3 class="rule-right"><?php echo $page_title; ?></h3>
		<?php get_template_part('parts/content/maincontent/maincontent', strtolower($page_title));?>
	</div>
</div>