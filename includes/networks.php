<?php
/**
 * Network definitions and icons.
 *
 * Brand icons are from Simple Icons 16.32.0 (CC0-1.0, https://simpleicons.org).
 * Email, link, share and check icons are from Material Icons (Apache-2.0).
 *
 * @package JustShare
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SVG path data keyed by icon name, all on a 24x24 view box.
 *
 * @return array<string,string>
 */
function just_share_icon_paths() {
	return array(
		'facebook' => 'M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z',
		'x' => 'M14.234 10.162 22.977 0h-2.072l-7.591 8.824L7.251 0H.258l9.168 13.343L.258 24H2.33l8.016-9.318L16.749 24h6.993zm-2.837 3.299-.929-1.329L3.076 1.56h3.182l5.965 8.532.929 1.329 7.754 11.09h-3.182z',
		'threads' => 'M18.263 11.097c-.03-3.486-1.92-5.586-5.111-5.586-2.13 0-3.922.963-4.863 2.499l2.062 1.438c.535-.843 1.272-1.543 2.628-1.543 1.528 0 2.318.85 2.544 2.431a15 15 0 0 0-2.236-.173c-4.125 0-6.068 1.867-6.068 4.336s1.943 3.99 4.804 3.99c3.139 0 5.013-2.115 5.781-4.735.798.361 1.348 1.204 1.348 2.47 0 3.387-3.907 5.232-7.22 5.232-4.885 0-8.077-3.207-8.077-8.424 0-6.392 4.223-10.487 9.9-10.487 3.808 0 5.69 1.671 6.97 3.914l2.108-1.475C21.44 2.078 18.331 0 13.663 0 6.227 0 1.168 5.277 1.168 12.934c0 7 4.953 11.066 10.856 11.066 4.878 0 9.809-2.846 9.809-7.716 0-2.545-1.46-4.231-3.569-5.187m-6.33 4.855c-1.077 0-2.026-.512-2.026-1.453 0-1.483 1.822-1.934 3.606-1.934.678 0 1.34.045 1.927.173-.422 1.927-1.671 3.215-3.508 3.214Z',
		'line' => 'M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314',
		'plurk' => 'M12.9017 1.9056a10.0652 10.0652 0 00-7.8802 3.707 10.1803 10.1803 0 00-.283.357l.004-.003c.232-.196.473-.345.717-.445l.058-.023c.299-.112.602-.147.9-.088 1.4401.289 2.1901 2.6091 1.6751 5.1832-.515 2.574-2.1 4.4271-3.54 4.139-1.0101-.202-1.6781-1.405-1.8121-2.992v-.005.052c-.003.132-.003.266 0 .4v.073l.002.059c.005.149.013.296.024.443.005.067.012.134.019.2a10.0322 10.0322 0 00.961 3.4431c.06.126.03.276-.078.363l-.277.226a.906.906 0 00-.29.97c0 .006.003.01.006.017a.955.955 0 00.059.142l.05-.039.23-.174a.2612.2612 0 11.316.416l-.245.186-.037.028 1.177 1.4481a.91.91 0 001.275.131l.258-.21a.298.298 0 01.374 0 10.0502 10.0502 0 006.5272 2.181 10.0422 10.0422 0 005.5722-1.855.298.298 0 01.38.025l.163.156a.909.909 0 001.179.059l-.004-.004-.21-.197a.262.262 0 01.358-.382l.225.21 1.26-1.326a.91.91 0 00-.033-1.282l-.263-.25a.297.297 0 01-.054-.36 10.0602 10.0602 0 001.103-6.6712c.301-.278.853-.824 1.0691-1.292.231-.502.29-1.02-.323-.792-.476.177-.842.291-1.286.19-1.417-3.5932-4.8472-6.1932-8.8513-6.4002a9.7102 9.7102 0 00-.473-.014zM2.2645 6.2466a1.228 1.228 0 00-1.082 1.7641 1.23 1.23 0 10.754 2.236c.177-.124.306-.289.395-.47.186.342.46.627.778.823a5.5901 5.5901 0 00.017.6001c.102 1.228.62 2.16 1.401 2.316 1.114.223 2.34-1.21 2.738-3.2.3991-1.99-.181-3.7841-1.295-4.0071-.434-.087-.885.08-1.298.432-.45.383-.854.988-1.14 1.73-.01-.002-.02-.003-.03-.007-.14-.04-.215-.131-.312-.152a1.23 1.23 0 00-.926-2.065zm2.862 1.2441c.054 0 .107.004.16.015.726.143 1.104 1.312.844 2.608-.259 1.2981-1.058 2.2301-1.783 2.0851-.493-.098-.824-.67-.905-1.433.181.07.37.113.56.122.527.024.871-.154 1.14-.513.346-.465.084-1.753-.374-1.92-.356-.13-.567.027-.884.05.16-.298.351-.544.557-.72.219-.185.453-.292.686-.295z',
		'telegram' => 'M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z',
		'email' => 'M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z',
		'copy' => 'M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z',
		'native' => 'M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92-1.31-2.92-2.92-2.92z',
		'check' => 'M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z',
	);
}
/**
 * Inline SVG markup for an icon.
 *
 * @param string $name Icon name from just_share_icon_paths().
 * @return string
 */
