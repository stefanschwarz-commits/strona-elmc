<?php
/**
 * Front page: ELMC 2027 landing / email signup.
 */
get_header();
?>

<div class="page">
	<section class="hero">
		<div class="hero-copy">
			<span class="eyebrow"><?php esc_html_e( 'Next edition', 'elmc2027' ); ?></span>
			<h1><?php esc_html_e( 'European Labour Mobility Congress 2027', 'elmc2027' ); ?></h1>
			<p class="lede">
				<?php esc_html_e( 'Since 2013, ELMC has brought together Europe\'s labour mobility institutions, employment agencies and policymakers. The 2027 edition is now in preparation — leave your email and we\'ll let you know as soon as dates and registration open.', 'elmc2027' ); ?>
			</p>
			<?php
			$elmc2027_signup_status = isset( $_GET['elmc2027_signup'] ) ? sanitize_text_field( wp_unslash( $_GET['elmc2027_signup'] ) ) : '';
			?>
			<div id="signup"></div>
			<?php if ( 'success' === $elmc2027_signup_status ) : ?>
				<p class="form-note"><strong><?php esc_html_e( 'Confirmed — thank you. We\'ll let you know as soon as ELMC 2027 details are announced.', 'elmc2027' ); ?></strong></p>
			<?php elseif ( 'check' === $elmc2027_signup_status ) : ?>
				<p class="form-note"><strong><?php esc_html_e( 'Almost done — please check your inbox and click the confirmation link we\'ve just sent you.', 'elmc2027' ); ?></strong></p>
			<?php elseif ( 'unsubscribed' === $elmc2027_signup_status ) : ?>
				<p class="form-note"><strong><?php esc_html_e( 'You have been unsubscribed. You will not receive any more e-mails about ELMC 2027.', 'elmc2027' ); ?></strong></p>
			<?php else : ?>
				<form class="signup-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="elmc2027_signup">
					<?php wp_nonce_field( 'elmc2027_signup', 'elmc2027_signup_nonce' ); ?>
					<input type="email" name="email" placeholder="you@organisation.eu" required>
					<button class="btn" type="submit"><?php esc_html_e( 'Notify me', 'elmc2027' ); ?></button>
					<input type="text" name="website" class="signup-hp" tabindex="-1" autocomplete="off" aria-hidden="true">
					<label class="signup-consent">
						<input type="checkbox" name="consent" value="1" required>
						<span><?php echo esc_html( elmc2027_consent_text() ); ?>
							<a href="<?php echo esc_url( elmc2027_privacy_url() ); ?>"><?php esc_html_e( 'Privacy notice', 'elmc2027' ); ?></a></span>
					</label>
				</form>
				<?php if ( 'error' === $elmc2027_signup_status ) : ?>
					<div class="form-note"><?php esc_html_e( 'Please enter a valid email address.', 'elmc2027' ); ?></div>
				<?php elseif ( 'consent' === $elmc2027_signup_status ) : ?>
					<div class="form-note"><?php esc_html_e( 'Please tick the consent box so we can send you the updates.', 'elmc2027' ); ?></div>
				<?php elseif ( 'invalid' === $elmc2027_signup_status ) : ?>
					<div class="form-note"><?php esc_html_e( 'This link is no longer valid. You can sign up again below.', 'elmc2027' ); ?></div>
				<?php else : ?>
					<div class="form-note"><?php esc_html_e( 'One email when ELMC 2027 details are announced. No spam, unsubscribe anytime.', 'elmc2027' ); ?></div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="hero-art">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/elmc-hero.jpg' ); ?>"
				alt="<?php esc_attr_e( 'European Labour (crossed out, replaced with Service) Mobility Congress — Barriers down! Europe forward!', 'elmc2027' ); ?>">
		</div>
	</section>

	<section class="status-strip">
		<div class="item">
			<div class="label"><?php esc_html_e( 'Edition', 'elmc2027' ); ?></div>
			<div class="value accent">ELMC 2027</div>
		</div>
		<div class="item">
			<div class="label"><?php esc_html_e( 'Dates & venue', 'elmc2027' ); ?></div>
			<div class="value"><?php esc_html_e( 'To be announced', 'elmc2027' ); ?></div>
		</div>
		<div class="item">
			<div class="label"><?php esc_html_e( 'Organiser', 'elmc2027' ); ?></div>
			<div class="value"><?php esc_html_e( 'European Institute for Labour Mobility', 'elmc2027' ); ?></div>
		</div>
	</section>

	<section class="about">
		<div class="about-copy">
			<h2 class="about-title"><?php esc_html_e( 'About ELMC', 'elmc2027' ); ?></h2>
			<p><?php esc_html_e( 'The European Labour Mobility Congress is a recurring meeting point for labour mobility institutions, employment agencies and policymakers from across Europe — a place to compare practice, discuss regulation, and build cooperation across borders.', 'elmc2027' ); ?></p>
		</div>
		<div class="about-stats">
			<div class="stat">
				<div class="stat-value">2013</div>
				<div class="stat-label"><?php esc_html_e( 'First edition', 'elmc2027' ); ?></div>
			</div>
			<div class="stat">
				<div class="stat-value">9</div>
				<div class="stat-label"><?php esc_html_e( 'Editions held', 'elmc2027' ); ?></div>
			</div>
			<div class="stat">
				<div class="stat-value">2027</div>
				<div class="stat-label"><?php esc_html_e( 'Next edition', 'elmc2027' ); ?></div>
			</div>
		</div>
	</section>

	<?php
	$elmc2027_past_editions = array(
		array( 'year' => '2025', 'title' => 'European Labour Mobility Congress 2025', 'url' => 'https://labourinstitute.eu/en/elmc2025/' ),
		array( 'year' => '2023', 'title' => 'European Labour Mobility Congress 2023', 'url' => 'https://ekmp.pl/2023/' ),
		array( 'year' => '2022', 'title' => 'European Labour Mobility Congress 2022', 'url' => 'https://ekmp.pl/2022/' ),
		array( 'year' => '2019', 'title' => 'VI European Labour Mobility Congress', 'url' => 'https://ekmp.pl/2019/' ),
		array( 'year' => '2017', 'title' => 'V European Labour Mobility Congress', 'url' => 'https://ekmp.pl/2017/' ),
		array( 'year' => '2016', 'title' => 'European Labour Mobility Congress 2016', 'url' => 'https://ekmp.pl/2016/' ),
		array( 'year' => '2015', 'title' => 'European Labour Mobility Congress 2015', 'url' => 'https://ekmp.pl/2015/' ),
		array( 'year' => '2014', 'title' => 'II European Labour Mobility Congress', 'url' => 'https://ekmp.pl/2014/' ),
		array( 'year' => '2013', 'title' => 'Kraków Conference (I edition)', 'url' => 'https://ekmp.pl/2013/' ),
	);
	?>
	<section class="archive" id="previous-editions">
		<h2 class="archive-title"><?php esc_html_e( 'Previous editions', 'elmc2027' ); ?></h2>
		<div class="archive-grid">
			<?php foreach ( $elmc2027_past_editions as $edition ) : ?>
				<a class="archive-card" href="<?php echo esc_url( $edition['url'] ); ?>" target="_blank" rel="noopener">
					<span class="archive-year"><?php echo esc_html( $edition['year'] ); ?></span>
					<span class="archive-name"><?php echo esc_html( $edition['title'] ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</section>
</div>

<?php
get_footer();
