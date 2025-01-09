<?php

// Inject the Umami tracking code into the <head> of the site
// add_action( 'wp_head', 'umami_wp_head' );
function umami_wp_head() {
	?>
	<script defer src="https://umami.websimple.com/script" data-website-id="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"></script>
	<?php
}
