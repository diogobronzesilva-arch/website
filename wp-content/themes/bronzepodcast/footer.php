<?php
/**
 * Rodapé do tema.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="site-footer">
	<div class="content-shell content-shell--wide site-footer__grid">
		<section class="newsletter" aria-labelledby="newsletter-title">
			<p class="eyebrow"><?php esc_html_e( 'Bronze Podcast', 'bronzepodcast' ); ?></p>
			<h2 id="newsletter-title"><?php esc_html_e( 'Receba os novos episódios e artigos.', 'bronzepodcast' ); ?></h2>
			<form class="newsletter__form" action="#" method="post" data-newsletter-form>
				<label for="newsletter-email"><?php esc_html_e( 'Endereço de email', 'bronzepodcast' ); ?></label>
				<div class="newsletter__controls">
					<input id="newsletter-email" type="email" name="email" autocomplete="email" placeholder="<?php esc_attr_e( 'Subscreva a newsletter', 'bronzepodcast' ); ?>" required>
					<button type="submit"><?php esc_html_e( 'Subscrever', 'bronzepodcast' ); ?></button>
				</div>
				<p class="newsletter__note"><?php esc_html_e( 'A ligação ao serviço de newsletter será configurada antes da publicação.', 'bronzepodcast' ); ?></p>
			</form>
		</section>

		<div class="site-footer__contact">
			<a href="mailto:info@bronzepodcast.com">info@bronzepodcast.com</a>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'fallback_cb'    => false,
					'menu_class'     => 'footer-menu',
				)
			);
			?>
		</div>
	</div>
	<div class="content-shell content-shell--wide site-footer__legal">
		<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> Bronze Podcast.</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
