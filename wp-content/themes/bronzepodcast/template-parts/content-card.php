<?php
/**
 * Cartão de artigo.
 *
 * @package BronzePodcast
 */
?>
<article <?php post_class( 'post-card' ); ?>>
	<a class="post-card__image" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large' ); ?>
		<?php else : ?>
			<span class="post-card__placeholder"></span>
		<?php endif; ?>
	</a>
	<div class="post-card__content">
		<p class="eyebrow"><?php echo esc_html( get_the_date() ); ?></p>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>
		<a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Ler artigo', 'bronzepodcast' ); ?> →</a>
	</div>
</article>
