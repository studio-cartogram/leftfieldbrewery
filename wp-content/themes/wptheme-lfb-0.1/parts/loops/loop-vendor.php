<?php 
$vendors = new WP_Query();
$vendors->query( array(
	'post_type'=> 'vendors'
	));
	if ($vendors->have_posts()) : ?>	
		<?php while ($vendors->have_posts()) : $vendors->the_post(); ?>
		<li <?php post_class() ?>>			
			<?php get_template_part('parts/content/content', 'vendor' ); ?>		
		</li>		
		<?php endwhile; ?>	
	<?php endif; 
?>