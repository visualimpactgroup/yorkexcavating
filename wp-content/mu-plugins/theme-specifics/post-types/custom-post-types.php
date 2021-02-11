<?php
// dashicon reference: https://lonewolfonline.net/wordpress-dashicons-cheat-sheet/

//News & Information
function news_custom_post_types() {
  $args = array(
		'label'                 => __( 'News & Blog', 'our-blog' ),
    'has_archive'           => true,
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-rss',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'show_in_rest'          => true,
    'taxonomies'            => array( 'category' ),
		'rewrite'               => array( 'slug' => 'our-blog', 'with_front' => false ),
	);

	register_post_type( 'our-blog', $args );
}
add_action( 'init', 'news_custom_post_types', 0 );

//Careers
function careers_custom_post_types() {
  $args = array(
		'label'                 => __( 'Job Openings', 'jobs' ),
    'has_archive'           => true,
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 10,
		'menu_icon'             => 'dashicons-admin-users',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		// 'capability_type'       => 'post',
    // 'capabilities'          => array(
    //   'create_posts'        => 'allow',
    // ),
		'show_in_rest'          => true,
		'rewrite'               => array( 'slug' => 'jobs' ),
	);


	register_post_type( 'jobs', $args );
}
add_action( 'init', 'careers_custom_post_types', 0 );


//Projects
function projects_custom_post_types() {
  $args = array(
		'label'                 => __( 'Projects', 'projects' ),
    'has_archive'           => false,
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 11,
		'menu_icon'             => 'dashicons-hammer',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		// 'capability_type'       => 'post',
    // 'capabilities'          => array(
    //   'create_posts'        => 'allow',
    // ),
		'show_in_rest'          => true,
		'rewrite'               => array( 'slug' => 'projects' ),
	);


	register_post_type( 'projects', $args );
}
add_action( 'init', 'projects_custom_post_types', 0 );

// portal
function portal_custom_post_types() {
  $args = array(
    'label'                 => __( 'Portal', 'portal' ),
    'labels'                => $labels,
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 12,
    'menu_icon'             => 'dashicons-welcome-widgets-menus',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => true,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
    'show_in_rest'          => true,
    'rewrite'               => array( 'slug' => 'portal' ),
  );
  register_post_type( 'Portal', $args );
}
add_action( 'init', 'portal_custom_post_types', 0 );

function archive_to_custom_archive() {
    if( is_post_type_archive( 'portal' ) ) {
        wp_redirect( home_url( '/portal/dashboard/' ), 301 );
        exit();
    }
}
add_action( 'template_redirect', 'archive_to_custom_archive' );
?>
