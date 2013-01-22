<?php
	$references = new WP_Query( array( "post_type" => "reference") );
?>
<div class="row">
	<div class="columns twelve">
		<h3>References</h3>
		<p>Kind words from students and their parents</p>
		<div class="flexslider references">
			<ul class="slides">
				<?php while ($references->have_posts()) : $references->the_post(); ?>
					<li class="reference">
						<article class="content">
							<blockquote>
								<?php echo get_the_content() ?>
							</blockquote>
							<?php the_title('<h5 data-icon="&#x2e" class="reference-name">','</h5>') ?>
							<h6 class="reference-date"><?php the_date() ?></h6>
						</article>
				<?php endwhile; ?>	
			</ul>
			<ul class="slide-counts">
				<li class="current-slide">1</li>
				<li class="total-slides"></li>
			</ul>	
		</div>
	</div>
</div><!-- references -->
<?php wp_reset_query(); ?>