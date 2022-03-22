<?php

// Clean admin menu
add_action( 'admin_init', 'clean_wp_menu_items' );
function clean_wp_menu_items(): void {
	remove_menu_page( 'edit-comments.php' ); // Comments
}

// Clean admin bar
add_action( 'admin_bar_menu', 'clean_wp_toolbar_items', 999 );
function clean_wp_toolbar_items( $menu ): void {
	$menu->remove_node( 'comments' ); // Comments
//	$menu->remove_node( 'customize' ); // Customize
//	$menu->remove_node( 'dashboard' ); // Dashboard
//	$menu->remove_node( 'edit' ); // Edit
//	$menu->remove_node( 'menus' ); // Menus
//	$menu->remove_node( 'new-content' ); // New Content
	$menu->remove_node( 'search' ); // Search
	// $menu->remove_node('site-name'); // Site Name
	$menu->remove_node( 'themes' ); // Themes
	$menu->remove_node( 'updates' ); // Updates
	$menu->remove_node( 'view-site' ); // Visit Site
	$menu->remove_node( 'view' ); // View
	$menu->remove_node( 'widgets' ); // Widgets
	$menu->remove_node( 'wp-logo' ); // WordPress Logo
}

// Clean dashboard widgets
add_action( 'wp_dashboard_setup', 'clean_wp_dashboard_widgets' );
function clean_wp_dashboard_widgets(): void {
	global $wp_meta_boxes;

	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] ); // Activity
//	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] ); // At a Glance
//	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health'] ); // Site Health Status
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] ); // WordPress Events and News
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] ); // Quick Draft
}

// Disables feeds.
function clean_wp_disable_feeds(): void {
	wp_redirect( site_url() );
}
add_action( 'do_feed', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_rdf', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_rss', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_rss2', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_atom', 'clean_wp_disable_feeds', 1 );

// Disables comments feeds.
add_action( 'do_feed_rss2_comments', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_atom_comments', 'hHeadache_disable_feeds', 1 );

// Disable XML RPC for security.
add_filter( 'xmlrpc_enabled', '__return_false' );

// Removes WordPress version.
remove_action( 'wp_head', 'wp_generator' );

// Removes generated icons.
remove_action( 'wp_head', 'wp_site_icon', 99 );

// Removes shortlink.
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Removes Really Simple Discovery link.
remove_action( 'wp_head', 'rsd_link' );

// Removes RSS feed links.
remove_action( 'wp_head', 'feed_links', 2 );

// Removes all extra RSS feed links.
remove_action( 'wp_head', 'feed_links_extra', 3 );

// Removes wlwmanifest.xml.
remove_action( 'wp_head', 'wlwmanifest_link' );

// Removes meta rel=dns-prefetch href=//s.w.org
remove_action( 'wp_head', 'wp_resource_hints', 2 );

// Removes relational links for the posts.
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

// Removes REST API link tag from header.
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

// Removes emojis.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

// Removes oEmbeds.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

// Remove language dropdown on login screen.
add_filter( 'login_display_language_dropdown', '__return_false' );

// Disable default users API endpoints for security.
// https://www.wp-tweaks.com/hackers-can-find-your-wordpress-username/
add_filter( 'rest_endpoints', 'clean_wp_disable_rest_endpoints' );
function clean_wp_disable_rest_endpoints( $endpoints ): array {
	if ( ! is_user_logged_in() ) {
		if ( isset( $endpoints['/wp/v2/users'] ) ) {
			unset( $endpoints['/wp/v2/users'] );
		}

		if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
			unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
		}
	}

	return $endpoints;
}

// Removes JPEG compression.
add_filter( 'jpeg_quality', 'clean_wp_remove_jpeg_compression', 10, 2 );
function clean_wp_remove_jpeg_compression(): int {
	return 100;
}

// Remove Gutenberg's front-end block styles.
add_action( 'wp_enqueue_scripts', 'clean_wp_remove_block_styles' );
function clean_wp_remove_block_styles(): void {
	wp_deregister_style( 'wp-block-library' );
}

// Remove Gutenberg's global styles.
// https://github.com/WordPress/gutenberg/pull/34334#issuecomment-911531705
add_action( 'wp_enqueue_scripts', 'clean_wp_remove_global_styles' );
function clean_wp_remove_global_styles() {
	wp_dequeue_style( 'global-styles' );
}

// Remove user roles.
add_action( 'init', 'clean_wp_remove_roles' );
function clean_wp_remove_roles(): void {
	remove_role( 'author' );
	remove_role( 'contributor' );
	remove_role( 'subscriber' );
}
