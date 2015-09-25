<?php
global $slug;
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
			<div class="row slide-row">
				<div class="columns twelve">
					<?php get_template_part('parts/content/content', $slug); ?>
				</div>
			</div>			
	<?php endwhile;
endif; 
?>