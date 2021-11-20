<?php

// Custom WP-CFM style
add_action( 'admin_head', 'wp_cfm_admin_head' );
function wp_cfm_admin_head() {
	?>
	<style>
    .wpcfm-bundles .multiselect {
      height: auto;
    }
	</style>
	<?php
}
