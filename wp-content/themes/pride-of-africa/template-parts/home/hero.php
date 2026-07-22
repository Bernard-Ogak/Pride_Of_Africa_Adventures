<?php
/**
 * Template Part: Hero Slider
 *
 * File:     template-parts/home/hero.php
 * Section:  Hero — Full-viewport slider with overlay, headline, CTA group, and scroll indicator.
 * Source:   ADAPTED — original spec expected a "hero_slide" CPT that does not exist
 *           in this theme. Slides are instead pulled from the existing Customizer
 *           settings via pride_of_africa_get_hero_slides() (see functions.php / the
 *           legacy template-parts/home-legacy/hero.php), so content already entered
 *           in the Customizer keeps working unchanged.
 * Spec:     01-Master-Design-Specification.md §11
 *           02-Master-UI-Specification-v2.md §11
 *           03-Master-UI-Specification-v3.md §4
 *           04-Component-Library-and-Pattern-Catalog.md §7
 *           05-WordPress-Theme-Architecture-Specification.md §4
 *
 * @package PrideOfAfrica
 */

// Pull slides from the Customizer via the theme's existing helper.
$raw_slides = function_exists( 'pride_of_africa_get_hero_slides' )
    ? pride_of_africa_get_hero_slides()
    : [];

// Bail silently if nothing is configured.
if ( empty( $raw_slides ) ) {
    return;
}

// Map the existing field names onto the ones this template expects.
$slides = array_map( function ( $s ) {
    return (object) [
        'heading'    => $s['title']              ?? '',
        'subheading' => $s['description']         ?? '',
        'cta_label'  => $s['btn_primary_text']    ?? '',
        'cta_url'    => $s['btn_primary_url']     ?? '',
        'btn_label'  => $s['btn_secondary_text']  ?? '',
        'btn_url'    => $s['btn_secondary_url']   ?? '',
        'image_url'  => $s['image_url']           ?? '',
    ];
}, $raw_slides );

$slide_count  = count( $slides );
$has_multiple = $slide_count > 1;
?>

<!-- =============================================
     c-hero  |  Hero Slider Section
     Height: 100vh / min 820px
     Overlay: rgba(0,0,0,.45)
     ============================================= -->
<section
    class="c-hero"
    id="c-hero"
    aria-label="<?php esc_attr_e( 'Featured destinations slideshow', 'pride-of-africa' ); ?>"
    data-hero-slider
    data-autoplay="true"
    data-interval="5000"
