<?php
/**
 * Reusable partial: Review QR Code card
 * File:   template-parts/cards/review-qr-code.php
 *
 * Renders wherever get_template_part('template-parts/cards/review-qr-code')
 * is called (footer, homepage, Review Hub page, contact page, etc.), so
 * the same admin-controlled destination/image is used everywhere.
 *
 * @package PrideOfAfrica
 */

$qr_url   = get_theme_mod( 'pride_review_qr_url', home_url( '/reviews' ) );
$qr_image = get_theme_mod( 'pride_review_qr_image', '' );

if ( empty( $qr_image ) ) {
    // Auto-generated fallback — SVG preferred, from a public QR image service.
    $qr_image = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&format=svg&ecc=M&color=0-153-0&data=' . rawurlencode( $qr_url );
}
?>
<div class="c-review-qr">
    <div class="c-review-qr__frame">
        <img
            src="<?php echo esc_url( $qr_image ); ?>"
            alt="<?php esc_attr_e( 'QR code linking to the Pride of Africa review page', 'pride-of-africa' ); ?>"
            width="180" height="180"
            loading="lazy" decoding="async"
            class="c-review-qr__image"
        >
    </div>
    <p class="c-review-qr__caption"><?php esc_html_e( 'Scan to Leave a Review', 'pride-of-africa' ); ?></p>
</div>
