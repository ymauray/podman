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

add_action( 'init', function () {
	register_post_type( 'podman_track', array(
			'labels'      => array(
				'name'          => __( 'Tracks' ),
				'singular_name' => __( 'Track' )
			),
			'public'      => true,
			'has_archive' => false,
			'rewrite'     => array( 'slug' => 'tracks' )
		)
	);

	register_taxonomy( 'podman_artist', 'podman_track', array(
		'labels' => array(
			'name'          => __( 'Artists' ),
			'singular_name' => __( 'Artist' )
		)
	) );

	register_taxonomy( 'podman_source', 'podman_track', array(
		'labels' => array(
			'name'          => __( 'Sources' ),
			'singular_name' => __( 'Source' )
		)
	) );

} );

add_action( 'podman_source_edit_form_fields', function ( $tag ) {
	$t_id      = $tag->term_id;
	$term_meta = get_option( 'taxonomy_term_' . $t_id );
	?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[podman_source_url]"><?php _e( 'URL' ); ?></label>
		</th>
		<td>
			<input type="text" name="term_meta[podman_source_url]" id="term_meta[podman_source_url]" size="40"
			       value="<?php echo $term_meta['podman_source_url'] ? $term_meta['podman_source_url'] : ''; ?>"><br/>
			<span class="description"><?php _e( 'The Source\'s URL.' ); ?></span>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[podman_source_facebook]"><?php _e( 'Facebook tag' ); ?></label>
		</th>
		<td>
			<input type="text" name="term_meta[podman_source_facebook]" id="term_meta[podman_source_facebook]" size="40"
			       value="<?php echo $term_meta['podman_source_facebook'] ? $term_meta['podman_source_facebook'] : ''; ?>"><br/>
			<span class="description"><?php _e( 'The Source\'s Facebook tag.' ); ?></span>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[podman_source_twitter]"><?php _e( 'Twitter tag' ); ?></label>
		</th>
		<td>
			<input type="text" name="term_meta[podman_source_twitter]" id="term_meta[podman_source_twitter]" size="40"
			       value="<?php echo $term_meta['podman_source_twitter'] ? $term_meta['podman_source_twitter'] : ''; ?>"><br/>
			<span class="description"><?php _e( 'The Source\'s Twitter tag.' ); ?></span>
		</td>
	</tr>
	<?php
}, 10, 2 );

add_action( 'podman_source_add_form_fields', function () {
	?>
	<div class="form-field term-podman_source_url-wrap">
		<label for="term_meta[podman_source_url]"><?php _e( 'URL' ); ?></label>
		<input type="text" name="term_meta[podman_source_url]" id="term_meta[podman_source_url]" size="40"
		       value="">
		<p><?php _e( 'The Source\'s URL.' ); ?></p>
	</div>
	<div class="form-field term-podman_source_facebook-wrap">
		<label for="term_meta[podman_source_facebook]"><?php _e( 'Facebook tag' ); ?></label>
		<input type="text" name="term_meta[podman_source_facebook]" id="term_meta[podman_source_facebook]" size="40"
		       value="">
		<p><?php _e( 'The Source\'s Facebook tag.' ); ?></p>
	</div>
	<div class="form-field term-podman_source_twitter-wrap">
		<label for="term_meta[podman_source_twitter]"><?php _e( 'Twitter tag' ); ?></label>
		<input type="text" name="term_meta[podman_source_twitter]" id="term_meta[podman_source_twitter]" size="40"
		       value="">
		<p><?php _e( 'The Source\'s Twitter tag.' ); ?></p>
	</div>
	<?php
}, 10, 2 );

$podman_save_source = function ( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id      = $term_id;
		$term_meta = get_option( 'taxonomy_term_' . $t_id );
		$cat_keys  = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset( $_POST['term_meta'][ $key ] ) ) {
				$term_meta[ $key ] = $_POST['term_meta'][ $key ];
			}
		}
		update_option( 'taxonomy_term_' . $t_id, $term_meta );
	}
};

add_action( 'edited_podman_source', $podman_save_source, 10, 2 );
add_action( 'created_podman_source', $podman_save_source, 10, 2 );