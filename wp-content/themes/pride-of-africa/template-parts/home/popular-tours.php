<?php
/**
 * Template Part: Popular Tours
 * File:   template-parts/home/popular-tours.php
 *
 * Filter pills are generated from the pride_tour_category taxonomy so
 * new categories created in wp-admin appear automatically. A fixed
 * preferred order is applied for the known launch categories; any
 * additional term is appended after them in term_id (creation) order.
 *
 * @package PrideOfAfrica
 */

$tours = new WP_Query( [
    'post_type'      => 'pride_tour',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
    // Only tours tagged with a Tour Category belong in this grid — other
    // pride_tour posts may exist solely for the "Featured Itineraries"
    // section and have no category to filter by.
    'tax_query'      => [
        [
            'taxonomy' => 'pride_tour_category',
            'operator' => 'EXISTS',
        ],
    ],
] );

if ( ! $tours->have_posts() ) {
    return;
}

$category_terms = get_terms( [
    'taxonomy'   => 'pride_tour_category',
    'hide_empty' => false,
] );
if ( is_wp_error( $category_terms ) ) {
    $category_terms = [];
}

$preferred_order = [ 'featured-packages', 'kenya', 'tanzania', 'multi-country', 'day-tours' ];
usort( $category_terms, function ( $a, $b ) use ( $preferred_order ) {
    $pos_a = array_search( $a->slug, $preferred_order, true );
    $pos_b = array_search( $b->slug, $preferred_order, true );
    $pos_a = false === $pos_a ? 999 + $a->term_id : $pos_a;
    $pos_b = false === $pos_b ? 999 + $b->term_id : $pos_b;
    return $pos_a <=> $pos_b;
} );

$default_filter = ! empty( $category_terms ) ? $category_terms[0]->slug : '';
?>

<section class="c-popular-tours l-section" id="popular-tours" aria-labelledby="tours-heading">
    <div class="u-container">

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Tours', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="tours-heading">
                <?php esc_html_e( 'Popular Tours', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-section-header__desc">
                <?php esc_html_e( 'Curated safari experiences for every traveler', 'pride-of-africa' ); ?>
            </p>
        </div>

        <?php if ( ! empty( $category_terms ) ) : ?>
        <div class="c-tours__filters" role="tablist" aria-label="<?php esc_attr_e( 'Filter tours by category', 'pride-of-africa' ); ?>" data-tours-filters>
            <?php foreach ( $category_terms as $i => $term ) : ?>
            <button
                type="button"
                class="c-tours__filter<?php echo ( 0 === $i ) ? ' c-tours__filter--active' : ''; ?>"
                data-tours-filter="<?php echo esc_attr( $term->slug ); ?>"
                role="tab"
                aria-selected="<?php echo ( 0 === $i ) ? 'true' : 'false'; ?>"
                tabindex="<?php echo ( 0 === $i ) ? '0' : '-1'; ?>"
            ><?php echo esc_html( $term->name ); ?></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="c-popular-tours__grid" data-tours-grid>
            <?php while ( $tours->have_posts() ) : $tours->the_post();
                $card_categories = wp_get_post_terms( get_the_ID(), 'pride_tour_category', [ 'fields' => 'slugs' ] );
                $is_default      = $default_filter && in_array( $default_filter, $card_categories, true );
                ?>
                <div class="c-tour-card-wrap<?php echo $is_default ? '' : ' c-tour-card-wrap--hidden'; ?>">
                    <?php get_template_part( 'template-parts/cards/tour-card' ); ?>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="c-popular-tours__footer">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'pride_tour' ) ); ?>" class="c-button c-button--outline">
                <?php esc_html_e( 'Browse All Tours', 'pride-of-africa' ); ?>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </div>
</section>

<script>
( function () {
    'use strict';
    var section = document.getElementById( 'popular-tours' );
    if ( ! section ) return;

    var filterBar = section.querySelector( '[data-tours-filters]' );
    var grid      = section.querySelector( '[data-tours-grid]' );
    if ( ! filterBar || ! grid ) return;

    var buttons = Array.prototype.slice.call( filterBar.querySelectorAll( '[data-tours-filter]' ) );
    var cards   = Array.prototype.slice.call( grid.querySelectorAll( '.c-tour-card-wrap' ) );

    function applyFilter( slug ) {
        cards.forEach( function ( card ) {
            var categories = ( card.querySelector( '.c-tour-card' ).dataset.tourCategories || '' ).split( ' ' );
            var matches    = categories.indexOf( slug ) !== -1;

            if ( matches ) {
                card.classList.remove( 'c-tour-card-wrap--hidden' );
                card.classList.remove( 'c-tour-card-wrap--leaving' );
            } else if ( ! card.classList.contains( 'c-tour-card-wrap--hidden' ) ) {
                card.classList.add( 'c-tour-card-wrap--leaving' );
                setTimeout( function () {
                    card.classList.add( 'c-tour-card-wrap--hidden' );
                    card.classList.remove( 'c-tour-card-wrap--leaving' );
                }, 200 );
            }
        } );
    }

    function activate( button, focus ) {
        buttons.forEach( function ( b ) {
            b.classList.remove( 'c-tours__filter--active' );
            b.setAttribute( 'aria-selected', 'false' );
            b.setAttribute( 'tabindex', '-1' );
        } );
        button.classList.add( 'c-tours__filter--active' );
        button.setAttribute( 'aria-selected', 'true' );
        button.setAttribute( 'tabindex', '0' );
        if ( focus ) button.focus();
        applyFilter( button.dataset.toursFilter );
    }

    buttons.forEach( function ( button, index ) {
        button.addEventListener( 'click', function () {
            activate( button, false );
        } );

        button.addEventListener( 'keydown', function ( e ) {
            var targetIndex = null;
            if ( e.key === 'ArrowRight' || e.key === 'ArrowDown' ) {
                targetIndex = ( index + 1 ) % buttons.length;
            } else if ( e.key === 'ArrowLeft' || e.key === 'ArrowUp' ) {
                targetIndex = ( index - 1 + buttons.length ) % buttons.length;
            } else if ( e.key === 'Home' ) {
                targetIndex = 0;
            } else if ( e.key === 'End' ) {
                targetIndex = buttons.length - 1;
            }
            if ( targetIndex !== null ) {
                e.preventDefault();
                activate( buttons[ targetIndex ], true );
            }
        } );
    } );
} )();
</script>
