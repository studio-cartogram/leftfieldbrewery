<?php
global $id;
?>
<div class="frontOfCard">
	<?php the_title();?>
	<p>
		<?php echo get_post_meta( $id, '_cartogram_short_description_value', TRUE );?>
	</p>			
	<?php the_post_thumbnail();?>
	<?php the_content();?>
	<span class="flip"> flip this card(>>) </span>
</div>
<div class="backOfCard">
	test
	<span class="flip"> flip this card(<<) </span>
</div>