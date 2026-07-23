<?php
/**
 * Card: Tour (Popular Tours section)
 * File:   template-parts/cards/tour-card.php
 *
 * Image + price badge on the left, title/description/highlights/meta/CTA
 * on the right. data-tour-categories carries every Tour Category slug
 * assigned to this post so the homepage filter JS can match on it
 * without any per-category markup changes as new categories are added.
 *
 * @package PrideOfAfrica
 */

$post_id    = get_the_ID();
$price      = get_post_meta( $post_id, '_tour_price',      true );
$duration   = get_post_meta( $post_id, '_tour_duration',   true );
$location   = get_post_meta( $post_id, '_tour_location',   true );
$highlights = array_filter( [
    get_post_meta( $post_id, '_tour_highlight_1', true ),
    get_post_meta( $post_id, '_tour_highlight_2', true ),
    get_post_meta( $post_id, '_tour_highlight_3', true ),
] );
$cta_text = get_post_meta( $post_id, '_tour_cta_text', true ) ?: __( 'Get a Quote', 'pride-of-africa' );
$cta_url  = get_post_meta( $post_id, '_tour_cta_url',  true ) ?: get_permalink();

$img_id     = get_post_thumbnail_id();
$img_url    = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
$img_srcset = $img_id ? wp_get_attachment_image_srcset( $img_id, 'large' ) : '';

$category_terms = get_the_terms( $post_id, 'pride_tour_category' );
$category_slugs = [];
if ( $category_terms && ! is_wp_error( $category_terms ) ) {
    foreach ( $category_terms as $term ) {
        $category_slugs[] = $term->slug;
    }
}
?>

<article class="c-tour-card" data-tour-categories="<?php echo esc_attr( implode( ' ', $category_slugs ) ); ?>">

    <div class="c-tour-card__image-wrap">
        <?php if ( $img_url ) : ?>
        <img class="c-tour-card__image"
             src="<?php echo esc_url( $img_url ); ?>"
             <?php if ( $img_srcset ) : ?>srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="(max-width:767px) 100vw,(max-width:1199px) 45vw,300px"<?php endif; ?>
             alt="<?php echo esc_attr( get_the_title() ); ?>"
             loading="lazy" decoding="async">
        <?php endif; ?>

        <?php if ( $price ) : ?>
        <span class="c-tour-card__price"><?php echo esc_html( $price ); ?></span>
        <?php endif; ?>
    </div>

    <div class="c-tour-card__body">
        <h3 class="c-tour-card__title"><?php the_title(); ?></h3>

        <p class="c-tour-card__desc">
            <?php echo esc_html( get_the_excerpt() ?: wp_trim_words( get_the_content(), 24, '…' ) ); ?>
        </p>

        <?php if ( $highlights ) : ?>
        <div class="c-tour-card__highlights">
            <?php foreach ( $highlights as $highlight ) : ?>
            <span class="c-tour-card__highlight">
                <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                <?php echo esc_html( $highlight ); ?>
            </span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="c-tour-card__meta">
            <?php if ( $duration ) : ?>
            <span class="c-tour-card__meta-item"><i class="bi bi-clock" aria-hidden="true"></i> <?php echo esc_html( $duration ); ?></span>
            <?php endif; ?>
            <?php if ( $location ) : ?>
            <span class="c-tour-card__meta-item"><i class="bi bi-geo-alt" aria-hidden="true"></i> <?php echo esc_html( $location ); ?></span>
            <?php endif; ?>
        </div>

        <a href="<?php echo esc_url( $cta_url ); ?>" class="c-tour-card__cta">
            <?php echo esc_html( $cta_text ); ?>
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </a>
    </div>

</article>
