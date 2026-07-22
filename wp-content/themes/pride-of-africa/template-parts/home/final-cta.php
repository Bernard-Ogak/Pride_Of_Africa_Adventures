<?php
/**
 * Template Part: Final CTA
 * File:   template-parts/home/final-cta.php
 * Spec:   03-Master-UI-Specification-v3.md §17
 *         Background: Image + Overlay | Padding: 96px
 *         Heading Width: 760px | Button: 220 x 60px
 * @package PrideOfAfrica
 */

$cta_img_id = get_theme_mod( 'poa_final_cta_image', '' );
$cta_img    = $cta_img_id ? wp_get_attachment_image_url( $cta_img_id, 'full' ) : '';
?>

<section class="c-final-cta" id="final-cta" aria-labelledby="final-cta-heading"
    <?php if ( $cta_img ) : ?>style="--final-cta-bg: url('<?php echo esc_url( $cta_img ); ?>')"<?php endif; ?>>

    <div class="c-final-cta__overlay" aria-hidden="true"></div>

    <div class="u-container">
        <div class="c-final-cta__inner">

            <span class="c-badge c-badge--light"><?php esc_html_e( 'Your Safari Awaits', 'pride-of-africa' ); ?></span>

            <h2 class="c-final-cta__heading" id="final-cta-heading">
                <?php esc_html_e( 'Start Your African Adventure Today', 'pride-of-africa' ); ?>
            </h2>

            <p class="c-final-cta__desc">
                <?php esc_html_e( 'Let our experts design the perfect safari experience tailored to your dreams, budget, and travel style.', 'pride-of-africa' ); ?>
            </p>

            <div class="c-final-cta__actions">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="c-button c-button--primary c-button--xl">
                    <?php esc_html_e( 'Plan My Safari', 'pride-of-africa' ); ?>
                </a>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'pride_tour' ) ); ?>" class="c-button c-button--outline c-button--light c-button--xl">
                    <?php esc_html_e( 'Browse Tours', 'pride-of-africa' ); ?>
                </a>
            </div>

        </div>
    </div>
</section>
