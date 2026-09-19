<?php
/**
 * ELMC 2027 homepage - built from the Claude Design handoff "ELMC 2027 Strona.dc.html".
 *
 * Section order and ground colours are locked by the design:
 * orange -> white(facts) -> navy -> white -> grey -> white -> grey -> white -> grey
 * -> orange -> black -> orange -> black -> white -> black.
 *
 * Image slots (4 recap photos, 8 speaker portraits, 7 partner logos) are dashed
 * placeholders until real material arrives - no invented people, no stock photos.
 */

get_header();

$lang      = elmc2027_lang();
$t         = elmc2027_copy( $lang );
$home      = elmc2027_home_url( $lang );
$assets    = get_template_directory_uri() . '/assets/img/';
$signup    = isset( $_GET['elmc2027_signup'] ) ? sanitize_text_field( wp_unslash( $_GET['elmc2027_signup'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$cfs_state = isset( $_GET['elmc2027_cfs'] ) ? sanitize_text_field( wp_unslash( $_GET['elmc2027_cfs'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
?>

<main id="main">

	<?php include locate_template( 'parts/hero.php' ); ?>

	<?php include locate_template( 'parts/facts.php' ); ?>

	<?php include locate_template( 'parts/band.php' ); ?>

	<section class="section bg-white" id="misja">
		<div class="wrap stack">
			<h2 class="kicker"><?php echo esc_html( $t['missionKicker'] ); ?></h2>
			<div class="split split-7-5">
				<p class="lead"><?php echo esc_html( $t['missionLead'] ); ?></p>
				<p class="body"><?php echo esc_html( $t['missionBody'] ); ?></p>
			</div>
			<ol class="pillars">
				<?php foreach ( $t['pillars'] as $i => $pillar ) : ?>
					<li class="pillar">
						<span class="num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<span class="pillar-title"><?php echo esc_html( $pillar['title'] ); ?></span>
						<span class="pillar-desc"><?php echo esc_html( $pillar['desc'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="section bg-grey" id="temat">
		<div class="wrap split split-1-1 split-center">
			<div>
				<p class="kicker kicker--plain"><?php echo esc_html( $t['themeKicker'] ); ?></p>
				<p class="theme-word" lang="en">
					<span>European</span>
					<span class="swap"><s class="strike">Labour</s><span class="swap-new">Service</span></span>
					<span>Mobility</span>
					<span>Congress</span>
				</p>
			</div>
			<div>
				<p class="theme-slogan"><?php echo esc_html( $t['themeSlogan'] ); ?></p>
				<p class="body theme-body"><?php echo esc_html( $t['themeBody'] ); ?></p>
			</div>
		</div>
	</section>

	<?php include locate_template( 'parts/about.php' ); ?>

	<section class="section bg-grey" id="dla-kogo">
		<div class="wrap split split-4-8">
			<div class="sticky">
				<h2 class="h2"><?php echo esc_html( $t['whoH'] ); ?></h2>
				<p class="who-lead"><?php echo esc_html( $t['whoLead'] ); ?></p>
			</div>
			<ol class="rows">
				<?php foreach ( $t['who'] as $i => $who ) : ?>
					<li class="row">
						<span class="num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<span class="row-title"><?php echo esc_html( $who['title'] ); ?></span>
						<span class="row-desc"><?php echo esc_html( $who['desc'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="section bg-white" id="relacja">
		<div class="wrap">
			<div class="head-row">
				<h2 class="h2"><?php echo esc_html( $t['recapH'] ); ?></h2>
				<a class="mono-link" href="https://labourinstitute.eu/ekmp2026/"><?php echo esc_html( $t['recapLink'] ); ?> →</a>
			</div>
			<div class="recap-grid">
				<div class="recap-main"><span class="slot"><?php echo esc_html( $t['recapSlots'][0] ); ?></span></div>
				<span class="slot"><?php echo esc_html( $t['recapSlots'][1] ); ?></span>
				<span class="slot"><?php echo esc_html( $t['recapSlots'][2] ); ?></span>
				<span class="slot"><?php echo esc_html( $t['recapSlots'][3] ); ?></span>
				<div class="recap-stat"><span class="recap-stat-n">17</span><span class="recap-stat-l"><?php echo esc_html( $t['recapStat'] ); ?></span></div>
			</div>
			<p class="recap-body"><?php echo esc_html( $t['recapBody'] ); ?></p>
		</div>
	</section>

	<section class="section bg-grey" id="prelegenci">
		<div class="wrap">
			<div class="head-row head-row--tight">
				<h2 class="h2"><?php echo esc_html( $t['speakersH'] ); ?></h2>
				<span class="note"><?php echo esc_html( $t['speakersNote'] ); ?></span>
			</div>
			<p class="speakers-body"><?php echo esc_html( $t['speakersBody'] ); ?></p>
			<ul class="speaker-grid">
				<?php foreach ( elmc2027_speaker_years() as $year ) : ?>
					<li class="speaker">
						<span class="slot slot--square"><?php echo esc_html( $t['speakerPhoto'] ); ?></span>
						<span>
							<span class="sp-name"><?php echo esc_html( $t['spName'] ); ?></span>
							<span class="sp-role"><?php echo esc_html( $t['spRole'] ); ?></span>
							<span class="sp-year">ELMC <?php echo esc_html( (string) $year ); ?></span>
						</span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="section bg-orange" id="cfs">
		<div class="wrap split split-1-1">
			<div>
				<p class="kicker kicker--ink">Call for Speakers</p>
				<h2 class="h2 cfs-h"><?php echo esc_html( $t['cfsH'] ); ?></h2>
				<p class="cfs-body"><?php echo esc_html( $t['cfsBody'] ); ?></p>
				<ul class="dash-list">
					<?php foreach ( $t['cfsList'] as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<?php if ( 'success' === $cfs_state ) : ?>
				<div class="card card--thanks">
					<p class="thanks-h"><?php echo esc_html( $t['cfsThanksH'] ); ?></p>
					<p class="thanks-b"><?php echo esc_html( $t['cfsThanksB'] ); ?></p>
				</div>
			<?php else : ?>
				<form class="card" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="elmc2027_cfs">
					<input type="hidden" name="lang" value="<?php echo esc_attr( $lang ); ?>">
					<?php wp_nonce_field( 'elmc2027_cfs', 'elmc2027_cfs_nonce' ); ?>
					<label class="field">
						<span class="field-label"><?php echo esc_html( $t['fName'] ); ?></span>
						<input type="text" name="cfs_name" required>
					</label>
					<label class="field">
						<span class="field-label"><?php echo esc_html( $t['fOrgPos'] ); ?></span>
						<input type="text" name="cfs_org" required>
					</label>
					<label class="field">
						<span class="field-label">E-mail</span>
						<input type="email" name="cfs_email" required>
					</label>
					<input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
					<label class="check">
						<input type="checkbox" name="cfs_rodo" value="1" required>
						<span><?php echo esc_html( elmc2027_cfs_consent_text( $lang ) ); ?></span>
					</label>
					<button class="btn-block" type="submit"><?php echo esc_html( $t['cfsSubmit'] ); ?></button>
					<?php if ( in_array( $cfs_state, array( 'fields', 'email', 'consent' ), true ) ) : ?>
						<p class="form-error">
							<?php
							if ( 'fields' === $cfs_state ) {
								echo esc_html( $t['cfsErrFields'] );
							} elseif ( 'email' === $cfs_state ) {
								echo esc_html( $t['cfsErrEmail'] );
							} else {
								echo esc_html( $t['cfsErrRodo'] );
							}
							?>
						</p>
					<?php else : ?>
						<p class="req"><?php echo esc_html( $t['required'] ); ?></p>
					<?php endif; ?>
				</form>
			<?php endif; ?>
		</div>
	</section>

	<section class="section bg-black" id="partnerstwo">
		<div class="wrap split split-5-7 split-wide-gap">
			<div class="sticky stack-22">
				<p class="kicker kicker--orange"><?php echo esc_html( $t['partKicker'] ); ?></p>
				<h2 class="h2-xl"><?php echo esc_html( $t['partH'] ); ?></h2>
				<p class="on-dark"><?php echo esc_html( $t['partBody'] ); ?></p>
				<div class="part-cta">
					<a class="btn btn--orange" href="mailto:<?php echo esc_attr( ELMC2027_CONTACT_EMAIL ); ?>"><?php echo esc_html( $t['partCta'] ); ?></a>
					<span class="part-note"><?php echo esc_html( $t['partNote'] ); ?> · <?php echo esc_html( ELMC2027_CONTACT_EMAIL ); ?></span>
				</div>
			</div>
			<ol class="tiers">
				<?php
				$marks = elmc2027_tier_marks();
				foreach ( $t['tiers'] as $i => $tier ) :
					$mark = $marks[ $i ];
					?>
					<li class="tier" style="--mark:<?php echo esc_attr( $mark['dot'] ); ?>;--mark-color:<?php echo esc_attr( $mark['color'] ); ?>;--mark-radius:<?php echo esc_attr( $mark['radius'] ); ?>;--tier-size:<?php echo esc_attr( $mark['size'] ); ?>">
						<span class="tier-mark" aria-hidden="true"></span>
						<span class="tier-head">
							<span class="tier-name"><?php echo esc_html( $tier['name'] ); ?></span>
							<span class="tier-tag"><?php echo esc_html( $tier['tag'] ); ?></span>
						</span>
						<span class="tier-desc"><?php echo esc_html( $tier['desc'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="section bg-orange" id="organizator">
		<div class="wrap split split-5-7">
			<div class="stack-28">
				<p class="kicker kicker--ink"><?php echo esc_html( $t['orgLabel'] ); ?></p>
				<img class="org-logo" src="<?php echo esc_url( $assets . 'logo-elmi.jpg' ); ?>" alt="<?php echo esc_attr( $t['elmi'] ); ?>" width="301" height="295">
				<a class="mono-link mono-link--ink" href="https://labourinstitute.eu">labourinstitute.eu →</a>
			</div>
			<div class="stack-24">
				<h2 class="h2-xl h2-xl--ink"><?php echo esc_html( $t['orgH'] ); ?></h2>
				<p class="org-body"><?php echo esc_html( $t['orgBody'] ); ?></p>
			</div>
		</div>
	</section>

	<section class="section bg-black" id="partnerzy">
		<div class="wrap">
			<div class="head-row head-row--partners">
				<h2 class="h2 on-dark-h"><?php echo esc_html( $t['partnersH'] ); ?></h2>
				<span class="note note--dark"><?php echo esc_html( $t['partnersNote'] ); ?></span>
			</div>
			<div class="logo-grid">
				<a class="logo-card" href="https://polishcare.eu">
					<img src="<?php echo esc_url( $assets . 'logo-psod.jpg' ); ?>" alt="<?php echo esc_attr( $t['psod'] ); ?>" width="1599" height="648">
				</a>
				<?php for ( $i = 0; $i < 7; $i++ ) : ?>
					<span class="logo-card logo-card--empty"><span class="slot slot--logo"><?php echo esc_html( $t['logoPh'] ); ?></span></span>
				<?php endfor; ?>
			</div>
		</div>
	</section>

	<?php include locate_template( 'parts/editions.php' ); ?>

</main>

<?php
get_footer();
