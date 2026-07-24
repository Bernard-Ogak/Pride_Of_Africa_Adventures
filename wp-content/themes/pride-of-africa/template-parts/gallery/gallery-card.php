<?php
/**
 * Card: Gallery Item
 * File:   template-parts/gallery/gallery-card.php
 *
 * Renders one grid/masonry tile. All the taxonomy terms and meta an
 * item carries are serialized into data-* attributes so the sticky
 * filter bar and lightbox can read them without extra queries.
 *
 * @package PrideOfAfrica
 */

$post_id     = get_the_ID();
$img_id      = get_post_thumbnail_id();
$img_url     = $img_id ? wp_get_attachment_image_url($img_id, 'large') : '';
$thumb_url   = $img_id ? wp_get_attachment_image_url($img_id, 'medium_large') : '';
$alt_text    = get_post_meta($post_id, '_gallery_alt_text', true) ?: get_the_title();
$media_type  = get_post_meta($post_id, '_gallery_media_type', true) ?: 'photo';
$video_url   = get_post_meta($post_id, '_gallery_video_url', true);
$orientation = pride_gallery_get_orientation($post_id);
$location    = get_post_meta($post_id, '_gallery_location', true);
$views       = (int) get_post_meta($post_id, '_gallery_views_count', true);
$featured    = (int) get_post_meta($post_id, '_gallery_featured', true);
$related_tour_id = (int) get_post_meta($post_id, '_gallery_related_tour', true);
$related_tour_url = $related_tour_id ? get_permalink($related_tour_id) : '';

$term_slugs = function ($taxonomy) use ($post_id) {
    $terms = get_the_terms($post_id, $taxonomy);
    return ($terms && !is_wp_error($terms)) ? implode(' ', wp_list_pluck($terms, 'slug')) : '';
};
$term_names = function ($taxonomy) use ($post_id) {
    $terms = get_the_terms($post_id, $taxonomy);
    return ($terms && !is_wp_error($terms)) ? implode(', ', wp_list_pluck($terms, 'name')) : '';
};

$search_blob = mb_strtolower(implode(' ', array_filter([
    get_the_title(),
    wp_strip_all_tags(get_the_content()),
    $term_names('pride_gallery_country'),
    $term_names('pride_gallery_park'),
    $term_names('pride_gallery_wildlife'),
    $term_names('pride_gallery_safari_type'),
    $term_names('pride_gallery_activity'),
    $term_names('pride_gallery_tag'),
])));
?>
<div
    class="c-gallery-card"
    data-gallery-item
    data-id="<?php echo esc_attr($post_id); ?>"
    data-media-type="<?php echo esc_attr($media_type); ?>"
    data-country="<?php echo esc_attr($term_slugs('pride_gallery_country')); ?>"
    data-park="<?php echo esc_attr($term_slugs('pride_gallery_park')); ?>"
    data-wildlife="<?php echo esc_attr($term_slugs('pride_gallery_wildlife')); ?>"
    data-safari-type="<?php echo esc_attr($term_slugs('pride_gallery_safari_type')); ?>"
    data-activity="<?php echo esc_attr($term_slugs('pride_gallery_activity')); ?>"
    data-season="<?php echo esc_attr($term_slugs('pride_gallery_season')); ?>"
    data-collection="<?php echo esc_attr($term_slugs('pride_gallery_collection')); ?>"
    data-orientation="<?php echo esc_attr($orientation); ?>"
    data-featured="<?php echo esc_attr($featured); ?>"
    data-views="<?php echo esc_attr($views); ?>"
    data-date="<?php echo esc_attr(get_the_date('U')); ?>"
    data-title="<?php echo esc_attr(get_the_title()); ?>"
    data-search="<?php echo esc_attr($search_blob); ?>"
    data-caption="<?php echo esc_attr(get_the_excerpt()); ?>"
    data-location="<?php echo esc_attr($location); ?>"
    data-full="<?php echo esc_url($img_url); ?>"
    data-video-url="<?php echo esc_url($video_url); ?>"
    data-permalink="<?php echo esc_url(get_permalink()); ?>"
    data-related-tour-url="<?php echo esc_url($related_tour_url); ?>"
>
    <button type="button" class="c-gallery-card__trigger" data-gallery-trigger aria-label="<?php echo esc_attr(sprintf(__('Open %s', 'pride-of-africa'), get_the_title())); ?>">
        <?php if ($thumb_url) : ?>
        <img class="c-gallery-card__image" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($alt_text); ?>" loading="lazy" decoding="async">
        <?php endif; ?>

        <?php if ('photo' !== $media_type) : ?>
        <span class="c-gallery-card__media-badge">
            <i class="bi <?php echo esc_attr('video' === $media_type ? 'bi-play-circle-fill' : ('drone' === $media_type ? 'bi-airplane-fill' : 'bi-arrows-angle-expand')); ?>" aria-hidden="true"></i>
        </span>
        <?php endif; ?>

        <?php if ($featured) : ?>
        <span class="c-gallery-card__featured-badge"><?php esc_html_e('Featured', 'pride-of-africa'); ?></span>
        <?php endif; ?>

        <span class="c-gallery-card__overlay">
            <span class="c-gallery-card__title"><?php the_title(); ?></span>
            <?php if ($location) : ?>
            <span class="c-gallery-card__location"><i class="bi bi-geo-alt" aria-hidden="true"></i> <?php echo esc_html($location); ?></span>
            <?php endif; ?>
        </span>
    </button>
</div>
