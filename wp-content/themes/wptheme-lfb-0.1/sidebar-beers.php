<?php 	$icon = get_post_meta( $post->ID, '_cartogram_icon_value', TRUE );
		$color = get_post_meta( $post->ID, '_cartogram_color_value', TRUE );?>

<h3 class="rule-left text-center ">An Unusual Delivery</h3>
<div class="row collapse flushed-right sidebar-beer">
	<div class="columns twelve double-bordered">
		<div class="rule-left">
			<div class="flip-container ">
				<a class="flip" id="to-back" href="#"><i class="icon-flip-right"></i></a>
				<a class="flip" id="to-front" href="#"><i class="icon-flip-left"></i></a>
				<span class="corner-two "></span>
				<div class="flipper">
					<div class="front" style="background:<?php echo $color; ?>">
							<?php
							the_title('<h2 class="light beer-name beer-block">', '</h2>');
							echo '<h3 class="light beer-tagline">' . get_post_meta( $id, '_cartogram_short_description_value', TRUE ) . '</h3>';
							echo '<div class="back-logo big-icon icon-' . $icon . '-a"></div>';
							the_content();
						?>
					</div>
					<div class="back">
						 	<p class="space-inner-top-large">More Details Coming Soon...</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	