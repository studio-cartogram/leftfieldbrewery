<h3 class="rule-left text-center ">Sort &amp; Filter </h3>
<div class="row collapse flushed-right">
	<div class="columns twelve rule-left ">
		<div class="row collapse">

			<div class="columns twelve categories-wrap">
				<h3 class="space-inner-top bg-navy light text-center">Categories</h3>
				<?php $categories = get_categories();
					$slug = get_queried_object()->post_name; 
					$term = get_queried_object();
					$term_name = apply_filters( 'single_cat_title', $term->name );
				if ($categories) {
					echo '<ul class="block-grid two-up list-categories">';
					foreach ($categories as $category) {
						if ($term_name == $category->cat_name) {
							$classes = "active";
						} else {
							$classes = "";
						}
						echo '<li' . ' class="' . $classes.'"><a class=" light" href="' . get_category_link( $category->term_id ) . '">' . $category->cat_name . '</a></li>';
					}
					echo '</ul>';
				}	
				?>
			</div>
		</div>	
		<div class="row collapse">
			<div class="columns twelve tags-wrap">	
				<h3 class="space-inner-top bg-navy light text-center rule-left ">Tags</h3>
				<div class="inner-text bg-navy light tag-cloud space-inner-top space-inner-bottom">
					<?php
						wp_tag_cloud(array(
							'smallest'                  => 12, 
						    'largest'                   => 12,
						    'unit'                      => 'px', 
						    'separator'                 => ", "
						));
					?>
				</div>
			</div>
		</div>
	</div>
</div>		
