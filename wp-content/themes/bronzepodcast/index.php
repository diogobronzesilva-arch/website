<?php
/**
 * Template principal e arquivo de artigos.
 *
 * @package BronzePodcast
 */

get_header();
?>
<main id="primary" class="site-main section-pad">
	<div class="content-shell content-shell--wide">
		<header class="archive-header">
			<p class="eyebrow"><?php esc_html_e( 'Bronze Podcast', 'bronzepodcast' ); ?></p>
			<h1><?php single_post_title(); ?></h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'card' );
				endwhile;
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Ainda não existem artigos publicados.', 'bronzepodcast' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
