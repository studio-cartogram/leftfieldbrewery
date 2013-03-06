<nav class="row collapse flushed-left border-top border-bottom" id="pagination" role="navigation">
	<div class="columns mobile-one one rule-right bg-navy pagination-arrow">
		<?php if(!get_previous_posts_link()){
				echo "<a class='cartogram-slider-disabled'><i class='icon-arrow-left'></i></a>";
 			} else {
 				previous_posts_link( __( '<i class="icon-arrow-left"></i>', 'cartogram' ) );
 			}
 		?>
	</div>
	<div class="columns mobile-one five rule-right border-bottom bg-cream pagination-link">
		<?php if(!get_previous_posts_link()){
				echo "<a class='disabled'>Newer</a>";
 			} else {
 				previous_posts_link( __( 'Newer', 'cartogram' ) );
 			}
 		?>
	</div>
	<div class="columns mobile-one five rule-right border-bottom bg-cream pagination-link">
			<?php if(!get_next_posts_link()){
				echo "<a class='disabled'>Older</a>";
 			} else {
 				next_posts_link( __( 'Older ', 'cartogram' ) );
 			}
 		?>
	</div>
	<div class="columns mobile-one one rule-right rule-left bg-navy pagination-arrow">
		<?php if(!get_next_posts_link()){
				echo "<a class='cartogram-slider-disabled'><i class='icon-arrow-right'></i></a>";
 			} else {
 				next_posts_link( __( '<i class="icon-arrow-right"></i>', 'cartogram' ) );
 			}
 		?>
	</div>
</nav><!-- #<?php echo $html_id; ?> .navigation -->


