<?php
/**
 * Front end: buttons, related posts and the share redirect.
 *
 * Ad blockers hide share buttons in two ways: by blocking third-party scripts
 * and by cosmetic rules such as a[href^="https://www.facebook.com/sharer.php"].
 * Every button here is rendered on the server, and each network link points
 * back to this site (?jsp_go=facebook&jsp_id=123), which answers with a 302 to
 * the network. The class names avoid words like "share" and "social" that
 * generic cosmetic rules match.
 *
 * @package JustShare
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'template_redirect', 'just_share_handle_redirect', 0 );
add_filter( 'the_content', 'just_share_filter_content', 20 );
add_action( 'wp_enqueue_scripts', 'just_share_enqueue' );

/**
 * Answer ?jsp_go=<network>&jsp_id=<post> with a redirect to the network.
 *
 * The target is built only from a known template and a published post, so
 * this is not an open redirect.
 */
function just_share_handle_redirect() {
	// phpcs:disable WordPress.Security.NonceVerification.Recommended -- public, idempotent GET.
	if ( ! isset( $_GET['jsp_go'], $_GET['jsp_id'] ) ) {
		return;
	}
	$network = sanitize_key( wp_unslash( $_GET['jsp_go'] ) );
	$post_id = absint( $_GET['jsp_id'] );
	// phpcs:enable

	$networks = just_share_networks();
	$post     = get_post( $post_id );
	if (
		! isset( $networks[ $network ] )
		|| 'link' !== $networks[ $network ]['type']
		|| empty( $networks[ $network ]['url'] )
		|| ! $post
		|| 'publish' !== get_post_status( $post )
		|| ! is_post_type_viewable( $post->post_type )
		|| ! empty( $post->post_password )
	) {
		return;
	}

	nocache_headers();
	header( 'X-Robots-Tag: noindex, nofollow' );
	// wp_safe_redirect() would refuse the external host; the URL is not user supplied.
	wp_redirect( just_share_fill_template( $networks[ $network ]['url'], $post ), 302, 'Just Share' ); // phpcs:ignore WordPress.Security.SafeRedirect.wp_redirect_wp_redirect
	exit;
}

/**
 * Whether the buttons belong on the current request.
 *
 * @return bool
 */
function just_share_is_target() {
	$settings = just_share_settings();
	return ! empty( $settings['post_types'] )
		&& is_singular( $settings['post_types'] )
		&& ! is_feed()
		&& ! is_embed()
		&& ! post_password_required();
}

/**
 * Add the buttons and related posts around the main post's content.
 *
 * @param string $content Post content.
 * @return string
 */
function just_share_filter_content( $content ) {
	static $running = false;

	// Only the main post, once, while it is being displayed. The loop check
	// keeps descriptions built from the_content in wp_head clean.
	if (
		$running
		|| ! just_share_is_target()
		|| ! in_the_loop()
		|| ! is_main_query()
		|| (int) get_the_ID() !== (int) get_queried_object_id()
	) {
		return $content;
	}

	$running  = true;
	$settings = just_share_settings();
	$post     = get_post();

	if ( in_array( $settings['position'], array( 'before', 'both' ), true ) ) {
		$content = just_share_render_bar( $post, $settings, 'before' ) . $content;
	}
	if ( in_array( $settings['position'], array( 'after', 'both' ), true ) ) {
		$content .= just_share_render_bar( $post, $settings, 'after' );
	}
	if ( $settings['related'] ) {
		$content .= just_share_render_related( $post, $settings );
	}
	$running = false;

	return $content;
}

/**
 * Button bar markup.
 *
 * @param WP_Post $post     Post.
 * @param array   $settings Settings.
 * @param string  $where    'before' or 'after' the content.
 * @return string
 */
function just_share_render_bar( $post, $settings, $where ) {
	$networks = just_share_networks();
	$items    = '';

	foreach ( $settings['networks'] as $key ) {
		if ( ! isset( $networks[ $key ] ) ) {
			continue;
		}
		$net   = $networks[ $key ];
		$class = 'jsp-btn jsp-btn--' . sanitize_html_class( $key ) . ( $net['solo'] ? ' jsp-btn--solo' : '' );
		$style = '--jsp-c:' . sanitize_hex_color( $net['color'] );
		/* translators: %s: network name, for example Facebook. */
		$aria = 'link' === $net['type'] ? sprintf( __( 'Share on %s', 'just-share' ), $net['label'] ) : $net['label'];
		$icon = isset( $net['icon'] ) ? $net['icon'] : just_share_icon( $key );

		switch ( $net['type'] ) {
			case 'link':
				$href  = add_query_arg(
					array(
						'jsp_go' => $key,
						'jsp_id' => $post->ID,
					),
					home_url( '/' )
				);
				$items .= sprintf(
					'<li><a class="%1$s" style="%2$s" href="%3$s" target="_blank" rel="nofollow noopener" aria-label="%4$s" title="%5$s">%6$s</a></li>',
					esc_attr( $class ),
					esc_attr( $style ),
					esc_url( $href ),
					esc_attr( $aria ),
					esc_attr( $net['label'] ),
					$icon
				);
				break;

			case 'mailto':
				$items .= sprintf(
					'<li><a class="%1$s" style="%2$s" href="%3$s" aria-label="%4$s" title="%4$s">%5$s</a></li>',
					esc_attr( $class ),
					esc_attr( $style ),
					esc_url( just_share_fill_template( $net['url'], $post ), array( 'mailto' ) ),
					esc_attr( $aria ),
					$icon
				);
				break;

			case 'copy':
				$items .= sprintf(
					'<li><button type="button" class="%1$s" style="%2$s" data-jsp-copy="%3$s" data-jsp-done="%4$s" aria-label="%5$s" title="%5$s">%6$s%7$s</button></li>',
					esc_attr( $class ),
					esc_attr( $style ),
					esc_url( just_share_post_url( $post ) ),
					esc_attr__( 'Link copied', 'just-share' ),
					esc_attr( $aria ),
					$icon,
					'<span class="jsp-done" aria-hidden="true">' . just_share_icon( 'check' ) . '</span>'
				);
				break;

			case 'native':
				// Shown by the script only where navigator.share exists.
				$items .= sprintf(
					'<li class="jsp-native" hidden><button type="button" class="%1$s" style="%2$s" data-jsp-native="%3$s" data-jsp-title="%4$s" aria-label="%5$s" title="%5$s">%6$s</button></li>',
					esc_attr( $class ),
					esc_attr( $style ),
					esc_url( just_share_post_url( $post ) ),
					esc_attr( just_share_post_title( $post ) ),
					esc_attr( $aria ),
					$icon
				);
				break;
		}
	}

	if ( '' === $items ) {
		return '';
	}

	$label = '' !== $settings['label'] ? '<p class="jsp-lede">' . esc_html( $settings['label'] ) . '</p>' : '';
	$live  = '<span class="jsp-status" role="status" aria-live="polite"></span>';

	return '<div class="jsp-bar jsp-bar--' . esc_attr( $where ) . '">' . $label . '<ul class="jsp-list">' . $items . '</ul>' . $live . '</div>';
}

