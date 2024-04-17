<?php

// Place the following in `wp-config.php`:

// if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
//  require_once __DIR__ . '/vendor/autoload.php';
// }
// define( "S3_UPLOADS_ENDPOINT", "https://your-endpoint.r2.cloudflarestorage.com" );
// define( "S3_UPLOADS_BUCKET", "your-bucket" );
// define( "S3_UPLOADS_BUCKET_URL", "https://pub-your-bucket-url.r2.dev" );
// define( "S3_UPLOADS_REGION", "auto" );
// define( "S3_UPLOADS_KEY", "your-access-key" );
// define( "S3_UPLOADS_SECRET", "your-access-secret" );

// Customize S3 Uploads plugin to work with R2 Cloudflare Storage
add_filter( "s3_uploads_s3_client_params", "r2_s3_uploads_s3_client_params" );
function r2_s3_uploads_s3_client_params( $params ) {
	$params["endpoint"]                = S3_UPLOADS_ENDPOINT;
	$params["use_path_style_endpoint"] = true;
	return $params;
}
