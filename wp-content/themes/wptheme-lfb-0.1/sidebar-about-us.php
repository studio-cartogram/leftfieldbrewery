<?php
$players = new WP_Query( array( "post_type" => "players") );
?>
<h3 class="rule-left text-center ">Meet The Team </h3>
<div class="row collapse flushed-right">
	<div class="columns twelve double-bordered">
		<div class="flexslider-players rule-left">
			<ul class="slides-players">
				<?php while ($players->have_posts()) :$players->the_post(); ?>
					<li class="card-players wrap">
						<section class="card-container">
							<div class="card">
							<span class="corner-one"></span>
							<span class="corner-two "></span>
							<span class="corner-three"></span>
							<span class="corner-four "></span>
							<a class="flip icon-flip-right" href="javascript:void();"> </a>
							
								<figure class="front">

									<?php the_post_thumbnail();?>o							
								</figure>
								<figure class="back">
									<?php the_title('<h2>', '</h2>') ?>
									<?php the_content();?>
								</figure>
							</div>
						<?php $email = get_post_meta( $post->ID, '_cartogram_email_value', TRUE );?>
						<a class="button" href="mailto:<?php echo $email ?>">Contact <?php the_title() ?></a>
						</section>

					</li>
				<?php endwhile; ?>
			</ul>
		</div>	
	</div>
</div>