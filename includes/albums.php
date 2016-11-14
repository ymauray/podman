<?php

add_action( 'init', function () {
	register_taxonomy( 'podman_album', 'podman_track', array(
		'labels' => array(
			'name'          => __( 'Albums' ),
			'singular_name' => __( 'Album' )
		)
	) );
} );
