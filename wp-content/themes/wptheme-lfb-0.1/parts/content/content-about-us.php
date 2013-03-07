<?php global $slug; ?>

<div class="row  <?php echo $page_title; ?>">
	<div id="post-<?php the_ID(); ?>" <?php post_class('columns eight push-four rule-left mobile-flush'); ?>>	
		<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
		<div class="row flushed-left collapse">
			<div class="column twelve rule-right">
				<div class="post-text space-inner-bottom-xlarge">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="sidebar columns four pull-eight mobile-flush">
		<?php get_sidebar($slug); ?>
	</div>
</div>