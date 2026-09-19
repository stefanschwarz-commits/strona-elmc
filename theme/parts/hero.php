<?php
/**
 * Shared section: hero. Used by the full homepage and the teaser page.
 * Expects $t, $lang, $assets and $signup from the including template.
 */
?>
<section class="hero">
	<div class="hero-copy">
		<p class="kicker kicker--ink"><?php echo esc_html( $t['heroKicker'] ); ?></p>
		<h1 class="hero-title"><?php echo esc_html( $t['heroTitle'] ); ?> <span class="hl-ink">2027</span></h1>
		<p class="hero-lead"><?php echo esc_html( $t['heroLead'] ); ?></p>

		<div class="signup" id="zapisz">
			<?php if ( in_array( $signup, array( 'success', 'check', 'unsubscribed' ), true ) ) : ?>
				<p class="notice">
					<?php
					if ( 'success' === $signup ) {
						echo esc_html( $t['stSuccess'] );
					} elseif ( 'check' === $signup ) {
						echo esc_html( $t['stCheck'] );
					} else {
						echo esc_html( $t['stUnsub'] );
					}
					?>
				</p>
			<?php else : ?>
				<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="elmc2027_signup">
					<input type="hidden" name="lang" value="<?php echo esc_attr( $lang ); ?>">
			<?php if ( elmc2027_is_teaser() ) : ?>
				<input type="hidden" name="view" value="teaser">
			<?php endif; ?>
					<?php wp_nonce_field( 'elmc2027_signup', 'elmc2027_signup_nonce' ); ?>
					<div class="capsule">
						<label class="sr-only" for="elmc-email"><?php echo esc_html( $t['emailPh'] ); ?></label>
						<input type="email" id="elmc-email" name="email" placeholder="<?php echo esc_attr( $t['emailPh'] ); ?>" required>
						<button type="submit"><?php echo esc_html( $t['notify'] ); ?></button>
					</div>
					<input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
					<label class="consent">
						<input type="checkbox" name="consent" value="1" required>
						<span><?php echo esc_html( elmc2027_consent_text( $lang ) ); ?>
							<a href="<?php echo esc_url( elmc2027_privacy_url() ); ?>"><?php echo esc_html( $t['privacyLink'] ); ?></a></span>
					</label>
				</form>
				<p class="fine">
					<?php
					if ( 'error' === $signup ) {
						echo esc_html( $t['stError'] );
					} elseif ( 'consent' === $signup ) {
						echo esc_html( $t['stConsent'] );
					} elseif ( 'invalid' === $signup ) {
						echo esc_html( $t['stInvalid'] );
					} else {
						echo esc_html( $t['noSpam'] );
					}
					?>
				</p>
			<?php endif; ?>
		</div>
	</div>
	<div class="hero-art">
		<img src="<?php echo esc_url( $assets . 'kv-elmc.jpg' ); ?>" alt="<?php echo esc_attr( $t['heroAlt'] ); ?>" width="1800" height="1354">
	</div>
</section>
