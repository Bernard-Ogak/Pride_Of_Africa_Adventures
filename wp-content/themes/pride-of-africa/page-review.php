<?php
/**
 * Template Name: Review Page
 *
 * @package Pride_Of_Africa
 */

get_header();

$testimonials = pride_of_africa_get_home_testimonials(6);
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <div class="text-center mb-5">
            <p class="text-uppercase text-primary fw-semibold mb-2">Traveler Reviews</p>
            <h1 class="display-5 fw-bold mb-3">What guests say about their Pride of Africa journeys</h1>
            <p class="lead text-muted mx-auto" style="max-width: 720px;">Every itinerary is shaped around comfort, discovery, and a seamless travel experience.</p>
        </div>

        <?php if (!empty($testimonials)) : ?>
            <div class="row g-4">
                <?php foreach ($testimonials as $testimonial) : ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="text-warning mb-3">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <p class="text-muted">“<?php echo esc_html($testimonial['excerpt'] ?: wp_strip_all_tags($testimonial['content'])); ?>”</p>
                                <h2 class="h6 fw-bold mb-0"><?php echo esc_html($testimonial['title']); ?></h2>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info">Testimonials will appear here once they are added to the site.</div>
        <?php endif; ?>

        <div class="text-center mt-5">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-lg">Share Your Safari Story</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
