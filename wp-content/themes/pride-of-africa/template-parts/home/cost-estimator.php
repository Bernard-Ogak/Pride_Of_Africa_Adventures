<?php
/**
 * Template Part: Safari Cost Estimator
 *
 * File:   template-parts/home/cost-estimator.php
 * Spec:   03-Master-UI-Specification-v3.md §12
 *         Card Width: 860px | Padding: 40px
 *         Input Height: 56px | Summary Card: 340px | Gap: 32px
 *         01-Master-Design-Specification.md §17 Cost Estimator
 *
 * @package PrideOfAfrica
 */
?>

<section class="c-estimator l-section l-section--alt" id="cost-estimator" aria-labelledby="estimator-heading">
    <div class="u-container">

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Budget Your Trip', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="estimator-heading">
                <?php esc_html_e( 'Safari Cost Estimator', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-section-header__desc">
                <?php esc_html_e( 'Get an instant budget estimate for your safari. Adjust your preferences to see how costs change.', 'pride-of-africa' ); ?>
            </p>
        </div>

        <div class="c-estimator__card" data-estimator>

            <!-- ── Controls ─── -->
            <div class="c-estimator__controls">

                <div class="c-estimator__group">
                    <label class="c-estimator__label" for="est-destination">
                        <i class="bi bi-geo-alt" aria-hidden="true"></i>
                        <?php esc_html_e( 'Destination', 'pride-of-africa' ); ?>
                    </label>
                    <select class="c-estimator__select" id="est-destination" name="est_destination" data-est-field="destination">
                        <option value="kenya"     data-base="2800"><?php esc_html_e( 'Kenya',        'pride-of-africa' ); ?></option>
                        <option value="tanzania"  data-base="3200"><?php esc_html_e( 'Tanzania',     'pride-of-africa' ); ?></option>
                        <option value="southafrica" data-base="2500"><?php esc_html_e( 'South Africa','pride-of-africa' ); ?></option>
                        <option value="botswana"  data-base="4500"><?php esc_html_e( 'Botswana',     'pride-of-africa' ); ?></option>
                        <option value="rwanda"    data-base="5000"><?php esc_html_e( 'Rwanda',       'pride-of-africa' ); ?></option>
                        <option value="namibia"   data-base="3000"><?php esc_html_e( 'Namibia',      'pride-of-africa' ); ?></option>
                        <option value="zimbabwe"  data-base="2600"><?php esc_html_e( 'Zimbabwe',     'pride-of-africa' ); ?></option>
                    </select>
                </div>

                <div class="c-estimator__group">
                    <label class="c-estimator__label" for="est-duration">
                        <i class="bi bi-calendar3" aria-hidden="true"></i>
                        <?php esc_html_e( 'Duration', 'pride-of-africa' ); ?>
                    </label>
                    <select class="c-estimator__select" id="est-duration" name="est_duration" data-est-field="duration">
                        <option value="5"  data-multiplier="1.0"><?php esc_html_e( '5 Days',  'pride-of-africa' ); ?></option>
                        <option value="7"  data-multiplier="1.3" selected><?php esc_html_e( '7 Days',  'pride-of-africa' ); ?></option>
                        <option value="10" data-multiplier="1.7"><?php esc_html_e( '10 Days', 'pride-of-africa' ); ?></option>
                        <option value="14" data-multiplier="2.2"><?php esc_html_e( '14 Days', 'pride-of-africa' ); ?></option>
                        <option value="21" data-multiplier="3.0"><?php esc_html_e( '21 Days', 'pride-of-africa' ); ?></option>
                    </select>
                </div>

                <div class="c-estimator__group">
                    <label class="c-estimator__label" for="est-adults">
                        <i class="bi bi-people" aria-hidden="true"></i>
                        <?php esc_html_e( 'Adults', 'pride-of-africa' ); ?>
                    </label>
                    <div class="c-estimator__stepper">
                        <button class="c-estimator__step" type="button" data-est-step="-1" data-est-target="est-adults" aria-label="<?php esc_attr_e( 'Decrease adults', 'pride-of-africa' ); ?>">
                            <i class="bi bi-dash" aria-hidden="true"></i>
                        </button>
                        <input class="c-estimator__number" type="number" id="est-adults" name="est_adults"
                               value="2" min="1" max="20" data-est-field="adults" readonly aria-live="polite">
                        <button class="c-estimator__step" type="button" data-est-step="1" data-est-target="est-adults" aria-label="<?php esc_attr_e( 'Increase adults', 'pride-of-africa' ); ?>">
                            <i class="bi bi-plus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <div class="c-estimator__group">
                    <label class="c-estimator__label" for="est-children">
                        <i class="bi bi-people" aria-hidden="true"></i>
                        <?php esc_html_e( 'Children', 'pride-of-africa' ); ?>
                    </label>
                    <div class="c-estimator__stepper">
                        <button class="c-estimator__step" type="button" data-est-step="-1" data-est-target="est-children" aria-label="<?php esc_attr_e( 'Decrease children', 'pride-of-africa' ); ?>">
                            <i class="bi bi-dash" aria-hidden="true"></i>
                        </button>
                        <input class="c-estimator__number" type="number" id="est-children" name="est_children"
                               value="0" min="0" max="10" data-est-field="children" readonly aria-live="polite">
                        <button class="c-estimator__step" type="button" data-est-step="1" data-est-target="est-children" aria-label="<?php esc_attr_e( 'Increase children', 'pride-of-africa' ); ?>">
                            <i class="bi bi-plus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <div class="c-estimator__group">
                    <label class="c-estimator__label" for="est-accommodation">
                        <i class="bi bi-house" aria-hidden="true"></i>
                        <?php esc_html_e( 'Accommodation', 'pride-of-africa' ); ?>
                    </label>
                    <select class="c-estimator__select" id="est-accommodation" name="est_accommodation" data-est-field="accommodation">
                        <option value="budget"  data-accom="0.8"><?php esc_html_e( 'Budget Camp',   'pride-of-africa' ); ?></option>
                        <option value="mid"     data-accom="1.0" selected><?php esc_html_e( 'Mid-range Lodge', 'pride-of-africa' ); ?></option>
                        <option value="luxury"  data-accom="1.6"><?php esc_html_e( 'Luxury Lodge',  'pride-of-africa' ); ?></option>
                        <option value="ultra"   data-accom="2.5"><?php esc_html_e( 'Ultra-Luxury',  'pride-of-africa' ); ?></option>
                    </select>
                </div>

                <div class="c-estimator__group">
                    <label class="c-estimator__label" for="est-vehicle">
                        <i class="bi bi-truck" aria-hidden="true"></i>
                        <?php esc_html_e( 'Vehicle', 'pride-of-africa' ); ?>
                    </label>
                    <select class="c-estimator__select" id="est-vehicle" name="est_vehicle" data-est-field="vehicle">
                        <option value="shared"  data-vehicle="0.7"><?php esc_html_e( 'Shared 4×4',   'pride-of-africa' ); ?></option>
                        <option value="private" data-vehicle="1.0" selected><?php esc_html_e( 'Private 4×4',  'pride-of-africa' ); ?></option>
                        <option value="luxury"  data-vehicle="1.4"><?php esc_html_e( 'Luxury 4×4',  'pride-of-africa' ); ?></option>
                    </select>
                </div>

            </div><!-- /.c-estimator__controls -->

            <!-- ── Summary ─── -->
            <div class="c-estimator__summary" aria-live="polite" aria-atomic="true">
                <div class="c-estimator__summary-inner">
                    <p class="c-estimator__summary-label"><?php esc_html_e( 'Estimated Total', 'pride-of-africa' ); ?></p>
                    <p class="c-estimator__price" data-est-total>
                        <span class="c-estimator__currency">USD</span>
                        <span class="c-estimator__amount" data-est-amount>8,320</span>
                    </p>
                    <p class="c-estimator__per-person" data-est-per-person><?php esc_html_e( '~$4,160 per person', 'pride-of-africa' ); ?></p>
                    <p class="c-estimator__disclaimer">
                        <?php esc_html_e( 'Indicative estimate. Final pricing depends on availability and inclusions.', 'pride-of-africa' ); ?>
                    </p>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ?: home_url( '/contact/' ) ); ?>"
                       class="c-button c-button--primary c-estimator__cta">
                        <?php esc_html_e( 'Get Exact Quote', 'pride-of-africa' ); ?>
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

        </div><!-- /.c-estimator__card -->

    </div>
