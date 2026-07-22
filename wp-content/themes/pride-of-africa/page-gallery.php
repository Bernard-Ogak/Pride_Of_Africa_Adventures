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
                    <?php $image_url = wp_get_attachment_image_url($item->ID, 'large'); ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm overflow-hidden">
                            <img src="<?php echo esc_url($image_url ?: $placeholder_images[$index % count($placeholder_images)]); ?>" class="card-img-top" alt="<?php echo esc_attr($item->post_title ?: 'Gallery image'); ?>" style="height: 240px; object-fit: cover;">
                            <div class="card-body">
                                <h3 class="h6 fw-bold mb-2"><?php echo esc_html($item->post_title ?: 'Gallery Image'); ?></h3>
                                <p class="text-muted small mb-0">Captured during a Pride of Africa travel experience.</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info">No gallery images are available yet. New photo content will appear here as the site grows.</div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
