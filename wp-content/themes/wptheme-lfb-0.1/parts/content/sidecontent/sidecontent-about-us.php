<?php
$players = new WP_Query( array( "post_type" => "players") );
?>
<h6>Meet the team</h6>
<div class="playersFlexSlider">
	<ul class="slides">
		<?php while ($players->have_posts()) : $players->the_post(); ?>
			<li class="playerCard">
				<?php the_post_thumbnail();?>
				<?php $email = get_post_meta( $post->ID, '_cartogram_email_value', TRUE );?>
				<a href="">Contact <?php the_title() ?></a>	
			</li>
		<?php endwhile; ?>	
	</ul>
</div>
