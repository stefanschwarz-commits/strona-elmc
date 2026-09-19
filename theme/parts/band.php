<?php
/**
 * Shared section: band. Used by the full homepage and the teaser page.
 * Expects $t, $lang, $assets and $signup from the including template.
 */
?>
<section class="band">
	<div class="wrap">
		<p class="slogan" lang="en">Barriers down!<br><span>Europe forward!</span></p>
		<p class="band-body"><?php echo esc_html( $t['bandBody'] ); ?></p>
	</div>
</section>
