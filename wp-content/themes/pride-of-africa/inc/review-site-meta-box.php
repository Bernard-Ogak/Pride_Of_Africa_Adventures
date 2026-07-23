<?php
/**
 * Admin meta box for the Review Platform CPT (Review Hub page selector).
 *
 * Platform name = post Title, logo = Featured Image, display order =
 * native Order field, enable/disable = Publish/Draft status. This box
 * only adds what has no native equivalent: the review URL and an
 * optional short tag like "Recommended" or "Most Popular".
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('add_meta_boxes', function () {
    add_meta_box(
        'pride_review_site_details',
        __('Review Platform Details', 'pride-of-africa'),
        'pride_of_africa_render_review_site_meta_box',
        'pride_review_site',
        'normal',
        'high'
    );
});

function pride_of_africa_render_review_site_meta_box($post) {
    wp_nonce_field('pride_review_site_meta_box', 'pride_review_site_meta_box_nonce');

    $url = get_post_meta($post->ID, '_review_site_url', true);
    $tag = get_post_meta($post->ID, '_review_site_tag', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="pride_review_site_url"><?php esc_html_e('Review URL', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="url" class="large-text" name="pride_review_site_url" id="pride_review_site_url"
                       value="<?php echo esc_attr($url); ?>" placeholder="https://www.tripadvisor.com/UserReviewEdit-...">
                <p class="description"><?php esc_html_e('Where visitors are redirected after clicking "Continue to Review".', 'pride-of-africa'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="pride_review_site_tag"><?php esc_html_e('Short Tag (optional)', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="pride_review_site_tag" id="pride_review_site_tag"
                       value="<?php echo esc_attr($tag); ?>" placeholder="<?php esc_attr_e('Recommended / Most Popular', 'pride-of-africa'); ?>">
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post_pride_review_site', function ($post_id) {
    if (!isset($_POST['pride_review_site_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['pride_review_site_meta_box_nonce'], 'pride_review_site_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['pride_review_site_url'])) {
        update_post_meta($post_id, '_review_site_url', esc_url_raw($_POST['pride_review_site_url']));
    }
    if (isset($_POST['pride_review_site_tag'])) {
        update_post_meta($post_id, '_review_site_tag', sanitize_text_field($_POST['pride_review_site_tag']));
    }
});
