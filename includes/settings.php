<?php
/**
 * Settings storage, defaults and sanitizing.
 *
 * @package JustShare
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'just_share_register_setting' );

/**
 * Default settings.
 *
 * @return array
 */
function just_share_defaults() {
	return array(
		'networks'      => array( 'facebook', 'x', 'threads', 'line', 'copy', 'native' ),
		'position'      => 'after',
		'label'         => '',
		'post_types'    => array( 'post' ),
		'related'       => true,
		'related_count' => 4,
		'related_title' => '',
	);
}

/**
 * Current settings merged over the defaults.
 *
 * @return array
 */
function just_share_settings() {
	$saved = get_option( JUST_SHARE_OPTION, array() );
	return wp_parse_args( is_array( $saved ) ? $saved : array(), just_share_defaults() );
}

/**
 * Register the option for the Settings API and the REST API.
 */
function just_share_register_setting() {
	register_setting(
		'just_share',
		JUST_SHARE_OPTION,
		array(
			'type'              => 'object',
			'default'           => just_share_defaults(),
			'sanitize_callback' => 'just_share_sanitize',
			'show_in_rest'      => array(
				'schema' => array(
					'type'                 => 'object',
					'additionalProperties' => false,
					'properties'           => array(
						'networks'      => array(
							'type'  => 'array',
							'items' => array( 'type' => 'string' ),
						),
						'position'      => array(
							'type' => 'string',
							'enum' => array( 'before', 'after', 'both', 'none' ),
						),
						'label'         => array( 'type' => 'string' ),
						'post_types'    => array(
							'type'  => 'array',
							'items' => array( 'type' => 'string' ),
						),
						'related'       => array( 'type' => 'boolean' ),
						'related_count' => array(
							'type'    => 'integer',
							'minimum' => 1,
							'maximum' => 12,
						),
						'related_title' => array( 'type' => 'string' ),
					),
				),
			),
		)
	);
}

/**
 * Sanitize settings from the admin form or the REST API.
 *
 * @param mixed $input Raw input.
 * @return array
 */
function just_share_sanitize( $input ) {
	$input    = is_array( $input ) ? $input : array();
	$defaults = just_share_defaults();
	$known    = array_keys( just_share_networks() );
	$out      = array();

	$networks        = isset( $input['networks'] ) ? (array) $input['networks'] : array();
	$networks        = array_map( 'sanitize_key', $networks );
	$out['networks'] = array_values( array_unique( array_intersect( $networks, $known ) ) );

	$position        = isset( $input['position'] ) ? sanitize_key( $input['position'] ) : $defaults['position'];
	$out['position'] = in_array( $position, array( 'before', 'after', 'both', 'none' ), true ) ? $position : $defaults['position'];

	$out['label'] = isset( $input['label'] ) ? sanitize_text_field( $input['label'] ) : '';

	$types             = isset( $input['post_types'] ) ? array_map( 'sanitize_key', (array) $input['post_types'] ) : $defaults['post_types'];
	$out['post_types'] = array_values( array_filter( $types, 'post_type_exists' ) );

	$out['related']       = ! empty( $input['related'] );
	$count                = isset( $input['related_count'] ) ? absint( $input['related_count'] ) : $defaults['related_count'];
	$out['related_count'] = min( 12, max( 1, $count ) );
	$out['related_title'] = isset( $input['related_title'] ) ? sanitize_text_field( $input['related_title'] ) : '';

	return $out;
}
