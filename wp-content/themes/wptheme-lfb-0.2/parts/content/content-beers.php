<?php
$alcvol = get_field('alcvol');
$ibu = get_field('ibu');
$srm = get_field('srm');
$food_pairings = get_field('food_pairings');
$bottle_shop = get_field('bottle_shop');
$title_content = get_field('content_title');

global $slug;
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<div class="row  <?php echo $slug; ?>">
			<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four mobile-flush rule-left"); ?>>	
				<h3 class="rule-right text-center ">
					<?php 
					if ($title_sidebar) {
						echo $title_sidebar;
					} else {
						echo 'Beer Stats';
					}
					?>
				</h3>
				<?php get_template_part('parts/slideshows/slideshow', 'beers'); ?>
				<div class="row flushed-left collapse">
					<div class="column twelve rule-right">
						<div class="post-text double-bordered">
							<div class="row collapse beer-stats equal-heights">					
								<?php
								echo '<div class="columns double-bordered space-inner-top alc">';
									echo '<h5 class="text-center border-bottom">ALC./VOL</h5>';
									echo '<h6 class="space-top">'. $alcvol . '</h6>';
								echo '</div>';
								echo '<div class="columns double-bordered space-inner-top IBU">';
									echo '<h5 class="text-center border-bottom">IBU</h5>';
									echo '<h6 class="space-top">'. $ibu . '</h6>';
								echo '</div>';
								echo '<div class="columns double-bordered space-inner-top SRM">';
									echo '<h5 class="text-center border-bottom">SRM</h5>';
									echo '<h6 class="space-top">'. $srm . '</h6>';
								echo '</div>';
								echo '<div class="columns double-bordered space-inner-top food_pairings">';
									echo '<h5 class="text-center border-bottom">Food Pairings</h5>';
									echo '<h6 class="space-top">'. $food_pairings . '</h6>';
								echo '</div>';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="sidebar columns four pull-eight mobile-flush">
				<?php get_sidebar('beers'); ?>
			</div>
		</div>
	<?php endwhile;
endif; 
?>
	