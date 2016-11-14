<?php

add_action( 'init', function () {
	register_taxonomy( 'podman_publicist', 'podman_track', array(
		'labels' => array(
			'name'          => __( 'Publicists' ),
			'singular_name' => __( 'Publicist' )
		)
	) );

} );

add_action( 'podman_publicist_edit_form_fields', function ( $tag ) {
	$t_id      = $tag->term_id;
	$term_meta = get_option( 'taxonomy_term_' . $t_id );
	?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[podman_publicist_url]"><?php _e( 'URL' ); ?></label>
		</th>
		<td>
			<input type="text" name="term_meta[podman_publicist_url]" id="term_meta[podman_publicist_url]" size="40"
			       value="<?php echo $term_meta['podman_publicist_url'] ? $term_meta['podman_publicist_url'] : ''; ?>"><br/>
			<span class="description"><?php _e( 'The Source\'s URL.' ); ?></span>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[podman_publicist_facebook]"><?php _e( 'Facebook tag' ); ?></label>
		</th>
		<td>
			<input type="text" name="term_meta[podman_publicist_facebook]" id="term_meta[podman_publicist_facebook]"
			       size="40"
			       value="<?php echo $term_meta['podman_publicist_facebook'] ? $term_meta['podman_publicist_facebook'] : ''; ?>"><br/>
			<span class="description"><?php _e( 'The Source\'s Facebook tag.' ); ?></span>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[podman_publicist_twitter]"><?php _e( 'Twitter tag' ); ?></label>
		</th>
		<td>
			<input type="text" name="term_meta[podman_publicist_twitter]" id="term_meta[podman_publicist_twitter]"
			       size="40"
			       value="<?php echo $term_meta['podman_publicist_twitter'] ? $term_meta['podman_publicist_twitter'] : ''; ?>"><br/>
			<span class="description"><?php _e( 'The Source\'s Twitter tag.' ); ?></span>
		</td>
	</tr>
	<?php
}, 10, 2 );

add_action( 'podman_publicist_add_form_fields', function () {
	?>
	<div class="form-field term-podman_publicist_url-wrap">
		<label for="term_meta[podman_publicist_url]"><?php _e( 'URL' ); ?></label>
		<input type="text" name="term_meta[podman_publicist_url]" id="term_meta[podman_publicist_url]" size="40"
		       value="">
		<p><?php _e( 'The Source\'s URL.' ); ?></p>
	</div>
	<div class="form-field term-podman_publicist_facebook-wrap">
		<label for="term_meta[podman_publicist_facebook]"><?php _e( 'Facebook tag' ); ?></label>
		<input type="text" name="term_meta[podman_publicist_facebook]" id="term_meta[podman_publicist_facebook]"
		       size="40"
		       value="">
		<p><?php _e( 'The Source\'s Facebook tag.' ); ?></p>
	</div>
	<div class="form-field term-podman_publicist_twitter-wrap">
		<label for="term_meta[podman_publicist_twitter]"><?php _e( 'Twitter tag' ); ?></label>
		<input type="text" name="term_meta[podman_publicist_twitter]" id="term_meta[podman_publicist_twitter]" size="40"
		       value="">
		<p><?php _e( 'The Source\'s Twitter tag.' ); ?></p>
	</div>
	<?php
}, 10, 2 );

add_action( 'edited_podman_publicist', $podman_save_taxonomy, 10, 2 );
add_action( 'created_podman_publicist', $podman_save_taxonomy, 10, 2 );