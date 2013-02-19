<?php

	/* ========================================================================================================================
	
	Cartogram Post Types and Taxonomies Functions v.1.0
	
	======================================================================================================================== */

	function create_post_types() {
		
		$labels = array(
			'name' => __( 'Beers' ),
			'singular_name' => __( 'Beer' ),
			'add_new' => __( 'Add New' ),
			'add_new_item' => __( 'Add New Beer' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit Beer' ),
			'new_item' => __( 'New Product' ),
			'view' => __( 'View Beer' ),
			'view_item' => __( 'View Beer' ),
			'search_items' => __( 'Search Beers' ),
			'not_found' => __( 'No Beers found' ),
			'not_found_in_trash' => __( 'No Beers found in Trash' ),
			'parent' => __( 'Parent Beer' ),
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,		
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'taxonomies' => array('category'),
			'menu_position' => null,
			'supports' => array('title', 'editor', 'thumbnail')
		); 	
		
		register_post_type( 'beers' , $args );

		$labels = array(
			'name' => __( 'Vendors' ),
			'singular_name' => __( 'Vendor' ),
			'add_new' => __( 'Add New' ),
			'add_new_item' => __( 'Add New Vendor' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit Vendor' ),
			'new_item' => __( 'New Product' ),
			'view' => __( 'View Vendor' ),
			'view_item' => __( 'View Vendor' ),
			'search_items' => __( 'Search Vendors' ),
			'not_found' => __( 'No Vendors found' ),
			'not_found_in_trash' => __( 'No Vendors found in Trash' ),
			'parent' => __( 'Parent Vendor' ),
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,		
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'taxonomies' => array('category'),
			'menu_position' => null,
			'supports' => array('title')
		); 	
		
		register_post_type( 'vendors' , $args );

		flush_rewrite_rules( false );
	}

	function create_taxonomies() {
		$labels = array(
	    	'name' => __( 'Restaurant Type' ),
	    	'singular_name' => __( 'Restaurant Type' ),
	    	'search_items' =>  __( 'Search Restaurant Types' ),
	    	'all_items' => __( 'All Restaurant Types' ),
	    	'parent_item' => __( 'Parent Restaurant Type' ),
	    	'parent_item_colon' => __( 'Parent Restaurant Type:' ),
	    	'edit_item' => __( 'Edit Restaurant Type' ),
	    	'update_item' => __( 'Update Restaurant Type' ),
	    	'add_new_item' => __( 'Add New Restaurant Type' ),
	    	'new_item_name' => __( 'New Restaurant Type Name' )
	  	); 	

	  	register_taxonomy('type','',array(
	    	'hierarchical' => false,
	    	'labels' => $manufacturerlabels
	  	));


		flush_rewrite_rules( false );
	}
?>