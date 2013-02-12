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
<<<<<<< HEAD
			<div class="row slide-row">
				<div class="columns twelve">
					<?php //get_template_part('parts/content/content', get_post_format() ); ?>	
				</div>
			</div>
=======
			
					<?php $slug = basename(get_permalink()); 
					get_template_part('parts/content/content', $slug ); ?>	
				
>>>>>>> 94eccba856f142ce481ba1ce1433cb0e81c856bb
		</li>		
		<?php endwhile; ?>	
	<?php endif; 
?>