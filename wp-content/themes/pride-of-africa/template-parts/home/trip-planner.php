<?php
/**
 * Template Part: Trip Planner Bar
 *
 * File:   template-parts/home/trip-planner.php
 * Source: Theme options / booking engine (static HTML form; JS submits to results page)
 * Spec:
 *   01-Master-Design-Specification.md  §9 Forms | §24 Component Inventory
 *   02-Master-UI-Specification-v2.md   §11 Planner Card | §12 Trip Planner
 *   03-Master-UI-Specification-v3.md   §5 Trip Planner
 *   04-Component-Library.md            §8 Trip Planner
 *   05-WordPress-Theme-Architecture.md §4 Homepage Section Mapping
 *
 * Layout (desktop):
 *   Width:         1240px  (--content-max)
 *   Height:        140px
 *   Padding:       32px    (--space-5)
 *   Columns:       5       (4 fields + 1 search button)
 *   Gap:           20px
 *   Input height:  56px
 *   Dropdown R:    10px    (--radius-md)
 *   Card radius:   20px    (--radius-xl)
 *   Card shadow:   Large   (--shadow-lg)
 *   Icon size:     22px
 *   Button width:  180px
 *
 * @package PrideOfAfrica
 */

// Retrieve destinations list from CPT for Destination select.
$destinations = get_posts( [
    'post_type'      => 'pride_destination',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'title',
    'order'          => 'ASC',
    'fields'         => 'ids',
] );

// Results / search page URL — filter-able so themes / plugins can override.
$search_url = apply_filters(
    'poa_planner_action_url',
    get_post_type_archive_link( 'pride_tour' ) ?: home_url( '/tours/' )
);

// Today's date for the date input min attribute.
$today = date_i18n( 'Y-m-d' );
?>

<!-- =================================================================
     c-trip-planner
     Floats over the hero bottom / top of the next section.
     Negative top margin pulls it upward to overlap the hero.
     ================================================================= -->
<div
    class="c-trip-planner"
    id="c-trip-planner"
    aria-label="<?php esc_attr_e( 'Plan your safari', 'pride-of-africa' ); ?>"
