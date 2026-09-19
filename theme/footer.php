<?php
/**
 * Footer: logo, organiser line and two link columns.
 */

$elmc_lang = elmc2027_lang();
$elmc_t    = elmc2027_copy( $elmc_lang );
$elmc_home = elmc2027_home_url( $elmc_lang );
?>
<footer class="site-footer" id="kontakt">
	<div class="footer-brand">
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-elmc.png' ); ?>" alt="European Labour Mobility Congress" width="412" height="415">
		<p>European Labour Mobility Congress<br><?php echo esc_html( $elmc_t['orgLabel'] ); ?>: <?php echo esc_html( $elmc_t['elmi'] ); ?></p>
	</div>
	<div class="footer-cols">
		<?php if ( ! elmc2027_is_teaser() ) : ?>
		<div>
			<a href="<?php echo esc_url( $elmc_home . '#o-kongresie' ); ?>"><?php echo esc_html( $elmc_t['navAbout'] ); ?></a>
			<a href="<?php echo esc_url( $elmc_home . '#relacja' ); ?>"><?php echo esc_html( $elmc_t['navRecap'] ); ?></a>
			<a href="<?php echo esc_url( $elmc_home . '#cfs' ); ?>">Call for Speakers</a>
			<a href="<?php echo esc_url( $elmc_home . '#partnerstwo' ); ?>"><?php echo esc_html( $elmc_t['navPartners'] ); ?></a>
		</div>
		<?php endif; ?>
		<div>
			<a href="<?php echo esc_url( elmc2027_page_url( $elmc_lang ) . '#edycje' ); ?>"><?php echo esc_html( $elmc_t['editionsH'] ); ?></a>
			<a class="accent" href="https://labourinstitute.eu">labourinstitute.eu</a>
			<a class="accent" href="mailto:<?php echo esc_attr( ELMC2027_CONTACT_EMAIL ); ?>"><?php echo esc_html( ELMC2027_CONTACT_EMAIL ); ?></a>
			<a href="<?php echo esc_url( elmc2027_privacy_url() ); ?>"><?php echo esc_html( $elmc_t['privacyLink'] ); ?></a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
