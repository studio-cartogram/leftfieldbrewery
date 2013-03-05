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
$page_title = basename(get_permalink());
?>

<div class="row <?php echo $page_title; ?>">
	<div class="columns eight push-four rule-left" id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>	
		<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
		<?php get_template_part('parts/content/maincontent/maincontent', $page_title);?>
	</div>
	<div class="columns four pull-eight">
		<?php get_sidebar(strtolower($page_title)); ?>
	</div>
</div>