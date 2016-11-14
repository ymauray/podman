<?php

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
} );

if ( is_admin() ) {
	$init_metabox = function () {
		add_action( 'add_meta_boxes', function () {
			add_meta_box( 'podman_track_details', __( 'Track details', 'podman' ), function ( $post ) {
				wp_nonce_field( 'podman_track_details_nonce_action', 'podman_track_details_nonce' );

				$cchits_link = get_post_meta( $post->ID, 'cchits_link', true );
				$source_link = get_post_meta( $post->ID, 'source_link', true );

				if ( empty( $cchits_link ) ) {
					$cchits_link = '';
				}
				if ( empty( $source_link ) ) {
					$source_link = '';
				}

				?>
				<p>
					<label class="podman-track-details-label"
					       for="podman_track_cchits_link"><?php _e( 'CCHits link', 'podman' ); ?></label>
					<br>
					<input name="podman_track_cchits_link" type="text" id="podman_track_cchits_link"
					       class="podman_track_details_field podman_track_cchits_link_field"
					       value="<?php esc_attr_e( $cchits_link ); ?>">
					<br>
					<span class="description">Link to CCHits.net's track page (not a voting link).</span>
				</p>
				<p>
					<label class="podman-track-details-label"
					       for="podman_track_source_link"><?php _e( 'Source link', 'podman' ); ?></label>
					<br>
					<input name="podman_track_source_link" type="text" id="podman_track_source_link"
					       class="podman_track_details_field podman_track_source_link_field"
					       value="<?php esc_attr_e( $source_link ); ?>">
					<br>
					<span class="description">Link to where the track comes from.</span>
				</p>
				<?php
			}, 'podman_track', 'normal' );
		} );

		add_action( 'save_post', function ( $post_id, $post ) {
			$nonce_name   = $_POST['podman_track_details_nonce'];
			$nonce_action = 'podman_track_details_nonce_action';

			if ( ! isset( $nonce_name ) ) {
				return;
			}

			if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
				return;
			}

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}

			if ( wp_is_post_autosave( $post_id ) ) {
				return;
			}

			if ( wp_is_post_revision( $post_id ) ) {
				return;
			}

			$cchits_link = isset( $_POST['podman_track_cchits_link'] ) ? sanitize_text_field( $_POST['podman_track_cchits_link'] ) : '';
			$source_link = isset( $_POST['podman_track_source_link'] ) ? sanitize_text_field( $_POST['podman_track_source_link'] ) : '';

			update_post_meta( $post_id, 'cchits_link', $cchits_link );
			update_post_meta( $post_id, 'source_link', $source_link );

		}, 10, 2 );
	};

	add_action( 'load-post.php', $init_metabox );
	add_action( 'load-post-new.php', $init_metabox );
};