<?php

add_action( 'init', function () {
	register_taxonomy( 'podman_episode', 'podman_track', array(
		'labels' => array(
			'name'          => __( 'Episodes' ),
			'singular_name' => __( 'Episode' )
		)
	) );
} );
