<?php
/**
 * Read-only lists in wp-admin: who signed up for notifications and who applied to speak.
 * No editing here on purpose - the source of truth for consents is the shared register.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_menu', function () {
	add_menu_page(
		'ELMC 2027',
		'ELMC 2027',
		'manage_options',
		'elmc2027',
		'elmc2027_admin_signups_page',
		'dashicons-megaphone',
		30
	);
	add_submenu_page( 'elmc2027', 'Zapisy na powiadomienia', 'Zapisy', 'manage_options', 'elmc2027', 'elmc2027_admin_signups_page' );
	add_submenu_page( 'elmc2027', 'Zgłoszenia prelegentów', 'Call for Speakers', 'manage_options', 'elmc2027-cfs', 'elmc2027_admin_cfs_page' );
} );

function elmc2027_admin_signups_page() {
	global $wpdb;
	$table = elmc2027_subscribers_table();
	$rows  = $wpdb->get_results( "SELECT * FROM {$table} ORDER BY id DESC LIMIT 500" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	$counts = array( 'confirmed' => 0, 'pending' => 0, 'unsubscribed' => 0 );
	foreach ( (array) $rows as $row ) {
		if ( isset( $counts[ $row->status ] ) ) {
			$counts[ $row->status ]++;
		}
	}
	?>
	<div class="wrap">
		<h1>Zapisy na powiadomienia o ELMC 2027</h1>
		<p>
			Potwierdzone: <strong><?php echo (int) $counts['confirmed']; ?></strong> ·
			Czekają na potwierdzenie: <strong><?php echo (int) $counts['pending']; ?></strong> ·
			Wypisani: <strong><?php echo (int) $counts['unsubscribed']; ?></strong>
		</p>
		<p>Wysyłamy tylko do potwierdzonych. Zapis i wypis trafiają też do wspólnego rejestru zgód.</p>
		<table class="widefat striped">
			<thead><tr><th>E-mail</th><th>Status</th><th>Język</th><th>Zapisano</th><th>Potwierdzono</th><th>Wypisano</th><th>Wersja zgody</th></tr></thead>
			<tbody>
			<?php if ( empty( $rows ) ) : ?>
				<tr><td colspan="7">Brak zapisów.</td></tr>
			<?php else : ?>
				<?php foreach ( $rows as $row ) : ?>
					<tr>
						<td><?php echo esc_html( $row->email ); ?></td>
						<td><?php echo esc_html( $row->status ); ?></td>
						<td><?php echo esc_html( strtoupper( isset( $row->lang ) ? $row->lang : '' ) ); ?></td>
						<td><?php echo esc_html( $row->created_at ); ?></td>
						<td><?php echo esc_html( (string) $row->confirmed_at ); ?></td>
						<td><?php echo esc_html( (string) $row->unsubscribed_at ); ?></td>
						<td><?php echo esc_html( $row->consent_version ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}

function elmc2027_admin_cfs_page() {
	global $wpdb;
	$table = elmc2027_cfs_table();
	$rows  = $wpdb->get_results( "SELECT * FROM {$table} ORDER BY id DESC LIMIT 500" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
	?>
	<div class="wrap">
		<h1>Zgłoszenia prelegentów (Call for Speakers)</h1>
		<p>Każde zgłoszenie jest też wysyłane mailem na <?php echo esc_html( ELMC2027_CONTACT_EMAIL ); ?>. Kolumna „Mail” pokazuje, czy wysyłka się powiodła.</p>
		<table class="widefat striped">
			<thead><tr><th>Imię i nazwisko</th><th>Organizacja / stanowisko</th><th>E-mail</th><th>Temat</th><th>Język</th><th>Mail</th><th>Zgłoszono</th><th>Wersja zgody</th></tr></thead>
			<tbody>
			<?php if ( empty( $rows ) ) : ?>
				<tr><td colspan="8">Brak zgłoszeń.</td></tr>
			<?php else : ?>
				<?php foreach ( $rows as $row ) : ?>
					<tr>
						<td><?php echo esc_html( $row->name ); ?></td>
						<td><?php echo esc_html( $row->organisation ); ?></td>
						<td><a href="mailto:<?php echo esc_attr( $row->email ); ?>"><?php echo esc_html( $row->email ); ?></a></td>
					<td><?php echo esc_html( isset( $row->topic ) ? $row->topic : '' ); ?></td>
						<td><?php echo esc_html( strtoupper( $row->lang ) ); ?></td>
						<td><?php echo $row->mail_sent ? 'wysłany' : 'nie wyszedł'; ?></td>
						<td><?php echo esc_html( $row->created_at ); ?></td>
						<td><?php echo esc_html( $row->consent_version ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
	<?php
}
