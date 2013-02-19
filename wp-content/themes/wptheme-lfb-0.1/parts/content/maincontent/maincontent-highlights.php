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
		?>
		<div class="columns six">

			<?php
			echo "<p>" . get_the_date('jS F, Y') . "</p>";
			the_title();
			the_excerpt();
			?>
		</div>
		<?php
	endwhile;
	$myExcerptLength = 0;
	?>
</div>
