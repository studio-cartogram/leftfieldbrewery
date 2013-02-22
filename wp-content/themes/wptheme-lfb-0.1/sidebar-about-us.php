<?php
$players = new WP_Query( array( "post_type" => "players") );
?>
<h6>Meet the team</h6>
<div class="playersFlexslider">
	<ul class="players_slides">
		<?php while ($players->have_posts()) :$players->the_post(); ?>
			<li class="playerCard wrap">
				<span class="flip"> flip this card </span>
				<section class="card-container">
					<div class="card">
						<figure class="front">
							<?php the_post_thumbnail();?>o							
						</figure>
						<figure class="back">
							<?php the_content();?>
						</figure>
					</div>
				<?php $email = get_post_meta( $post->ID, '_cartogram_email_value', TRUE );?>
				<a href="mailto:<?php echo $email ?>">Contact <?php the_title() ?></a>
				</section>
			</li>
		<?php endwhile; ?>	
	</ul>
</div>
