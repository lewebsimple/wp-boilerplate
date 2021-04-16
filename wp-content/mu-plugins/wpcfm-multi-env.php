<?php
/**
 * Plugin Name: WP-CFM multi-environment
 * Version: 0.1.9
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

// Available WP-CFM environments
add_filter( 'wpcfm_multi_env', 'custom_wpcfm_multi_env' );
function custom_wpcfm_multi_env( $environments ) {
	return array(
		'dev',
		'prod',
	);
}

// Current WP-CFM environment
add_filter( 'wpcfm_current_env', 'custom_wpcfm_current_env' );
function custom_wpcfm_current_env( $env ) {
	$dev_url_parts = implode( '|', array(
		'.ledevsimple.ca',
		'localhost',
	) );
	if ( preg_match( "/$dev_url_parts/", get_site_url() ) ) {
		return 'dev';
	}

	return 'prod';
}

// Customize WP-CFM items
add_filter( 'wpcfm_configuration_items', 'custom_wpcfm_configuration_items', 100 );
function custom_wpcfm_configuration_items( $items ) {
	$disallowed_items = array(
		// WordPress
		'admin_email_lifespan',
		'blog_charset',
		'can_compress_scripts',
		'default_email_category',
		'default_link_category',
		'default_post_format',
		'finished_splitting_shared_terms',
		'finished_updating_comment_type',
		'fresh_site',
		'hack_file',
		'html_type',
		'initial_db_version',
		'link_manager_enabled',
		'links_updated_date_format',
		'mailserver_login',
		'mailserver_pass',
		'mailserver_port',
		'mailserver_url',
		'new_admin_email',
		'recently_activated',
		'recently_edited',
		'recovery_keys',
		'recovery_mode_email_last_sent',
		'sticky_posts',
		'theme_mods_twentytwentyone',
		'theme_switched',
		'uninstall_plugins',
		'widget_archives',
		'widget_calendar',
		'widget_categories',
		'widget_custom_html',
		'widget_media_audio',
		'widget_media_gallery',
		'widget_media_image',
		'widget_media_video',
		'widget_meta',
		'widget_nav_menu',
		'widget_pages',
		'widget_recent-comments',
		'widget_recent-posts',
		'widget_rss',
		'widget_search',
		'widget_tag_cloud',
		'widget_text',
		'tax/link_category',
		'tax/post_format',
		// Advanced Custom Fields
		'acf_version',
		// iThemes Security Pro
		'itsec_online_files_hashes',
		'itsec_scheduler_page_load',
		'itsec_temp_whitelist_ip',
		'ithemes-updater-cache',
		'ithemes-updater-keys',
		// Loco Translate
		'loco_recent',
		// WooCommerce
		'action_scheduler_hybrid_store_demarkation',
		'action_scheduler_lock_async-request-runner',
		'current_theme_supports_woocommerce',
		'product_cat_children',
		'schema-ActionScheduler_LoggerSchema',
		'schema-ActionScheduler_StoreSchema',
		'wc_admin_note_home_screen_feedback_homescreen_accessed',
		'wc_blocks_db_schema_version',
		'wc_remote_inbox_notifications_specs',
		'wc_remote_inbox_notifications_stored_state',
		'widget_woocommerce_layered_nav',
		'widget_woocommerce_layered_nav_filters',
		'widget_woocommerce_price_filter',
		'widget_woocommerce_product_categories',
		'widget_woocommerce_product_search',
		'widget_woocommerce_product_tag_cloud',
		'widget_woocommerce_products',
		'widget_woocommerce_rating_filter',
		'widget_woocommerce_recent_reviews',
		'widget_woocommerce_recently_viewed_products',
		'widget_woocommerce_top_rated_products',
		'widget_woocommerce_widget_cart',
		'woocommerce_admin_install_timestamp',
		'woocommerce_admin_install_timestamp',
		'woocommerce_admin_notices',
		'woocommerce_admin_version',
		'woocommerce_db_version',
		'woocommerce_demo_store',
		'woocommerce_maxmind_geolocation_settings',
		'woocommerce_maybe_regenerate_images_hash',
		'woocommerce_meta_box_errors',
		'woocommerce_queue_flush_rewrite_rules',
		'woocommerce_schema_version',
		'woocommerce_version',
		'tax/action-group',
		// WPBakery
		'vc_version',
		'wpb_js_less_version',
	);
	foreach ( $disallowed_items as $row ) {
		unset( $items[ $row ] );
	}

	return $items;
}
