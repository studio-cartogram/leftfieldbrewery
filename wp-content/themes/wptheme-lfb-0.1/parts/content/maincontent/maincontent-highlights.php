<div class="row">
	<div class="columns twelve">
		<?php
		$query = new WP_Query('showposts=1');
		while ($query->have_posts()): $query->the_post();
			echo get_the_date('jS F, Y');
			the_post_thumbnail();
			foreach (get_the_category() as $category) {
				echo $category->cat_name;
			}
			the_tags();
			the_excerpt();
		endwhile;
		?>
	</div>
</div>
<div class="row">
	<div class="columns twelve">
		<h5>More from the feed</h5>
	</div>
</div>
<div class="row">
	<?php
	global $myExcerptLength;
	$myExcerptLength = 20;
	$query = new WP_Query('showposts=2&offset=1');
	while ($query->have_posts()): $query->the_post();
		get_template_part('parts/content/content', 'summary');
	endwhile;
	$myExcerptLength = 0;
	?>
</div>
<div class="row">
	<div class="columns one">
		left
	</div>
	<div class="columns five">
		newer <?php //Will this always be unclickable? ?>
	</div>
	<div class="columns five">
		<a href="<?php echo get_site_url() ?>/page/2/" class="highlightsPagination">older</a>
	</div>
	<div class="columns one">
		right
	</div>
</div>
