<?php
/**
 * Single tour template.
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php $tour_terms = wp_get_post_terms(get_the_ID(), ['pride_country', 'pride_safari_type', 'pride_duration'], ['fields' => 'names']); ?>
            <header class="mb-5">
                <p class="text-uppercase text-primary fw-semibold mb-2">Tour</p>
                <h1 class="display-5 fw-bold mb-3"><?php the_title(); ?></h1>
                <div class="text-muted lead"><?php echo esc_html(get_the_excerpt()); ?></div>
                <?php if (!empty($tour_terms)) : ?>
                    <div class="mt-3">
                        <span class="badge bg-light text-dark"><?php echo esc_html(implode(' • ', $tour_terms)); ?></span>
                    </div>
                <?php endif; ?>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-4">
                    <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded shadow-sm']); ?>
                </div>
            <?php endif; ?>

            <div class="row g-5">
                <div class="col-lg-8 entry-content">
                    <?php the_content(); ?>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 bg-dark text-white">
                        <div class="card-body p-4">
                            <h2 class="h5 fw-bold mb-3">Need this itinerary tailored?</h2>
                            <p class="text-white-50">We can adjust timing, accommodations, and activities to fit your group and budget.</p>
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-light">Request a custom plan</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </section>
</main>

<?php get_footer(); ?>
