<?php
function custom_post_type() {

		$labels = array(
			'name'                  => _x( 'Staff Members', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Staff', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Staff', 'text_domain' ),
			'name_admin_bar'        => __( 'Staff', 'text_domain' ),
			'archives'              => __( 'Featured Archives', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'All Posts', 'text_domain' ),
			'add_new_item'          => __( 'Add New', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Person', 'text_domain' ),
			'edit_item'             => __( 'Edit Person', 'text_domain' ),
			'update_item'           => __( 'Update Person', 'text_domain' ),
			'view_item'             => __( 'View Person', 'text_domain' ),
			'search_items'          => __( 'Search People', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Person', 'text_domain' ),
			'set_featured_image'    => __( 'Set Person', 'text_domain' ),
			'remove_featured_image' => __( 'Remove Person', 'text_domain' ),
			'use_featured_image'    => __( 'Use as Person', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Post Type', 'text_domain' ),
			'description'           => __( 'Post Type Description', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array(),
			'taxonomies'            => array(),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'menu_icon'                => 'dashicons-admin-users',
		);
		register_post_type( 'br_person', $args );

}
add_action( 'init', 'custom_post_type', 0 );


add_action( 'init', 'init_remove_support', 100 );
function init_remove_support() {
		remove_post_type_support( 'br_person', 'editor' );
}

add_action( 'cmb2_admin_init', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {
		$prefix = 'br_';

		/**
		 * Initiate the metabox
		 */
		$cmb = new_cmb2_box( array(
				'id'            => 'test_metabox',
				'title'         => __( 'Staff Member', 'cmb2' ),
				'object_types'  => array('br_person' ), // Post type
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true, // Show field names on the left
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
		) );

		// Regular text field
		$cmb->add_field( array(
				'name'       => __( 'Display Name', 'cmb2' ),
				'desc'       => __( '', 'cmb2' ),
				'id'         => $prefix . 'name',
				'type'       => 'text',
				'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
		) );

		$cmb->add_field( array(
			'name' => esc_html__( 'Portrait', 'cmb2' ),
			'desc' => esc_html__( 'Upload an image or enter a URL.', 'cmb2' ),
			'id'   => $prefix . 'portrait',
			'type' => 'file',
		) );

		// Regular text field
		$cmb->add_field( array(
				'name'       => __( 'Title', 'cmb2' ),
				'desc'       => __( '', 'cmb2' ),
				'id'         => $prefix . 'title',
				'type'       => 'text',
				'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
				// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
				// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
				// 'on_front'        => false, // Optionally designate a field to wp-admin only
				// 'repeatable'      => true,
		) );

		$cmb->add_field( array(
			'name'    => esc_html__( 'Bio', 'cmb2' ),
			'desc'    => esc_html__( 'field description (optional)', 'cmb2' ),
			'id'      => $prefix . 'bio',
			'type'    => 'wysiwyg',
			'options' => array( 'textarea_rows' => 5, ),
		) );

}

function prefix_set_test_default( $field_args, $field ) {
	return '[br_person id="' . $field->object_id . '"]';
}
