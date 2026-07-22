<?php
/**
 * Testimonials section template part.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

$testimonials = pride_of_africa_get_home_testimonials(3);
if (empty($testimonials)) {
    return;
}
?>

<section class="testimonials py-5 bg-light" id="testimonials">
    <div class="container-site">
        <div class="section-header text-center mb-5">
            <div class="eyebrow mb-2">TRAVELER REVIEWS</div>
            <h2 class="section-title">What Our Guests Say</h2>
        </div>

        <div class="row g-4">
            <?php foreach ($testimonials as $testimonial) : ?>
                <article class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3 text-warning">★★★★★</div>
                            <p class="mb-3">“<?php echo esc_html($testimonial['excerpt'] ?: wp_trim_words(strip_tags($testimonial['content']), 24)); ?>”</p>
                            <h3 class="h6 mb-0"><?php echo esc_html($testimonial['title']); ?></h3>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
