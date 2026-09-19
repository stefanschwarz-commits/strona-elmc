<?php
/**
 * Shared section: editions. Used by the full homepage and the teaser page.
 * Expects $t, $lang, $assets and $signup from the including template.
 */
?>
<section class="editions" id="edycje">
	<span class="editions-label"><?php echo esc_html( $t['editionsH'] ); ?></span>
	<ul class="pills">
		<?php foreach ( elmc2027_editions( $lang ) as $edition ) : ?>
			<li>
				<a class="pill" href="<?php echo esc_url( $edition['href'] ); ?>" title="<?php echo esc_attr( $edition['label'] ); ?>">
					<span class="pill-roman"><?php echo esc_html( $edition['roman'] ); ?></span><?php echo esc_html( $edition['year'] ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
