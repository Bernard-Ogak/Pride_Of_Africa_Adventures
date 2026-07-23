<?php
/**
 * Template Part: Safari Cost Estimator
 * File:   template-parts/home/cost-estimator.php
 *
 * Rebuilt to price real safari packages instead of a synthetic
 * destination/accommodation/vehicle formula. Packages are the same
 * pride_tour posts (tagged with a Tour Category) that power the
 * homepage "Popular Tours" section, so admins only maintain tour data
 * in one place. Total = official rate × traveler count.
 *
 * @package PrideOfAfrica
 */

$packages = new WP_Query( [
    'post_type'      => 'pride_tour',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
    'tax_query'      => [
        [
            'taxonomy' => 'pride_tour_category',
            'operator' => 'EXISTS',
        ],
    ],
    'meta_query'     => [
        [
            'key'     => '_tour_price',
            'compare' => 'EXISTS',
        ],
    ],
] );

if ( ! $packages->have_posts() ) {
    return;
}

$max_travelers = (int) get_theme_mod( 'pride_estimator_max_travelers', 20 );
$max_travelers = $max_travelers > 0 ? $max_travelers : 20;

$contact_url = home_url( '/contact' );
?>

<section class="c-estimator l-section l-section--alt" id="cost-estimator" aria-labelledby="estimator-heading">
    <div class="u-container">

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Safari Cost Estimator', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="estimator-heading">
                <?php esc_html_e( 'How Much Will My Safari Cost?', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-section-header__desc">
                <?php esc_html_e( 'Select a safari package and number of travelers. Prices are per person based on our official rates.', 'pride-of-africa' ); ?>
            </p>
        </div>

        <div class="c-estimator__card c-estimator__card--3col" data-estimator>

            <!-- ── Column 1: Package + Travelers ─── -->
            <div class="c-estimator__controls">

                <div class="c-estimator__group c-estimator__group--full">
                    <label class="c-estimator__label" for="est-package">
                        <i class="bi bi-map" aria-hidden="true"></i>
                        <?php esc_html_e( 'Safari Package', 'pride-of-africa' ); ?>
                    </label>
                    <select class="c-estimator__select" id="est-package" name="est_package" data-est-field="package">
                        <?php while ( $packages->have_posts() ) : $packages->the_post();
                            $post_id   = get_the_ID();
                            $price_str = get_post_meta( $post_id, '_tour_price', true );
                            $price_num = (float) preg_replace( '/[^0-9.]/', '', $price_str );
                            $location  = get_post_meta( $post_id, '_tour_location', true );
                            $cta_url   = get_post_meta( $post_id, '_tour_cta_url', true ) ?: $contact_url;
                            $is_default = ( get_the_title() === '4-Day Maasai Mara Migration Safari' );
                        ?>
                        <option
                            value="<?php echo esc_attr( $post_id ); ?>"
                            data-price="<?php echo esc_attr( $price_num ); ?>"
                            data-price-label="<?php echo esc_attr( $price_str ); ?>"
                            data-location="<?php echo esc_attr( $location ); ?>"
                            data-cta-url="<?php echo esc_attr( $cta_url ); ?>"
                            <?php selected( $is_default ); ?>
                        ><?php the_title(); ?></option>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </select>
                </div>

                <div class="c-estimator__group c-estimator__group--full">
                    <label class="c-estimator__label" for="est-travelers">
                        <i class="bi bi-people" aria-hidden="true"></i>
                        <?php esc_html_e( 'Travelers', 'pride-of-africa' ); ?>
                    </label>
                    <div class="c-estimator__stepper">
                        <button class="c-estimator__step" type="button" data-est-step="-1" data-est-target="est-travelers" aria-label="<?php esc_attr_e( 'Decrease travelers', 'pride-of-africa' ); ?>" aria-controls="est-travelers">
                            <i class="bi bi-dash" aria-hidden="true"></i>
                        </button>
                        <input class="c-estimator__number" type="number" id="est-travelers" name="est_travelers"
                               value="1" min="1" max="<?php echo esc_attr( $max_travelers ); ?>" data-est-field="travelers" readonly aria-live="polite" aria-label="<?php esc_attr_e( 'Number of travelers', 'pride-of-africa' ); ?>">
                        <button class="c-estimator__step" type="button" data-est-step="1" data-est-target="est-travelers" aria-label="<?php esc_attr_e( 'Increase travelers', 'pride-of-africa' ); ?>" aria-controls="est-travelers">
                            <i class="bi bi-plus" aria-hidden="true"></i>
                        </button>
                        <span class="c-estimator__stepper-suffix"><?php esc_html_e( 'person', 'pride-of-africa' ); ?></span>
                    </div>
                </div>

            </div><!-- /.c-estimator__controls -->

            <!-- ── Column 2: Live Safari Cost Estimator ─── -->
            <div class="c-estimator__summary" aria-live="polite" aria-atomic="true">
                <div class="c-estimator__summary-inner">
                    <p class="c-estimator__summary-label" data-est-package-name><?php esc_html_e( 'Loading…', 'pride-of-africa' ); ?></p>
                    <p class="c-estimator__price" data-est-total>
                        <span class="c-estimator__currency">$</span>
                        <span class="c-estimator__amount" data-est-amount>0</span>
                    </p>
                    <p class="c-estimator__per-person"><?php esc_html_e( 'per person (official rate)', 'pride-of-africa' ); ?></p>
                    <p class="c-estimator__calc" data-est-calc></p>
                    <p class="c-estimator__total-label" data-est-total-label></p>
                </div>
            </div>

            <!-- ── Column 3: Booking Summary ─── -->
            <div class="c-estimator__booking">
                <h3 class="c-estimator__booking-title"><?php esc_html_e( 'Booking Summary', 'pride-of-africa' ); ?></h3>
                <dl class="c-estimator__booking-list">
                    <div class="c-estimator__booking-row">
                        <dt><?php esc_html_e( 'Package', 'pride-of-africa' ); ?></dt>
                        <dd data-est-booking-package></dd>
                    </div>
                    <div class="c-estimator__booking-row">
                        <dt><?php esc_html_e( 'Destination', 'pride-of-africa' ); ?></dt>
                        <dd data-est-booking-location></dd>
                    </div>
                    <div class="c-estimator__booking-row">
                        <dt><?php esc_html_e( 'Official Rate', 'pride-of-africa' ); ?></dt>
                        <dd data-est-booking-rate></dd>
                    </div>
                </dl>
                <a href="<?php echo esc_url( $contact_url ); ?>" class="c-button c-button--primary c-estimator__cta" data-est-cta>
                    <?php esc_html_e( 'Get My Exact Quote', 'pride-of-africa' ); ?>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

        </div><!-- /.c-estimator__card -->

        <p class="c-estimator__notice">
            <i class="bi bi-info-circle" aria-hidden="true"></i>
            <strong><?php esc_html_e( 'Official Rates:', 'pride-of-africa' ); ?></strong>
            <?php esc_html_e( 'Prices shown are per-person USD rates. Flights, visas, and travel insurance are not included.', 'pride-of-africa' ); ?>
        </p>

        <div class="c-estimator__bespoke">
            <p><?php esc_html_e( 'Need something different? Contact our safari experts for a fully personalized quote.', 'pride-of-africa' ); ?></p>
            <a href="<?php echo esc_url( $contact_url ); ?>" class="c-button c-button--outline">
                <?php esc_html_e( 'Request a Custom Safari', 'pride-of-africa' ); ?>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </div>
</section>

<script>
( function () {
    'use strict';
    const card = document.querySelector( '[data-estimator]' );
    if ( ! card ) return;

    const packageSelect = card.querySelector( '#est-package' );
    const travelersInput = card.querySelector( '#est-travelers' );

    function formatUSD( n ) {
        return '$' + Math.round( n ).toLocaleString( 'en-US' );
    }

    function calcTotal() {
        const opt = packageSelect.options[ packageSelect.selectedIndex ];
        if ( ! opt ) return;

        const price     = parseFloat( opt.dataset.price ) || 0;
        const priceLabel= opt.dataset.priceLabel || formatUSD( price ) + ' / person';
        const location  = opt.dataset.location || '';
        const ctaUrl    = opt.dataset.ctaUrl || '';
        const name      = opt.textContent;
        const travelers = Math.max( 1, parseInt( travelersInput.value, 10 ) || 1 );
        const total     = price * travelers;

        card.querySelector( '[data-est-package-name]' ).textContent = name;
        card.querySelector( '[data-est-amount]' ).textContent = Math.round( price ).toLocaleString( 'en-US' );
        card.querySelector( '[data-est-calc]' ).textContent = formatUSD( price ) + ' × ' + travelers + ( travelers === 1 ? ' traveler' : ' travelers' );
        card.querySelector( '[data-est-total-label]' ).textContent = 'Total for ' + travelers + ( travelers === 1 ? ' Person: ' : ' People: ' ) + formatUSD( total );

        card.querySelector( '[data-est-booking-package]' ).textContent = name;
        card.querySelector( '[data-est-booking-location]' ).textContent = location;
        card.querySelector( '[data-est-booking-rate]' ).textContent = priceLabel;

        const ctaBtn = card.querySelector( '[data-est-cta]' );
        if ( ctaBtn && ctaUrl ) ctaBtn.setAttribute( 'href', ctaUrl );
    }

    card.querySelectorAll( '[data-est-step]' ).forEach( btn => {
        btn.addEventListener( 'click', () => {
            const step   = parseInt( btn.dataset.estStep, 10 );
            const target = card.querySelector( '#' + btn.dataset.estTarget );
            if ( ! target ) return;
            const min = parseInt( target.min, 10 );
            const max = parseInt( target.max, 10 );
            target.value = Math.min( max, Math.max( min, ( parseInt( target.value, 10 ) || min ) + step ) );
            calcTotal();
        } );
    } );

    packageSelect.addEventListener( 'change', calcTotal );

    calcTotal();
} )();
</script>
