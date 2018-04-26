<?php 	
$icon_image = get_field('icon');
$short_description = get_field('short_description');
$color = get_field('color');
$title_sidebar = get_field('sidebar_title');
?>

<h3 class="rule-left text-center ">
<?php 
	if ($title_sidebar) {
		echo $title_sidebar;
	} else {
		echo 'An Unusual Delivery';
	}
?>
</h3>

<div class="row collapse flushed-right sidebar-beer">
	<div class="columns twelve double-bordered">
		<div class="rule-left">
			<div style="background:<?php echo $color; ?>" class="flip-container ">
				<a class="flip" id="to-back" href="#"><i style="color:<?php echo $color; ?>"  class="icon-flip-right"></i></a>
				<div class="flipper ">
					<div class="front" style="background:<?php echo $color; ?>">
						<span class="corner-two "></span>
							<?php
							the_title('<h2 class="light beer-name beer-block">', '</h2>');
							echo '<h3 class="light beer-tagline">' . $short_description . '</h3>';
              echo '<div class="back-logo big-icon multi-svg">';
              echo '<img src="' . wp_get_attachment_image_src( $icon_image )[0] . '" />';
							echo '</div>';
							the_content();
						?>
					</div>
					<div class="back" style="background:<?php echo $color; ?>">
						<span class="corner-two "></span>
						<a class="flip" id="to-front" href="#"><i style="color:<?php echo $color; ?>" class="icon-flip-left"></i></a>
						<p class="space-inner-top-large">More Details Coming Soon...</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
