<?php
/**
 * Call for Speakers - applications from the 2027 homepage.
 *
 * Every application is stored in the site database (so nothing is lost if e-mail fails)
 * and a notification goes to the congress mailbox. The consent text and its version are
 * stored with each row, exactly as with the notification signup.
 *
 * NOT passed to the shared consent register yet: the register's catalogue of purposes
 * (PRZEKAZYWANIE_ZGLOSZEN.md, pkt 4) has no code for speaker applications, and a site is
 * not allowed to invent codes. Waiting for a code - see SPRAWY_OTWARTE.md.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function elmc2027_cfs_table() {
	global $wpdb;
	return $wpdb->prefix . 'elmc2027_cfs';
}

function elmc2027_install_cfs_table() {
	global $wpdb;
	$table_name      = elmc2027_cfs_table();
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE {$table_name} (
		id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
		name VARCHAR(190) NOT NULL,
		organisation VARCHAR(255) NOT NULL,
		email VARCHAR(190) NOT NULL,
		lang VARCHAR(5) NOT NULL DEFAULT 'pl',
		consent_version VARCHAR(40) NOT NULL DEFAULT '',
		consent_text TEXT NULL,
		mail_sent TINYINT(1) NOT NULL DEFAULT 0,
		created_at DATETIME NOT NULL,
		PRIMARY KEY  (id),
		KEY email (email)
	) {$charset_collate};";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
}

/**
 * Consent clause shown next to the application form. Taken from the design handoff;
 * TEMPORARY until the legal review, like the signup clause. A changed text gets a new version.
 */
function elmc2027_cfs_consent_text( $lang = null ) {
	$lang = ( 'en' === $lang ) ? 'en' : 'pl';
	if ( 'en' === $lang ) {
		return 'I consent to the processing of my personal data by the European Labour Mobility Institute for the purpose of contact regarding participation in ELMC 2027.';
	}
	return 'Wyrażam zgodę na przetwarzanie moich danych osobowych przez Europejski Instytut Mobilności Pracy w celu kontaktu w sprawie udziału w ELMC 2027.';
}

function elmc2027_cfs_consent_version( $lang = null ) {
	$lang = ( 'en' === $lang ) ? 'en' : 'pl';
	return 'cfs-' . $lang . '-' . substr( hash( 'sha256', elmc2027_cfs_consent_text( $lang ) ), 0, 8 );
}

function elmc2027_cfs_redirect( $status, $lang ) {
	wp_safe_redirect( add_query_arg( 'elmc2027_cfs', $status, elmc2027_home_url( $lang ) ) . '#cfs' );
	exit;
}

function elmc2027_handle_cfs() {
	global $wpdb;
	$table = elmc2027_cfs_table();
	$lang  = ( isset( $_POST['lang'] ) && 'en' === $_POST['lang'] ) ? 'en' : 'pl';

	if (
		! isset( $_POST['elmc2027_cfs_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['elmc2027_cfs_nonce'] ) ), 'elmc2027_cfs' )
	) {
		elmc2027_cfs_redirect( 'fields', $lang );
	}
	// Honeypot: real people never fill this hidden field.
	if ( ! empty( $_POST['website'] ) ) {
		elmc2027_cfs_redirect( 'success', $lang );
	}

	$name  = isset( $_POST['cfs_name'] ) ? sanitize_text_field( wp_unslash( $_POST['cfs_name'] ) ) : '';
	$org   = isset( $_POST['cfs_org'] ) ? sanitize_text_field( wp_unslash( $_POST['cfs_org'] ) ) : '';
	$email = isset( $_POST['cfs_email'] ) ? strtolower( sanitize_email( wp_unslash( $_POST['cfs_email'] ) ) ) : '';

	if ( '' === $name || '' === $org ) {
		elmc2027_cfs_redirect( 'fields', $lang );
	}
	if ( '' === $email || ! is_email( $email ) ) {
		elmc2027_cfs_redirect( 'email', $lang );
	}
	if ( empty( $_POST['cfs_rodo'] ) ) {
		elmc2027_cfs_redirect( 'consent', $lang );
	}

	// One application per address every 10 minutes - keeps the mailbox clean on double clicks.
	$last = $wpdb->get_var( $wpdb->prepare( "SELECT created_at FROM {$table} WHERE email = %s ORDER BY id DESC LIMIT 1", $email ) );
	if ( $last && strtotime( $last ) > current_time( 'timestamp' ) - 600 ) {
		elmc2027_cfs_redirect( 'success', $lang );
	}

	$wpdb->insert(
		$table,
		array(
			'name'            => mb_substr( $name, 0, 190 ),
			'organisation'    => mb_substr( $org, 0, 255 ),
			'email'           => $email,
			'lang'            => $lang,
			'consent_version' => elmc2027_cfs_consent_version( $lang ),
			'consent_text'    => elmc2027_cfs_consent_text( $lang ),
			'created_at'      => current_time( 'mysql' ),
		)
	);
	$row_id = (int) $wpdb->insert_id;

	$sent = wp_mail(
		ELMC2027_CONTACT_EMAIL,
		sprintf( 'ELMC 2027 - zgloszenie Call for Speakers: %s', $name ),
		implode(
			"\n",
			array(
				'Nowe zgloszenie z formularza Call for Speakers na ' . elmc2027_home_url( $lang ),
				'',
				'Imie i nazwisko: ' . $name,
				'Organizacja / stanowisko: ' . $org,
				'E-mail: ' . $email,
				'Jezyk formularza: ' . strtoupper( $lang ),
				'Czas: ' . current_time( 'mysql' ),
				'',
				'Zgoda (' . elmc2027_cfs_consent_version( $lang ) . '):',
				elmc2027_cfs_consent_text( $lang ),
			)
		),
		array( 'Reply-To: ' . $email )
	);
	if ( $sent && $row_id ) {
		$wpdb->update( $table, array( 'mail_sent' => 1 ), array( 'id' => $row_id ) );
	}

	elmc2027_cfs_redirect( 'success', $lang );
}
add_action( 'admin_post_elmc2027_cfs', 'elmc2027_handle_cfs' );
add_action( 'admin_post_nopriv_elmc2027_cfs', 'elmc2027_handle_cfs' );
