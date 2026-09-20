<?php
/**
 * Sticky header: logo, section links, language switch and the signup button.
 */

$elmc_lang   = elmc2027_lang();
$elmc_home   = elmc2027_home_url( $elmc_lang );
$elmc_page   = elmc2027_page_url( $elmc_lang );
$elmc_t      = elmc2027_copy( $elmc_lang );
$elmc_teaser = elmc2027_is_teaser();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class( 'lang-' . $elmc_lang ); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php echo esc_html( $elmc_t['skipToMain'] ); ?></a>

<header class="site-header">
	<a class="brand" href="<?php echo esc_url( $elmc_page ); ?>">
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-elmc.svg' ); ?>" alt="European Labour Mobility Congress" width="412" height="415">
		<span class="brand-year">2027</span>
	</a>

	<?php if ( $elmc_teaser ) : ?>
	<span class="site-nav" aria-hidden="true"></span>
	<?php else : ?>
	<nav class="site-nav" aria-label="<?php echo esc_attr( $elmc_t['navAbout'] ); ?>">
		<a href="<?php echo esc_url( $elmc_home . '#misja' ); ?>"><?php echo esc_html( $elmc_t['navMission'] ); ?></a>
		<a href="<?php echo esc_url( $elmc_home . '#o-kongresie' ); ?>"><?php echo esc_html( $elmc_t['navAbout'] ); ?></a>
		<a href="<?php echo esc_url( $elmc_home . '#relacja' ); ?>"><?php echo esc_html( $elmc_t['navRecap'] ); ?></a>
		<a href="<?php echo esc_url( $elmc_home . '#prelegenci' ); ?>"><?php echo esc_html( $elmc_t['navSpeakers'] ); ?></a>
		<a href="<?php echo esc_url( $elmc_home . '#cfs' ); ?>">Call for Speakers</a>
		<a href="<?php echo esc_url( $elmc_home . '#partnerstwo' ); ?>"><?php echo esc_html( $elmc_t['navPartners'] ); ?></a>
	</nav>

	<?php /* Below 1100px the row of links does not fit; the same links open from here. */ ?>
	<details class="menu">
		<summary><?php echo esc_html( $elmc_t['menu'] ); ?></summary>
		<nav class="menu-panel" aria-label="<?php echo esc_attr( $elmc_t['menu'] ); ?>">
			<a href="<?php echo esc_url( $elmc_home . '#misja' ); ?>"><?php echo esc_html( $elmc_t['navMission'] ); ?></a>
			<a href="<?php echo esc_url( $elmc_home . '#o-kongresie' ); ?>"><?php echo esc_html( $elmc_t['navAbout'] ); ?></a>
			<a href="<?php echo esc_url( $elmc_home . '#relacja' ); ?>"><?php echo esc_html( $elmc_t['navRecap'] ); ?></a>
			<a href="<?php echo esc_url( $elmc_home . '#prelegenci' ); ?>"><?php echo esc_html( $elmc_t['navSpeakers'] ); ?></a>
			<a href="<?php echo esc_url( $elmc_home . '#cfs' ); ?>">Call for Speakers</a>
			<a href="<?php echo esc_url( $elmc_home . '#partnerstwo' ); ?>"><?php echo esc_html( $elmc_t['navPartners'] ); ?></a>
		</nav>
	</details>
	<?php endif; ?>

	<div class="lang">
		<a href="<?php echo esc_url( elmc2027_page_url( 'pl' ) ); ?>"<?php echo 'pl' === $elmc_lang ? ' class="is-current" aria-current="true"' : ''; ?> lang="pl">PL</a>
		<span aria-hidden="true">/</span>
		<a href="<?php echo esc_url( elmc2027_page_url( 'en' ) ); ?>"<?php echo 'en' === $elmc_lang ? ' class="is-current" aria-current="true"' : ''; ?> lang="en">EN</a>
	</div>

	<a class="btn header-cta" href="<?php echo esc_url( $elmc_page . '#zapisz' ); ?>"><?php echo esc_html( $elmc_t['notify'] ); ?></a>
</header>
