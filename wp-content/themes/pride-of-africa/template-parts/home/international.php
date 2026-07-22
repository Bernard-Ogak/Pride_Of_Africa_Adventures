<?php
/**
 * Template Part: International Destinations
 * File:   template-parts/home/international.php
 * Spec:   01-Master-Design-Specification.md §8
 *         Background: Dark (#243228) | 8 country cards
 * @package PrideOfAfrica
 */

$countries = get_terms( [
    'taxonomy'   => 'pride_country',
    'hide_empty' => true,
    'orderby'    => 'menu_order',
    'order'      => 'ASC',
    'number'     => 8,
] );

if ( is_wp_error( $countries ) || empty( $countries ) ) {
    return;
}
?>
<section class="c-international l-section" id="international-destinations" aria-labelledby="international-heading">
    <div class="u-container">
        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Across The Continent', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="international-heading"><?php esc_html_e( 'Explore Africa By Country', 'pride-of-africa' ); ?></h2>
            <p class="c-section-header__desc"><?php esc_html_e( 'From East to Southern Africa — each country offers a unique wildlife experience.', 'pride-of-africa' ); ?></p>
        </div>

        <div class="c-international__grid" role="list">
            <?php foreach ( $countries as $country ) :
                $img_id   = get_term_meta( $country->term_id, '_country_image', true );
                $img_url  = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
                $count    = $country->count;
                $link     = get_term_link( $country );
            ?>
            <a class="c-international__card" href="<?php echo esc_url( is_wp_error( $link ) ? '#' : $link ); ?>" role="listitem"
               aria-label="<?php echo esc_attr( sprintf( __( 'Explore %1$s — %2$d tours', 'pride-of-africa' ), $country->name, $count ) ); ?>">
                <?php if ( $img_url ) : ?>
                <div class="c-international__img-wrap" aria-hidden="true">
                    <img class="c-international__img" src="<?php echo esc_url( $img_url ); ?>" alt="" loading="lazy" decoding="async">
                </div>
                <?php endif; ?>
                <div class="c-international__overlay" aria-hidden="true"></div>
                <div class="c-international__body">
                    <h3 class="c-international__name"><?php echo esc_html( $country->name ); ?></h3>
                    <p class="c-international__count"><?php echo esc_html( sprintf( _n( '%d Tour', '%d Tours', $count, 'pride-of-africa' ), $count ) ); ?></p>
                    <span class="c-international__arrow" aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
