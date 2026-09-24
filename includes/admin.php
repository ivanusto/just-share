<?php
/**
 * Settings page under Settings > Just Share.
 *
 * @package JustShare
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_menu', 'just_share_admin_menu' );
add_filter( 'plugin_action_links_' . plugin_basename( JUST_SHARE_FILE ), 'just_share_action_links' );

/**
 * Add the settings page.
 */
function just_share_admin_menu() {
	add_options_page(
		__( 'Just Share', 'just-share' ),
		__( 'Just Share', 'just-share' ),
		'manage_options',
		'just-share',
		'just_share_render_admin'
	);
}

/**
 * Settings link on the Plugins screen.
 *
 * @param string[] $links Links.
 * @return string[]
 */
function just_share_action_links( $links ) {
	array_unshift( $links, '<a href="' . esc_url( admin_url( 'options-general.php?page=just-share' ) ) . '">' . esc_html__( 'Settings', 'just-share' ) . '</a>' );
	return $links;
}

/**
 * Render the settings page.
 */
function just_share_render_admin() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$s     = just_share_settings();
	$name  = JUST_SHARE_OPTION;
	$types = get_post_types( array( 'public' => true ), 'objects' );
	unset( $types['attachment'] );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Just Share', 'just-share' ); ?></h1>
		<p><?php esc_html_e( 'Buttons are plain links that go through this site, so ad blockers do not hide them. No third-party scripts are loaded.', 'just-share' ); ?></p>
		<form method="post" action="options.php">
			<?php settings_fields( 'just_share' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><?php esc_html_e( 'Buttons', 'just-share' ); ?></th>
					<td>
						<fieldset>
							<?php foreach ( just_share_networks() as $key => $net ) : ?>
								<label style="display:inline-block;min-width:10em;margin:0 0 .4em">
									<input type="checkbox" name="<?php echo esc_attr( $name ); ?>[networks][]" value="<?php echo esc_attr( $key ); ?>" <?php checked( in_array( $key, $s['networks'], true ) ); ?> />
									<?php echo esc_html( $net['label'] ); ?>
								</label>
							<?php endforeach; ?>
							<p class="description"><?php esc_html_e( '"More options" opens the system share sheet and only appears on devices that support it.', 'just-share' ); ?></p>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="jsp-position"><?php esc_html_e( 'Position', 'just-share' ); ?></label></th>
					<td>
						<select id="jsp-position" name="<?php echo esc_attr( $name ); ?>[position]">
							<option value="after" <?php selected( $s['position'], 'after' ); ?>><?php esc_html_e( 'After the content', 'just-share' ); ?></option>
							<option value="before" <?php selected( $s['position'], 'before' ); ?>><?php esc_html_e( 'Before the content', 'just-share' ); ?></option>
							<option value="both" <?php selected( $s['position'], 'both' ); ?>><?php esc_html_e( 'Before and after', 'just-share' ); ?></option>
							<option value="none" <?php selected( $s['position'], 'none' ); ?>><?php esc_html_e( 'Hidden', 'just-share' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="jsp-label"><?php esc_html_e( 'Text above the buttons', 'just-share' ); ?></label></th>
					<td><input type="text" class="regular-text" id="jsp-label" name="<?php echo esc_attr( $name ); ?>[label]" value="<?php echo esc_attr( $s['label'] ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Post types', 'just-share' ); ?></th>
					<td>
						<fieldset>
							<?php foreach ( $types as $type ) : ?>
								<label style="display:inline-block;min-width:10em">
									<input type="checkbox" name="<?php echo esc_attr( $name ); ?>[post_types][]" value="<?php echo esc_attr( $type->name ); ?>" <?php checked( in_array( $type->name, $s['post_types'], true ) ); ?> />
									<?php echo esc_html( $type->labels->singular_name ); ?>
								</label>
							<?php endforeach; ?>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Related posts', 'just-share' ); ?></th>
					<td>
						<label>
							<input type="checkbox" name="<?php echo esc_attr( $name ); ?>[related]" value="1" <?php checked( $s['related'] ); ?> />
							<?php esc_html_e( 'Show posts from the same categories after the content', 'just-share' ); ?>
						</label>
						<p>
							<label for="jsp-related-count"><?php esc_html_e( 'Number of posts', 'just-share' ); ?></label>
							<input type="number" min="1" max="12" class="small-text" id="jsp-related-count" name="<?php echo esc_attr( $name ); ?>[related_count]" value="<?php echo esc_attr( $s['related_count'] ); ?>" />
						</p>
						<p>
							<label for="jsp-related-title"><?php esc_html_e( 'Heading', 'just-share' ); ?></label>
							<input type="text" class="regular-text" id="jsp-related-title" name="<?php echo esc_attr( $name ); ?>[related_title]" value="<?php echo esc_attr( $s['related_title'] ); ?>" placeholder="<?php esc_attr_e( 'Related posts', 'just-share' ); ?>" />
						</p>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
