<?php
/**
 * Fallback template (blog index, search results, archives, ...).
 */
get_header();
?>

<div class="page">
	<div class="page-content">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<?php the_excerpt(); ?>
				</article>
				<?php
			endwhile;
			?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found.', 'elmc2027' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
