<?php
/**
 * Admin meta box for the Feature CPT ("Why Choose Us" homepage cards).
 *
 * The card title uses the post Title, the description uses the main
 * content editor, and display order/enable-disable use WordPress's
 * native Order field (page-attributes) and Publish/Draft status —
 * this field only adds the icon, which doesn't have a native equivalent.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('add_meta_boxes', function () {
    add_meta_box(
        'pride_feature_details',
        __('Feature Icon', 'pride-of-africa'),
        'pride_of_africa_render_feature_meta_box',
        'pride_feature',
        'side',
        'default'
    );
});

function pride_of_africa_render_feature_meta_box($post) {
    wp_nonce_field('pride_feature_meta_box', 'pride_feature_meta_box_nonce');

    $icon = get_post_meta($post->ID, '_feature_icon', true) ?: 'bi-star';
    ?>
    <p>
        <label for="pride_feature_icon"><?php esc_html_e('Bootstrap Icon class', 'pride-of-africa'); ?></label><br>
        <input type="text" class="widefat" name="pride_feature_icon" id="pride_feature_icon"
               value="<?php echo esc_attr($icon); ?>" placeholder="bi-binoculars">
        <span class="description">
            <?php
            printf(
                /* translators: %s: link to Bootstrap Icons library */
                esc_html__('Any class name from %s, e.g. bi-binoculars, bi-map, bi-shield-check, bi-headset, bi-wallet2, bi-star-fill.', 'pride-of-africa'),
                '<a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">icons.getbootstrap.com</a>'
            );
            ?>
        </span>
    </p>
    <p>
        <i class="bi <?php echo esc_attr($icon); ?>" style="font-size:2rem;color:#009900;" aria-hidden="true"></i>
    </p>
    <?php
}

add_action('save_post_pride_feature', function ($post_id) {
    if (!isset($_POST['pride_feature_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['pride_feature_meta_box_nonce'], 'pride_feature_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['pride_feature_icon'])) {
        update_post_meta($post_id, '_feature_icon', sanitize_html_class(trim($_POST['pride_feature_icon'])));
    }
});
