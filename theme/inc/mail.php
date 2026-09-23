<?php
/**
 * Outgoing mail through Microsoft 365 instead of the hosting server (23.09.2026).
 *
 * Why: elmc.eu says (SPF) that only Microsoft sends mail for this domain, so confirmation
 * e-mails posted by the hosting server were rejected - a signup never received its link.
 * Until the congress gets its own mailbox (kontakt@elmc.eu), messages go out through the
 * existing "Claude (ELMI)" mailbox, signed with the congress name.
 *
 * Credentials live in wp-config.php (ELMC2027_GRAPH_*), never in the repository. Without
 * them nothing changes: WordPress falls back to its usual way of sending.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function elmc2027_graph_ready() {
	foreach ( array( 'ELMC2027_GRAPH_TENANT_ID', 'ELMC2027_GRAPH_CLIENT_ID', 'ELMC2027_GRAPH_CLIENT_SECRET', 'ELMC2027_GRAPH_SENDER' ) as $const ) {
		if ( ! defined( $const ) || '' === constant( $const ) ) {
			return false;
		}
	}
	return true;
}

/**
 * Access token for the mail application. Cached for an hour - one token serves many messages.
 */
function elmc2027_graph_token() {
	$cached = get_transient( 'elmc2027_graph_token' );
	if ( $cached ) {
		return $cached;
	}
	$response = wp_remote_post(
		'https://login.microsoftonline.com/' . rawurlencode( ELMC2027_GRAPH_TENANT_ID ) . '/oauth2/v2.0/token',
		array(
			'timeout' => 20,
			'body'    => array(
				'client_id'     => ELMC2027_GRAPH_CLIENT_ID,
				'client_secret' => ELMC2027_GRAPH_CLIENT_SECRET,
				'scope'         => 'https://graph.microsoft.com/.default',
				'grant_type'    => 'client_credentials',
			),
		)
	);
	if ( is_wp_error( $response ) ) {
		return '';
	}
	$data = json_decode( wp_remote_retrieve_body( $response ), true );
	if ( empty( $data['access_token'] ) ) {
		return '';
	}
	$ttl = isset( $data['expires_in'] ) ? max( 60, (int) $data['expires_in'] - 300 ) : 3000;
	set_transient( 'elmc2027_graph_token', $data['access_token'], $ttl );
	return $data['access_token'];
}

/**
 * Takes over wp_mail(). Returns null when it cannot help, and WordPress sends the old way.
 */
add_filter( 'pre_wp_mail', function ( $null, $atts ) {
	if ( ! elmc2027_graph_ready() ) {
		return null;
	}
	$to = is_array( $atts['to'] ) ? $atts['to'] : explode( ',', (string) $atts['to'] );
	$to = array_values( array_filter( array_map( 'sanitize_email', array_map( 'trim', $to ) ) ) );
	if ( ! $to ) {
		return null;
	}

	$token = elmc2027_graph_token();
	if ( ! $token ) {
		return null;
	}

	// Reply-To set by the caller (e.g. a speaker's address on a Call for Speakers notice).
	$reply_to = array();
	$headers  = isset( $atts['headers'] ) ? (array) $atts['headers'] : array();
	foreach ( $headers as $header ) {
		if ( preg_match( '/^\s*reply-to\s*:\s*(.+)$/i', (string) $header, $m ) ) {
			$address = sanitize_email( trim( $m[1], " <>\t" ) );
			if ( $address ) {
				$reply_to[] = array( 'emailAddress' => array( 'address' => $address ) );
			}
		}
	}

	$message = array(
		'message'         => array(
			'subject'      => (string) $atts['subject'],
			'body'         => array( 'contentType' => 'Text', 'content' => (string) $atts['message'] ),
			'from'         => array( 'emailAddress' => array( 'address' => ELMC2027_GRAPH_SENDER, 'name' => 'European Labour Mobility Congress' ) ),
			'toRecipients' => array_map( function ( $address ) {
				return array( 'emailAddress' => array( 'address' => $address ) );
			}, $to ),
		),
		'saveToSentItems' => true,
	);
	if ( $reply_to ) {
		$message['message']['replyTo'] = $reply_to;
	}

	$response = wp_remote_post(
		'https://graph.microsoft.com/v1.0/users/' . rawurlencode( ELMC2027_GRAPH_SENDER ) . '/sendMail',
		array(
			'timeout' => 25,
			'headers' => array( 'Authorization' => 'Bearer ' . $token, 'Content-Type' => 'application/json' ),
			'body'    => wp_json_encode( $message, JSON_UNESCAPED_UNICODE ),
		)
	);
	if ( is_wp_error( $response ) || 202 !== (int) wp_remote_retrieve_response_code( $response ) ) {
		// Let WordPress try the old way rather than losing the message silently.
		delete_transient( 'elmc2027_graph_token' );
		return null;
	}
	return true;
}, 10, 2 );
