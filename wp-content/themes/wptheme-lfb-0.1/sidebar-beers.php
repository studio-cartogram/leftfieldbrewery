<?php
global $id;
?>
<div class="wrap">
	<span class="flip"> flip this card </span>
	<section class="card-container">
		<div class="card">
			<figure class="front">
				<?php the_title();?>
				<?php echo get_post_meta( $id, '_cartogram_short_description_value', TRUE );?>		
				<?php the_post_thumbnail();?>
				<?php the_content();?>
			</figure>
			<figure class="back">
				Squeeze extra innings hot dog cup of coffee pinch runner fan designated hitter triple-A bandbox. Grass starter moneyball visitors play, mustard small ball. Flyout run wins alley breaking ball catcher run batted in rotation. Retire bases loaded 1-2-3 basehit out earned run reliever. Wrigley good eye left field cork rally streak foul pole blue. Slugging strike zone cookie sweep strike zone foul pole passed ball.
			</figure>
		</div>
	</section>
</div>