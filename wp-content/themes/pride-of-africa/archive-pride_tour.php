<?php
/**
 * Archive template for tours.
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <header class="mb-5 text-center">
            <p class="text-uppercase text-primary fw-semibold mb-2">Tours</p>
            <h1 class="display-5 fw-bold mb-3">Find a tour that matches your travel style</h1>
            <p class="lead text-muted">From wildlife-focused safaris to beach escapes, each journey is designed around comfort and discovery.</p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="row g-4">
                <?php while (have_posts()) : the_post(); ?>
                    <?php $tour_terms = wp_get_post_terms(get_the_ID(), ['pride_country', 'pride_safari_type', 'pride_duration'], ['fields' => 'names']); ?>
                    <article class="col-lg-4">
                        <div class="card h-100 shadow-sm border-0 overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'card-img-top', 'style' => 'height: 220px; object-fit: cover;']); ?>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="text-muted small mb-2">
                                    <?php echo !empty($tour_terms) ? esc_html(implode(' • ', $tour_terms)) : esc_html__('Featured itinerary', 'pride-of-africa'); ?>
                                </div>
                                <h2 class="h5 fw-bold"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h2>
                                <p class="mb-3 text-muted"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">Explore tour</a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info">No tours published yet.</div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
