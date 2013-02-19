<?php
$players = new WP_Query( array( "post_type" => "players") );
?>
<h6>Meet the team</h6>
<div class="playersFlexslider">
	<ul class="players_slides">
		<?php while ($players->have_posts()) :$players->the_post(); ?>
			<li class="playerCard">
				<div class="frontOfCard">
					<?php the_post_thumbnail();?>
					<span class="flip"> flip this card(>>) </span>
				</div>
				<div class="backOfCard">
					<?php the_content();?>
					<span class="flip"> flip this card(<<) </span>
				</div>

				<?php $email = get_post_meta( $post->ID, '_cartogram_email_value', TRUE );?>
				<a href="mailto:<?php echo $email ?>">Contact <?php the_title() ?></a>
			</li>
		<?php endwhile; ?>	
	</ul>
</div>
