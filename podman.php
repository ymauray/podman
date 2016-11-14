<?php

/*
Plugin Name: Podman
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: yannick
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

include "includes/common.php";

include "includes/tracks.php";
include "includes/artists.php";
include "includes/albums.php";
include "includes/publicists.php";
include "includes/episodes.php";

add_action( 'admin_menu', function () {
	add_menu_page( __( 'PodMan', 'podman' ), __( 'PodMan', 'podman' ), 'edit_post', 'podman' );

	add_submenu_page( 'podman', __( 'Add track', 'podman' ), __( 'Add track', 'podman' ), 'edit_post', 'podman', function () {
		esc_html_e( __( 'Add track', 'podman' ) );
	} );

	add_submenu_page( 'podman', __( 'About', 'podman' ), __( 'About', 'podman' ), 'edit_post', 'podman-about', function () {
		esc_html_e( __( 'About PodMan', 'podman' ) );
	} );
} );

add_action( 'admin_enqueue_scripts', function ( $hook ) {
	if ( $hook == 'post.php' ) {
		wp_register_style( 'podman_admin_css', plugin_dir_url(__FILE__) . 'styles/podman.css', false );
		wp_enqueue_style( 'podman_admin_css' );
	}
} );
