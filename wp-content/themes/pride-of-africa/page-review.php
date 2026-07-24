<?php
/**
 * Template Name: Review Hub
 * File:   page-review.php
 *
 * The central "choose a platform" destination the QR code and every
 * "Leave a Review" link points to. Platforms are pride_review_site
 * posts — published = enabled, ordered by each post's native Order
 * field, logo = featured image, everything editable from wp-admin.
 *
 * @package Pride_Of_Africa
 */

get_header();

$platforms = new WP_Query( [
    'post_type'      => 'pride_review_site',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );
?>

<main id="primary">
    <section class="c-review-hub l-section">
        <div class="u-container">
            <div class="c-review-hub__grid">

                <div class="c-review-hub__intro">
                    <span class="c-badge c-badge--accent"><?php esc_html_e( 'Leave a Review', 'pride-of-africa' ); ?></span>
                    <h1 class="c-review-hub__title"><?php esc_html_e( 'Leave a Review', 'pride-of-africa' ); ?></h1>
                    <p class="c-review-hub__text">
                        <?php esc_html_e( 'Thank you for choosing Pride of Africa Adventures & Safaris. We hope your safari exceeded your expectations. Your review helps future travelers discover authentic African adventures. Please choose your preferred platform below.', 'pride-of-africa' ); ?>
                    </p>
                </div>

                <div class="c-review-hub__action">

                    <?php get_template_part( 'template-parts/cards/review-qr-code' ); ?>

                    <?php if ( $platforms->have_posts() ) : ?>
                    <form id="review-platform-form" novalidate>
                        <fieldset class="c-review-hub__fieldset">
                            <legend class="c-review-hub__legend"><?php esc_html_e( 'Choose a review platform', 'pride-of-africa' ); ?></legend>

                            <div class="c-review-hub__platforms">
                                <?php $i = 0; while ( $platforms->have_posts() ) : $platforms->the_post();
                                    $post_id = get_the_ID();
                                    $url     = get_post_meta( $post_id, '_review_site_url', true );
                                    $tag     = get_post_meta( $post_id, '_review_site_tag', true );
                                    $logo_id = get_post_thumbnail_id();
                                    $logo    = $logo_id ? wp_get_attachment_image_url( $logo_id, 'thumbnail' ) : '';
                                    $i++;
                                ?>
                                <label class="c-review-hub__platform">
                                    <input
                                        type="radio"
                                        name="review_platform"
                                        value="<?php echo esc_attr( $url ); ?>"
                                        <?php checked( 1 === $i ); ?>
                                        required
                                    >
                                    <span class="c-review-hub__platform-logo">
                                        <?php if ( $logo ) : ?>
                                            <img src="<?php echo esc_url( $logo ); ?>" alt="" loading="lazy" width="32" height="32">
                                        <?php else : ?>
                                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                                        <?php endif; ?>
                                    </span>
                                    <span class="c-review-hub__platform-name"><?php the_title(); ?></span>
                                    <?php if ( $tag ) : ?>
                                    <span class="c-review-hub__platform-tag"><?php echo esc_html( $tag ); ?></span>
                                    <?php endif; ?>
                                    <span class="c-review-hub__platform-radio" aria-hidden="true"></span>
                                </label>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        </fieldset>

                        <p class="c-review-hub__error" id="review-platform-error" role="alert" hidden>
                            <?php esc_html_e( 'Please select a review platform before continuing.', 'pride-of-africa' ); ?>
                        </p>

                        <button type="submit" class="c-button c-button--primary c-review-hub__submit">
                            <?php esc_html_e( 'Continue to Review', 'pride-of-africa' ); ?>
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </button>
                    </form>
                    <?php else : ?>
                        <p><?php esc_html_e( 'Review platforms will appear here once they are added in wp-admin.', 'pride-of-africa' ); ?></p>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </section>
</main>

<script>
( function () {
    'use strict';
    var form = document.getElementById( 'review-platform-form' );
    if ( ! form ) return;

    var error = document.getElementById( 'review-platform-error' );

    form.addEventListener( 'submit', function ( e ) {
        e.preventDefault();
        var selected = form.querySelector( 'input[name="review_platform"]:checked' );

        if ( ! selected || ! selected.value ) {
            error.hidden = false;
            return;
        }

        error.hidden = true;
        window.location.href = selected.value;
    } );

    form.querySelectorAll( 'input[name="review_platform"]' ).forEach( function ( input ) {
        input.addEventListener( 'change', function () { error.hidden = true; } );
    } );
} )();
</script>

<?php get_footer(); ?>
