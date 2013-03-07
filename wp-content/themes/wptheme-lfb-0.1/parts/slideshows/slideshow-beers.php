<div class="row bg-cream collapse flushed-left ">
	<div class="columns twelve double-bordered">
		<div class="flexslider-beers rule-right">
			<ul class="slides-beers">
				<?php $thumb_ID = get_post_thumbnail_id( $post->ID );
				if ( $images = get_posts(array(
						'post_parent' => $id,
						'post_type' => 'attachment',
						'numberposts' => -1,
						'orderby'        => 'title',
						'order'           => 'ASC',
						'post_mime_type' => 'image',
						'exclude' => $thumb_ID,
						))){
					foreach($images as $image) {
						$attachment=wp_get_attachment_image_src($image->ID, $size);
						?>
							<li class="beer_slide">
								<img src="<?php echo $attachment[0]; ?>" <?php echo $attributes; ?> />
								<?php echo get_post_field('post_excerpt', $image->ID);?>
							</li>
						<?php
					}
				} ?>
			</ul>
			<span class="corner-one"></span>
			<span class="corner-two"></span>
			<span class="corner-three"></span>
			<span class="corner-four"></span>
		</div>
	</div>
</div>