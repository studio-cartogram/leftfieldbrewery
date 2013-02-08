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

		flush_rewrite_rules( false );
	}

	function create_taxonomies() {
		$labels = array(
	    	'name' => __( 'Designer' ),
	    	'singular_name' => __( 'Designer' ),
	    	'search_items' =>  __( 'Search Designers' ),
	    	'all_items' => __( 'All Designers' ),
	    	'parent_item' => __( 'Parent Designer' ),
	    	'parent_item_colon' => __( 'Parent Designer:' ),
	    	'edit_item' => __( 'Edit Designer' ),
	    	'update_item' => __( 'Update Designer' ),
	    	'add_new_item' => __( 'Add New Designer' ),
	    	'new_item_name' => __( 'New Designer Name' )
	  	); 	

	  	register_taxonomy('manufacturer','products',array(
	    	'hierarchical' => false,
	    	'labels' => $manufacturerlabels
	  	));


		flush_rewrite_rules( false );
	}
?>