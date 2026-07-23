<?php
/**
 * Template Part: Why Choose Us / Trust Section
 * File:   template-parts/home/trust.php
 *
 * Renders pride_feature posts dynamically — order via each post's
 * native "Order" field, visibility via Publish/Draft status. Falls
 * back to nothing (section hides) if no features are published, same
 * as every other content-driven homepage section in this theme.
 *
 * @package PrideOfAfrica
 */

$features = new WP_Query( [
    'post_type'      => 'pride_feature',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );

if ( ! $features->have_posts() ) {
    return;
}
?>

<section class="c-trust l-section" id="why-choose-us" aria-labelledby="trust-heading">
    <div class="u-container">

        <div class="c-trust__header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Why Choose Us', 'pride-of-africa' ); ?></span>
            <h2 class="c-trust__heading" id="trust-heading">
                <?php esc_html_e( 'Why Choose Us', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-trust__subheading">
                <?php esc_html_e( 'Your African adventure deserves local expertise', 'pride-of-africa' ); ?>
            </p>
        </div>

        <ul class="c-trust__grid" data-fade-up-group>
            <?php while ( $features->have_posts() ) : $features->the_post();
                $icon = get_post_meta( get_the_ID(), '_feature_icon', true ) ?: 'bi-star';
                ?>
            <li>
                <article class="c-trust__card" data-fade-up>
                    <div class="c-trust__icon-wrap">
                        <i class="bi <?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
                    </div>
                    <h3 class="c-trust__card-title"><?php the_title(); ?></h3>
                    <p class="c-trust__card-desc"><?php echo esc_html( get_the_excerpt() ?: wp_trim_words( get_the_content(), 30, '…' ) ); ?></p>
                </article>
            </li>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>

    </div>
</section>

<script>
( function () {
    'use strict';
    var group = document.querySelector( '#why-choose-us [data-fade-up-group]' );
    if ( ! group ) return;

    var items = Array.prototype.slice.call( group.querySelectorAll( '[data-fade-up]' ) );
    var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

    if ( reduceMotion || typeof IntersectionObserver === 'undefined' ) {
        items.forEach( function ( el ) { el.classList.add( 'is-visible' ); } );
        return;
    }

    var observer = new IntersectionObserver( function ( entries ) {
        entries.forEach( function ( entry ) {
            if ( entry.isIntersecting ) {
                entry.target.classList.add( 'is-visible' );
                observer.unobserve( entry.target );
            }
        } );
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' } );

    items.forEach( function ( el, i ) {
        el.style.transitionDelay = ( i % 3 ) * 80 + 'ms';
        observer.observe( el );
    } );
} )();
</script>
