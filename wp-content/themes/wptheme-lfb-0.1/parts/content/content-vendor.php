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
<a target="_blank" class="row collapse flushed-right block-level" id="post-<?php the_ID(); ?>" <?php post_class(); ?> href="<?php echo $mapurl; ?>" title="<?php get_the_title(); ?>" rel="bookmark">
	<div class="columns two icon-wrap mobile-one text-center">
		<i class="icon"></i>
	</div>	
	<div class="columns format-text eight rule-right rule-left">
		<h5 class="text-small"><strong><?php the_title(); ?></strong></h5>
    	<h6 class="text-small"><?php echo $address; ?></h6>       
	</div>
	<div class="columns two map-wrap text-center">
		<h4>MAP</h4>
	</div>
</a> 