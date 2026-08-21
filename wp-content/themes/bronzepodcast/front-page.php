<?php
/**
 * Página inicial.
 *
 * @package BronzePodcast
 */

get_header();
?>
<main id="primary" class="site-main home-main">
	<section class="hero">
		<div class="hero__overlay"></div>
		<div class="content-shell content-shell--wide hero__content">
			<p class="eyebrow"><?php esc_html_e( 'Desde 2020', 'bronzepodcast' ); ?></p>
			<h1><?php esc_html_e( 'Um Podcast Católico', 'bronzepodcast' ); ?></h1>
			<p class="hero__intro"><?php esc_html_e( 'Fé, tradição e cultura portuguesa num tempo que pede clareza e coragem.', 'bronzepodcast' ); ?></p>
			<a class="button button--light" href="<?php echo esc_url( home_url( '/podcast/' ) ); ?>"><?php esc_html_e( 'Ouvir o podcast', 'bronzepodcast' ); ?></a>
		</div>
	</section>

	<section class="episodes section-pad" aria-labelledby="episodes-title">
		<div class="content-shell content-shell--wide">
			<div class="section-heading">
				<p class="eyebrow"><?php esc_html_e( 'YouTube', 'bronzepodcast' ); ?></p>
				<h2 id="episodes-title"><?php esc_html_e( 'Últimos episódios', 'bronzepodcast' ); ?></h2>
			</div>
			<div class="episode-grid">
				<article class="episode-card">
					<div class="video-frame">
						<iframe src="https://www.youtube-nocookie.com/embed/xsM6DrjWxM4" title="<?php esc_attr_e( 'Episódio recente do Bronze Podcast', 'bronzepodcast' ); ?>" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
				</article>
				<article class="episode-card">
					<div class="video-frame">
						<iframe src="https://www.youtube-nocookie.com/embed/YaPC_g224TQ" title="<?php esc_attr_e( 'Episódio recente do Bronze Podcast', 'bronzepodcast' ); ?>" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
				</article>
			</div>
		</div>
	</section>

	<section class="store-feature section-pad" aria-labelledby="store-title">
		<div class="content-shell content-shell--wide">
			<div class="section-heading section-heading--split">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Loja online', 'bronzepodcast' ); ?></p>
					<h2 id="store-title"><?php esc_html_e( 'Alguns artigos da loja', 'bronzepodcast' ); ?></h2>
				</div>
				<a class="text-link" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/loja/' ) ); ?>"><?php esc_html_e( 'Ver todos os artigos', 'bronzepodcast' ); ?> →</a>
			</div>

			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<?php echo do_shortcode( '[products limit="6" columns="3" orderby="date" order="DESC" visibility="visible"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php else : ?>
				<div class="setup-notice">
					<p><?php esc_html_e( 'Os produtos aparecerão aqui depois de instalar o WooCommerce e importar o catálogo.', 'bronzepodcast' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="manifesto section-pad">
		<div class="content-shell manifesto__inner">
			<p class="eyebrow"><?php esc_html_e( 'AMDG', 'bronzepodcast' ); ?></p>
			<h2><?php esc_html_e( 'Só Cristo pode acalmar a tormenta, na Igreja e no mundo.', 'bronzepodcast' ); ?></h2>
			<a class="button button--outline" href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Conhecer o projeto', 'bronzepodcast' ); ?></a>
		</div>
	</section>
</main>
<?php
get_footer();

