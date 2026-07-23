<?php
/**
 * Admin meta box for blog posts — Featured toggle + view counter.
 *
 * Everything else the blog archive/single templates need (title,
 * content, excerpt, featured image, author, publish date, Topic and
 * Destination taxonomies) already has a native WordPress field —
 * this box only adds the "Featured" flag, which doesn't.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('add_meta_boxes', function () {
    add_meta_box(
        'pride_blog_featured',
        __('Blog Settings', 'pride-of-africa'),
        'pride_of_africa_render_blog_meta_box',
        'post',
        'side',
        'default'
    );
});

function pride_of_africa_render_blog_meta_box($post) {
    wp_nonce_field('pride_blog_meta_box', 'pride_blog_meta_box_nonce');
    $featured = (bool) get_post_meta($post->ID, '_post_featured', true);
    ?>
    <label>
        <input type="checkbox" name="pride_post_featured" value="1" <?php checked($featured); ?>>
        <?php esc_html_e('Featured article', 'pride-of-africa'); ?>
    </label>
    <p class="description"><?php esc_html_e('Featured articles can appear as the archive\'s highlighted story and in the "Featured" sort order.', 'pride-of-africa'); ?></p>
    <?php
}

add_action('save_post_post', function ($post_id) {
    if (!isset($_POST['pride_blog_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['pride_blog_meta_box_nonce'], 'pride_blog_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    update_post_meta($post_id, '_post_featured', isset($_POST['pride_post_featured']) ? 1 : 0);
});

/**
 * Lightweight view counter (powers the "Most Popular" archive sort).
 * Counts once per page load on the canonical single view, skipping
 * logged-in editors/admins so preview/editing visits don't inflate it.
 */
add_action('wp_head', function () {
    if (!is_single() || 'post' !== get_post_type()) {
        return;
    }
    if (current_user_can('edit_posts')) {
        return;
    }

    $post_id = get_queried_object_id();
    if (!$post_id) {
        return;
    }
    $views = (int) get_post_meta($post_id, '_post_views_count', true);
    update_post_meta($post_id, '_post_views_count', $views + 1);
});
