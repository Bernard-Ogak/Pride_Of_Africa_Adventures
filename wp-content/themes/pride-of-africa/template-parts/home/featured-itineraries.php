<?php
/**
 * Template Part: Featured Itineraries
 *
 * File:   template-parts/home/featured-itineraries.php
 * Spec:   03-Master-UI-Specification-v3.md §10
 *         Card Width: 620px | Card Height: 440px
 *         Content Width: 50% | Image Width: 50% | Gap: 40px
 *
 * @package PrideOfAfrica
 */

$itineraries = new WP_Query( [
    'post_type'      => 'pride_tour',
    'posts_per_page' => 4,
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
    $itineraries = new WP_Query( [
        'post_type'      => 'pride_tour',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'orderby'        => 'rand',
    ] );
}

if ( ! $itineraries->have_posts() ) {
    return;
}
?>

<section class="c-itineraries l-section" id="featured-itineraries" aria-labelledby="itineraries-heading">
    <div class="u-container">

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Curated Journeys', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="itineraries-heading">
                <?php esc_html_e( 'Featured Itineraries', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-section-header__desc">
                <?php esc_html_e( 'Day-by-day journeys through Africa\'s most remarkable wilderness areas.', 'pride-of-africa' ); ?>
            </p>
        </div>

        <div class="c-itineraries__grid">

            <?php $idx = 0; while ( $itineraries->have_posts() ) : $itineraries->the_post();
                $post_id  = get_the_ID();
                $duration = get_post_meta( $post_id, '_tour_duration', true );
                $price    = get_post_meta( $post_id, '_tour_price',    true );
                $country  = get_post_meta( $post_id, '_tour_country',  true );
                $img_id   = get_post_thumbnail_id();
                $img_url  = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
                $reverse  = ( $idx % 2 !== 0 ) ? ' c-itinerary-card--reverse' : '';
                $idx++;
            ?>

            <article class="c-itinerary-card<?php echo esc_attr( $reverse ); ?>">

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
                    <?php if ( $duration ) : ?>
                    <span class="c-badge c-badge--overlay c-badge--duration">
                        <i class="bi bi-clock" aria-hidden="true"></i>
                        <?php echo esc_html( $duration ); ?>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="c-itinerary-card__body">
                    <?php if ( $country ) : ?>
                    <span class="c-badge c-badge--country">
                        <i class="bi bi-geo-alt" aria-hidden="true"></i>
                        <?php echo esc_html( $country ); ?>
                    </span>
                    <?php endif; ?>

                    <h3 class="c-itinerary-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <p class="c-itinerary-card__excerpt">
                        <?php echo esc_html( wp_trim_words( get_the_excerpt(), 25, '…' ) ); ?>
                    </p>

                    <div class="c-itinerary-card__footer">
                        <?php if ( $price ) : ?>
                        <span class="c-itinerary-card__price">
                            <?php esc_html_e( 'From', 'pride-of-africa' ); ?>
                            <strong><?php echo esc_html( $price ); ?></strong>
                            <em><?php esc_html_e( 'per person', 'pride-of-africa' ); ?></em>
                        </span>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="c-button c-button--primary">
                            <?php esc_html_e( 'View Itinerary', 'pride-of-africa' ); ?>
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

            </article>

            <?php endwhile; wp_reset_postdata(); ?>

        </div>

    </div>
</section>
