<?php
$instagram = new WP_Query('showposts=1');
while ($instagram->have_posts()): $instagram->the_post();?>

<?php endwhile;
?>

<?php 
$instagram = new WP_Query();
$instagram->query( array(
	'post_type'=> 'instagrams'
	));
	if ($instagram->have_posts()) : ?>	
		<div class="row bg-cream collapse flushed-left ">
			<div class="columns twelve double-bordered">
				<div class="flexslider rule-right">
					<ul class="slides">
						<?php while ($instagram->have_posts()) : $instagram->the_post(); ?>
						<li <?php post_class() ?>>			
							<?php get_template_part('parts/content/content', 'instagram' ); ?>		
						</li>		
						<?php endwhile; ?>	
					</ul>
				</div>
			</div>
		</div>
	<?php endif; 
?>


