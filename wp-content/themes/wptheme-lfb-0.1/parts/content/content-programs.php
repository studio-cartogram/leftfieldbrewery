<?php 
	$spaces_available = get_post_meta( get_the_ID(), '_cartogram_spaces_available_value', TRUE );
	if ($spaces_available) {
		$classes='space-available';
	}
	$just_added = get_post_meta( get_the_ID(), '_cartogram_just_added_value', TRUE );
	if ($just_added) {
		$classes='just-added';
	}
?>
<a class="th <?php echo $classes ?>" href="<?php the_permalink() ?>">
	<?php echo the_post_thumbnail('cartogram_post_thumb_big'). '<h4>'. get_the_title() .'</h4>'; ?>
</a>