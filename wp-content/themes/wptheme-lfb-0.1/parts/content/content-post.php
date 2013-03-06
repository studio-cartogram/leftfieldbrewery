<?php
global $slug;
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<div class="row  <?php echo $slug; ?>">
			<div id="post-<?php the_ID(); ?>" <?php post_class("columns eight push-four rule-left"); ?>>	
				<h3 class="rule-right text-center"><?php echo get_the_title(get_option('page_for_posts')) ?></h3>
				<div class="row flushed-left collapse">
					<div class="column twelve rule-right">
						<div class="post-text double-bordered">
							<div class="row collapse">
								<div class="columns seven post-meta">
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
							
							the_content(); ?>
						</div>
					</div>
				</div>
			<?php get_template_part('parts/navigation/pagination','single') ?>
			</div>
			<div class="columns four pull-eight">
				<?php get_sidebar(get_post_type()); ?>
			</div>
		</div>

	<?php endwhile;
endif; 
?>