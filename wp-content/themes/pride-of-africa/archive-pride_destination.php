<?php
/**
 * Archive template for destinations.
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <header class="mb-5 text-center">
            <p class="text-uppercase text-primary fw-semibold mb-2">Destinations</p>
            <h1 class="display-5 fw-bold mb-3">Discover the places that inspire every safari</h1>
            <p class="lead text-muted">Browse the countries and landscapes that shape our itineraries.</p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="row g-4">
                <?php while (have_posts()) : the_post(); ?>
                    <?php $country_terms = wp_get_post_terms(get_the_ID(), 'pride_country', ['fields' => 'names']); ?>
                    <article class="col-lg-4">
                        <div class="card h-100 shadow-sm border-0 overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'card-img-top', 'style' => 'height: 220px; object-fit: cover;']); ?>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="text-muted small mb-2">
                                    <?php echo !empty($country_terms) ? esc_html(implode(', ', $country_terms)) : esc_html__('Featured destination', 'pride-of-africa'); ?>
                                </div>
                                <h2 class="h5 fw-bold"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h2>
                                <p class="mb-3 text-muted"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">View destination</a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info">No destinations published yet.</div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