>

    <!-- ── Slide Track ───────────────────────── -->
    <div class="c-hero__track" role="list" aria-live="off">

        <?php
        $index = 0;
        foreach ( $slides as $slide ) :

            // ── Slide content ──────────────────────
            $heading    = $slide->heading;
            $subheading = $slide->subheading;
            $cta_label  = $slide->cta_label;
            $cta_url    = $slide->cta_url;
            $btn_label  = $slide->btn_label;
            $btn_url    = $slide->btn_url;

            // ── Background image ─────────────────
            // Customizer slides store a resolved URL rather than an attachment ID,
            // so no srcset is available here.
            $img_src    = $slide->image_url;
            $img_srcset = '';
            $img_alt    = $heading ?: get_bloginfo( 'name' );

            $is_active  = ( $index === 0 ) ? ' c-hero__slide--active' : '';
            $aria_hidden = ( $index === 0 ) ? 'false' : 'true';
            $tab_index   = ( $index === 0 ) ? '0' : '-1';
            $index++;
        ?>

        <div
            class="c-hero__slide<?php echo esc_attr( $is_active ); ?>"
            role="listitem"
            aria-hidden="<?php echo esc_attr( $aria_hidden ); ?>"
            aria-label="<?php echo esc_attr( sprintf(
                /* translators: %1$d: slide number, %2$d: total slides */
                __( 'Slide %1$d of %2$d', 'pride-of-africa' ),
                $index,
                $slide_count
            ) ); ?>"
        >

            <!-- Background image -->
            <?php if ( $img_src ) : ?>
            <div class="c-hero__bg" aria-hidden="true">
                <img
                    class="c-hero__bg-img"
                    src="<?php echo esc_url( $img_src ); ?>"
                    <?php if ( $img_srcset ) : ?>
                    srcset="<?php echo esc_attr( $img_srcset ); ?>"
                    sizes="100vw"
                    <?php endif; ?>
                    alt="<?php echo esc_attr( $img_alt ); ?>"
                    <?php echo ( $index > 1 ) ? 'loading="lazy"' : 'fetchpriority="high"'; ?>
                    decoding="async"
                >
            </div>
            <?php endif; ?>

            <!-- Dark overlay — rgba(0,0,0,.45) -->
            <div class="c-hero__overlay" aria-hidden="true"></div>

            <!-- ── Hero Content ─────────────────
                 Width:     760px (max)
                 Headline:  680px (max)
                 Paragraph: 620px (max)
                 Buttons:   56px height
                 ─────────────────────────────── -->
            <div class="c-hero__content">
                <div class="u-container">

                    <?php if ( $heading ) : ?>
                    <h1
                        class="c-hero__headline"
                        tabindex="<?php echo esc_attr( $tab_index ); ?>"
                    >
                        <?php echo esc_html( $heading ); ?>
                    </h1>
                    <?php endif; ?>

                    <?php if ( $subheading ) : ?>
                    <p class="c-hero__subheading">
                        <?php echo esc_html( $subheading ); ?>
                    </p>
                    <?php endif; ?>

                    <!-- CTA Group — gap: 20px -->
                    <div class="c-hero__cta-group" role="group" aria-label="<?php esc_attr_e( 'Call to action', 'pride-of-africa' ); ?>">

                        <?php if ( $cta_label && $cta_url ) : ?>
                        <a
                            href="<?php echo esc_url( $cta_url ); ?>"
                            class="c-button c-button--primary c-button--hero"
                            tabindex="<?php echo esc_attr( $tab_index ); ?>"
                        >
                            <?php echo esc_html( $cta_label ); ?>
                        </a>
                        <?php endif; ?>

                        <?php if ( $btn_label && $btn_url ) : ?>
                        <a
                            href="<?php echo esc_url( $btn_url ); ?>"
                            class="c-button c-button--secondary c-button--hero"
                            tabindex="<?php echo esc_attr( $tab_index ); ?>"
                        >
                            <?php echo esc_html( $btn_label ); ?>
                        </a>
                        <?php endif; ?>

                    </div><!-- /.c-hero__cta-group -->

                </div><!-- /.u-container -->
            </div><!-- /.c-hero__content -->

        </div><!-- /.c-hero__slide -->

        <?php endforeach; ?>

    </div><!-- /.c-hero__track -->


    <?php if ( $has_multiple ) : ?>

    <!-- ── Slider Controls ───────────────────── -->
    <div class="c-hero__controls" aria-label="<?php esc_attr_e( 'Slider controls', 'pride-of-africa' ); ?>">

        <button
            class="c-hero__arrow c-hero__arrow--prev"
            aria-label="<?php esc_attr_e( 'Previous slide', 'pride-of-africa' ); ?>"
            data-hero-prev
            type="button"
        >
            <i class="bi bi-chevron-left" aria-hidden="true"></i>
        </button>

        <!-- Pagination dots -->
        <div class="c-hero__pagination" role="tablist" aria-label="<?php esc_attr_e( 'Slide navigation', 'pride-of-africa' ); ?>">
            <?php for ( $i = 0; $i < $slide_count; $i++ ) : ?>
            <button
                class="c-hero__dot<?php echo ( $i === 0 ) ? ' c-hero__dot--active' : ''; ?>"
                role="tab"
                aria-selected="<?php echo ( $i === 0 ) ? 'true' : 'false'; ?>"
                aria-label="<?php echo esc_attr( sprintf(
                    /* translators: %d: slide number */
                    __( 'Go to slide %d', 'pride-of-africa' ),
                    $i + 1
                ) ); ?>"
                data-hero-dot="<?php echo esc_attr( $i ); ?>"
                type="button"
            ></button>
            <?php endfor; ?>
        </div>

        <button
            class="c-hero__arrow c-hero__arrow--next"
            aria-label="<?php esc_attr_e( 'Next slide', 'pride-of-africa' ); ?>"
            data-hero-next
            type="button"
        >
            <i class="bi bi-chevron-right" aria-hidden="true"></i>
        </button>

    </div><!-- /.c-hero__controls -->

    <?php endif; ?>

