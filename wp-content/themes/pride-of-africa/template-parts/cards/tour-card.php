<?php
/**
 * Card: Tour
 * File:   template-parts/cards/tour-card.php
 * Spec:   03-Master-UI-Specification-v3.md §9
 *         Card Width: 392px | Image: 340px
 *         Price Badge: Top Right | Duration Badge: Top Left | CTA: 48px
 * @package PrideOfAfrica
 */

$post_id  = get_the_ID();
$price    = get_post_meta( $post_id, '_tour_price',    true );
$duration = get_post_meta( $post_id, '_tour_duration', true );
$country  = get_post_meta( $post_id, '_tour_country',  true );
$rating   = (float) get_post_meta( $post_id, '_tour_rating', true );
$reviews  = (int) get_post_meta( $post_id, '_tour_review_count', true );
$img_id   = get_post_thumbnail_id();
$img_url  = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
$img_srcset = $img_id ? wp_get_attachment_image_srcset( $img_id, 'large' ) : '';
?>

<article class="c-tour-card" aria-label="<?php echo esc_attr( get_the_title() ); ?>">

    <div class="c-tour-card__image-wrap">
        <?php if ( $img_url ) : ?>
        <img class="c-tour-card__image"
             src="<?php echo esc_url( $img_url ); ?>"
             <?php if ( $img_srcset ) : ?>srcset="<?php echo esc_attr( $img_srcset ); ?>" sizes="(max-width:767px) 100vw,(max-width:1199px) 50vw,33vw"<?php endif; ?>
             alt="<?php echo esc_attr( get_the_title() ); ?>"
             loading="lazy" decoding="async">
        <?php endif; ?>

        <?php if ( $duration ) : ?>
        <span class="c-badge c-badge--pill c-badge--dark c-tour-card__duration">
            <i class="bi bi-clock" aria-hidden="true"></i>
            <?php echo esc_html( $duration ); ?>
        </span>
        <?php endif; ?>

        <?php if ( $price ) : ?>
        <span class="c-badge c-badge--accent c-tour-card__price">
            <?php esc_html_e( 'From', 'pride-of-africa' ); ?> <?php echo esc_html( $price ); ?>
        </span>
        <?php endif; ?>
    </div>

    <div class="c-tour-card__body">
        <?php if ( $country ) : ?>
        <span class="c-badge c-badge--country">
            <i class="bi bi-geo-alt" aria-hidden="true"></i>
            <?php echo esc_html( $country ); ?>
        </span>
        <?php endif; ?>

        <h3 class="c-tour-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p class="c-tour-card__excerpt">
            <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '…' ) ); ?>
        </p>

        <?php if ( $rating > 0 ) : ?>
        <div class="c-tour-card__rating" aria-label="<?php echo esc_attr( sprintf( __( 'Rated %s out of 5', 'pride-of-africa' ), $rating ) ); ?>">
            <?php for ( $s = 1; $s <= 5; $s++ ) : ?>
            <i class="bi <?php echo $s <= round( $rating ) ? 'bi-star-fill' : 'bi-star'; ?>" aria-hidden="true"></i>
            <?php endfor; ?>
            <?php if ( $reviews ) : ?>
            <span class="c-tour-card__review-count">(<?php echo esc_html( $reviews ); ?>)</span>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <a href="<?php the_permalink(); ?>" class="c-button c-button--primary c-tour-card__cta"
           aria-label="<?php echo esc_attr( sprintf( __( 'View %s tour details', 'pride-of-africa' ), get_the_title() ) ); ?>">
            <?php esc_html_e( 'View Tour', 'pride-of-africa' ); ?>
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </a>
    </div>

</article>
