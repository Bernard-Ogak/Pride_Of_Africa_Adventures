<?php
/**
 * Template Part: Top Destinations
 *
 * File:   template-parts/home/destinations.php
 * Spec:   03-Master-UI-Specification-v3.md §8
 *         Desktop: 3 Columns | Gap: 32px
 *         Card Height: 480px | Image Height: 320px
 *         Content Padding: 24px | Badge Height: 34px
 *         Badge Radius: 999px | Hover Lift: -8px
 *
 * @package PrideOfAfrica
 */

$destinations = new WP_Query( [
    'post_type'      => 'pride_destination',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
] );

if ( ! $destinations->have_posts() ) {
    return;
}
?>

<section class="c-destinations l-section" id="top-destinations" aria-labelledby="destinations-heading">
    <div class="u-container">

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Where To Go', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="destinations-heading">
                <?php esc_html_e( 'Top Safari Destinations', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-section-header__desc">
                <?php esc_html_e( 'Discover Africa\'s most breathtaking wildlife corridors and iconic safari landscapes.', 'pride-of-africa' ); ?>
            </p>
        </div>

        <div class="c-destinations__grid">
            <?php while ( $destinations->have_posts() ) : $destinations->the_post();
                get_template_part( 'template-parts/cards/destination-card' );
            endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="c-destinations__footer">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'pride_destination' ) ); ?>" class="c-button c-button--outline">
                <?php esc_html_e( 'View All Destinations', 'pride-of-africa' ); ?>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </div>
</section>
