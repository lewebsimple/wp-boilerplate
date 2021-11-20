<?php

// Custom WP-CFM style
add_action( 'admin_head', 'wpcfm_admin_head' );
function wpcfm_admin_head() {
	?>
	<style>
    .wpcfm-bundles .multiselect {
      height: auto;
    }
	</style>
	<?php
}

// Custom WP-CFM configuration items
add_filter( 'wpcfm_configuration_items', 'wpcfm_configuration_items', 100 );
function wpcfm_configuration_items( $items ) {
	// Core
	unset( $items['admin_email_lifespan'] );
	unset( $items['blog_charset'] );
	unset( $items['can_compress_scripts'] );
	unset( $items['cron'] );
	unset( $items['db_version'] );
	unset( $items['default_email_category'] );
	unset( $items['default_link_category'] );
	unset( $items['default_post_format'] );
	unset( $items['finished_splitting_shared_terms'] );
	unset( $items['finished_updating_comment_type'] );
	unset( $items['fresh_site'] );
	unset( $items['hack_file'] );
	unset( $items['html_type'] );
	unset( $items['https_detection_errors'] );
	unset( $items['initial_db_version'] );
	unset( $items['link_manager_enabled'] );
	unset( $items['links_updated_date_format'] );
	unset( $items['mailserver_login'] );
	unset( $items['mailserver_pass'] );
	unset( $items['mailserver_port'] );
	unset( $items['mailserver_url'] );
	unset( $items['ping_sites'] );
	unset( $items['recently_activated'] );
	unset( $items['recently_edited'] );
	unset( $items['recovery_keys'] );
	unset( $items['tax/link_category'] );
	unset( $items['tax/post_format'] );
	unset( $items['tax/wp_theme'] );
	unset( $items['theme_mods_twentytwentyone'] );
	unset( $items['theme_switched'] );
	unset( $items['uninstall_plugins'] );
	unset( $items['upload_path'] );
	unset( $items['upload_url_path'] );
	unset( $items['wp_force_deactivated_plugins'] );
	unset( $items['wp_user_roles'] );

	// ACF Better Search
	unset( $items['acfbs_notice_hidden'] );

	// Gravity Forms
	unset( $items['gf_db_version'] );
	unset( $items['gf_rest_api_db_version'] );
	unset( $items['gform_pending_installation'] );
	unset( $items['gform_version_info'] );
	unset( $items['gravityformsaddon_gravityformswebapi_version'] );
	unset( $items['rg_form_version'] );

	// Polylang
	unset( $items['polylang_licenses'] );

	// The SEO Framework
	unset( $items['autodescription-updates-cache'] );
	unset( $items['the_seo_framework_initial_db_version'] );
	unset( $items['the_seo_framework_upgraded_db_version'] );

	// Theia Smart Thumbs
	unset( $items['tst_dashboard'] );

	// WooCommerce
	unset( $items['action_scheduler_hybrid_store_demarkation'] );
	unset( $items['action_scheduler_lock_async-request-runner'] );
	unset( $items['action_scheduler_migration_status'] );
	unset( $items['current_theme_supports_woocommerce'] );
	unset( $items['schema-ActionScheduler_LoggerSchema'] );
	unset( $items['schema-ActionScheduler_StoreSchema'] );
	unset( $items['wc_blocks_db_schema_version'] );
	unset( $items['wc_blocks_surface_cart_checkout_probability'] );
	unset( $items['wc_remote_inbox_notifications_specs'] );
	unset( $items['wc_remote_inbox_notifications_stored_state'] );
	unset( $items['wc_remote_inbox_notifications_wca_updated'] );
	unset( $items['woocommerce_admin_install_timestamp'] );
	unset( $items['woocommerce_admin_notices'] );
	unset( $items['woocommerce_admin_version'] );
	unset( $items['woocommerce_db_version'] );
	unset( $items['woocommerce_maxmind_geolocation_settings'] );
	unset( $items['woocommerce_meta_box_errors'] );
	unset( $items['woocommerce_schema_version'] );
	unset( $items['woocommerce_trash_cancelled_orders'] );
	unset( $items['woocommerce_trash_failed_orders'] );
	unset( $items['woocommerce_trash_pending_orders'] );
	unset( $items['woocommerce_version'] );

	// WP Offload SES
	unset( $items['wposes_constant_WPOSES_SETTINGS'] );
	unset( $items['wposes_last_cron_check'] );
	unset( $items['wposes_last_cron_run'] );
	unset( $items['wposes_tracking_key'] );
	unset( $items['wposes_version'] );

	return $items;
}
