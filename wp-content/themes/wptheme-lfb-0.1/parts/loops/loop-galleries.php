<div class="row">
	<div class="columns twelve">
		<div class="flexslider">
			<ul class="slides">
				<?php 
				global $attachments;
   				foreach ($attachments as $picture) {
   					echo "<li>";
   					echo '<img src="' . wp_get_attachment_url($picture->ID) . '">';
   					$picture_title = $picture->post_title;
   					$picture_caption = $picture ->post_excerpt;
   					echo '<p class="flex-caption">';
   					echo '<span>'. $picture_title . '</span>'; 					
   					echo $picture_caption;   	
   					echo '</p>';
   					echo "</li>";
   				}
				?>
			</ul>
			<ul class="slide-counts">
				<li class="current-slide">1</li>
				<li class="total-slides"></li>
			</ul>	
		</div>
	</div>
</div><!-- Gallery -->
