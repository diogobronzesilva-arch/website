<?php
/**
 * Cabeçalho do tema.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#primary"><?php esc_html_e( 'Saltar para o conteúdo', 'bronzepodcast' ); ?></a>
<header class="site-header" data-site-header>
	<div class="site-header__inner content-shell content-shell--wide">
		<div class="site-brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php esc_attr_e( 'Bronze Podcast — página inicial', 'bronzepodcast' ); ?>">
				<img src="https://assets.zyrosite.com/cdn-cgi/image/format=auto,w=375,fit=crop/meP1JK36yjC3XzJk/black-and-white-vintage-studio-apparel-label-brand-logo-2-mjEQGKvDj4sVwQ8X.png" alt="<?php esc_attr_e( 'Bronze Podcast', 'bronzepodcast' ); ?>">
				</a>
			<?php endif; ?>
		</div>

		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-navigation" data-menu-toggle>
			<span class="menu-toggle__line"></span>
			<span class="menu-toggle__line"></span>
			<span class="menu-toggle__line"></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Abrir menu', 'bronzepodcast' ); ?></span>
		</button>

		<nav id="site-navigation" class="site-navigation" aria-label="<?php esc_attr_e( 'Navegação principal', 'bronzepodcast' ); ?>" data-site-navigation>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'site-menu',
					'container'      => false,
					'fallback_cb'    => 'bronzepodcast_menu_fallback',
				)
			);
			?>
		</nav>

		<div class="site-actions">
			<a href="https://x.com/bronzpodcast" target="_blank" rel="noopener noreferrer" aria-label="X / Twitter">X</a>
			<a href="https://www.youtube.com/@bronzepodcast/" target="_blank" rel="noopener noreferrer" aria-label="YouTube">YT</a>
			<?php bronzepodcast_cart_link(); ?>
		</div>
	</div>
</header>
