<?php
/**
 * Card: Testimonial
 * File:   template-parts/cards/testimonial-card.php
 * Spec:   03-Master-UI-Specification-v3.md §13
 *         Card Width: 420px | Card Height: 360px
 *         Padding: 36px | Avatar: 70px | Quote Margin: 24px
 * @package PrideOfAfrica
 */

$post_id    = get_the_ID();
$index      = isset( $args['index'] ) ? (int) $args['index'] : 0;
$total      = isset( $args['total'] ) ? (int) $args['total'] : 1;
$rating     = (int) get_post_meta( $post_id, '_testimonial_rating',  true ) ?: 5;
$location   = get_post_meta( $post_id, '_testimonial_location', true );
$tour       = get_post_meta( $post_id, '_testimonial_tour',     true );
$avatar_id  = get_post_thumbnail_id();
$avatar_url = $avatar_id ? wp_get_attachment_image_url( $avatar_id, 'thumbnail' ) : '';
$is_active  = $index === 0;
?>

<article
    class="c-testimonial-card<?php echo $is_active ? ' c-testimonial-card--active' : ''; ?>"
    aria-hidden="<?php echo $is_active ? 'false' : 'true'; ?>"
    aria-label="<?php echo esc_attr( sprintf( __( 'Testimonial %1$d of %2$d from %3$s', 'pride-of-africa' ), $index + 1, $total, get_the_title() ) ); ?>"
>
    <div class="c-testimonial-card__rating" aria-label="<?php echo esc_attr( sprintf( __( '%d out of 5 stars', 'pride-of-africa' ), $rating ) ); ?>">
        <?php for ( $s = 1; $s <= 5; $s++ ) : ?>
        <i class="bi <?php echo $s <= $rating ? 'bi-star-fill' : 'bi-star'; ?>" aria-hidden="true"></i>
        <?php endfor; ?>
    </div>

    <blockquote class="c-testimonial-card__quote">
        <p><?php echo esc_html( wp_trim_words( get_the_content(), 40, '…' ) ); ?></p>
    </blockquote>

    <footer class="c-testimonial-card__footer">
        <?php if ( $avatar_url ) : ?>
        <img class="c-testimonial-card__avatar"
             src="<?php echo esc_url( $avatar_url ); ?>"
             alt="<?php echo esc_attr( get_the_title() ); ?>"
             width="70" height="70" loading="lazy" decoding="async">
        <?php else : ?>
        <div class="c-testimonial-card__avatar c-testimonial-card__avatar--placeholder" aria-hidden="true">
            <i class="bi bi-person-fill"></i>
        </div>
        <?php endif; ?>

        <div class="c-testimonial-card__meta">
            <cite class="c-testimonial-card__name"><?php the_title(); ?></cite>
            <?php if ( $location ) : ?>
            <span class="c-testimonial-card__location">
                <i class="bi bi-geo-alt" aria-hidden="true"></i>
                <?php echo esc_html( $location ); ?>
            </span>
            <?php endif; ?>
            <?php if ( $tour ) : ?>
            <span class="c-testimonial-card__tour">
                <i class="bi bi-compass" aria-hidden="true"></i>
                <?php echo esc_html( $tour ); ?>
            </span>
            <?php endif; ?>
        </div>
    </footer>
</article>
