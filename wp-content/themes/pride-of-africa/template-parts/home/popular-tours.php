<?php
/**
 * Template Part: Popular Tours
 *
 * File:   template-parts/home/popular-tours.php
 * Spec:   03-Master-UI-Specification-v3.md §9
 *         Grid: 3 Columns | Gap: 32px | Card Width: 392px
 *         Image: 340px | Price Badge: Top Right
 *         Duration Badge: Top Left | CTA: 48px
 *
 * @package PrideOfAfrica
 */

$tours = new WP_Query( [
    'post_type'      => 'pride_tour',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'meta_query'     => [
        [
            'key'     => '_tour_featured',
            'value'   => '1',
            'compare' => '=',
        ],
    ],
] );

// Fallback: any 6 tours if no featured set
if ( ! $tours->have_posts() ) {
    $tours = new WP_Query( [
        'post_type'      => 'pride_tour',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ] );
}

if ( ! $tours->have_posts() ) {
    return;
}
?>

<section class="c-popular-tours l-section l-section--alt" id="popular-tours" aria-labelledby="tours-heading">
    <div class="u-container">

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Handpicked For You', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="tours-heading">
                <?php esc_html_e( 'Popular Safari Tours', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-section-header__desc">
                <?php esc_html_e( 'Choose from our most loved safari experiences, each crafted to deliver extraordinary wildlife encounters.', 'pride-of-africa' ); ?>
            </p>
        </div>

        <div class="c-popular-tours__grid">
            <?php while ( $tours->have_posts() ) : $tours->the_post();
                get_template_part( 'template-parts/cards/tour-card' );
            endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="c-popular-tours__footer">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'pride_tour' ) ); ?>" class="c-button c-button--outline">
                <?php esc_html_e( 'Browse All Tours', 'pride-of-africa' ); ?>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </div>
</section>
