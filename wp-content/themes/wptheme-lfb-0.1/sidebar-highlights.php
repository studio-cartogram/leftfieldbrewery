<h5>Sort & Filter</h5>
<h5>Categories</h5>
<?php $categories = get_categories(array(
	'show_option_all'    => '',
	'orderby'            => 'name',
	'order'              => 'ASC',
	'style'              => 'list',
	'show_count'         => 0,
	'hide_empty'         => 0,
	'use_desc_for_title' => 1,
	'child_of'           => 0,
	'feed'               => '',
	'feed_type'          => '',
	'feed_image'         => '',
	'exclude'            => '',
	'exclude_tree'       => '',
	'include'            => '',
	'hierarchical'       => 1,
	'title_li'           => __( 'Categories' ),
	'show_option_none'   => __('No categories'),
	'number'             => null,
	'echo'               => 1,
	'depth'              => 0,
	'current_category'   => 0,
	'pad_counts'         => 0,
	'taxonomy'           => 'category',
	'walker'             => null
	));
foreach ($categories as $category) {
	?>
	<a href="<?php echo get_site_url() . '/highlights/' . $category->cat_name;?>"><?php echo $category->cat_name ?></a>
	<?php
}
?>
<h5>Tags</h5>
<?php
wp_tag_cloud(array(
	 'smallest'                  => 10, 
    'largest'                   => 10,
    'unit'                      => 'pt', 
    'number'                    => 45,  
    'format'                    => 'flat',
    'separator'                 => "\n",
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