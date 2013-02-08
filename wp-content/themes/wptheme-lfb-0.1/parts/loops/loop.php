<?php 
$posts = new WP_Query();
$posts->query( array(
	'post_type'=> 'page',
	'orderby' => 'menu_order',
	'order' => 'ASC'
	));
	if ($posts->have_posts()) : ?>	
		<?php while ($posts->have_posts()) : $posts->the_post(); ?>
		<li>
			
					<?php $slug = basename(get_permalink()); 
					get_template_part('parts/content/content', $slug ); ?>	
				
		</li>		
		<?php endwhile; ?>	
	<?php endif; 
?>