<div class="row  <?php echo $slug; ?>">
	<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four rule-left"); ?>>	
		<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
		<?php get_template_part('parts/slideshows/slideshow', 'beers'); ?>
	</div>
	<div class="columns four pull-eight">
		<?php get_sidebar('beers'); ?>
	</div>
</div>
	