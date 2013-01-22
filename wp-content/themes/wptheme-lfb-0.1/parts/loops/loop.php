<?php 
$posts = new WP_Query();
$posts->query( array(
		
	));
	if ($posts->have_posts()) : ?>
	
				<?php while ($posts->have_posts()) : $posts->the_post(); ?>
					<?php get_template_part('parts/content/content', get_post_format() ); ?>	
				<?php endwhile; ?>
	<?php endif; 
?>