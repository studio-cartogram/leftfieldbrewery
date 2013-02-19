<?php
/**
* The default template for displaying content
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/
?>
<?php $mapurl = get_post_meta($post->ID, '_cartogram_map_value', true); ?>
<?php $address = get_post_meta($post->ID, '_cartogram_address_value', true); ?>

<a id="post-<?php the_ID(); ?>" <?php post_class(); ?> href="<?php echo $mapurl; ?>" title="<?php get_the_title(); ?>" rel="bookmark">
	<h4 class="entry-title"><?php the_title(); ?></h4>
    <p>
    	<?php echo $address; ?>
    </p>
</a>        
