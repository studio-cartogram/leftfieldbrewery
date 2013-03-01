<div class="row  highlights">
	<div class="columns eight push-four rule-left">	
		<?php the_title('<h3 class="rule-right text-center">','</h3>') ?>
			<div class="row flushed-left collapse">
				<div class="column twelve rule-right">
					<div class="post-text double-bordered">
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
			</div>
		</div>	
	</div>
	<div class="columns pull-eight four">
		<?php get_sidebar('highlights'); ?>
	</div>
</div>