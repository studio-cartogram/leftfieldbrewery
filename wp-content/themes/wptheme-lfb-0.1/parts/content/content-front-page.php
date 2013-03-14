<?php global $slug;
?>
<div class="row  <?php echo $slug; ?>">
	<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four mobile-flush rule-left"); ?>>	
		<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
		<?php get_template_part('parts/slideshows/slideshow'); ?>
		<div class="row">
			<div class="columns seven rule-right">
				<div class="row">
					<div class="columns double-bordered twelve space-inner-top space-inner-bottom text-center">
						<h3>Highlight Reel</h3>
					</div>
				</div>
				<div class="row homehighlightreel">
					<div class="columns twelve">
						<?php
						global $myExcerptLength;
						$query = new WP_Query('showposts=1');
						while ($query->have_posts()): $query->the_post();?>
							<div class="row border-top border-bottom ">
								<div class="columns six format-text bg-cream rule-right bg-cream">
									<p class="collapse text-small"><?php the_date('jS F, Y'); ?></p>
								</div>
							</div>
							<div class="row border-bottom">
								<div class="columns format-text twelve rule-right equal-height bg-cream">
									<h5><a href="the_permalink() ?>"><?php the_title(); ?></a></h5>
									<?php the_excerpt(); ?>
									<?php  more_link(); ?>
								</div>
							</div>		
						<?php endwhile;
						?>
					</div>
				</div>
			</div>
			<div class="columns five rule-inside-right">
				<div class="row row-flush-left">
					<div class="double-bordered-inside columns twelve mobile-divide space-inner-top space-inner-bottom text-center">
						<h3>MVP</h3>
					</div>
				</div>
				<div class="row flushed-left collapse">
					<?php 
						$foundMVP = false;
						$beers = new WP_Query(array("post_type" => "beers"));
						while ($beers->have_posts() && !$foundMVP): $beers->the_post();
							if (get_post_meta( $post->ID, '_cartogram_mvp_value', TRUE )) { 						$foundMVP = true;
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
								$permalink = get_permalink( $post->ID );
								$color = get_post_meta( $post->ID, '_cartogram_color_value', TRUE );
							}
						endwhile;
						?>
					<div class="mobile-flush equal-height rule-right columns twelve mvp space-inner-bottom text-center border-top" style="background:<?php echo $color; ?>">
							<a class="light" href="<?php echo $permalink; ?>">
								<h2 class="beer-name beer-block light"><?php the_title(); ?></h2>
								<?php echo '<h3 class="light beer-tagline">' . get_post_meta( $id, '_cartogram_short_description_value', TRUE ) . '</h3>';?>
								<?php more_link() ?>
							</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="columns four sidebar pull-eight mobile-flush">
		<?php if (is_front_page()) {
			get_sidebar('front-page'); 
		} elseif (is_home()) { 
			get_sidebar('home');
		} else {
			get_sidebar($slug);
		} ?>
	</div>
</div>