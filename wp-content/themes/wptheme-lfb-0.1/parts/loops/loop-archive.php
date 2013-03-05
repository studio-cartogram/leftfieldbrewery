<?php
global $slug; ?>
<li class="slideNum<?php echo $i; ?>">
	<div class="row slide-row">
		<div class="columns twelve">
			<div class="row  <?php echo $slug; ?>">
				<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four rule-left"); ?>>	
					<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
					<div class="row flushed-left collapse">
						<div class="column twelve rule-right">
							<div class="post-text">
								<?php if ( have_posts() ) : ?>
									<ul class="block-grid two-up excerpt-loop">
										<?php while ( have_posts() ) : the_post(); ?>
											<li>
												<?php get_template_part('parts/content/content', 'excerpt'); ?>
											</li>
										<?php endwhile; ?>
									</ul>
								<?php endif; ?>	
							</div>
						</div>
					</div>
				</div>
				<div class="columns four pull-eight">
					<?php if (is_front_page()) {
						get_sidebar('front-page'); 
					} elseif (is_home()) { 
						get_sidebar('home');
					} else {
						get_sidebar($slug);
					} ?>
				</div>
			</div>
		</div>		
	</div>			
</li>
	