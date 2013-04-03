<?php global $slug;
global $query_string;
?>

<div class="row  <?php echo $slug; ?>">
	<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four mobile-flush rule-left"); ?>>	
		<h3 class="rule-right text-center"><?php echo get_the_title(get_option('page_for_posts')) ?></h3>
		<div class="row flushed-left collapse">
			<div class="column twelve rule-right">
				<div class="post-text double-bordered space-inner-bottom-xlarge">
					<?php
						query_posts( $query_string . '&posts_per_page=1' );
					if (have_posts()) : 	
					while (have_posts()): the_post(); ?>
						<div class="row collapse">
							<div class="columns five post-meta">
								<h4 class="boxed"> <span><?php the_date('jS F, Y'); ?></span></h4>
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
					endif;
					?>
				</div>
			</div>
		</div>
		<div class="row flushed-left collapse">
			<div class="columns twelve double-bordered bg-cream">
				<h3 class="text-center rule-right">More from the feed</h3>
			</div>
		</div>
		<div class="row flushed-left equal-heights collapse">
			<?php query_posts( $query_string . '&posts_per_page=2&offset=1' );
				if (have_posts()) : 	
				while (have_posts()): the_post(); ?>
					<div class="columns six format-text rule-right bg-cream post-small space-inner-bottom">
						<?php get_template_part('parts/content/content', 'summary'); ?>
					</div>		
				<?php endwhile; 
			endif;
			?>
		</div>	
		<?php get_template_part('parts/navigation/pagination'); ?>

		


	</div>
	<div class="columns four mobile-flush pull-eight">
			<?php get_sidebar('home'); ?>
	</div>
</div>