<?php
global $slug;
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<div class="row  <?php echo $slug; ?>">
			<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four mobile-flush rule-left"); ?>>	
				<h3 class="rule-right text-center">A Distinctive League of Delicious Brews</h3>
				<?php get_template_part('parts/slideshows/slideshow', 'beers'); ?>
				<div class="row flushed-left collapse">
					<div class="column twelve rule-right">
						<div class="post-text double-bordered">
							<div class="row collapse beer-stats">					
								<?php
								$fields = array(
										"ALC./VOL" => "alc",
										"IBU" => "IBU",
										"SRM" => "SRM",
										"Food Pairings" => "food_pairings" 
									);
								foreach ($fields as $title => $name) { 
									echo '<div class="columns double-bordered space-inner-top ' . $name . '">';
										echo '<h5 class="text-center border-bottom">' . $title . '</h5>';
										echo '<h6 class="space-top">'. get_post_meta( $id, '_cartogram_'.$name.'_value', TRUE ) . '</h6>';
									echo '</div>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="columns four pull-eight mobile-flush">
				<?php get_sidebar('beers'); ?>
			</div>
		</div>
	<?php endwhile;
endif; 
?>
	