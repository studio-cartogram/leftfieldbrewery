<div class="row  highlights">
	<div class="columns four">
		<?php get_sidebar('highlights'); ?>
	</div>
	<div class="columns eight">	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h3 class="entry-title"><?php echo $page_title; ?></h3>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<div class="row">
					<div class="columns twelve">
						<?php
						global $post;
						the_post_thumbnail();
						foreach (get_the_category() as $category) {
							echo $category->cat_name;
						}
						the_tags();
						the_content();
						?>
					</div>
				</div>
				<div class="row">
					<div class="columns one">
						left
					</div>
					<div class="columns five">
						<?php  previous_post_link('%link', "newer", TRUE)?>
					</div>
					<div class="columns five">
						<?php next_post_link('%link', "older", TRUE);?>
					</div>
					<div class="columns one">
						right
					</div>
				</div>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>