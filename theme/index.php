<?php
/**
 * Fallback template (search, archives, anything without its own template).
 */
get_header();
?>

<main id="main" class="section bg-white">
	<div class="wrap prose">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<h2 class="h2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
				<?php
			endwhile;
			?>
		<?php else : ?>
			<p><?php echo esc_html( 'en' === elmc2027_lang() ? 'Nothing found.' : 'Nic nie znaleziono.' ); ?></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
