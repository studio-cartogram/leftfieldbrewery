<?php
global $slug; ?>
<div class="row">
	<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight mobile-flush push-four rule-left"); ?>>	
		<h3 class="rule-right text-center"><?php echo get_the_title(get_option('page_for_posts')) ?></h3>
		<div id="content" class="row flushed-left  collapse">
			<div class="column twelve rule-right ">
				<div class="post-text double-bordered">
					<div class="row collapse bg-cream">
						<div class="columns seven post-meta space-inner-bottom">
							<?php if ( is_day() ) :
								echo '<h4 class="boxed"><span>Archives</span> <span class="bg-navy light">' . get_the_date(  ) . '</span></h4>';
							elseif ( is_month() ) :
								echo '<h4 class="boxed"><span>Archives</span> <span class="bg-navy light">' . get_the_date( 'F Y' ) . '</span></h4>';
							elseif ( is_year() ) :
								echo '<h4 class="boxed"><span>Archives</span> <span class="bg-navy light">' . get_the_date( 'Y' ) . '</span></h4>';
							elseif(is_category()) :
								echo '<h4 class="boxed"><span>Category</span> <span class="bg-navy light">' . single_cat_title( '', false ) . '</span></h4>';
							elseif(is_tag()) :
								echo '<h4 class="boxed"><span>Tag</span> <span class="bg-navy light">' . single_cat_title( '', false ) . '</span></h4>';
							
							elseif(is_paged()) :
								echo '<h4 class="boxed"><span>Page</span> <span class="bg-navy light">' . $paged . '</span></h4>';
							
							else :
								_e( 'Archives', 'twentytwelve' );
							endif;
							?>
							
						</div>
					</div>
				</div>
				
				<?php if ( have_posts() ) : $count=0 ;
						$posts_per_page = get_option('posts_per_page');
						$posts_on_this_page = $wp_query->post_count;
						$posts_in_query = $wp_query->found_posts; 
						 while ( have_posts() ) : the_post(); $count++;
							if ($count % 2 != 0 || $total == 1) {
								echo'<div class="row  bg-cream collapse">';
							} 
							?>
							<div class="columns six format-text space-inner-bottom rule-right bg-cream post-small post-<?php echo $count ?>">
								<?php get_template_part('parts/content/content', 'excerpt'); ?>
							</div>
							<?php if (($count % 2 == 0) || ($count == $posts_in_query) || ($count == $posts_per_page) || $posts_on_this_page == 1  ) {
								echo '</div>';

							} ?>
						<?php endwhile; ?>
					
					
				<?php endif; ?>	
				
			</div>
		</div>
		<?php get_template_part('parts/navigation/pagination'); ?>	
	</div>
	<div class="columns mobile-flush four pull-eight">
		<?php if (is_front_page()) {
			get_sidebar('front-page'); 
		} elseif (is_home()) { 
			get_sidebar('home');
		} else {
			get_sidebar('home');
		} ?>
	</div>
</div>