>
    <div class="u-container c-trip-planner__container">

        <form
            class="c-trip-planner__form"
            action="<?php echo esc_url( $search_url ); ?>"
            method="GET"
            aria-label="<?php esc_attr_e( 'Safari search form', 'pride-of-africa' ); ?>"
            novalidate
            data-planner-form
        >

            <!-- ── Field 1: Destination ───────────────── -->
            <div class="c-trip-planner__field" data-planner-field="destination">
                <label
                    class="c-trip-planner__label"
                    for="planner-destination"
                >
                    <i class="bi bi-compass" aria-hidden="true"></i>
                    <?php esc_html_e( 'Destination', 'pride-of-africa' ); ?>
                </label>
                <div class="c-trip-planner__input-wrap">
                    <i class="bi bi-geo-alt c-trip-planner__icon" aria-hidden="true"></i>
                    <select
                        class="c-trip-planner__select"
                        id="planner-destination"
                        name="destination"
                        aria-required="false"
                        data-planner-field-input
                    >
                        <option value="">
                            <?php esc_html_e( 'Any destination', 'pride-of-africa' ); ?>
                        </option>
                        <?php foreach ( $destinations as $dest_id ) :
                            $dest_title = get_the_title( $dest_id );
                            $dest_slug  = get_post_field( 'post_name', $dest_id );
                        ?>
                        <option value="<?php echo esc_attr( $dest_slug ); ?>">
                            <?php echo esc_html( $dest_title ); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div><!-- /.c-trip-planner__field -->

            <!-- ── Field 2: Country ──────────────────── -->
            <div class="c-trip-planner__field" data-planner-field="country">
                <label
                    class="c-trip-planner__label"
                    for="planner-country"
                >
                    <i class="bi bi-flag" aria-hidden="true"></i>
                    <?php esc_html_e( 'Country', 'pride-of-africa' ); ?>
                </label>
                <div class="c-trip-planner__input-wrap">
                    <i class="bi bi-map c-trip-planner__icon" aria-hidden="true"></i>
                    <select
                        class="c-trip-planner__select"
                        id="planner-country"
                        name="country"
                        aria-required="false"
                        data-planner-field-input
                    >
                        <option value="">
                            <?php esc_html_e( 'Any country', 'pride-of-africa' ); ?>
                        </option>
                        <?php
                        // Common visitor source countries — static list per content request.
                        $planner_countries = [
                            'United States', 'Canada', 'United Kingdom', 'Germany', 'France',
                            'Italy', 'Spain', 'Netherlands', 'Belgium', 'Switzerland',
                            'Australia', 'New Zealand', 'India', 'China', 'Japan',
                            'South Korea', 'Singapore', 'UAE', 'Saudi Arabia', 'South Africa',
                            'Kenya', 'Uganda', 'Tanzania', 'Nigeria', 'Brazil',
                            'Mexico', 'Other',
                        ];
                        foreach ( $planner_countries as $country_name ) :
                            $country_slug = sanitize_title( $country_name );
                        ?>
                        <option value="<?php echo esc_attr( $country_slug ); ?>">
                            <?php echo esc_html( $country_name ); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div><!-- /.c-trip-planner__field -->

            <!-- ── Field 3: Travel Date ──────────────── -->
            <div class="c-trip-planner__field" data-planner-field="date">
                <label
                    class="c-trip-planner__label"
                    for="planner-date"
                >
                    <i class="bi bi-calendar3" aria-hidden="true"></i>
                    <?php esc_html_e( 'Travel Date', 'pride-of-africa' ); ?>
                </label>
                <div class="c-trip-planner__input-wrap">
                    <i class="bi bi-calendar-event c-trip-planner__icon" aria-hidden="true"></i>
                    <input
                        class="c-trip-planner__input"
                        type="date"
                        id="planner-date"
                        name="travel_date"
                        min="<?php echo esc_attr( $today ); ?>"
                        placeholder="<?php esc_attr_e( 'Select date', 'pride-of-africa' ); ?>"
                        aria-required="false"
                        autocomplete="off"
                        data-planner-field-input
                    >
                </div>
            </div><!-- /.c-trip-planner__field -->

            <!-- ── Field 4: Travelers ────────────────── -->
            <div class="c-trip-planner__field" data-planner-field="travelers">
                <label
                    class="c-trip-planner__label"
                    for="planner-travelers"
                >
                    <i class="bi bi-people" aria-hidden="true"></i>
                    <?php esc_html_e( 'Travelers', 'pride-of-africa' ); ?>
                </label>
                <div class="c-trip-planner__input-wrap">
                    <i class="bi bi-person c-trip-planner__icon" aria-hidden="true"></i>
                    <select
                        class="c-trip-planner__select"
                        id="planner-travelers"
                        name="travelers"
                        aria-required="false"
                        data-planner-field-input
                    >
                        <option value="">
                            <?php esc_html_e( 'Any group size', 'pride-of-africa' ); ?>
                        </option>
                        <?php
                        $traveler_options = [
                            '1'   => __( '1 Traveler',    'pride-of-africa' ),
                            '2'   => __( '2 Travelers',   'pride-of-africa' ),
                            '3-4' => __( '3–4 Travelers', 'pride-of-africa' ),
                            '5-8' => __( '5–8 Travelers', 'pride-of-africa' ),
                            '9+'  => __( '9+ Travelers',  'pride-of-africa' ),
                        ];
                        foreach ( $traveler_options as $val => $label ) :
                        ?>
                        <option value="<?php echo esc_attr( $val ); ?>">
                            <?php echo esc_html( $label ); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div><!-- /.c-trip-planner__field -->

            <!-- ── Field 5: Search Button ────────────── -->
            <div class="c-trip-planner__field c-trip-planner__field--submit" data-planner-field="search">
                <button
                    class="c-button c-button--primary c-trip-planner__submit"
                    type="submit"
                    aria-label="<?php esc_attr_e( 'Search available tours', 'pride-of-africa' ); ?>"
                    data-planner-submit
                >
                    <i class="bi bi-search" aria-hidden="true"></i>
                    <span><?php esc_html_e( 'Search Tours', 'pride-of-africa' ); ?></span>

                    <!-- Loading spinner — shown via JS during submit -->
                    <span class="c-trip-planner__spinner" aria-hidden="true" hidden>
                        <i class="bi bi-arrow-repeat" aria-hidden="true"></i>
                    </span>
                </button>
            </div><!-- /.c-trip-planner__field -->

        </form><!-- /.c-trip-planner__form -->

    </div><!-- /.c-trip-planner__container -->
</div><!-- /.c-trip-planner -->
