<?php
/**
 * Teaser: the short version of the homepage for elmc.eu until the full site launches.
 *
 * Same sections, copy and design as the full page, limited to what is already true
 * and complete: hero with the signup, key facts, slogan, about the congress and the
 * past editions. Nothing here waits for photos, speakers or partner logos.
 */

get_header();

$lang   = elmc2027_lang();
$t      = elmc2027_copy( $lang );
$assets = get_template_directory_uri() . '/assets/img/';
$signup = isset( $_GET['elmc2027_signup'] ) ? sanitize_text_field( wp_unslash( $_GET['elmc2027_signup'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
?>

<main id="main">

	<?php include locate_template( 'parts/hero.php' ); ?>

	<?php include locate_template( 'parts/facts.php' ); ?>

	<?php include locate_template( 'parts/band.php' ); ?>

	<?php include locate_template( 'parts/about.php' ); ?>

	<?php include locate_template( 'parts/editions.php' ); ?>

</main>

<?php
get_footer();
