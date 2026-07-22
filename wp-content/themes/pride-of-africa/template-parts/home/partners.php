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

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Partners', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title"><?php esc_html_e( 'Our Trusted Partners', 'pride-of-africa' ); ?></h2>
            <p class="c-section-header__desc"><?php esc_html_e( 'Working with leading travel and tourism organizations across Africa and beyond.', 'pride-of-africa' ); ?></p>
        </div>

    </div>

    <!-- Outside .u-container so the marquee spans edge-to-edge -->
    <div class="c-partners__track">
        <div class="c-partners__track-inner" data-partners-marquee>
            <?php
            // Rendered twice back-to-back so the marquee can loop
            // seamlessly (animation scrolls exactly -50%, i.e. one copy).
            for ( $copy = 0; $copy < 2; $copy++ ) :
                foreach ( $partners as $partner ) :
                    $logo_url = $partner['image'];
                    $website  = $partner['url'];
                    $name     = $partner['name'];
                ?>
                <div class="c-partners__item" role="listitem" <?php echo ( 0 === $copy ) ? '' : 'aria-hidden="true"'; ?>>
                    <?php if ( $website ) : ?>
                    <a
                        href="<?php echo esc_url( $website ); ?>"
                        class="c-partners__link"
                        target="_blank"
                        rel="noopener noreferrer"
                        tabindex="<?php echo ( 0 === $copy ) ? '0' : '-1'; ?>"
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
                <?php endforeach;
            endfor; ?>
        </div>
    </div>

</section>
