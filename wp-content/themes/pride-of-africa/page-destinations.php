<?php
/**
 * Template Name: Destinations Listing
 *
 * @package Pride_Of_Africa
 */

get_header();

$destinations = pride_of_africa_get_home_destinations(8);
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <header class="mb-5 text-center">
            <p class="text-uppercase text-primary fw-semibold mb-2">Destinations</p>
            <h1 class="display-5 fw-bold mb-3">Explore the landscapes and countries behind every journey</h1>
            <p class="lead text-muted">From high-altitude adventures to island beaches, each destination is crafted for a different kind of safari experience.</p>
        </header>

        <?php if (!empty($destinations)) : ?>
            <div class="row g-4">
                <?php foreach ($destinations as $destination) : ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="card h-100 border-0 shadow-sm overflow-hidden">
                            <?php if (!empty($destination['featured_image'])) : ?>
                                <img src="<?php echo esc_url($destination['featured_image']); ?>" class="card-img-top" alt="<?php echo esc_attr($destination['title']); ?>" style="height: 220px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h2 class="h5 fw-bold"><a href="<?php echo esc_url($destination['permalink']); ?>" class="text-decoration-none"><?php echo esc_html($destination['title']); ?></a></h2>
                                <p class="text-muted mb-3"><?php echo esc_html(wp_trim_words($destination['excerpt'] ?: wp_strip_all_tags($destination['content']), 24)); ?></p>
                                <a href="<?php echo esc_url($destination['permalink']); ?>" class="btn btn-outline-primary btn-sm">View details</a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info">Destination entries will appear here once content is added.</div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
