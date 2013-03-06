
<h3 class="rule-left text-center ">An Unusual Delivery</h3>
<div class="row collapse flushed-right">
	<div class="columns twelve double-bordered">
		<div class="rule-left">
			<div class="flip-container">
				<a class="flip" id="to-back" href="#"><i class="icon-flip-right"></i></a>
				<a class="flip" id="to-front" href="#"><i class="icon-flip-left"></i></a>
				<span class="corner-one"></span>
				<span class="corner-two "></span>
				<span class="corner-three"></span>
				<span class="corner-four "></span>
				<div class="flipper">
					<div class="front">
					<?php if (has_post_thumbnail()) { 
								the_post_thumbnail();
							} else {
								echo '<img src="' . get_bloginfo("stylesheet_directory") . '/images/placeholder.png" class="placeholder-players"/>';
						} 
						$first_name = preg_split("/[\s,]+/", get_the_title());
					?>
					</div>
					<div class="back">
						<?php echo '<div class="back-logo icon-' . $icon . '"></div>';
						 	the_title('<h2>', '</h2>');
						 	echo get_post_meta( $id, '_cartogram_short_description_value', TRUE );
							the_content();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	