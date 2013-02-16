<?php
	$establishments = new WP_Query( array( "post_type" => "establishments") );

?>
<div class="row">
	<div class="columns twelve">
		<h6>Find out beer at these all-star establishments. </h6>
		<ul class="establishments"> 
			<?php while ($establishments->have_posts()) : $establishments->the_post(); ?>
				<li class="establishment">
					<article class="content">
						<?php $icons = array(	
							"drinks_icon" => get_post_meta( $post->ID, '_cartogram_drinks_value', TRUE ),
							"food_icon" => get_post_meta( $post->ID, '_cartogram_food_value', TRUE ),
							"draft_icon" => get_post_meta( $post->ID, '_cartogram_draft_value', TRUE )
						); ?>
						<?php foreach ($icons as $type => $value) {
							if ($value) {
								//This implies the establishment has "type"={food, drinks, draft}
								echo $type;
							}
						}?>
						<?php the_title('<h7 class="establishment-name">','</h7>') ?>
						<?php the_content() ?>				
					</article>
				</li>
			<?php endwhile; ?>	
		</ul>
	</div>
</div>