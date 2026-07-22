<?php
/**
 * Template Part: Leave a Review Banner
 * File:   template-parts/home/review.php
 * Spec:   03-Master-UI-Specification-v3.md §14
 *         Height: 320px | Content Width: 720px
 *         Primary Button: 200 x 56px
 *         Background: Accent Green or image+overlay
 * @package PrideOfAfrica
 */

$tripadvisor = get_theme_mod( 'poa_tripadvisor_url', '' );
$google      = get_theme_mod( 'poa_google_review_url', '' );
?>

<section class="c-review l-section l-section--compact" id="leave-review" aria-labelledby="review-heading">
    <div class="c-review__bg" aria-hidden="true"></div>

    <div class="u-container">
        <div class="c-review__inner">

            <div class="c-review__content">
                <h2 class="c-review__heading" id="review-heading">
                    <?php esc_html_e( 'Share Your Safari Experience', 'pride-of-africa' ); ?>
                </h2>
                <p class="c-review__desc">
                    <?php esc_html_e( 'Your story inspires the next adventure. Leave us a review and help other travellers discover the magic of Africa.', 'pride-of-africa' ); ?>
                </p>
            </div>

            <div class="c-review__actions">
                <?php if ( $tripadvisor ) : ?>
                <a href="<?php echo esc_url( $tripadvisor ); ?>" class="c-button c-button--surface c-review__btn"
                   target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Review us on TripAdvisor', 'pride-of-africa' ); ?>">
                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                    <?php esc_html_e( 'TripAdvisor', 'pride-of-africa' ); ?>
                </a>
                <?php endif; ?>
                <?php if ( $google ) : ?>
                <a href="<?php echo esc_url( $google ); ?>" class="c-button c-button--outline c-button--light c-review__btn"
                   target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Review us on Google', 'pride-of-africa' ); ?>">
                    <i class="bi bi-google" aria-hidden="true"></i>
                    <?php esc_html_e( 'Google Reviews', 'pride-of-africa' ); ?>
                </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
