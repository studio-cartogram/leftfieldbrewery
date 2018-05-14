<?php
$images = get_field('images');
$size = 'full';
?>

<div class="row bg-cream collapse flushed-left ">
	<div class="columns twelve double-bordered">
		<div class="flexslider-beers rule-right">
		
		<?php if( have_rows('images') ): ?>

			<ul class="slides-beers">

				<?php while( have_rows('images') ): the_row(); 

					$image = get_sub_field('image');
					?>

					<li class="beer_slide">

						<div class="image-wrap">

							<?php echo wp_get_attachment_image( $image, $size ); ?>
							
						</div>

					</li>

				<?php endwhile; ?>

			</ul>

			<?php endif; ?>
			<span class="corner-one"></span>
			<span class="corner-two"></span>
			<span class="corner-three"></span>
			<span class="corner-four"></span>
		</div>
	</div>
</div>
