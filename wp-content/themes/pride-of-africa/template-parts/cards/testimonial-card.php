<?php
/**
 * Card: Testimonial
 * File:   template-parts/cards/testimonial-card.php
 * Rebuilt to match the Testimonials reference screenshot: quote icon,
 * quote text, star rating, initials avatar, name + trip/location, and
 * a platform badge (TripAdvisor / SafariBookings / Trustpilot).
 * @package PrideOfAfrica
 */

// Accept the post explicitly (via $args) rather than relying on the
// global $post / setup_postdata() — in this loop context setup_postdata()
// was not reliably updating get_the_ID()/get_the_title() between cards.
$card_post = isset( $args['post'] ) ? $args['post'] : get_post();
$post_id   = $card_post->ID;
$rating   = (int) get_post_meta( $post_id, '_testimonial_rating',  true ) ?: 5;
$location = get_post_meta( $post_id, '_testimonial_location', true );
$tour     = get_post_meta( $post_id, '_testimonial_tour',     true );
$platform = get_post_meta( $post_id, '_testimonial_platform', true ) ?: 'tripadvisor';

$platforms = [
    'tripadvisor'   => [ 'label' => __( 'TripAdvisor',   'pride-of-africa' ), 'color' => '#34E0A1' ],
    'safaribookings'=> [ 'label' => __( 'SafariBookings', 'pride-of-africa' ), 'color' => '#F0932B' ],
    'trustpilot'    => [ 'label' => __( 'Trustpilot',     'pride-of-africa' ), 'color' => '#00B67A' ],
];
$platform_data = $platforms[ $platform ] ?? $platforms['tripadvisor'];

$name    = get_the_title( $card_post );
$initials = '';
foreach ( preg_split( '/\s+/', trim( $name ) ) as $word ) {
    if ( $word !== '' ) {
        $initials .= mb_strtoupper( mb_substr( $word, 0, 1 ) );
    }
}
$initials = mb_substr( $initials, 0, 2 );
?>

<article
    class="c-testimonial-card"
    data-platform="<?php echo esc_attr( $platform ); ?>"
    aria-label="<?php echo esc_attr( sprintf( __( 'Testimonial from %s', 'pride-of-africa' ), $name ) ); ?>"
>
    <i class="bi bi-quote c-testimonial-card__quote-icon" aria-hidden="true"></i>

    <blockquote class="c-testimonial-card__quote">
        <p><?php echo esc_html( wp_trim_words( $card_post->post_content, 40, '…' ) ); ?></p>
    </blockquote>

    <div class="c-testimonial-card__rating" aria-label="<?php echo esc_attr( sprintf( __( '%d out of 5 stars', 'pride-of-africa' ), $rating ) ); ?>">
        <?php for ( $s = 1; $s <= 5; $s++ ) : ?>
        <i class="bi <?php echo $s <= $rating ? 'bi-star-fill' : 'bi-star'; ?>" aria-hidden="true"></i>
        <?php endfor; ?>
    </div>

    <footer class="c-testimonial-card__footer">
        <div class="c-testimonial-card__avatar" aria-hidden="true"><?php echo esc_html( $initials ); ?></div>

        <div class="c-testimonial-card__meta">
            <cite class="c-testimonial-card__name"><?php echo esc_html( $name ); ?></cite>
            <?php if ( $tour || $location ) : ?>
            <span class="c-testimonial-card__trip">
                <?php echo esc_html( trim( $tour . ( $tour && $location ? ' · ' : '' ) . $location ) ); ?>
            </span>
            <?php endif; ?>
        </div>
    </footer>

    <span class="c-testimonial-card__platform" style="--platform-color: <?php echo esc_attr( $platform_data['color'] ); ?>">
        <span class="c-testimonial-card__platform-dot" aria-hidden="true"></span>
        <?php echo esc_html( $platform_data['label'] ); ?>
        <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i>
    </span>
</article>
