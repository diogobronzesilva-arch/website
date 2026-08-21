<?php
/**
 * Página não encontrada.
 *
 * @package BronzePodcast
 */

get_header();
?>
<main id="primary" class="site-main error-page section-pad">
	<div class="content-shell content-shell--article">
		<p class="eyebrow">404</p>
		<h1><?php esc_html_e( 'Esta página não foi encontrada.', 'bronzepodcast' ); ?></h1>
		<p><?php esc_html_e( 'Pode ter sido movida ou o endereço pode estar incorreto.', 'bronzepodcast' ); ?></p>
		<a class="button button--light" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Voltar ao início', 'bronzepodcast' ); ?></a>
	</div>
</main>
<?php
get_footer();