function just_share_icon( $name ) {
	$paths = just_share_icon_paths();
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return '<svg viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path fill="currentColor" d="' . esc_attr( $paths[ $name ] ) . '"/></svg>';
}

/**
 * Every button the plugin knows about.
 *
 * Keys of each entry:
 * - label: visible name, used in the accessible label.
 * - color: brand color.
 * - solo:  true when the logo is itself a filled shape and is drawn in the
 *          brand color on its own; false draws a white glyph on a colored disc.
 * - type:  'link' (redirect through this site), 'mailto', 'copy' or 'native'.
 * - url:   target template for 'link' and 'mailto'; {url} and {title} are
 *          replaced with the URL-encoded permalink and title.
 *
 * @return array<string,array>
 */
function just_share_networks() {
	$networks = array(
		'facebook' => array(
			'label' => 'Facebook',
			'color' => '#0866FF',
			'solo'  => true,
			'type'  => 'link',
			'url'   => 'https://www.facebook.com/sharer/sharer.php?u={url}',
		),
		'x'        => array(
			'label' => 'X',
			'color' => '#000000',
			'solo'  => false,
			'type'  => 'link',
			'url'   => 'https://x.com/intent/tweet?text={title}&url={url}',
		),
		'threads'  => array(
			'label' => 'Threads',
			'color' => '#000000',
			'solo'  => false,
			'type'  => 'link',
			'url'   => 'https://www.threads.net/intent/post?text={title}%20{url}',
		),
		'line'     => array(
			'label' => 'LINE',
			'color' => '#00C300',
			'solo'  => true,
			'type'  => 'link',
			'url'   => 'https://social-plugins.line.me/lineit/share?url={url}',
		),
		'plurk'    => array(
			'label' => 'Plurk',
			'color' => '#FF574D',
			'solo'  => false,
			'type'  => 'link',
			'url'   => 'https://www.plurk.com/?qualifier=shares&status={url}%20({title})',
		),
		'telegram' => array(
			'label' => 'Telegram',
			'color' => '#26A5E4',
			'solo'  => true,
			'type'  => 'link',
			'url'   => 'https://t.me/share/url?url={url}&text={title}',
		),
		'email'    => array(
			'label' => __( 'Email', 'just-share' ),
			'color' => '#6B7280',
			'solo'  => false,
			'type'  => 'mailto',
			'url'   => 'mailto:?subject={title}&body={url}',
		),
		'copy'     => array(
			'label' => __( 'Copy link', 'just-share' ),
			'color' => '#6B7280',
			'solo'  => false,
			'type'  => 'copy',
		),
		'native'   => array(
			'label' => __( 'More options', 'just-share' ),
			'color' => '#6B7280',
			'solo'  => false,
			'type'  => 'native',
		),
	);

	/**
	 * Filter the available buttons. Add an entry with type 'link' to support
	 * another network; its URL is only ever reached through the redirect.
	 *
	 * @param array $networks Network definitions.
	 */
	return apply_filters( 'just_share_networks', $networks );
}

/**
 * The URL that gets shared for a post.
 *
 * @param WP_Post $post Post.
 * @return string
 */
function just_share_post_url( $post ) {
	/**
	 * Filter the URL that is shared, for example to add campaign parameters.
	 *
	 * @param string  $url  Permalink.
	 * @param WP_Post $post Post.
	 */
	return (string) apply_filters( 'just_share_post_url', get_permalink( $post ), $post );
}

/**
 * The plain-text title that gets shared for a post.
 *
 * @param WP_Post $post Post.
 * @return string
 */
function just_share_post_title( $post ) {
	return html_entity_decode( wp_strip_all_tags( get_the_title( $post ) ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
}

/**
 * Fill a network URL template for a post.
 *
 * @param string  $template Template with {url} and {title}.
 * @param WP_Post $post     Post.
 * @return string
 */
function just_share_fill_template( $template, $post ) {
	return strtr(
		$template,
		array(
			'{url}'   => rawurlencode( just_share_post_url( $post ) ),
			'{title}' => rawurlencode( just_share_post_title( $post ) ),
		)
	);
}
