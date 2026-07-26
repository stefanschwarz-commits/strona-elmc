<?php
/**
 * Header template.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="page">
	<header class="site-header">
		<a class="wordmark" href="<?php echo esc_url( home_url( '/' ) ); ?>">ELMC<span>.</span> — European Labour Mobility Congress</a>
		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'elmc2027' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => false,
			) );
			?>
		</nav>
	</header>
</div>
