<?php
$players = new WP_Query( array( "post_type" => "players") );
?>
<h3 class="rule-left text-center mobile-divide">Meet The Team </h3>
<div class="row collapse flushed-right">
	<div class="columns twelve double-bordered">
		<div class="flexslider-players rule-left mobile-divide">
			<ul class="slides-players">
				<?php while ($players->have_posts()) :$players->the_post(); ?>
					<?php 	$email = get_post_meta( $post->ID, '_cartogram_email_value', TRUE );
							$icon = get_post_meta( $post->ID, '_cartogram_icon_value', TRUE );?>

					<li class="card-players wrap">
						<div class="flip-container">
							<a class="flip" id="to-back" href="#"><i class="icon-flip-right"></i></a>
							<div class="flipper">
								<div class="front">
									<span class="corner-two "></span>
									<?php echo '<div class="back-logo icon-' . $icon . '"></div>';
									 	the_title('<h2>', '</h2>');
										the_content();
									?>
								</div>
								<div class="back">
									<span class="corner-two "></span>
									<a class="flip" id="to-front" href="#"><i class="icon-flip-left"></i></a>
									<?php if (has_post_thumbnail()) { 
											the_post_thumbnail('cartogram_player_cropped');
										} else {
											echo '<img src="' . get_bloginfo("stylesheet_directory") . '/images/placeholder.png" class="placeholder-players"/>';
									} 
									$first_name = preg_split("/[\s,]+/", get_the_title());
								?>
								</div>
							</div>
							<a class="name double-bordered expand medium white button" href="mailto:<?php echo $email ?>">Contact <?php echo $first_name[0]; ?></a>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>	
	</div>
</div>