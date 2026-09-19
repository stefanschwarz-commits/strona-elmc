<?php
/**
 * ELMC 2027 theme setup.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Where congress e-mail goes (Call for Speakers, partnership enquiries). */
const ELMC2027_CONTACT_EMAIL = 'kontakt@ekmp.pl';

/** Bump when the database layout changes; tables are then rebuilt on the next request. */
const ELMC2027_DB_VERSION = '3';

require_once get_template_directory() . '/inc/i18n.php';
require_once get_template_directory() . '/inc/copy.php';
require_once get_template_directory() . '/inc/cfs.php';
if ( is_admin() ) {
	require_once get_template_directory() . '/inc/admin.php';
}

function elmc2027_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'elmc2027_setup' );

function elmc2027_assets() {
	// Archivo (display + body) and Space Mono (labels) - the two faces of the design system.
	wp_enqueue_style(
		'elmc2027-fonts',
		'https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'elmc2027-style',
		get_stylesheet_uri(),
		array( 'elmc2027-fonts' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'elmc2027_assets' );

add_action( 'wp_head', function () {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 0 );

/**
 * "Notify me" signup with explicit consent and double opt-in (19.09.2026).
 *
 * - The consent checkbox is required; its exact text and a stable version id are stored with each signup.
 * - A signup only becomes valid after the person clicks the confirmation link sent by e-mail.
 * - Every e-mail carries an unsubscribe link; unsubscribing withdraws the consent.
 * - Confirmations and withdrawals are passed to the shared consent register (mu-plugin
 *   rodo-przekazywanie.php, cel ELMC_POWIADOMIENIA). On dev.ekmp.pl the register runs in test mode.
 *
 * The consent texts below are TEMPORARY (modelled on the ELMI contact-form clause) until the legal
 * review at the end of the project; a changed text automatically gets a new version id.
 */

function elmc2027_consent_text( $lang = null ) {
	$lang = ( 'en' === $lang || 'pl' === $lang ) ? $lang : elmc2027_lang();
	if ( 'pl' === $lang ) {
		return 'Wyrażam zgodę na przetwarzanie mojego adresu e-mail przez Europejski Instytut Mobilności Pracy (administratora danych) w celu przesyłania mi informacji o Europejskim Kongresie Mobilności Pracy 2027, zgodnie z art. 6 ust. 1 lit. a RODO. Zgodę mogę wycofać w każdej chwili, korzystając z linku do wypisu w każdej wiadomości.';
	}
	return 'I consent to the processing of my e-mail address by the European Labour Mobility Institute (data controller) for the purpose of sending me information about the European Labour Mobility Congress 2027, in accordance with Art. 6(1)(a) GDPR. I can withdraw my consent at any time using the unsubscribe link in every e-mail.';
}

function elmc2027_consent_version( $lang = null ) {
	$lang = ( 'en' === $lang || 'pl' === $lang ) ? $lang : elmc2027_lang();
	return 'notify-' . $lang . '-' . substr( hash( 'sha256', elmc2027_consent_text( $lang ) ), 0, 8 );
}

function elmc2027_subscribers_table() {
	global $wpdb;
	return $wpdb->prefix . 'elmc2027_subscribers';
}

function elmc2027_install_tables() {
	global $wpdb;
	$table_name      = elmc2027_subscribers_table();
	$charset_collate = $wpdb->get_charset_collate();

	// Rows created before 19.09.2026 came from the English-only form, hence the default.
	$sql = "CREATE TABLE {$table_name} (
		id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
		email VARCHAR(190) NOT NULL,
		created_at DATETIME NOT NULL,
		status VARCHAR(20) NOT NULL DEFAULT 'pending',
		token CHAR(32) NOT NULL DEFAULT '',
		lang VARCHAR(5) NOT NULL DEFAULT 'en',
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
	elmc2027_install_cfs_table();
	update_option( 'elmc2027_db_version', ELMC2027_DB_VERSION );
}
add_action( 'after_switch_theme', 'elmc2027_install_tables' );
add_action( 'init', function () {
	if ( get_option( 'elmc2027_db_version' ) !== ELMC2027_DB_VERSION ) {
		elmc2027_install_tables();
	}
} );

function elmc2027_privacy_url() {
	$url = get_privacy_policy_url();
	return $url ? $url : home_url( '/privacy-notice/' );
}

function elmc2027_redirect( $status, $lang = null ) {
	$lang = ( 'en' === $lang || 'pl' === $lang ) ? $lang : elmc2027_lang();
	wp_safe_redirect( add_query_arg( 'elmc2027_signup', $status, elmc2027_home_url( $lang ) ) . '#zapisz' );
	exit;
}

function elmc2027_send_mail( $to, $subject, $lines ) {
	return wp_mail( $to, $subject, implode( "\n\n", $lines ) );
}

function elmc2027_register_event( $row, $event ) {
	if ( ! function_exists( 'rodo_przekaz' ) ) {
		return;
	}
	$lang    = ( isset( $row->lang ) && 'pl' === $row->lang ) ? 'pl' : 'en';
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
		'zrodlo'        => array( 'typ' => 'nowe_zgloszenie' === $event ? 'zapis_powiadomienia' : 'wypis', 'nazwa' => 'nowe_zgloszenie' === $event ? 'notify-me (potwierdzone kliknięciem w mailu)' : 'link-w-mailu', 'jezyk' => $lang, 'adres' => elmc2027_home_url( $lang ) ),
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
	$lang  = ( isset( $_POST['lang'] ) && 'en' === $_POST['lang'] ) ? 'en' : 'pl';

	if (
		! isset( $_POST['elmc2027_signup_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['elmc2027_signup_nonce'] ) ), 'elmc2027_signup' )
	) {
		elmc2027_redirect( 'error', $lang );
	}
	// Honeypot: real people never fill this hidden field.
	if ( ! empty( $_POST['website'] ) ) {
		elmc2027_redirect( 'check', $lang );
	}
	$email = isset( $_POST['email'] ) ? strtolower( sanitize_email( wp_unslash( $_POST['email'] ) ) ) : '';
	if ( empty( $email ) || ! is_email( $email ) ) {
		elmc2027_redirect( 'error', $lang );
	}
	if ( empty( $_POST['consent'] ) ) {
		elmc2027_redirect( 'consent', $lang );
	}

	$row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE email = %s", $email ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	if ( $row && 'confirmed' === $row->status ) {
		elmc2027_redirect( 'check', $lang ); // Same message as a new signup - never reveal who is subscribed.
	}
	// At most one confirmation e-mail per address every 10 minutes.
	if ( $row && $row->confirmation_sent_at && strtotime( $row->confirmation_sent_at ) > current_time( 'timestamp' ) - 600 ) {
		elmc2027_redirect( 'check', $lang );
	}
	$token = wp_generate_password( 32, false, false );
	$data  = array(
		'status' => 'pending', 'token' => $token, 'lang' => $lang, 'consent_version' => elmc2027_consent_version( $lang ),
		'consent_text' => elmc2027_consent_text( $lang ), 'confirmation_sent_at' => current_time( 'mysql' ), 'unsubscribed_at' => null,
	);
	if ( $row ) {
		$wpdb->update( $table, $data, array( 'id' => $row->id ) );
	} else {
		$wpdb->insert( $table, array( 'email' => $email, 'created_at' => current_time( 'mysql' ) ) + $data );
	}

	$copy = elmc2027_copy( $lang );
	elmc2027_send_mail(
		$email,
		$copy['mailSubject'],
		array_merge(
			$copy['mailLines'],
			array(
				$copy['mailConfirm'] . add_query_arg( 'elmc2027_confirm', $token, elmc2027_home_url( $lang ) ),
				$copy['mailIgnore'],
				$copy['mailUnsub'] . add_query_arg( 'elmc2027_unsubscribe', $token, elmc2027_home_url( $lang ) ),
				$copy['mailPrivacy'] . elmc2027_privacy_url(),
				$copy['mailSign'],
			)
		)
	);
	elmc2027_redirect( 'check', $lang );
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
		$row   = strlen( $token ) === 32 ? $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE token = %s", $token ) ) : null; // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( ! $row ) {
			elmc2027_redirect( 'invalid' );
		}
		$lang = ( isset( $row->lang ) && 'pl' === $row->lang ) ? 'pl' : 'en';
		if ( 'elmc2027_confirm' === $param ) {
			if ( 'pending' === $row->status ) {
				$wpdb->update( $table, array( 'status' => 'confirmed', 'confirmed_at' => current_time( 'mysql' ) ), array( 'id' => $row->id ) );
				elmc2027_register_event( $row, 'nowe_zgloszenie' );
			}
			elmc2027_redirect( 'unsubscribed' === $row->status ? 'invalid' : 'success', $lang );
		}
		if ( 'unsubscribed' !== $row->status ) {
			$was_confirmed = 'confirmed' === $row->status;
			$wpdb->update( $table, array( 'status' => 'unsubscribed', 'unsubscribed_at' => current_time( 'mysql' ) ), array( 'id' => $row->id ) );
			if ( $was_confirmed ) {
				elmc2027_register_event( $row, 'wycofanie_zgody' );
			}
		}
		elmc2027_redirect( 'unsubscribed', $lang );
	}
} );
