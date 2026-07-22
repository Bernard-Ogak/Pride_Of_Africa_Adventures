<?php
/**
 * Popular tours section template part.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

$tours = pride_of_africa_get_home_tours(4);
if (empty($tours)) {
    return;
}
?>

<section class="popular-tours py-5" id="popular-tours">
    <div class="container-site">
        <div class="section-header text-center mb-5">
            <div class="eyebrow mb-2">POPULAR SAFARIS</div>
            <h2 class="section-title">Featured Tours</h2>
            <p class="section-description">Curated experiences across East Africa, the Indian Ocean, and bespoke wilderness adventures.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($tours as $tour) : ?>
                <article class="col-lg-6">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($tour['featured_image'])) : ?>
                            <img src="<?php echo esc_url($tour['featured_image']); ?>" alt="<?php echo esc_attr($tour['title']); ?>" class="card-img-top" style="height:220px;object-fit:cover;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h3 class="h5 mb-2"><?php echo esc_html($tour['title']); ?></h3>
                            <?php if (!empty($tour['excerpt'])) : ?>
                                <p class="text-muted mb-3"><?php echo esc_html($tour['excerpt']); ?></p>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($tour['permalink']); ?>" class="btn btn-primary mt-auto">
                                <?php esc_html_e('View Tour', 'pride-of-africa'); ?>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
