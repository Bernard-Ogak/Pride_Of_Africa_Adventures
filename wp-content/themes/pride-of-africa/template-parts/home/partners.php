<?php
/**
 * Template Part: Trusted Partners / Logo Bar
 *
 * File:   template-parts/home/partners.php
 * Spec:   01-Master-Design-Specification.md §14
 *         03-Master-UI-Specification-v3.md §7
 *         Container Height: 140px | Logo Height: 48px
 *         Spacing: 60px | Hover Scale: 1.05
 *         White background | Monochrome logos | Hover colour
 *
 * Source: ADAPTED — original spec expected a "partner" CPT that does not
 *         exist in this theme. Logos are instead read from the existing
 *         Customizer settings (pride_trusted_partners_logo_{n}_image, etc.),
 *         the same source the legacy trusted-partners.php template used.
 *
 * @package PrideOfAfrica
 */

$partners = [];
for ( $p = 1; $p <= 12; $p++ ) {
    $image_id = get_theme_mod( "pride_trusted_partners_logo_{$p}_image", '' );
    if ( empty( $image_id ) ) {
        continue;
    }
    $image_url = wp_get_attachment_image_url( $image_id, 'medium' );
    if ( empty( $image_url ) ) {
        continue;
    }
    $partners[] = [
        'name'  => get_theme_mod( "pride_trusted_partners_logo_{$p}_name", '' ),
        'image' => $image_url,
        'url'   => get_theme_mod( "pride_trusted_partners_logo_{$p}_url", '' ),
    ];
}

if ( empty( $partners ) ) {
    return;
}
?>

<section class="c-partners l-section l-section--compact" id="trusted-partners" aria-label="<?php esc_attr_e( 'Our trusted partners', 'pride-of-africa' ); ?>">
    <div class="u-container">

        <p class="c-partners__label"><?php esc_html_e( 'Trusted By Leading Travel Organisations', 'pride-of-africa' ); ?></p>

        <div class="c-partners__track" role="list">
            <?php foreach ( $partners as $partner ) :
                $logo_url = $partner['image'];
                $website  = $partner['url'];
                $name     = $partner['name'];
            ?>
            <div class="c-partners__item" role="listitem">
                <?php if ( $website ) : ?>
                <a
                    href="<?php echo esc_url( $website ); ?>"
                    class="c-partners__link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php echo esc_attr( sprintf( __( 'Visit %s website', 'pride-of-africa' ), $name ) ); ?>"
                >
                <?php endif; ?>

                    <img
                        class="c-partners__logo"
                        src="<?php echo esc_url( $logo_url ); ?>"
                        alt="<?php echo esc_attr( $name ); ?>"
                        width="160"
                        height="48"
                        loading="lazy"
                        decoding="async"
                    >

                <?php if ( $website ) : ?>
                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