</section><!-- /.c-hero -->


<!-- =============================================
     Trip Planner Bar — floats over hero bottom
     Width: 1240px | Height: 140px | Padding: 32px
     Loaded as a separate template part per §4
     ============================================= -->
<?php get_template_part( 'template-parts/home/trip-planner' ); ?>


<!-- =============================================
     Hero Slider — Vanilla JS (deferred)
     No jQuery dependency. Follows motion spec:
     Crossfade: 500ms | Autoplay: 5000ms
     Supports: prefers-reduced-motion
     ============================================= -->
<script>
( function () {
    'use strict';

    const section   = document.querySelector( '[data-hero-slider]' );
    if ( ! section ) return;

    const slides    = section.querySelectorAll( '.c-hero__slide' );
    const dots      = section.querySelectorAll( '[data-hero-dot]' );
    const prevBtn   = section.querySelector( '[data-hero-prev]' );
    const nextBtn   = section.querySelector( '[data-hero-next]' );
    const total     = slides.length;

    if ( total < 2 ) return;

    let current  = 0;
    let timer    = null;
    const INTERVAL = parseInt( section.dataset.interval, 10 ) || 5000;

    // Respect prefers-reduced-motion
    const prefersReduced = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

    function goTo( index ) {
        slides[ current ].classList.remove( 'c-hero__slide--active' );
        slides[ current ].setAttribute( 'aria-hidden', 'true' );
        slides[ current ].querySelectorAll( 'a, button' ).forEach( el => el.setAttribute( 'tabindex', '-1' ) );

        if ( dots[ current ] ) {
            dots[ current ].classList.remove( 'c-hero__dot--active' );
            dots[ current ].setAttribute( 'aria-selected', 'false' );
        }

        current = ( index + total ) % total;

        slides[ current ].classList.add( 'c-hero__slide--active' );
        slides[ current ].setAttribute( 'aria-hidden', 'false' );
        slides[ current ].querySelectorAll( 'a, button' ).forEach( el => el.setAttribute( 'tabindex', '0' ) );

        if ( dots[ current ] ) {
            dots[ current ].classList.add( 'c-hero__dot--active' );
            dots[ current ].setAttribute( 'aria-selected', 'true' );
        }
    }

    function startAutoplay() {
        if ( prefersReduced ) return;
        stopAutoplay();
        timer = setInterval( () => goTo( current + 1 ), INTERVAL );
    }

    function stopAutoplay() {
        if ( timer ) clearInterval( timer );
    }

    if ( prevBtn ) prevBtn.addEventListener( 'click', () => { goTo( current - 1 ); startAutoplay(); } );
    if ( nextBtn ) nextBtn.addEventListener( 'click', () => { goTo( current + 1 ); startAutoplay(); } );

    dots.forEach( dot => {
        dot.addEventListener( 'click', () => {
            goTo( parseInt( dot.dataset.heroDot, 10 ) );
            startAutoplay();
        } );
    } );

    // Pause on hover / focus
    section.addEventListener( 'mouseenter', stopAutoplay );
    section.addEventListener( 'mouseleave', startAutoplay );
    section.addEventListener( 'focusin',    stopAutoplay );
    section.addEventListener( 'focusout',   startAutoplay );

    // Keyboard: left/right arrows
    section.addEventListener( 'keydown', ( e ) => {
        if ( e.key === 'ArrowLeft'  ) { goTo( current - 1 ); startAutoplay(); }
        if ( e.key === 'ArrowRight' ) { goTo( current + 1 ); startAutoplay(); }
    } );

    startAutoplay();

} )();
</script>
