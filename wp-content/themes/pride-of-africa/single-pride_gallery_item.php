<?php
/**
 * Single gallery item template — a direct-linkable, SEO-indexable page
 * per photo/video (the lightbox is the primary in-context viewer;
 * this exists so each item has its own crawlable, shareable URL).
 *
 * @package Pride_Of_Africa
 */

get_header();

while (have_posts()) : the_post();
    $post_id     = get_the_ID();
    $img_id      = get_post_thumbnail_id();
    $img_url     = $img_id ? wp_get_attachment_image_url($img_id, 'full') : '';
    $alt_text    = get_post_meta($post_id, '_gallery_alt_text', true) ?: get_the_title();
    $media_type  = get_post_meta($post_id, '_gallery_media_type', true) ?: 'photo';
    $video_url   = get_post_meta($post_id, '_gallery_video_url', true);
    $photographer = get_post_meta($post_id, '_gallery_photographer', true);
    $location    = get_post_meta($post_id, '_gallery_location', true);
    $video       = pride_gallery_normalize_video_url($video_url);
    $related     = pride_gallery_get_related_items($post_id, 4);
?>

<main id="primary">
    <article class="l-section">
        <div class="u-container" style="max-width:56rem;">

            <nav class="c-article__breadcrumb" style="margin-bottom:var(--space-4);">
                <a href="<?php echo esc_url(home_url('/gallery')); ?>"><?php esc_html_e('Gallery', 'pride-of-africa'); ?></a>
                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                <span><?php the_title(); ?></span>
            </nav>

            <div style="border-radius:var(--radius-lg);overflow:hidden;background:#000;margin-bottom:var(--space-5);">
                <?php if ('photo' !== $media_type && $video['src']) :
                    if (in_array($video['type'], ['youtube', 'vimeo'], true)) : ?>
                        <div style="aspect-ratio:16/9;"><iframe src="<?php echo esc_url($video['src']); ?>" style="width:100%;height:100%;border:0;" allowfullscreen loading="lazy" title="<?php echo esc_attr(get_the_title()); ?>"></iframe></div>
                    <?php else : ?>
                        <video src="<?php echo esc_url($video['src']); ?>" controls playsinline style="width:100%;display:block;"></video>
                    <?php endif;
                elseif ($img_url) : ?>
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>" style="width:100%;display:block;">
                <?php endif; ?>
            </div>

            <h1 style="font-size:1.75rem;font-weight:700;margin-bottom:.5rem;"><?php the_title(); ?></h1>
            <?php if (get_the_excerpt()) : ?><p style="color:#5A6472;font-size:1.0625rem;"><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>

            <div style="display:flex;flex-wrap:wrap;gap:1.25rem;font-size:.875rem;color:#707070;margin:var(--space-4) 0;padding-bottom:var(--space-4);border-bottom:1px solid var(--poa-color-border);">
                <?php if ($location) : ?><span><i class="bi bi-geo-alt" aria-hidden="true"></i> <?php echo esc_html($location); ?></span><?php endif; ?>
                <?php if ($photographer) : ?><span><i class="bi bi-camera" aria-hidden="true"></i> <?php echo esc_html($photographer); ?></span><?php endif; ?>
                <span><i class="bi bi-calendar3" aria-hidden="true"></i> <?php echo esc_html(get_the_date()); ?></span>
            </div>

            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="c-button c-button--primary"><?php esc_html_e('Book This Safari', 'pride-of-africa'); ?></a>

            <?php if (!empty($related)) : ?>
            <div style="margin-top:var(--space-7);">
                <h2 style="font-size:1.25rem;font-weight:700;margin-bottom:var(--space-4);"><?php esc_html_e('Related Gallery', 'pride-of-africa'); ?></h2>
                <div class="c-related-gallery__grid">
                    <?php foreach ($related as $related_post) : setup_postdata($related_post); ?>
                        <?php get_template_part('template-parts/gallery/gallery-card'); ?>
                    <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </article>
</main>

<?php get_template_part('template-parts/gallery/lightbox'); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
