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
 * "Notify me" signup with explicit consent and double opt-in (19.09.2026).
 *
 * - The consent checkbox is required; its exact text and a stable version id are stored with each signup.
 * - A signup only becomes valid after the person clicks the confirmation link sent by e-mail.
 * - Every e-mail carries an unsubscribe link; unsubscribing withdraws the consent.
 * - Confirmations and withdrawals are passed to the shared consent register (mu-plugin
 *   rodo-przekazywanie.php, cel ELMC_POWIADOMIENIA). On dev.ekmp.pl the register runs in test mode.
 *
 * The consent text below is TEMPORARY (modelled on the ELMI contact-form clause) until the legal
 * review at the end of the project; a changed text automatically gets a new version id.
 */

const ELMC2027_DB_VERSION = '2';

function elmc2027_consent_text() {
	return 'I consent to the processing of my e-mail address by the European Labour Mobility Institute (data controller) for the purpose of sending me information about the European Labour Mobility Congress 2027, in accordance with Art. 6(1)(a) GDPR. I can withdraw my consent at any time using the unsubscribe link in every e-mail.';
}

function elmc2027_consent_version() {
	return 'notify-en-' . substr( hash( 'sha256', elmc2027_consent_text() ), 0, 8 );
}

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
		status VARCHAR(20) NOT NULL DEFAULT 'pending',
		token CHAR(32) NOT NULL DEFAULT '',
		consent_version VARCHAR(40) NOT NULL DEFAULT '',
		consent_text TEXT NULL,
		confirmation_sent_at DATETIME NULL,
		confirmed_at DATETIME NULL,
		unsubscribed_at DATETIME NULL,
		PRIMARY KEY  (id),
		UNIQUE KEY email (email),
		KEY token (token)
	) {$charset_collate};";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
	update_option( 'elmc2027_db_version', ELMC2027_DB_VERSION );
}
add_action( 'after_switch_theme', 'elmc2027_install_subscribers_table' );
add_action( 'init', function () {
	if ( get_option( 'elmc2027_db_version' ) !== ELMC2027_DB_VERSION ) {
		elmc2027_install_subscribers_table();
	}
} );

function elmc2027_privacy_url() {
	$url = get_privacy_policy_url();
	return $url ? $url : home_url( '/privacy-notice/' );
}

function elmc2027_redirect( $status ) {
	wp_safe_redirect( add_query_arg( 'elmc2027_signup', $status, home_url( '/' ) ) . '#signup' );
	exit;
}

function elmc2027_send_mail( $to, $subject, $lines ) {
	return wp_mail( $to, $subject, implode( "\n\n", $lines ) );
}

function elmc2027_register_event( $row, $event ) {
	if ( ! function_exists( 'rodo_przekaz' ) ) {
		return;
	}
	$consent = array( 'cel' => 'ELMC_POWIADOMIENIA', 'rodzaj' => 'zgoda', 'osoba' => 0 );
	if ( 'nowe_zgloszenie' === $event ) {
		$consent += array( 'udzielona' => true, 'wymagana' => true, 'wersja' => $row->consent_version, 'tresc' => $row->consent_text,
			'dokument' => array( 'url' => elmc2027_privacy_url() ) );
		$id = 'elmc.eu:powiadomienia:zapis:' . $row->id;
	} else {
		$consent += array( 'udzielona' => false );
		$id = 'elmc.eu:powiadomienia:wypis:' . $row->id . ':' . gmdate( 'Ymd\THis' );
	}
	$report = array(
		'id_zgloszenia' => $id,
		'administrator' => 'ELMI',
		'zdarzenie'     => $event,
		'czas'          => wp_date( 'c' ),
		'zrodlo'        => array( 'typ' => 'nowe_zgloszenie' === $event ? 'zapis_powiadomienia' : 'wypis', 'nazwa' => 'nowe_zgloszenie' === $event ? 'notify-me (potwierdzone kliknięciem w mailu)' : 'link-w-mailu', 'jezyk' => 'en', 'adres' => home_url( '/' ) ),
		'osoby'         => array( array( 'indeks' => 0, 'rola' => 'subskrybent', 'email' => $row->email, 'podana_przez' => null ) ),
		'zgody'         => array( $consent ),
		'klauzula_informacyjna' => array( 'url' => elmc2027_privacy_url() ),
		'odnosnik'      => array( 'system' => 'elmc2027', 'tabela' => 'elmc2027_subscribers', 'id' => (string) $row->id ),
	);
	if ( 'wycofanie_zgody' === $event ) {
		$report['odnosi_sie_do'] = 'elmc.eu:powiadomienia:zapis:' . $row->id;
	}
	rodo_przekaz( $report );
}

