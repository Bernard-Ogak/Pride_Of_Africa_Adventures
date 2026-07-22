<?php
/**
 * Gallery preview section template part.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

$gallery_items = get_posts([
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'numberposts'    => 6,
    'post_status'    => 'inherit',
]);

if (empty($gallery_items)) {
    return;
}
?>

<section class="gallery-preview py-5" id="gallery-preview">
    <div class="container-site">
        <div class="section-header text-center mb-5">
            <div class="eyebrow mb-2">PHOTO GALLERY</div>
            <h2 class="section-title">Moments From The Wild</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($gallery_items as $item) : ?>
                <div class="col-md-6 col-lg-4">
                    <img src="<?php echo esc_url(wp_get_attachment_url($item->ID)); ?>" alt="" class="img-fluid rounded shadow-sm" style="height:220px;object-fit:cover;width:100%;">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
