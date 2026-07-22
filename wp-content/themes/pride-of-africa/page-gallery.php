<?php
/**
 * Template Name: Gallery Page
 *
 * @package Pride_Of_Africa
 */

get_header();

$gallery_items = get_posts([
    'post_type'      => 'attachment',
    'post_status'    => 'inherit',
    'post_mime_type' => 'image',
    'posts_per_page' => 12,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$placeholder_images = [
    get_template_directory_uri() . '/assets/images/default/destination-1.jpg',
    get_template_directory_uri() . '/assets/images/default/destination-2.jpg',
    get_template_directory_uri() . '/assets/images/default/destination-3.jpg',
    get_template_directory_uri() . '/assets/images/default/destination-4.jpg',
    get_template_directory_uri() . '/assets/images/default/destination-5.jpg',
    get_template_directory_uri() . '/assets/images/default/destination-6.jpg',
];
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <div class="row align-items-end mb-5">
            <div class="col-lg-8">
                <p class="text-uppercase text-primary fw-semibold mb-2">Gallery</p>
                <h1 class="display-5 fw-bold mb-3">Moments from the field, the camps, and the journey</h1>
                <p class="lead text-muted">A visual glimpse into the landscapes, wildlife, and experiences that shape every Pride of Africa safari.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Plan Your Own Trip</a>
            </div>
        </div>

        <?php if (!empty($gallery_items)) : ?>
            <div class="row g-4">
                <?php foreach ($gallery_items as $index => $item) : ?>
                    <?php
                    $image_url   = wp_get_attachment_image_url($item->ID, 'large');
                    $description = trim($item->post_excerpt ?: $item->post_content);
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm gallery-photo-card">
                            <div class="gallery-photo">
                                <img src="<?php echo esc_url($image_url ?: $placeholder_images[$index % count($placeholder_images)]); ?>" alt="<?php echo esc_attr($description ?: __('Pride of Africa gallery photo', 'pride-of-africa')); ?>" loading="lazy">
                            </div>
                            <?php if ($description) : ?>
                                <div class="card-body">
                                    <p class="text-muted small mb-0"><?php echo esc_html($description); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info">No gallery images are available yet. New photo content will appear here as the site grows.</div>
        <?php endif; ?>
    </section>
</main>

<style>
.gallery-photo-card { overflow: hidden; }
.gallery-photo { overflow: hidden; height: 240px; }
.gallery-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .4s ease;
}
.gallery-photo-card:hover .gallery-photo img { transform: scale(1.08); }
@media (prefers-reduced-motion: reduce) {
    .gallery-photo img { transition: none; }
    .gallery-photo-card:hover .gallery-photo img { transform: none; }
}
</style>

<?php get_footer(); ?>