function elmc2027_handle_signup() {
	global $wpdb;
	$table = elmc2027_subscribers_table();

	if (
		! isset( $_POST['elmc2027_signup_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['elmc2027_signup_nonce'] ) ), 'elmc2027_signup' )
	) {
		elmc2027_redirect( 'error' );
	}
	// Honeypot: real people never fill this hidden field.
	if ( ! empty( $_POST['website'] ) ) {
		elmc2027_redirect( 'check' );
	}
	$email = isset( $_POST['email'] ) ? strtolower( sanitize_email( wp_unslash( $_POST['email'] ) ) ) : '';
	if ( empty( $email ) || ! is_email( $email ) ) {
		elmc2027_redirect( 'error' );
	}
	if ( empty( $_POST['consent'] ) ) {
		elmc2027_redirect( 'consent' );
	}

	$row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE email = %s", $email ) );
	if ( $row && 'confirmed' === $row->status ) {
		elmc2027_redirect( 'check' ); // Same message as a new signup - never reveal who is subscribed.
	}
	// At most one confirmation e-mail per address every 10 minutes.
	if ( $row && $row->confirmation_sent_at && strtotime( $row->confirmation_sent_at ) > current_time( 'timestamp' ) - 600 ) {
		elmc2027_redirect( 'check' );
	}
	$token = wp_generate_password( 32, false, false );
	$data  = array(
		'status' => 'pending', 'token' => $token, 'consent_version' => elmc2027_consent_version(),
		'consent_text' => elmc2027_consent_text(), 'confirmation_sent_at' => current_time( 'mysql' ), 'unsubscribed_at' => null,
	);
	if ( $row ) {
		$wpdb->update( $table, $data, array( 'id' => $row->id ) );
	} else {
		$wpdb->insert( $table, array( 'email' => $email, 'created_at' => current_time( 'mysql' ) ) + $data );
	}

	elmc2027_send_mail( $email, 'Please confirm: ELMC 2027 updates', array(
		'Hello,',
		'Someone (hopefully you) asked to be notified about the European Labour Mobility Congress 2027 using this e-mail address.',
		'To confirm, please click: ' . add_query_arg( 'elmc2027_confirm', $token, home_url( '/' ) ),
		'If it was not you, simply ignore this message - you will not receive anything else.',
		'Unsubscribe at any time: ' . add_query_arg( 'elmc2027_unsubscribe', $token, home_url( '/' ) ),
		'Information on how we process your data: ' . elmc2027_privacy_url(),
		'European Labour Mobility Congress',
	) );
	elmc2027_redirect( 'check' );
}
add_action( 'admin_post_elmc2027_signup', 'elmc2027_handle_signup' );
add_action( 'admin_post_nopriv_elmc2027_signup', 'elmc2027_handle_signup' );

// Confirmation and unsubscribe links (GET with a random 32-character token).
add_action( 'template_redirect', function () {
	global $wpdb;
	$table = elmc2027_subscribers_table();
	foreach ( array( 'elmc2027_confirm', 'elmc2027_unsubscribe' ) as $param ) {
		if ( empty( $_GET[ $param ] ) ) {
			continue;
		}
		$token = preg_replace( '/[^A-Za-z0-9]/', '', (string) wp_unslash( $_GET[ $param ] ) );
		$row   = strlen( $token ) === 32 ? $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE token = %s", $token ) ) : null;
		if ( ! $row ) {
			elmc2027_redirect( 'invalid' );
		}
		if ( 'elmc2027_confirm' === $param ) {
			if ( 'pending' === $row->status ) {
				$wpdb->update( $table, array( 'status' => 'confirmed', 'confirmed_at' => current_time( 'mysql' ) ), array( 'id' => $row->id ) );
				elmc2027_register_event( $row, 'nowe_zgloszenie' );
			}
			elmc2027_redirect( 'unsubscribed' === $row->status ? 'invalid' : 'success' );
		}
		if ( 'unsubscribed' !== $row->status ) {
			$was_confirmed = 'confirmed' === $row->status;
			$wpdb->update( $table, array( 'status' => 'unsubscribed', 'unsubscribed_at' => current_time( 'mysql' ) ), array( 'id' => $row->id ) );
			if ( $was_confirmed ) {
				elmc2027_register_event( $row, 'wycofanie_zgody' );
			}
		}
		elmc2027_redirect( 'unsubscribed' );
	}
} );