/**
 * Posts to show under the current one.
 *
 * Takes the posts published just before this one in the same categories, so
 * every post links to a different, nearby set and old posts stay reachable.
 * Newer posts fill in when there are not enough older ones.
 *
 * @param WP_Post $post  Post.
 * @param int     $count How many.
 * @return int[] Post IDs.
 */
function just_share_related_ids( $post, $count ) {
	$base = array(
		'post_type'           => $post->post_type,
		'post_status'         => 'publish',
		'posts_per_page'      => $count,
		'post__not_in'        => array( $post->ID ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
		'fields'              => 'ids',
		'has_password'        => false,
	);

	if ( is_object_in_taxonomy( $post->post_type, 'category' ) ) {
		$cats = wp_get_post_categories( $post->ID );
		if ( $cats ) {
			$base['category__in'] = $cats;
		}
	}

	$older = new WP_Query(
		$base + array(
			'orderby'    => 'date',
			'order'      => 'DESC',
			'date_query' => array(
				array(
					'before' => $post->post_date,
					'column' => 'post_date',
				),
			),
		)
	);
	$ids = $older->posts;

	if ( count( $ids ) < $count ) {
		$base['posts_per_page'] = $count - count( $ids );
		$base['post__not_in']   = array_merge( array( $post->ID ), $ids );
		$newer                  = new WP_Query(
			$base + array(
				'orderby' => 'date',
				'order'   => 'ASC',
			)
		);
		$ids = array_merge( $ids, $newer->posts );
	}

	/**
	 * Filter the related post IDs.
	 *
	 * @param int[]   $ids   Post IDs.
	 * @param WP_Post $post  Current post.
	 * @param int     $count Requested number.
	 */
	return array_map( 'intval', (array) apply_filters( 'just_share_related_ids', $ids, $post, $count ) );
}

/**
 * Related posts markup.
 *
 * @param WP_Post $post     Post.
 * @param array   $settings Settings.
 * @return string
 */
function just_share_render_related( $post, $settings ) {
	$ids = just_share_related_ids( $post, (int) $settings['related_count'] );
	if ( ! $ids ) {
		return '';
	}

	$title = '' !== $settings['related_title'] ? $settings['related_title'] : __( 'Related posts', 'just-share' );
	$cards = '';
	foreach ( $ids as $id ) {
		$thumb = get_the_post_thumbnail(
			$id,
			'medium_large',
			array(
				'class'   => 'jsp-card__img',
				'loading' => 'lazy',
				'alt'     => '',
			)
		);
		$cards .= sprintf(
			'<li class="jsp-card"><a class="jsp-card__link" href="%1$s">%2$s<span class="jsp-card__title">%3$s</span></a><time class="jsp-card__date" datetime="%4$s">%5$s</time></li>',
			esc_url( get_permalink( $id ) ),
			$thumb ? $thumb : '<span class="jsp-card__img jsp-card__img--none"></span>',
			esc_html( get_the_title( $id ) ),
			esc_attr( get_the_date( 'c', $id ) ),
			esc_html( get_the_date( '', $id ) )
		);
	}

	return '<section class="jsp-reads" aria-labelledby="jsp-reads-title"><h2 class="jsp-reads__title" id="jsp-reads-title">' . esc_html( $title ) . '</h2><ul class="jsp-reads__grid">' . $cards . '</ul></section>';
}

/**
 * Styles and the small script for copy and native sharing.
 */
function just_share_enqueue() {
	if ( ! just_share_is_target() ) {
		return;
	}
	wp_enqueue_style( 'just-share', JUST_SHARE_URL . 'assets/just-share.css', array(), JUST_SHARE_VERSION );
	wp_enqueue_script(
		'just-share',
		JUST_SHARE_URL . 'assets/just-share.js',
		array(),
		JUST_SHARE_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);
}
