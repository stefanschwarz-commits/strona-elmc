<?php
/**
 * Shared section: facts. Used by the full homepage and the teaser page.
 * Expects $t, $lang, $assets and $signup from the including template.
 */
?>
<div class="facts">
	<div class="fact"><span class="fact-label"><?php echo esc_html( $t['fEdition'] ); ?></span><span class="fact-value"><?php echo esc_html( $t['fEditionV'] ); ?></span></div>
	<div class="fact"><span class="fact-label"><?php echo esc_html( $t['fDates'] ); ?></span><span class="fact-value"><?php echo esc_html( $t['tba'] ); ?></span></div>
	<div class="fact"><span class="fact-label"><?php echo esc_html( $t['fPlace'] ); ?></span><span class="fact-value"><?php echo esc_html( $t['fPlaceV'] ); ?></span></div>
	<div class="fact"><span class="fact-label"><?php echo esc_html( $t['fOrg'] ); ?></span><span class="fact-value"><?php echo esc_html( $t['elmi'] ); ?></span></div>
</div>
