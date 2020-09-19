<?php global $slug; ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="row  <?php echo $slug; ?>">
	<div id="post-<?php the_ID(); ?>" <?php post_class('columns eight push-four rule-left mobile-flush'); ?>>	
		<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
		<div class="row flushed-left collapse">
			<div class="column twelve rule-right">
				<div class="post-text border-bottom space-inner-top-large space-inner-bottom-xlarge">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="columns sidebar four pull-eight mobile-flush">
		<?php get_sidebar('events'); ?>	
	</div>
</div>

<?php endwhile; ?>