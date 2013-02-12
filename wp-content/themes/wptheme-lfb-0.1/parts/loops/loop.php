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
			<div class="row slide-row">
				<div class="columns twelve">
					<?php //get_template_part('parts/content/content', get_post_format() ); ?>	
				</div>
			</div>
		</li>		
		<?php endwhile; ?>	
	<?php endif; 
?>