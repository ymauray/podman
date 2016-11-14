<?php

add_action( 'init', function () {
	register_taxonomy( 'podman_artist', 'podman_track', array(
		'labels' => array(
			'name'          => __( 'Artists' ),
			'singular_name' => __( 'Artist' )
		)
	) );
} );

//

add_action( 'podman_artist_edit_form_fields', function ( $tag ) {
	$t_id      = $tag->term_id;
	$term_meta = get_option( 'taxonomy_term_' . $t_id );
	?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[podman_artist_location]"><?php _e( 'Location', 'podman' ); ?></label>
		</th>
		<td>
			<input type="text" name="term_meta[podman_artist_location]" id="term_meta[podman_artist_location]" size="40"
			       value="<?php echo $term_meta['podman_artist_location'] ? $term_meta['podman_artist_location'] : ''; ?>"><br/>
			<span class="description"><?php _e( 'Where is the artist from.' ); ?></span>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[podman_artist_website]"><?php _e( 'Website', 'podman' ); ?></label>
		</th>
		<td>
			<input type="text" name="term_meta[podman_artist_website]" id="term_meta[podman_artist_website]" size="40"
			       value="<?php echo $term_meta['podman_artist_website'] ? $term_meta['podman_artist_website'] : ''; ?>"><br/>
			<span class="description"><?php _e( 'The artist\'s website.' ); ?></span>
		</td>
	</tr>
	<?php
}, 10, 2 );

add_action( 'edited_podman_artist', $podman_save_taxonomy, 10, 2 );