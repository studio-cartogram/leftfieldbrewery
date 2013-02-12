<?php 
	$posts = new WP_Query();
	$posts->query( array(
		));
		if ($posts->have_posts()) : ?>	
			<?php while ($posts->have_posts()) : $posts->the_post(); ?>
			
				<div class="row">
					<div class="columns twelve">
						<?php  
						get_template_part('parts/content/content', 'post' ); ?>	
					</div>
				</div>
			<?php endwhile; ?>	
		<?php endif; 
	?>