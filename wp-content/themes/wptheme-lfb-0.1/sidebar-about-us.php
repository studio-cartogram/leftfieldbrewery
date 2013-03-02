<?php
$players = new WP_Query( array( "post_type" => "players") );
?>
<h3 class="rule-left text-center ">Meet The Team </h3>
<div class="row collapse flushed-right">
	<div class="columns twelve double-bordered">
		<div class="flexslider-players rule-left">
			<ul class="slides-players">
				<?php while ($players->have_posts()) :$players->the_post(); ?>
					<?php 	$email = get_post_meta( $post->ID, '_cartogram_email_value', TRUE );
							$icon = get_post_meta( $post->ID, '_cartogram_icon_value', TRUE );?>

					<li class="card-players wrap">
						<div class="flip-container">
							<a class="flip" href="#"><i class="icon-flip-right"></i></a>
							<span class="corner-one"></span>
							<span class="corner-two "></span>
							<span class="corner-three"></span>
							<span class="corner-four "></span>
							<div class="flipper">
								<div class="front">
								<?php if (has_post_thumbnail()) { 
											the_post_thumbnail();
										} else {
											echo '<div class="placeholder-players"></div>';
									} 
									$first_name = preg_split("/[\s,]+/", get_the_title());
								?>


									<a class="name double-bordered expand white button" href="mailto:<?php echo $email ?>">Contact <?php echo $first_name[0]; ?></a>
									
								</div>
								<div class="back">
									<?php echo '<div class="back-logo icon-' . $icon . '"></div>';
									 	the_title('<h2>', '</h2>');
										the_content();
									?>
								</div>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>	
	</div>
</div>