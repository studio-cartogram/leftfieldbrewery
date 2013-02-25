
<div class="row bg-cream ">
	<div class="columns twelve double-bordered-inside">
		INstagram goes here:
	</div>
</div>
<div class="row">
	<div class="columns seven rule-right">
		<div class="row">
			<div class="columns double-bordered twelve space-inner-top space-inner-bottom text-center">
				<h3>Highlight Reel</h3>
			</div>
		</div>
		<div class="row">
			<div class="columns twelve">
				<?php
				global $myExcerptLength;
				$myExcerptLength = 20;
				$query = new WP_Query('showposts=1');
				while ($query->have_posts()): $query->the_post();?>
					<div class="row border-top border-bottom ">
						<div class="columns six format-text bg-cream rule-right bg-cream">
							<p class="collapse text-small"><?php the_date('jS F, Y'); ?></p>
						</div>
					</div>
					<div class="row border-bottom">
						<div class="columns format-text twelve rule-right bg-cream">
							<h5><a href="the_permalink() ?>"><?php the_title(); ?></a></h5>
							<?php the_excerpt(); ?>
							<?php more_link(); ?>
						</div>
					</div>		
				<?php endwhile;
				$myExcerptLength = 0;
				?>
			</div>
		</div>
	</div>
	<div class="columns five rule-inside-right">
		<div class="row row-flush-left">
			<div class="double-bordered-inside columns twelve space-inner-top space-inner-bottom text-center">
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
					}
				endwhile;
				?>
			<div class="columns twelve mvp text-center bg-blue" style="background-image: url('<?php echo $image[0]; ?>')">
					<h2><?php the_title(); ?></h2>
					<p><a href="<?php echo $permalink; ?>">Learn More</a></p>
			</div>
		</div>
	</div>
</div>
