<?php

	/* ========================================================================================================================
	
	Cartogram Post Types and Taxonomies Functions v.1.0
	
	======================================================================================================================== */

	function create_post_types() {
		
		$jobsLabels = array(
			'name' => __( 'Jobs' ),
			'singular_name' => __( 'Job' ),
			'add_new' => __( 'Add New' ),
			'add_new_item' => __( 'Add New Job' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit Job' ),
			'new_item' => __( 'New Job' ),
			'view' => __( 'View Job' ),
			'view_item' => __( 'View Job' ),
			'search_items' => __( 'Search Jobs' ),
			'not_found' => __( 'No Jobs found' ),
			'not_found_in_trash' => __( 'No Jobs found in Trash' ),
			'parent' => __( 'Parent Job' ),
		);
		
		$jobsArgs = array(
			'labels' => $jobsLabels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => false,		
			'rewrite' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'taxonomies' => array('category'),
			'menu_position' => null,
			'supports' => array('title', 'editor', 'thumbnail')
		); 	
		
		register_post_type( 'jobs' , $jobsArgs );

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

		$vendorLabels = array(
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
		
		$vendorArgs = array(
			'labels' => $vendorLabels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,		
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'taxonomies' => array(),
			'menu_position' => null,
			'supports' => array('title')
		); 	
		
		register_post_type( 'vendors' , $vendorArgs );

		$instagramLabels = array(
			'name' => __( 'Instagrams' ),
			'singular_name' => __( 'Instagram' ),
			'add_new' => __( 'Add New' ),
			'add_new_item' => __( 'Add New Instagram' ),
			'edit' => __( 'Edit' ),
			'edit_item' => __( 'Edit Instagram' ),
			'new_item' => __( 'New Product' ),
			'view' => __( 'View Instagram' ),
			'view_item' => __( 'View Instagram' ),
			'search_items' => __( 'Search Instagrams' ),
			'not_found' => __( 'No Instagrams found' ),
			'not_found_in_trash' => __( 'No Instagrams found in Trash' ),
			'parent' => __( 'Parent Instagram' ),
		);
		
		$instagramArgs = array(
			'labels' => $instagramLabels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,		
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'taxonomies' => array(),
			'menu_position' => null,
			'supports' => array('title', 'editor', 'thumbnail')
		); 	
		
		register_post_type( 'instagrams' , $instagramArgs );



		flush_rewrite_rules( false );
	}

	function create_taxonomies() {
		$labels = array(
	    	'name' => __( 'Vendor Type' ),
	    	'singular_name' => __( 'Vendor Type' ),
	    	'search_items' =>  __( 'Search Vendor Types' ),
	    	'all_items' => __( 'All Vendor Types' ),
	    	'parent_item' => __( 'Parent Vendor Type' ),
	    	'parent_item_colon' => __( 'Parent Vendor Type:' ),
	    	'edit_item' => __( 'Edit Vendor Type' ),
	    	'update_item' => __( 'Update Vendor Type' ),
	    	'add_new_item' => __( 'Add New Vendor Type' ),
	    	'new_item_name' => __( 'New Vendor Type Name' )
	  	); 	

	  	register_taxonomy('type','vendors',array(
	    	'hierarchical' => true,
	    	'labels' => $labels
	  	));

		flush_rewrite_rules( false );
	}
?>
