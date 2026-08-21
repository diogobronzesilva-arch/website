<?php
/**
 * Funções e configuração do tema Bronze Podcast.
 *
 * @package BronzePodcast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRONZEPODCAST_VERSION', '0.1.0' );

function bronzepodcast_setup() {
	load_theme_textdomain( 'bronzepodcast', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 160,
			'width'       => 160,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 560,
			'single_image_width'    => 860,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'max_rows'        => 8,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Menu principal', 'bronzepodcast' ),
			'footer'  => __( 'Menu do rodapé', 'bronzepodcast' ),
		)
	);
}
add_action( 'after_setup_theme', 'bronzepodcast_setup' );

function bronzepodcast_assets() {
	wp_enqueue_style(
		'bronzepodcast-fonts',
		'https://fonts.googleapis.com/css2?family=Junge&family=Montserrat:wght@400;500;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'bronzepodcast-main',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		BRONZEPODCAST_VERSION
	);
	wp_enqueue_script(
		'bronzepodcast-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		BRONZEPODCAST_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'bronzepodcast_assets' );

function bronzepodcast_excerpt_length() {
	return 26;
}
add_filter( 'excerpt_length', 'bronzepodcast_excerpt_length' );

function bronzepodcast_menu_fallback() {
	$links = array(
		__( 'Sobre', 'bronzepodcast' )    => home_url( '/sobre/' ),
		__( 'Podcast', 'bronzepodcast' )  => home_url( '/podcast/' ),
		__( 'Blog', 'bronzepodcast' )     => home_url( '/blog/' ),
		__( 'Oração', 'bronzepodcast' )   => 'https://tesourofieis.com',
		__( 'Loja', 'bronzepodcast' )     => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/loja/' ),
		__( 'Contacto', 'bronzepodcast' ) => home_url( '/contacto/' ),
	);

	echo '<ul class="site-menu">';
	foreach ( $links as $label => $url ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( $url ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

function bronzepodcast_cart_count() {
	if ( function_exists( 'WC' ) && WC()->cart ) {
		return WC()->cart->get_cart_contents_count();
	}

	return 0;
}

function bronzepodcast_cart_link() {
	if ( ! function_exists( 'wc_get_cart_url' ) ) {
		return;
	}
	?>
	<a class="site-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'Ver carrinho', 'bronzepodcast' ); ?>">
		<span aria-hidden="true">◌</span>
		<span class="site-cart__count"><?php echo esc_html( bronzepodcast_cart_count() ); ?></span>
	</a>
	<?php
}

function bronzepodcast_cart_fragments( $fragments ) {
	ob_start();
	?>
	<span class="site-cart__count"><?php echo esc_html( bronzepodcast_cart_count() ); ?></span>
	<?php
	$fragments['.site-cart__count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'bronzepodcast_cart_fragments' );

function bronzepodcast_woocommerce_wrappers() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	add_action( 'woocommerce_before_main_content', 'bronzepodcast_wrapper_start', 10 );
	add_action( 'woocommerce_after_main_content', 'bronzepodcast_wrapper_end', 10 );
}
add_action( 'after_setup_theme', 'bronzepodcast_woocommerce_wrappers' );

function bronzepodcast_wrapper_start() {
	echo '<main id="primary" class="site-main shop-main"><div class="content-shell content-shell--wide">';
}

function bronzepodcast_wrapper_end() {
	echo '</div></main>';
}
