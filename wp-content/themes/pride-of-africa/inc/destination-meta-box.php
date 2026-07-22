<?php
/**
 * Admin meta box for the Destination CPT — individual destination
 * detail-page content (Why Visit, Top Attractions, Best Time To Visit,
 * Cost Guide, Safari Route Map, FAQs, closing CTA).
 *
 * Repeater-style fields use a simple "field | field" per-line format
 * in a textarea rather than a JS repeater UI, so they stay editable
 * from the plain admin screen.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('add_meta_boxes', function () {
    add_meta_box(
        'pride_destination_details',
        __('Destination Page Details', 'pride-of-africa'),
        'pride_of_africa_render_destination_meta_box',
        'pride_destination',
        'normal',
        'high'
    );
});

function pride_of_africa_destination_fields() {
    return [
        'tagline'          => ['label' => 'Tagline (hero eyebrow)', 'type' => 'text', 'placeholder' => 'The Birthplace of Safari'],
        'why_visit'        => ['label' => 'Why Visit — one reason per line', 'type' => 'textarea', 'placeholder' => "Witness the Great Wildebeest Migration (Jul–Oct)\nSee the Big Five in Maasai Mara & Amboseli"],
        'attractions'      => ['label' => 'Top Attractions — "Title | Description" per line', 'type' => 'textarea', 'placeholder' => "Maasai Mara National Reserve | Kenya's most iconic reserve...\nAmboseli National Park | Africa's finest elephant viewing..."],
        'best_time'        => ['label' => 'Best Time To Visit — "Label | Date Range | Description" per line', 'type' => 'textarea', 'placeholder' => "Peak Season | July – October | Great Migration\nGood Season | January – March | Calving season\nGreen Season | April – June | Fewer crowds"],
        'best_time_note'   => ['label' => 'Best Time — footer note', 'type' => 'text', 'placeholder' => 'Kenya is a year-round destination. Each season offers unique wildlife experiences.'],
        'cost_guide'       => ['label' => 'Cost Guide — "Tier | Price Range" per line', 'type' => 'textarea', 'placeholder' => "Budget | \$150–\$300/day\nMid-Range | \$300–\$600/day\nLuxury | \$600–\$1,500+/day"],
        'cost_note'        => ['label' => 'Cost Guide — footer note', 'type' => 'text', 'placeholder' => 'Prices include accommodation, meals, game drives, and park fees.'],
        'route_intro'      => ['label' => 'Safari Route — breadcrumb line', 'type' => 'text', 'placeholder' => 'Nairobi → Maasai Mara → Lake Naivasha → Amboseli → Kenya Coast'],
        'route_stops'      => ['label' => 'Safari Route — "Stop Name | Subtitle" per line', 'type' => 'textarea', 'placeholder' => "Nairobi | Starting Point\nMaasai Mara | Great Migration"],
        'route_note'       => ['label' => 'Safari Route — footer note', 'type' => 'textarea', 'placeholder' => 'Also available: Kenya + Tanzania combined route...'],
        'faqs'             => ['label' => 'FAQs — "Question | Answer" per line', 'type' => 'textarea', 'placeholder' => "Do I need a visa to visit Kenya? | Most nationalities need an eTA...\nIs Kenya safe for tourists? | Yes, very safe..."],
        'cta_heading'      => ['label' => 'Closing CTA heading', 'type' => 'text', 'placeholder' => 'Ready to Explore Kenya?'],
        'cta_text'         => ['label' => 'Closing CTA text', 'type' => 'text', 'placeholder' => 'Let our local experts craft your perfect Kenya safari.'],
        'cta_label'        => ['label' => 'Closing CTA button label', 'type' => 'text', 'placeholder' => 'Plan My Safari'],
    ];
}

function pride_of_africa_render_destination_meta_box($post) {
    wp_nonce_field('pride_destination_meta_box', 'pride_destination_meta_box_nonce');
    ?>
    <p style="color:#666;"><?php esc_html_e('The intro paragraph under the title uses the Excerpt field. Everything below powers the individual destination page sections.', 'pride-of-africa'); ?></p>
    <table class="form-table">
        <?php foreach (pride_of_africa_destination_fields() as $key => $field) :
            $meta_key = '_destination_' . $key;
            $value = get_post_meta($post->ID, $meta_key, true);
        ?>
        <tr>
            <th><label for="<?php echo esc_attr($meta_key); ?>"><?php echo esc_html($field['label']); ?></label></th>
            <td>
                <?php if ('textarea' === $field['type']) : ?>
                <textarea class="large-text" rows="4" name="<?php echo esc_attr($meta_key); ?>" id="<?php echo esc_attr($meta_key); ?>"
                          placeholder="<?php echo esc_attr($field['placeholder']); ?>"><?php echo esc_textarea($value); ?></textarea>
                <?php else : ?>
                <input type="text" class="large-text" name="<?php echo esc_attr($meta_key); ?>" id="<?php echo esc_attr($meta_key); ?>"
                       value="<?php echo esc_attr($value); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php
}

add_action('save_post_pride_destination', function ($post_id) {
    if (!isset($_POST['pride_destination_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['pride_destination_meta_box_nonce'], 'pride_destination_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    foreach (pride_of_africa_destination_fields() as $key => $field) {
        $meta_key = '_destination_' . $key;
        if (!isset($_POST[$meta_key])) {
            continue;
        }
        $value = ('textarea' === $field['type'])
            ? sanitize_textarea_field($_POST[$meta_key])
            : sanitize_text_field($_POST[$meta_key]);
        update_post_meta($post_id, $meta_key, $value);
    }
});

/**
 * Parse a "field | field | field" per-line textarea meta value into an
 * array of arrays, e.g. "Title | Description\nTitle 2 | Description 2".
 *
 * @param string $raw
 * @return array<int, array<int, string>>
 */
function pride_of_africa_parse_pipe_lines($raw) {
    $lines = array_filter(array_map('trim', explode("\n", (string) $raw)));
    $rows = [];
    foreach ($lines as $line) {
        $rows[] = array_map('trim', explode('|', $line));
    }
    return $rows;
}
