<?php
/**
 * Shared section: about. Used by the full homepage and the teaser page.
 * Expects $t, $lang, $assets and $signup from the including template.
 */
?>
<section class="section bg-white rule-top" id="o-kongresie">
	<div class="wrap split split-1-1">
		<h2 class="h2"><?php echo esc_html( $t['aboutH1'] ); ?> <span class="hl-orange"><?php echo esc_html( $t['aboutH2'] ); ?></span> <?php echo esc_html( $t['aboutH3'] ); ?></h2>
		<div>
			<p class="body"><?php echo esc_html( $t['aboutBody'] ); ?></p>
			<div class="stats">
				<div class="stat"><span class="stat-n">2013</span><span class="stat-l"><?php echo esc_html( $t['s1'] ); ?></span></div>
				<div class="stat"><span class="stat-n">9</span><span class="stat-l"><?php echo esc_html( $t['s2'] ); ?></span></div>
				<div class="stat"><span class="stat-n">17</span><span class="stat-l"><?php echo esc_html( $t['s3'] ); ?></span></div>
			</div>
		</div>
	</div>
</section>
