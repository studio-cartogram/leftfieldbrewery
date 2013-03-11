<?php
global $post;
	$current =  get_permalink();
	$prevPost = get_previous_post();
	$prevURL = get_permalink($prevPost->ID);
	$nextPost = get_next_post();
	$nextURL = get_permalink($nextPost->ID);
?>

<nav class="row collapse flushed-left border-top border-bottom" id="pagination" role="navigation">
	<div class="columns mobile-one one rule-right bg-navy pagination-arrow">
		<?php if(!$nextURL){
				echo "<a class='cartogram-slider-disabled'><i class='icon-arrow-left'></i></a>";
 			} else { 
 				echo '<a href="' . $nextURL . '" ><i class="icon-arrow-left"></i></a>';
 			}
 		?>
	</div>
	<div class="columns mobile-one five rule-right border-bottom bg-cream pagination-link">
		<?php if(!$nextURL){
				echo "<a class='disabled'>Older</a>";
 			} else {
 				echo '<a href="' . $nextURL . '" >Newer</a>';
 			}
 		?>
	</div>
	<div class="columns mobile-one five rule-right border-bottom bg-cream pagination-link">
			<?php if(!$prevURL){
				echo "<a class='disabled'>Newer</a>";
 			} else {
 				echo '<a href="' . $prevURL . '" >Older</a>';
 			}
 		?>
	</div>
	<div class="columns mobile-one one rule-right rule-left bg-navy pagination-arrow">
			<?php if(!$prevURL){
				echo "<a class='cartogram-slider-disabled'><i class='icon-arrow-right'></i></a>";
 			} else {
 				echo '<a href="' . $prevURL . '" ><i class="icon-arrow-right"></i></a>';
 			}
 		?>
	</div>
</nav><!-- #<?php echo $html_id; ?> .navigation -->