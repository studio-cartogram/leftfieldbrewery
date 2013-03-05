<?php
global $slug;
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<li class="slideNum<?php echo $i; ?>">
			<div class="row slide-row">
				<div class="columns twelve">
					<?php get_template_part('parts/content/content', $slug); ?>
				</div>
			</div>			
		</li>
	<?php endwhile;
endif; 
?>		