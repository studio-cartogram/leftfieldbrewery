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

		$manufacturerlabels = array(
	    	'name' => __( 'Manufacturer' ),
	    	'singular_name' => __( 'Manufacturer' ),
	    	'search_items' =>  __( 'Search Manufacturers' ),
	    	'all_items' => __( 'All Manufacturers' ),
	    	'parent_item' => __( 'Parent Manufacturer' ),
	    	'parent_item_colon' => __( 'Parent Manufacturer:' ),
	    	'edit_item' => __( 'Edit Manufacturer' ),
	    	'update_item' => __( 'Update Manufacturer' ),
	    	'add_new_item' => __( 'Add New Manufacturer' ),
	    	'new_item_name' => __( 'New Manufacturer Name' )
	  	); 	

	  	register_taxonomy('manufacturer','products',array(
	    	'hierarchical' => false,
	    	'labels' => $manufacturerlabels
	  	));

	  	register_taxonomy('designer','products',array(
	    	'hierarchical' => false,
	    	'labels' => $labels
	  	));


///Registering programs taxonomies for gallleries
		$programlabels = array(
	    	'name' => __( 'Program' ),
	    	'singular_name' => __( 'Program' ),
	    	'search_items' =>  __( 'Search Programs' ),
	    	'all_items' => __( 'All Programs' ),
	    	'parent_item' => __( 'Parent Program' ),
	    	'parent_item_colon' => __( 'Parent Program:' ),
	    	'edit_item' => __( 'Edit Program' ),
	    	'update_item' => __( 'Update Program' ),
	    	'add_new_item' => __( 'Add New Program' ),
	    	'new_item_name' => __( 'New Program Name' )
	  	);
	  	register_taxonomy('programs','galleries',array(
	    	'hierarchical' => true,
	    	'labels' => $programlabels
	  	));
		flush_rewrite_rules( false );
	}
?>