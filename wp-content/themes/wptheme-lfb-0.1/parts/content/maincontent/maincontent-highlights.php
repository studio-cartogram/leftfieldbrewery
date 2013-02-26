<div class="row flushed-left collapse">
	<div class="column twelve rule-right">
		<div class="post-text double-bordered">
			<?php
			$query = new WP_Query('showposts=1');
			while ($query->have_posts()): $query->the_post(); ?>
				<div class="row collapse">
					<div class="columns five post-meta">
						<h4 class="boxed"> <?php the_date('jS F, Y'); ?></h4>
					</div>
				</div>
				<?php if (has_post_thumbnail()){
					echo "<a href='" . get_permalink() . "'>" . get_the_post_thumbnail() . "</a>";
				}
				echo "<h1 class='post-title'>" . "<a href='" . get_permalink() . "'>" . get_the_title() . "</a></h1>";
				$categories = 	get_the_category();
				$tags 		= 	get_the_tags();
				$separator 	= 	'◆';
				$output 	= 	'<ul class="link-list">';

				if($categories){
					foreach($categories as $category) {
						$output .= '<li class="sep">'.$separator.'</li>';
						$output .= '<li><a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></li>';
					}
				}
				if($tags){
					foreach($tags as $tag) {
						$output .= '<li class="sep">'.$separator.'</li>';
						$output .= '<li><a href="'.get_tag_link($tag->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $tag->name ) ) . '">'.$tag->name.'</a></li>';
					}
				}
				if($categories || $tags){ 
					$output .= "</ul>";
					echo trim($output, $separator);
				}				
				the_excerpt();
				more_link();
			endwhile;
			?>
		</div>
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
