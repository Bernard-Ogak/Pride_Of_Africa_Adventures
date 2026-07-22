<?php
/**
 * Template Name: Tours Listing
 *
 * @package Pride_Of_Africa
 */

get_header();

$tours = pride_of_africa_get_home_tours(8);
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <header class="mb-5 text-center">
            <p class="text-uppercase text-primary fw-semibold mb-2">Tours</p>
            <h1 class="display-5 fw-bold mb-3">Choose from expertly crafted safari and holiday experiences</h1>
            <p class="lead text-muted">Each itinerary blends wildlife viewing, comfort, and thoughtful logistics into one memorable adventure.</p>
        </header>

        <?php if (!empty($tours)) : ?>
            <div class="row g-4">
                <?php foreach ($tours as $tour) : ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="card h-100 border-0 shadow-sm overflow-hidden">
                            <?php if (!empty($tour['featured_image'])) : ?>
                                <img src="<?php echo esc_url($tour['featured_image']); ?>" class="card-img-top" alt="<?php echo esc_attr($tour['title']); ?>" style="height: 220px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h2 class="h5 fw-bold"><a href="<?php echo esc_url($tour['permalink']); ?>" class="text-decoration-none"><?php echo esc_html($tour['title']); ?></a></h2>
                                <p class="text-muted mb-3"><?php echo esc_html(wp_trim_words($tour['excerpt'] ?: wp_strip_all_tags($tour['content']), 24)); ?></p>
                                <a href="<?php echo esc_url($tour['permalink']); ?>" class="btn btn-outline-primary btn-sm">Explore tour</a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info">Tour entries will appear here once content is added.</div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
