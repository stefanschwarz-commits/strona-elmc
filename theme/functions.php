<?php
/**
 * ELMC 2027 theme setup.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function elmc2027_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	register_nav_menus( array(
		'primary' => __( 'Primary menu (e.g. Poprzednie edycje)', 'elmc2027' ),
	) );
}
add_action( 'after_setup_theme', 'elmc2027_setup' );

function elmc2027_assets() {
	wp_enqueue_style(
		'elmc2027-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'elmc2027_assets' );

/**
 * Email signup: minimal storage in a dedicated table.
 * Swap this out for a real ESP (Mailchimp, Brevo, ...) once one is chosen.
 */

function elmc2027_subscribers_table() {
	global $wpdb;
	return $wpdb->prefix . 'elmc2027_subscribers';
}

function elmc2027_install_subscribers_table() {
	global $wpdb;
	$table_name      = elmc2027_subscribers_table();
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE {$table_name} (
		id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
		email VARCHAR(190) NOT NULL,
		created_at DATETIME NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY email (email)
	) {$charset_collate};";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
}
add_action( 'after_switch_theme', 'elmc2027_install_subscribers_table' );

function elmc2027_handle_signup() {
	global $wpdb;

	if (
		! isset( $_POST['elmc2027_signup_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['elmc2027_signup_nonce'] ) ), 'elmc2027_signup' )
	) {
		wp_safe_redirect( add_query_arg( 'elmc2027_signup', 'error', home_url( '/' ) ) );
		exit;
	}

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

	if ( empty( $email ) || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'elmc2027_signup', 'error', home_url( '/' ) ) );
		exit;
	}

	$wpdb->query(
		$wpdb->prepare(
			"INSERT IGNORE INTO " . elmc2027_subscribers_table() . " (email, created_at) VALUES (%s, %s)",
			$email,
			current_time( 'mysql' )
		)
	);

	wp_safe_redirect( add_query_arg( 'elmc2027_signup', 'success', home_url( '/' ) ) );
	exit;
}
add_action( 'admin_post_elmc2027_signup', 'elmc2027_handle_signup' );
add_action( 'admin_post_nopriv_elmc2027_signup', 'elmc2027_handle_signup' );
