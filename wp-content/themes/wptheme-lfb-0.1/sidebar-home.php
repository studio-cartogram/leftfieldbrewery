<?php
	$vendors = new WP_Query( array( "post_type" => "vendors") );

?>
<div class="row">
	<div class="columns twelve">
		<h6>Find out beer at these all-star establishments. </h6>
		<ul class="vendors"> 
			<?php while ($vendors->have_posts()) : $vendors->the_post(); ?>
				<li class="vendor">
					<article class="content">
						<?php
							$taxonomy_icons = array("bar"=> "&#xe016;", "restaurant" => "&#xe007;", "brew pub" => "&#xe014;");
							$map_url = get_post_meta( $post->ID, '_cartogram_map_value', TRUE );
							$descriptive_address = get_post_meta( $post->ID, '_cartogram_address_value', TRUE );
							$taxonomies = wp_get_post_terms($post->ID, 'type');
							foreach ($taxonomies as $taxonomy) {
						?>
								<div class="fs1"aria-hidden="true" data-icon="<?php echo $taxonomy_icons[$taxonomy->name];?>"></div>
						
					 		<?php }	?>

						<?php the_title('<h7 class="vendor-name">','</h7>') ?>
						<?php echo $descriptive_address;?>
					</article>
				</li>
			<?php endwhile; ?>	
		</ul>
	</div>
</div>