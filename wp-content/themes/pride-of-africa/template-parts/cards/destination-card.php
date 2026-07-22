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
$tours     = (int) get_post_meta( $post_id, '_destination_tour_count', true );
$highlight = get_post_meta( $post_id, '_destination_highlight', true );
$img_id    = get_post_thumbnail_id();
$img_url   = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
$img_srcset= $img_id ? wp_get_attachment_image_srcset( $img_id, 'large' ) : '';
?>

<article class="c-destination-card" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
    <a class="c-destination-card__link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"></a>

    <div class="c-destination-card__image-wrap">
        <?php if ( $img_url ) : ?>
        <img class="c-destination-card__image"
             src="<?php echo esc_url( $img_url ); ?>"
             <?php if ( $img_srcset ) : ?>srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="(max-width:767px) 100vw,(max-width:1199px) 50vw,33vw"<?php endif; ?>
             alt="<?php echo esc_attr( get_the_title() ); ?>"
             loading="lazy" decoding="async">
        <?php endif; ?>
        <?php if ( $tours > 0 ) : ?>
        <span class="c-badge c-badge--pill c-badge--overlay">
            <?php echo esc_html( sprintf( _n( '%d Tour', '%d Tours', $tours, 'pride-of-africa' ), $tours ) ); ?>
        </span>
        <?php endif; ?>
    </div>

    <div class="c-destination-card__body">
        <h3 class="c-destination-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <?php if ( $highlight ) : ?>
        <p class="c-destination-card__highlight"><?php echo esc_html( $highlight ); ?></p>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>" class="c-destination-card__cta" aria-label="<?php echo esc_attr( sprintf( __( 'Explore %s', 'pride-of-africa' ), get_the_title() ) ); ?>">
            <?php esc_html_e( 'Explore', 'pride-of-africa' ); ?>
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </a>
    </div>
</article>
