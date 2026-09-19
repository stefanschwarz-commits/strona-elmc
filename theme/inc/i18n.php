<?php
/**
 * Two languages on one page: Polish at the root address, English under /en/.
 *
 * Both versions are rendered by the server, so each has its own address that can be
 * linked and indexed. The layout is identical; only the copy changes (inc/copy.php).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const ELMC2027_REWRITE_VERSION = '1';

function elmc2027_languages() {
	return array( 'pl', 'en' );
}

/**
 * Current language. On the front end it comes from the address (/en/), in form
 * handlers from the posted "lang" field, and it falls back to Polish.
 */
function elmc2027_lang() {
	if ( 'en' === get_query_var( 'elmc_lang' ) ) {
		return 'en';
	}
	if ( isset( $_REQUEST['lang'] ) && 'en' === $_REQUEST['lang'] ) { // phpcs:ignore WordPress.Security.NonceVerification
		return 'en';
	}
	return 'pl';
}

/**
 * Home address of a language version.
 */
function elmc2027_home_url( $lang = null, $path = '' ) {
	$lang = in_array( $lang, elmc2027_languages(), true ) ? $lang : elmc2027_lang();
	$url  = 'en' === $lang ? home_url( '/en/' ) : home_url( '/' );
	return $path ? $url . ltrim( $path, '/' ) : $url;
}

// /en/ is a rewrite, not a real page: it renders the front page template with English copy.
add_action( 'init', function () {
	add_rewrite_rule( '^en/?$', 'index.php?elmc_lang=en', 'top' );
	if ( get_option( 'elmc2027_rewrite_version' ) !== ELMC2027_REWRITE_VERSION ) {
		flush_rewrite_rules( false );
		update_option( 'elmc2027_rewrite_version', ELMC2027_REWRITE_VERSION );
	}
} );

add_filter( 'query_vars', function ( $vars ) {
	$vars[] = 'elmc_lang';
	return $vars;
} );

// Without this WordPress would bounce /en/ back to the root address.
add_filter( 'redirect_canonical', function ( $redirect ) {
	return 'en' === get_query_var( 'elmc_lang' ) ? false : $redirect;
} );

add_filter( 'template_include', function ( $template ) {
	if ( 'en' === get_query_var( 'elmc_lang' ) ) {
		$front = locate_template( 'front-page.php' );
		if ( $front ) {
			return $front;
		}
	}
	return $template;
} );

// Language of the document, and the page title and description per language.
add_filter( 'language_attributes', function ( $output ) {
	return 'lang="' . ( 'en' === elmc2027_lang() ? 'en' : 'pl' ) . '"';
} );

add_filter( 'pre_get_document_title', function ( $title ) {
	if ( is_front_page() || 'en' === get_query_var( 'elmc_lang' ) ) {
		return elmc2027_t( 'docTitle' );
	}
	return $title;
} );

add_action( 'wp_head', function () {
	$is_home = is_front_page() || 'en' === get_query_var( 'elmc_lang' );
	if ( $is_home ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( elmc2027_t( 'heroLead' ) ) );
		printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( elmc2027_t( 'docTitle' ) ) );
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( elmc2027_t( 'heroLead' ) ) );
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( get_template_directory_uri() . '/assets/img/kv-elmc.jpg' ) );
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( elmc2027_home_url() ) );
		echo '<meta property="og:type" content="website">' . "\n";
	}
	printf( '<link rel="alternate" hreflang="pl" href="%s">' . "\n", esc_url( elmc2027_home_url( 'pl' ) ) );
	printf( '<link rel="alternate" hreflang="en" href="%s">' . "\n", esc_url( elmc2027_home_url( 'en' ) ) );
	printf( '<link rel="alternate" hreflang="x-default" href="%s">' . "\n", esc_url( elmc2027_home_url( 'pl' ) ) );
	if ( $is_home ) {
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( elmc2027_home_url() ) );
	}
}, 1 );
