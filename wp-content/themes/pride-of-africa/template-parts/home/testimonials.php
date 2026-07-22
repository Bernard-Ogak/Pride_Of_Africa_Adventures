<?php
/**
 * Template Part: Testimonials
 * File:   template-parts/home/testimonials.php
 *
 * Rebuilt to match the Testimonials reference screenshot: light
 * background, a verification legend, platform filter pills (All /
 * TripAdvisor / SafariBookings / Trustpilot) with prev/next controls,
 * and a 3-cards-per-page grid that pages through the filtered set.
 *
 * @package PrideOfAfrica
 */

$testimonials = new WP_Query( [
    'post_type'      => 'pride_testimonial',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );

if ( ! $testimonials->have_posts() ) {
    return;
}

$items = $testimonials->posts;
$count = count( $items );

$platform_filters = [
    ''               => __( 'All',            'pride-of-africa' ),
    'tripadvisor'    => __( 'TripAdvisor',     'pride-of-africa' ),
    'safaribookings' => __( 'SafariBookings',  'pride-of-africa' ),
    'trustpilot'     => __( 'Trustpilot',      'pride-of-africa' ),
];
?>

<section class="c-testimonials l-section" id="testimonials" aria-labelledby="testimonials-heading">
    <div class="u-container">

        <div class="c-testimonials__header">
            <div class="c-section-header c-section-header--start">
                <span class="c-badge c-badge--accent"><?php esc_html_e( 'Testimonials', 'pride-of-africa' ); ?></span>
                <h2 class="c-section-header__title" id="testimonials-heading"><?php esc_html_e( 'What Our Travelers Say', 'pride-of-africa' ); ?></h2>
                <ul class="c-testimonials__legend">
                    <li><i class="bi bi-shield-check" aria-hidden="true"></i> <?php esc_html_e( 'Verified on TripAdvisor', 'pride-of-africa' ); ?></li>
                    <li><i class="bi bi-shield-check" aria-hidden="true"></i> <?php esc_html_e( 'SafariBookings Reviewed', 'pride-of-africa' ); ?></li>
                    <li><i class="bi bi-shield-check" aria-hidden="true"></i> <?php esc_html_e( 'Trustpilot Rated', 'pride-of-africa' ); ?></li>
                </ul>
            </div>

            <div class="c-testimonials__filterbar" data-testimonials-filterbar>
                <div class="c-testimonials__filters" role="tablist" aria-label="<?php esc_attr_e( 'Filter testimonials by platform', 'pride-of-africa' ); ?>">
                    <?php foreach ( $platform_filters as $value => $label ) : ?>
                    <button
                        type="button"
                        class="c-testimonials__filter<?php echo ( '' === $value ) ? ' c-testimonials__filter--active' : ''; ?>"
                        data-testimonials-filter="<?php echo esc_attr( $value ); ?>"
                        role="tab"
                        aria-selected="<?php echo ( '' === $value ) ? 'true' : 'false'; ?>"
                    ><?php echo esc_html( $label ); ?></button>
                    <?php endforeach; ?>
                </div>
                <div class="c-testimonials__controls" aria-label="<?php esc_attr_e( 'Testimonials pagination', 'pride-of-africa' ); ?>">
                    <button class="c-testimonials__arrow c-testimonials__arrow--prev" type="button"
                            aria-label="<?php esc_attr_e( 'Previous page', 'pride-of-africa' ); ?>" data-test-prev>
                        <i class="bi bi-chevron-left" aria-hidden="true"></i>
                    </button>
                    <button class="c-testimonials__arrow c-testimonials__arrow--next" type="button"
                            aria-label="<?php esc_attr_e( 'Next page', 'pride-of-africa' ); ?>" data-test-next>
                        <i class="bi bi-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="c-testimonials__grid" data-testimonials-grid>
            <?php foreach ( $items as $item ) :
                get_template_part( 'template-parts/cards/testimonial-card', null, [ 'post' => $item ] );
            endforeach; ?>
        </div>

    </div>
</section>

<script>
( function () {
    'use strict';
    const section = document.getElementById( 'testimonials' );
    if ( ! section ) return;

    const grid       = section.querySelector( '[data-testimonials-grid]' );
    const cards      = Array.from( grid.querySelectorAll( '.c-testimonial-card' ) );
    const filterBtns = section.querySelectorAll( '[data-testimonials-filter]' );
    const prevBtn    = section.querySelector( '[data-test-prev]' );
    const nextBtn    = section.querySelector( '[data-test-next]' );
    const PER_PAGE   = 3;

    let activeFilter = '';
    let page = 0;

    function filtered() {
        return activeFilter
            ? cards.filter( c => c.dataset.platform === activeFilter )
            : cards;
    }

    function render() {
        const list = filtered();
        const totalPages = Math.max( 1, Math.ceil( list.length / PER_PAGE ) );
        page = ( page + totalPages ) % totalPages;

        cards.forEach( c => { c.style.display = 'none'; } );
        list.slice( page * PER_PAGE, page * PER_PAGE + PER_PAGE ).forEach( c => { c.style.display = ''; } );

        if ( prevBtn ) prevBtn.disabled = totalPages <= 1;
        if ( nextBtn ) nextBtn.disabled = totalPages <= 1;
    }

    filterBtns.forEach( btn => {
        btn.addEventListener( 'click', function () {
            filterBtns.forEach( b => { b.classList.remove( 'c-testimonials__filter--active' ); b.setAttribute( 'aria-selected', 'false' ); } );
            this.classList.add( 'c-testimonials__filter--active' );
            this.setAttribute( 'aria-selected', 'true' );
            activeFilter = this.dataset.testimonialsFilter || '';
            page = 0;
            render();
        } );
    } );

    if ( prevBtn ) prevBtn.addEventListener( 'click', () => { page -= 1; render(); } );
    if ( nextBtn ) nextBtn.addEventListener( 'click', () => { page += 1; render(); } );

    render();
} )();
</script>
