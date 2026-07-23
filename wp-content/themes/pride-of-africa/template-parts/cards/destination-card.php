<?php
/**
 * Card: Destination
 * File:   template-parts/cards/destination-card.php
 * Spec:   03-Master-UI-Specification-v3.md §8
 *         Card Height: 480px | Image Height: 320px
 *         Content Padding: 24px | Badge Height: 34px
 *         Badge Radius: 999px | Hover Lift: -8px
 * @package PrideOfAfrica
 */

$post_id   = get_the_ID();
$highlight = get_post_meta( $post_id, '_destination_highlight', true );
$img_id    = get_post_thumbnail_id();
$img_url   = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
$img_srcset= $img_id ? wp_get_attachment_image_srcset( $img_id, 'large' ) : '';
$title     = get_the_title();
$maps_url  = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $title );
?>

<article class="c-destination-card" aria-label="<?php echo esc_attr( $title ); ?>">

    <a class="c-destination-card__image-wrap" href="<?php the_permalink(); ?>">
        <?php if ( $img_url ) : ?>
        <img class="c-destination-card__image"
             src="<?php echo esc_url( $img_url ); ?>"
             <?php if ( $img_srcset ) : ?>srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="(max-width:767px) 100vw,(max-width:1199px) 50vw,33vw"<?php endif; ?>
             alt="<?php echo esc_attr( $title ); ?>"
             loading="lazy" decoding="async">
        <?php endif; ?>
        <div class="c-destination-card__scrim" aria-hidden="true"></div>

        <div class="c-destination-card__overlay">
            <h3 class="c-destination-card__title"><?php echo esc_html( $title ); ?></h3>
            <?php if ( $highlight ) : ?>
            <p class="c-destination-card__highlight"><?php echo esc_html( $highlight ); ?></p>
            <?php endif; ?>
            <span class="c-destination-card__cta">
                <?php esc_html_e( 'Explore', 'pride-of-africa' ); ?>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </span>
        </div>
    </a>

    <?php
    $excerpt = get_the_excerpt() ?: wp_trim_words( get_the_content(), 20, '…' );
    if ( $excerpt ) :
    ?>
    <p class="c-destination-card__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 18, '…' ) ); ?></p>
    <?php endif; ?>

    <div class="c-destination-card__actions">
        <a href="<?php the_permalink(); ?>" class="c-button c-button--primary c-destination-card__explore-btn"
           aria-label="<?php echo esc_attr( sprintf( __( 'Explore %s', 'pride-of-africa' ), $title ) ); ?>">
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
            <?php echo esc_html( sprintf( __( 'Explore %s', 'pride-of-africa' ), $title ) ); ?>
        </a>
        <a href="<?php echo esc_url( $maps_url ); ?>" class="c-button c-button--outline-neutral c-destination-card__maps-btn"
           target="_blank" rel="noopener noreferrer"
           aria-label="<?php echo esc_attr( sprintf( __( 'View %s on Maps', 'pride-of-africa' ), $title ) ); ?>">
            <i class="bi bi-geo-alt" aria-hidden="true"></i>
            <?php esc_html_e( 'Maps', 'pride-of-africa' ); ?>
        </a>
    </div>
</article>
