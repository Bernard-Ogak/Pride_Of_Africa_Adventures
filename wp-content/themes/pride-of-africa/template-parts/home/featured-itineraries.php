<?php
/**
 * Template Part: Featured Itineraries ("Luxury Safari Collection")
 * File:   template-parts/home/featured-itineraries.php
 *
 * Only pride_tour posts explicitly checked "Featured on Homepage"
 * (_tour_itinerary_featured) are shown — no random fallback — so an
 * admin fully controls what appears here. Order via each post's native
 * "Order" field (page-attributes, already supported on pride_tour).
 *
 * @package PrideOfAfrica
 */

$itineraries = new WP_Query( [
    'post_type'      => 'pride_tour',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'meta_query'     => [
        [
            'key'     => '_tour_itinerary_featured',
            'value'   => '1',
            'compare' => '=',
        ],
    ],
] );

if ( ! $itineraries->have_posts() ) {
    return;
}

$badge_dark = [ 'signature' ];
?>

<section class="c-itineraries l-section" id="featured-itineraries" aria-labelledby="itineraries-heading">
    <div class="u-container">

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Luxury Safari Collection', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="itineraries-heading">
                <?php esc_html_e( 'Featured Itineraries', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-section-header__desc">
                <?php esc_html_e( 'Discover our hand-crafted luxury safari journeys across Kenya and Tanzania — designed to combine iconic wildlife, premium lodges, and unforgettable landscapes.', 'pride-of-africa' ); ?>
            </p>
        </div>

        <div class="c-itineraries__grid" data-fade-up-group>

            <?php while ( $itineraries->have_posts() ) : $itineraries->the_post();
                $post_id    = get_the_ID();
                $badge      = get_post_meta( $post_id, '_tour_itinerary_badge', true );
                $duration   = get_post_meta( $post_id, '_tour_duration', true );
                $route      = get_post_meta( $post_id, '_tour_itinerary_route', true );
                $highlights = array_filter( array_map( 'trim', explode( "\n", (string) get_post_meta( $post_id, '_tour_itinerary_highlights', true ) ) ) );
                $quote      = get_post_meta( $post_id, '_tour_itinerary_quote', true );
                $cta_label  = get_post_meta( $post_id, '_tour_itinerary_cta_label', true ) ?: __( 'View Itinerary', 'pride-of-africa' );
                $cta_url    = get_post_meta( $post_id, '_tour_itinerary_cta_url', true ) ?: get_permalink();

                $stops = array_filter( array_map( 'trim', explode( '>', (string) $route ) ) );

                $img_id  = get_post_thumbnail_id();
                $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';

                $badge_class = in_array( strtolower( $badge ), $badge_dark, true ) ? ' c-itinerary-card__badge--dark' : '';
            ?>

            <article class="c-itinerary-card" data-fade-up>

                <div class="c-itinerary-card__image-wrap">
                    <?php if ( $img_url ) : ?>
                    <img
                        class="c-itinerary-card__image"
                        src="<?php echo esc_url( $img_url ); ?>"
                        alt="<?php echo esc_attr( get_the_title() ); ?>"
                        loading="lazy"
                        decoding="async"
                    >
                    <?php endif; ?>

                    <?php if ( $badge ) : ?>
                    <span class="c-itinerary-card__badge<?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $badge ); ?></span>
                    <?php endif; ?>

                    <?php if ( $duration ) : ?>
                    <span class="c-badge c-badge--overlay c-badge--dark c-itinerary-card__duration">
                        <i class="bi bi-clock" aria-hidden="true"></i>
                        <?php echo esc_html( $duration ); ?>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="c-itinerary-card__body">
                    <h3 class="c-itinerary-card__title">
                        <a href="<?php echo esc_url( $cta_url ); ?>"><?php the_title(); ?></a>
                    </h3>

                    <?php if ( $stops ) : ?>
                    <div class="c-itinerary-card__route">
                        <span class="c-itinerary-card__route-label"><?php esc_html_e( 'Route', 'pride-of-africa' ); ?></span>
                        <ol class="c-itinerary-card__route-stops">
                            <?php foreach ( $stops as $i => $stop ) : ?>
                            <li>
                                <?php if ( $i > 0 ) : ?><i class="bi bi-chevron-right c-itinerary-card__route-sep" aria-hidden="true"></i><?php endif; ?>
                                <span><?php echo esc_html( $stop ); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                    <?php endif; ?>

                    <?php if ( $highlights ) : ?>
                    <div class="c-itinerary-card__highlights">
                        <span class="c-itinerary-card__highlights-label"><?php esc_html_e( 'Highlights', 'pride-of-africa' ); ?></span>
                        <ul>
                            <?php foreach ( $highlights as $highlight ) : ?>
                            <li><i class="bi bi-star-fill" aria-hidden="true"></i> <?php echo esc_html( $highlight ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if ( $quote ) : ?>
                    <blockquote class="c-itinerary-card__quote">
                        <?php echo esc_html( $quote ); ?>
                    </blockquote>
                    <?php endif; ?>

                    <a href="<?php echo esc_url( $cta_url ); ?>" class="c-button c-button--primary c-itinerary-card__cta">
                        <?php echo esc_html( $cta_label ); ?>
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>

            </article>

            <?php endwhile; wp_reset_postdata(); ?>

        </div>

        <div class="c-itineraries__callout">
            <p class="c-itineraries__callout-text">
                <?php esc_html_e( 'Looking for a custom itinerary tailored to your schedule?', 'pride-of-africa' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="c-button c-button--outline c-button--light">
                <?php esc_html_e( 'Request a Bespoke Safari', 'pride-of-africa' ); ?>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </div>
</section>

<script>
( function () {
    'use strict';
    var group = document.querySelector( '#featured-itineraries [data-fade-up-group]' );
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
        el.style.transitionDelay = ( i % 3 ) * 100 + 'ms';
        observer.observe( el );
    } );
} )();
</script>
