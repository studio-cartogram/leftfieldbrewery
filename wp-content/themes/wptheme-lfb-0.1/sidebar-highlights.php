<h3 class="rule-left text-center ">Sort &amp; Filter </h3>
<div class="row collapse flushed-right">
	<div class="columns twelve rule-left ">
		<div class="row collapse">
			<div class="columns twelve categories-wrap">
				<h3 class="space-inner-top bg-navy light text-center">Categories</h3>
				<?php $categories = get_categories();
				if ($categories) {
					echo '<ul class="block-grid two-up list-categories">';
					foreach ($categories as $category) {
						echo '<li><a class=" light" href="' . ' get_site_url()' . '/category/' . $category->cat_name . '">' . $category->cat_name . '</a></li>';
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
						    'number'                    => 45,  
						    'format'                    => 'flat',
						    'separator'                 => ", ",
						    'orderby'                   => 'name', 
						    'order'                     => 'ASC',
						    'exclude'                   => null, 
						    'include'                   => null, 
						    'topic_count_text_callback' => default_topic_count_text,
						    'link'                      => 'view', 
						    'taxonomy'                  => 'post_tag', 
						    'echo'                      => true
						));
					?>
				</div>
			</div>
		</div>
	</div>
</div>		
