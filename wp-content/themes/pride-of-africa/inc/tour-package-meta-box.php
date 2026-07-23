<?php
/**
 * Admin meta box for Tour CPT — Popular Tours card fields.
 *
 * Adds the fields the homepage "Popular Tours" card reads: price,
 * duration, location, three highlight badges, and a per-tour CTA
 * (button text + destination). The tour title (post title), description
 * (excerpt), and card image (featured image) already exist as native
 * WordPress fields. Category filtering uses the Tour Category taxonomy.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('add_meta_boxes', function () {
    add_meta_box(
        'pride_tour_package_details',
        __('Popular Tours Card Details', 'pride-of-africa'),
        'pride_of_africa_render_tour_package_meta_box',
        'pride_tour',
        'normal',
        'high'
    );
});

function pride_of_africa_render_tour_package_meta_box($post) {
    wp_nonce_field('pride_tour_package_meta_box', 'pride_tour_package_meta_box_nonce');

    $price      = get_post_meta($post->ID, '_tour_price', true);
    $duration   = get_post_meta($post->ID, '_tour_duration', true);
    $location   = get_post_meta($post->ID, '_tour_location', true);
    $highlight1 = get_post_meta($post->ID, '_tour_highlight_1', true);
    $highlight2 = get_post_meta($post->ID, '_tour_highlight_2', true);
    $highlight3 = get_post_meta($post->ID, '_tour_highlight_3', true);
    $cta_text   = get_post_meta($post->ID, '_tour_cta_text', true) ?: __('Get a Quote', 'pride-of-africa');
    $cta_url    = get_post_meta($post->ID, '_tour_cta_url', true);
    ?>
    <p style="color:#666;">
        <?php esc_html_e('These fields power the card shown in the homepage "Popular Tours" section. Use Tour Category (right-hand panel) to control which filter pill(s) this tour appears under — check "Featured Packages" to include it in the default view.', 'pride-of-africa'); ?>
    </p>
    <table class="form-table">
        <tr>
            <th><label for="pride_tour_price"><?php esc_html_e('Price', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="pride_tour_price" id="pride_tour_price"
                       value="<?php echo esc_attr($price); ?>" placeholder="<?php esc_attr_e('$820 / person', 'pride-of-africa'); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_duration"><?php esc_html_e('Duration', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="pride_tour_duration" id="pride_tour_duration"
                       value="<?php echo esc_attr($duration); ?>" placeholder="<?php esc_attr_e('4 Days', 'pride-of-africa'); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_location"><?php esc_html_e('Location', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="pride_tour_location" id="pride_tour_location"
                       value="<?php echo esc_attr($location); ?>" placeholder="<?php esc_attr_e('Maasai Mara, Kenya', 'pride-of-africa'); ?>">
            </td>
        </tr>
        <tr>
            <th><label><?php esc_html_e('Highlights', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="regular-text mb-1" name="pride_tour_highlight_1" value="<?php echo esc_attr($highlight1); ?>" placeholder="<?php esc_attr_e('Highlight 1', 'pride-of-africa'); ?>" style="display:block;margin-bottom:6px;"><input type="text" class="regular-text" name="pride_tour_highlight_2" value="<?php echo esc_attr($highlight2); ?>" placeholder="<?php esc_attr_e('Highlight 2', 'pride-of-africa'); ?>" style="display:block;margin-bottom:6px;"><input type="text" class="regular-text" name="pride_tour_highlight_3" value="<?php echo esc_attr($highlight3); ?>" placeholder="<?php esc_attr_e('Highlight 3', 'pride-of-africa'); ?>" style="display:block;">
                <p class="description"><?php esc_html_e('Shown as three small badges on the card.', 'pride-of-africa'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_cta_text"><?php esc_html_e('CTA Button Text', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="pride_tour_cta_text" id="pride_tour_cta_text"
                       value="<?php echo esc_attr($cta_text); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_cta_url"><?php esc_html_e('CTA Destination', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="url" class="large-text" name="pride_tour_cta_url" id="pride_tour_cta_url"
                       value="<?php echo esc_attr($cta_url); ?>" placeholder="<?php echo esc_attr(home_url('/contact')); ?>">
                <p class="description"><?php esc_html_e('Where "Get a Quote" links to — a quote/inquiry page or this tour\'s own page. Leave blank to link to this tour\'s page.', 'pride-of-africa'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post_pride_tour', function ($post_id) {
    if (!isset($_POST['pride_tour_package_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['pride_tour_package_meta_box_nonce'], 'pride_tour_package_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'pride_tour_price'      => '_tour_price',
        'pride_tour_duration'   => '_tour_duration',
        'pride_tour_location'   => '_tour_location',
        'pride_tour_highlight_1'=> '_tour_highlight_1',
        'pride_tour_highlight_2'=> '_tour_highlight_2',
        'pride_tour_highlight_3'=> '_tour_highlight_3',
        'pride_tour_cta_text'   => '_tour_cta_text',
    ];
    foreach ($fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$post_key]));
        }
    }

    if (isset($_POST['pride_tour_cta_url'])) {
        update_post_meta($post_id, '_tour_cta_url', esc_url_raw($_POST['pride_tour_cta_url']));
    }
});
