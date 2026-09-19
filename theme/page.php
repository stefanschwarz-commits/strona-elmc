<?php
/**
 * Single page (e.g. the privacy notice) - plain text column in the design system.
 */
get_header();
?>

<main id="main" class="section bg-white">
	<div class="wrap prose">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<h1 class="h2"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<?php
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
