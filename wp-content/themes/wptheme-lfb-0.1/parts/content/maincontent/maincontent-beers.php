<?php 
global $id;
?>
<div class="row">
	<div class="columns twelve">
		<div class="beersFlexslider">
			<ul class="beers_slides">
				<?php
				$thumb_ID = get_post_thumbnail_id( $post->ID );

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

				}
				?>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="columns twelve">
		<?php
		$fields = array(
				"ALC./VOL" => "alc",
				"IBU" => "IBU",
				"SRM" => "SRM",
				"Food Pairings" => "food_pairings" 
			);
		foreach ($fields as $title => $name) {
			echo $title . get_post_meta( $id, '_cartogram_'.$name.'_value', TRUE );
		}
		?>
	</div>
</div>
