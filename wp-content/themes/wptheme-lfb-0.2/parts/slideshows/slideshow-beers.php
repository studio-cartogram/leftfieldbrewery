<?php
$images = get_field('images');
$size = 'full';
?>

<div class="row bg-cream collapse flushed-left ">
	<div class="columns twelve double-bordered">
		<div class="flexslider-beers rule-right text-center">
			<?php if( have_rows('images') ): ?>
				<?php while( have_rows('images') ): the_row(); 
					$image = get_sub_field('image'); ?>
					<div class="space-bottom">
						<?php echo wp_get_attachment_image( $image, $size ); ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
