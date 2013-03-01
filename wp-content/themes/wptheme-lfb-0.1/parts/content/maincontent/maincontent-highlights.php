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
<div class="row flushed-left collapse">
	<div class="columns twelve double-bordered bg-cream">
		<h3 class="text-center rule-right">More from the feed</h3>
	</div>
</div>
<div class="row flushed-left collapse">
	<?php global $myExcerptLength;
			$myExcerptLength = 20;
		$query = new WP_Query('showposts=2&offset=1');
		while ($query->have_posts()): $query->the_post(); ?>
			<div class="columns six format-text rule-right bg-cream">
				<?php get_template_part('parts/content/content', 'summary'); ?>
			</div>		

		<?php endwhile;
	$myExcerptLength = 0;
	?>
</div>	
<div class="row flushed-left collapse border-top border-bottom">
	<div class="columns one rule-right bg-navy">
		<a class="direction-nav"><i class="icon-arrow-left"></i></a>
	</div>
	<div class="columns five rule-right border-bottom bg-cream">
		<a class="button-link expand button disabled" href="<?php echo get_site_url() ?>/page/2/" class="highlightsPagination">
			Newer <?php //Will this always be unclickable? ?>
		</a>
	</div>
	<div class="columns five rule-right border-bottom bg-cream">
		<a class="button-link expand button" href="<?php echo get_site_url() ?>/page/2/" class="highlightsPagination">
			Older
		</a>
	</div>
	<div class="columns one rule-right rule-left bg-navy">
		<a class="direction-nav" href="<?php echo get_site_url() ?>/page/2/" class="highlightsPagination"><i class="icon-arrow-right"></i></a>
	</div>
</div>
