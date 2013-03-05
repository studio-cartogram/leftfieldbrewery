<?php
global $slug; ?>

<div class="row  <?php echo $page_title; ?>">
	<div class="columns eight push-four rule-left" id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>	
		<?php // the_title('<h3 class="rule-right text-center">','</h3>') ?>
		<div class="row flushed-left collapse">
			<div class="column twelve rule-right">
				<div class="post-text">
					<?php if ( have_posts() ) :
							while ( have_posts() ) : the_post(); ?>
									<div class="row ">
									<div class="columns twelve">
											
									</div>
								</div>			
						<?php endwhile;
					endif; 
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="columns four pull-eight">
		<?php get_sidebar($slug); ?>
	</div>
</div>