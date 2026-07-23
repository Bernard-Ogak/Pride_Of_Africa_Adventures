<?php
/**
 * Admin meta box for Tour CPT — Featured Itinerary fields.
 *
 * Adds the fields the Featured Itineraries card reads that don't
 * already exist as CPT meta: a badge label (Most Popular / Best Value
 * / Signature), a route breadcrumb, a highlights list, a pull quote,
 * and a per-card CTA button label.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('add_meta_boxes', function () {
    add_meta_box(
        'pride_tour_itinerary_details',
        __('Featured Itinerary Details', 'pride-of-africa'),
        'pride_of_africa_render_tour_itinerary_meta_box',
        'pride_tour',
        'normal',
        'high'
    );
});

function pride_of_africa_render_tour_itinerary_meta_box($post) {
    wp_nonce_field('pride_tour_itinerary_meta_box', 'pride_tour_itinerary_meta_box_nonce');

    $badge      = get_post_meta($post->ID, '_tour_itinerary_badge', true);
    $route      = get_post_meta($post->ID, '_tour_itinerary_route', true);
    $highlights = get_post_meta($post->ID, '_tour_itinerary_highlights', true);
    $quote      = get_post_meta($post->ID, '_tour_itinerary_quote', true);
    $cta_label  = get_post_meta($post->ID, '_tour_itinerary_cta_label', true) ?: __('View Itinerary', 'pride-of-africa');
    $cta_url    = get_post_meta($post->ID, '_tour_itinerary_cta_url', true);
    $featured   = (bool) get_post_meta($post->ID, '_tour_itinerary_featured', true);
    ?>
    <p style="color:#666;">
        <?php esc_html_e('These fields only show on the homepage "Featured Itineraries" section when "Featured on Homepage" below is checked.', 'pride-of-africa'); ?>
    </p>
    <table class="form-table">
        <tr>
            <th><label for="pride_tour_itinerary_featured"><?php esc_html_e('Featured on Homepage', 'pride-of-africa'); ?></label></th>
            <td>
                <label>
                    <input type="checkbox" name="pride_tour_itinerary_featured" id="pride_tour_itinerary_featured" value="1" <?php checked($featured); ?>>
                    <?php esc_html_e('Show this tour in the homepage "Featured Itineraries" section', 'pride-of-africa'); ?>
                </label>
                <p class="description"><?php esc_html_e('Use the Order field (right-hand Page Attributes panel) to control display order.', 'pride-of-africa'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_itinerary_badge"><?php esc_html_e('Badge', 'pride-of-africa'); ?></label></th>
            <td>
                <select name="pride_tour_itinerary_badge" id="pride_tour_itinerary_badge">
                    <option value=""><?php esc_html_e('None', 'pride-of-africa'); ?></option>
                    <?php foreach (['Most Popular', 'Best Value', 'Signature'] as $option) : ?>
                    <option value="<?php echo esc_attr($option); ?>" <?php selected($badge, $option); ?>><?php echo esc_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_itinerary_route"><?php esc_html_e('Route', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="large-text" name="pride_tour_itinerary_route" id="pride_tour_itinerary_route"
                       value="<?php echo esc_attr($route); ?>" placeholder="<?php esc_attr_e('Nairobi > Maasai Mara > Lake Nakuru > Amboseli > Nairobi', 'pride-of-africa'); ?>">
                <p class="description"><?php esc_html_e('Separate stops with ">"', 'pride-of-africa'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_itinerary_highlights"><?php esc_html_e('Highlights', 'pride-of-africa'); ?></label></th>
            <td>
                <textarea class="large-text" rows="5" name="pride_tour_itinerary_highlights" id="pride_tour_itinerary_highlights"
                          placeholder="<?php esc_attr_e("Big Five safari experience in Maasai Mara\nMara River wildlife viewing", 'pride-of-africa'); ?>"><?php echo esc_textarea($highlights); ?></textarea>
                <p class="description"><?php esc_html_e('One highlight per line.', 'pride-of-africa'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_itinerary_quote"><?php esc_html_e('Pull Quote', 'pride-of-africa'); ?></label></th>
            <td>
                <textarea class="large-text" rows="2" name="pride_tour_itinerary_quote" id="pride_tour_itinerary_quote"><?php echo esc_textarea($quote); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_itinerary_cta_label"><?php esc_html_e('CTA Button Label', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="pride_tour_itinerary_cta_label" id="pride_tour_itinerary_cta_label"
                       value="<?php echo esc_attr($cta_label); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="pride_tour_itinerary_cta_url"><?php esc_html_e('CTA Destination', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="url" class="large-text" name="pride_tour_itinerary_cta_url" id="pride_tour_itinerary_cta_url"
                       value="<?php echo esc_attr($cta_url); ?>" placeholder="<?php echo esc_attr(get_permalink($post)); ?>">
                <p class="description"><?php esc_html_e('Leave blank to link to this tour\'s own page.', 'pride-of-africa'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post_pride_tour', function ($post_id) {
    if (!isset($_POST['pride_tour_itinerary_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['pride_tour_itinerary_meta_box_nonce'], 'pride_tour_itinerary_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['pride_tour_itinerary_badge'])) {
        update_post_meta($post_id, '_tour_itinerary_badge', sanitize_text_field($_POST['pride_tour_itinerary_badge']));
    }
    if (isset($_POST['pride_tour_itinerary_route'])) {
        update_post_meta($post_id, '_tour_itinerary_route', sanitize_text_field($_POST['pride_tour_itinerary_route']));
    }
    if (isset($_POST['pride_tour_itinerary_highlights'])) {
        update_post_meta($post_id, '_tour_itinerary_highlights', sanitize_textarea_field($_POST['pride_tour_itinerary_highlights']));
    }
    if (isset($_POST['pride_tour_itinerary_quote'])) {
        update_post_meta($post_id, '_tour_itinerary_quote', sanitize_textarea_field($_POST['pride_tour_itinerary_quote']));
    }
    if (isset($_POST['pride_tour_itinerary_cta_label'])) {
        update_post_meta($post_id, '_tour_itinerary_cta_label', sanitize_text_field($_POST['pride_tour_itinerary_cta_label']));
    }
    if (isset($_POST['pride_tour_itinerary_cta_url'])) {
        update_post_meta($post_id, '_tour_itinerary_cta_url', esc_url_raw($_POST['pride_tour_itinerary_cta_url']));
    }
    update_post_meta($post_id, '_tour_itinerary_featured', isset($_POST['pride_tour_itinerary_featured']) ? 1 : 0);
});
