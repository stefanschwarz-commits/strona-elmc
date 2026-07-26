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
			<?php if ( 'success' === $elmc2027_signup_status ) : ?>
				<p class="form-note"><strong><?php esc_html_e( 'Thanks — we\'ll be in touch.', 'elmc2027' ); ?></strong></p>
			<?php else : ?>
				<form class="signup-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="elmc2027_signup">
					<?php wp_nonce_field( 'elmc2027_signup', 'elmc2027_signup_nonce' ); ?>
					<input type="email" name="email" placeholder="you@organisation.eu" required>
					<button class="btn" type="submit"><?php esc_html_e( 'Notify me', 'elmc2027' ); ?></button>
				</form>
				<?php if ( 'error' === $elmc2027_signup_status ) : ?>
					<div class="form-note"><?php esc_html_e( 'Please enter a valid email address.', 'elmc2027' ); ?></div>
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
</div>

<?php
get_footer();
