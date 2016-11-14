<?php

$podman_save_taxonomy = function ( $term_id ) {
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