</section>

<script>
( function () {
    'use strict';
    const card = document.querySelector( '[data-estimator]' );
    if ( ! card ) return;

    const CHILD_RATE = 0.6;

    function getVal( sel ) {
        const el = card.querySelector( sel );
        return el ? el : null;
    }

    function calcTotal() {
        const destEl   = getVal( '[data-est-field="destination"]' );
        const durEl    = getVal( '[data-est-field="duration"]' );
        const accomEl  = getVal( '[data-est-field="accommodation"]' );
        const vehicleEl= getVal( '[data-est-field="vehicle"]' );
        const adultsEl = getVal( '[data-est-field="adults"]' );
        const childEl  = getVal( '[data-est-field="children"]' );

        const base      = parseFloat( destEl.options[destEl.selectedIndex].dataset.base ) || 3000;
        const mult      = parseFloat( durEl.options[durEl.selectedIndex].dataset.multiplier ) || 1;
        const accom     = parseFloat( accomEl.options[accomEl.selectedIndex].dataset.accom ) || 1;
        const vehicle   = parseFloat( vehicleEl.options[vehicleEl.selectedIndex].dataset.vehicle ) || 1;
        const adults    = parseInt( adultsEl.value, 10 ) || 1;
        const children  = parseInt( childEl.value,  10 ) || 0;
        const pax       = adults + ( children * CHILD_RATE );

        const total = Math.round( base * mult * accom * vehicle * pax );
        const perPerson = adults > 0 ? Math.round( total / adults ) : total;

        const amountEl    = card.querySelector( '[data-est-amount]' );
        const perPersonEl = card.querySelector( '[data-est-per-person]' );

        if ( amountEl ) amountEl.textContent = total.toLocaleString();
        if ( perPersonEl ) perPersonEl.textContent = '~$' + perPerson.toLocaleString() + ' per person';
    }

    // Stepper buttons
    card.querySelectorAll( '[data-est-step]' ).forEach( btn => {
        btn.addEventListener( 'click', () => {
            const step   = parseInt( btn.dataset.estStep,   10 );
            const target = card.querySelector( '#' + btn.dataset.estTarget );
            if ( ! target ) return;
            const newVal = Math.min( parseInt( target.max, 10 ), Math.max( parseInt( target.min, 10 ), parseInt( target.value, 10 ) + step ) );
            target.value = newVal;
            calcTotal();
        } );
    } );

    // Select changes
    card.querySelectorAll( 'select[data-est-field]' ).forEach( sel => {
        sel.addEventListener( 'change', calcTotal );
    } );

    calcTotal();
} )();
</script>
