<?php
/**
 * Template Part: Testimonials
 * File:   template-parts/home/testimonials.php
 * Spec:   03-Master-UI-Specification-v3.md §13
 *         Dark Background: Full Width | Card Width: 420px
 *         Card Height: 360px | Padding: 36px | Avatar: 70px
 *         Quote Margin: 24px | Navigation Buttons: 48px
 * @package PrideOfAfrica
 */

$testimonials = new WP_Query( [
    'post_type'      => 'pride_testimonial',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );

if ( ! $testimonials->have_posts() ) {
    return;
}

$items = $testimonials->posts;
$count = count( $items );
?>

<section class="c-testimonials l-section l-section--dark" id="testimonials" aria-labelledby="testimonials-heading">
    <div class="u-container">

        <div class="c-section-header c-section-header--light">
            <span class="c-badge c-badge--light"><?php esc_html_e( 'What Travellers Say', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="testimonials-heading"><?php esc_html_e( 'Safari Stories', 'pride-of-africa' ); ?></h2>
            <p class="c-section-header__desc"><?php esc_html_e( 'Real experiences from travellers who have journeyed with Pride of Africa.', 'pride-of-africa' ); ?></p>
        </div>

        <div class="c-testimonials__slider" data-testimonials-slider aria-live="off">
            <div class="c-testimonials__track">
                <?php foreach ( $items as $i => $item ) :
                    setup_postdata( $item );
                    get_template_part( 'template-parts/cards/testimonial-card', null, [ 'index' => $i, 'total' => $count ] );
                endforeach;
                wp_reset_postdata(); ?>
            </div>
        </div>

        <?php if ( $count > 1 ) : ?>
        <div class="c-testimonials__controls" aria-label="<?php esc_attr_e( 'Testimonials navigation', 'pride-of-africa' ); ?>">
            <button class="c-testimonials__arrow c-testimonials__arrow--prev" type="button"
                    aria-label="<?php esc_attr_e( 'Previous testimonial', 'pride-of-africa' ); ?>" data-test-prev>
                <i class="bi bi-chevron-left" aria-hidden="true"></i>
            </button>
            <div class="c-testimonials__pagination" role="tablist">
                <?php for ( $i = 0; $i < $count; $i++ ) : ?>
                <button class="c-testimonials__dot<?php echo $i === 0 ? ' c-testimonials__dot--active' : ''; ?>"
                        role="tab" aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                        aria-label="<?php echo esc_attr( sprintf( __( 'Go to testimonial %d', 'pride-of-africa' ), $i + 1 ) ); ?>"
                        data-test-dot="<?php echo esc_attr( $i ); ?>" type="button"></button>
                <?php endfor; ?>
            </div>
            <button class="c-testimonials__arrow c-testimonials__arrow--next" type="button"
                    aria-label="<?php esc_attr_e( 'Next testimonial', 'pride-of-africa' ); ?>" data-test-next>
                <i class="bi bi-chevron-right" aria-hidden="true"></i>
            </button>
        </div>
        <?php endif; ?>

    </div>
</section>

<script>
( function () {
    'use strict';
    const section = document.querySelector( '[data-testimonials-slider]' );
    if ( ! section ) return;
    const cards  = section.querySelectorAll( '.c-testimonial-card' );
    const dots   = document.querySelectorAll( '[data-test-dot]' );
    const prev   = document.querySelector( '[data-test-prev]' );
    const next   = document.querySelector( '[data-test-next]' );
    const total  = cards.length;
    if ( total < 2 ) return;
    let cur = 0;

    function goTo( i ) {
        cards[cur].classList.remove( 'c-testimonial-card--active' );
        cards[cur].setAttribute( 'aria-hidden', 'true' );
        if ( dots[cur] ) { dots[cur].classList.remove( 'c-testimonials__dot--active' ); dots[cur].setAttribute( 'aria-selected', 'false' ); }
        cur = ( i + total ) % total;
        cards[cur].classList.add( 'c-testimonial-card--active' );
        cards[cur].setAttribute( 'aria-hidden', 'false' );
        if ( dots[cur] ) { dots[cur].classList.add( 'c-testimonials__dot--active' ); dots[cur].setAttribute( 'aria-selected', 'true' ); }
    }

    if ( prev ) prev.addEventListener( 'click', () => goTo( cur - 1 ) );
    if ( next ) next.addEventListener( 'click', () => goTo( cur + 1 ) );
    dots.forEach( d => d.addEventListener( 'click', () => goTo( parseInt( d.dataset.testDot, 10 ) ) ) );

    const reduced = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
    if ( ! reduced ) setInterval( () => goTo( cur + 1 ), 6000 );
} )();
</script>
