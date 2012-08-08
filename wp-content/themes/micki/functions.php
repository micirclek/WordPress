<?php

// links:
define('FACEBOOK_URL', 'https://www.facebook.com/profile.php?id=2262952');
define('TWITTER_URL', 'https://twitter.com/mcirclek');
define('MICKI_URL', 'http://micirclek.org');
define('CKI_URL', 'http://circlek.org');

// right posts:
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'micki_right_box',
		array(
			'labels' => array(
				'name' => __( 'Right Boxes' ),
				'singular_name' => __( 'Box' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
	
	register_post_type( 'micki_bottom_box',
		array(
			'labels' => array(
				'name' => __( 'Bottom Boxes' ),
				'singular_name' => __( 'Box' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
	
	register_post_type( 'micki_quote',
		array(
			'labels' => array(
				'name' => __( 'Quotes' ),
				'singular_name' => __( 'Quote' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
}

// check for tagline:
function get_tagline() {
	if (get_bloginfo('description')) {
		echo get_bloginfo('description');
	} else {
		echo "Live to Serve, Love to Serve!";
	}
}

// slideshow image sizes:
if (function_exists('add_image_size')) { 
	add_image_size('micki_thmb', 120, 80, true);
	add_image_size('micki_main', 540, 360, true);
}

// custom media field (slideshow url):
function micki_photo_url( $form_fields, $post ) {

	$form_fields['micki_photo_url'] = array(
		'label' => 'Slideshow URL',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'micki_photo_url', true ),
		'helps' => 'Link for if image is cliked in slideshow.'
	);
	
	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'micki_photo_url', 10, 2 );

function micki_photo_url_save( $post, $attachment ) {
	if( isset( $attachment['micki_photo_url'] ) )
		update_post_meta( $post['ID'], 'micki_photo_url', $attachment['micki_photo_url'] );
	
	return $post;
}

add_filter( 'attachment_fields_to_save', 'micki_photo_url_save', 10, 2 );

?>