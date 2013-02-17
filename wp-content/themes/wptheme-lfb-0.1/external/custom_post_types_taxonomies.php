<?php

	/* ========================================================================================================================
	
	Cartogram Post Types and Taxonomies Functions v.1.0
	
	======================================================================================================================== */

	function create_post_types() {
		
		$establishmentsLabels = array(
			'name' => __( 'Establishments' ),
			'singular_name' => __( 'Establishment' ),
			'add_new' => __( 'Add New' ),
			'add_new_item' => __( 'Add New Establishment' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit Establishment' ),
			'new_item' => __( 'New Establishment' ),
			'view' => __( 'View Establishment' ),
			'view_item' => __( 'View Establishment' ),
			'search_items' => __( 'Search Establishments' ),
			'not_found' => __( 'No Establishments found' ),
			'not_found_in_trash' => __( 'No Establishments found in Trash' ),
			'parent' => __( 'Parent Establishment' ),
		);
		
		$establishmentsArgs = array(
			'labels' => $establishmentsLabels,
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
		
		register_post_type( 'establishments' , $establishmentsArgs );

		$playersLabels = array(
			'name' => __( 'Players' ),
			'singular_name' => __( 'Player' ),
			'add_new' => __( 'Add New' ),
			'add_new_item' => __( 'Add New Player' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit Player' ),
			'new_item' => __( 'New Player' ),
			'view' => __( 'View Player' ),
			'view_item' => __( 'View Player' ),
			'search_items' => __( 'Search Players' ),
			'not_found' => __( 'No Players found' ),
			'not_found_in_trash' => __( 'No Players found in Trash' ),
			'parent' => __( 'Parent Player' ),
		);
		
		$playersArgs = array(
			'labels' => $playersLabels,
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
		
		register_post_type( 'players' , $playersArgs );


		$beersLabels = array(
			'name' => __( 'Beers' ),
			'singular_name' => __( 'Beer' ),
			'add_new' => __( 'Add New' ),
			'add_new_item' => __( 'Add New Beer' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit Beer' ),
			'new_item' => __( 'New Beer' ),
			'view' => __( 'View Beer' ),
			'view_item' => __( 'View Beer' ),
			'search_items' => __( 'Search Beers' ),
			'not_found' => __( 'No Beers found' ),
			'not_found_in_trash' => __( 'No Beers found in Trash' ),
			'parent' => __( 'Parent Beer' ),
		);
		
		$beersArgs = array(
			'labels' => $beersLabels,
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
		
		register_post_type( 'beers' , $beersArgs );
		flush_rewrite_rules( false );
	}

	function create_taxonomies() {
		flush_rewrite_rules( false );
	}
?>