<?php
/**
 * Admin meta box for the Testimonial CPT.
 *
 * The post Title is the traveler's name and the standard content editor
 * is the quote/excerpt (both already built into WordPress) — this box
 * adds the remaining fields the front-end template reads: star rating,
 * country/location, the trip/tour name, and which review platform
 * (TripAdvisor / SafariBookings / Trustpilot) the badge on the card shows.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('add_meta_boxes', function () {
    add_meta_box(
        'pride_testimonial_details',
        __('Testimonial Details', 'pride-of-africa'),
        'pride_of_africa_render_testimonial_meta_box',
        'pride_testimonial',
        'normal',
        'high'
    );
});

function pride_of_africa_render_testimonial_meta_box($post) {
    wp_nonce_field('pride_testimonial_meta_box', 'pride_testimonial_meta_box_nonce');

    $rating   = get_post_meta($post->ID, '_testimonial_rating', true) ?: 5;
    $location = get_post_meta($post->ID, '_testimonial_location', true);
    $tour     = get_post_meta($post->ID, '_testimonial_tour', true);
    $platform = get_post_meta($post->ID, '_testimonial_platform', true) ?: 'tripadvisor';

    $platforms = [
        'tripadvisor'    => 'TripAdvisor',
        'safaribookings' => 'SafariBookings',
        'trustpilot'     => 'Trustpilot',
    ];
    ?>
    <p style="color:#666;">
        <?php esc_html_e('The traveler\'s name uses the post Title above; the review quote uses the main content editor below.', 'pride-of-africa'); ?>
    </p>
    <table class="form-table">
        <tr>
            <th><label for="pride_testimonial_rating"><?php esc_html_e('Star Rating', 'pride-of-africa'); ?></label></th>
            <td>
                <select name="pride_testimonial_rating" id="pride_testimonial_rating">
                    <?php for ($i = 5; $i >= 1; $i--) : ?>
                    <option value="<?php echo esc_attr($i); ?>" <?php selected($rating, $i); ?>>
                        <?php echo esc_html(str_repeat('★', $i) . str_repeat('☆', 5 - $i)); ?>
                    </option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="pride_testimonial_location"><?php esc_html_e('Country / Location', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="pride_testimonial_location" id="pride_testimonial_location"
                       value="<?php echo esc_attr($location); ?>" placeholder="<?php esc_attr_e('e.g. USA', 'pride-of-africa'); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="pride_testimonial_tour"><?php esc_html_e('Trip / Tour Name', 'pride-of-africa'); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="pride_testimonial_tour" id="pride_testimonial_tour"
                       value="<?php echo esc_attr($tour); ?>" placeholder="<?php esc_attr_e('e.g. Maasai Mara Safari', 'pride-of-africa'); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="pride_testimonial_platform"><?php esc_html_e('Review Platform', 'pride-of-africa'); ?></label></th>
            <td>
                <select name="pride_testimonial_platform" id="pride_testimonial_platform">
                    <?php foreach ($platforms as $value => $label) : ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($platform, $value); ?>><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="description"><?php esc_html_e('Controls the platform badge shown on the testimonial card and which filter pill it appears under.', 'pride-of-africa'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

add_action('save_post_pride_testimonial', function ($post_id) {
    if (!isset($_POST['pride_testimonial_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['pride_testimonial_meta_box_nonce'], 'pride_testimonial_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['pride_testimonial_rating'])) {
        update_post_meta($post_id, '_testimonial_rating', absint($_POST['pride_testimonial_rating']));
    }
    if (isset($_POST['pride_testimonial_location'])) {
        update_post_meta($post_id, '_testimonial_location', sanitize_text_field($_POST['pride_testimonial_location']));
    }
    if (isset($_POST['pride_testimonial_tour'])) {
        update_post_meta($post_id, '_testimonial_tour', sanitize_text_field($_POST['pride_testimonial_tour']));
    }
    if (isset($_POST['pride_testimonial_platform'])) {
        update_post_meta($post_id, '_testimonial_platform', sanitize_key($_POST['pride_testimonial_platform']));
    }
});
