<?php
/**
 * Top Destinations Section Customizer Settings
 *
 * Manages up to 6 destination cards with image, country, title,
 * description, badge label, and URL.
 *
 * @package Pride_Of_Africa
 * @subpackage Customizer
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Top Destinations customizer settings and controls
 *
 * @param WP_Customize_Manager $wp_customize
 * @return void
 */
function pride_of_africa_destinations_customize_register($wp_customize) {

    // =========================================================================
    // SECTION
    // =========================================================================

    $wp_customize->add_section('pride_destinations_section', [
        'title'       => esc_html__('Top Destinations', 'pride-of-africa'),
        'description' => esc_html__('Configure Top Destinations card grid section', 'pride-of-africa'),
        'priority'    => 29,
    ]);

    // Enable/Disable
    $wp_customize->add_setting('pride_destinations_enabled', [
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_destinations_enabled', [
        'label'    => esc_html__('Enable Top Destinations Section', 'pride-of-africa'),
        'section'  => 'pride_destinations_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ]);

    // =========================================================================
    // SECTION HEADER
    // =========================================================================

    $header_fields = [
        'eyebrow'     => ['Eyebrow Label',       'text',     'EXPLORE AFRICA'],
        'title'       => ['Section Title',        'text',     'Top Safari Destinations'],
        'description' => ['Section Description',  'textarea', 'From the sweeping Serengeti plains to the lush jungles of Uganda — discover the continent\'s most extraordinary wildlife destinations.'],
        'cta_text'    => ['View All Button Text',  'text',     'View All Destinations'],
        'cta_url'     => ['View All Button URL',   'url',      ''],
    ];

    $priority = 20;
    foreach ($header_fields as $key => [$label, $type, $default]) {
        $sanitize = $type === 'url' ? 'esc_url_raw' : ($type === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field');
        $wp_customize->add_setting("pride_destinations_{$key}", [
            'default'           => $default,
            'sanitize_callback' => $sanitize,
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_destinations_{$key}", [
            'label'    => esc_html__($label, 'pride-of-africa'),
            'section'  => 'pride_destinations_section',
            'type'     => $type,
            'priority' => $priority,
        ]);
        $priority += 10;
    }

    // =========================================================================
    // DESTINATION CARDS (up to 6)
    // =========================================================================

    $card_defaults = [
        1 => ['country' => 'Kenya',     'title' => 'Maasai Mara National Reserve',   'badge' => 'Most Popular',          'cta_text' => 'Explore Kenya'],
        2 => ['country' => 'Tanzania',  'title' => 'Serengeti & Ngorongoro Crater',  'badge' => '',                      'cta_text' => 'Explore Tanzania'],
        3 => ['country' => 'Uganda',    'title' => 'Bwindi Impenetrable Forest',     'badge' => 'Bucket List',           'cta_text' => 'Explore Uganda'],
        4 => ['country' => 'Tanzania',  'title' => 'Zanzibar Archipelago',           'badge' => '',                      'cta_text' => 'Explore Zanzibar'],
        5 => ['country' => 'Kenya',     'title' => 'Amboseli National Park',         'badge' => '',                      'cta_text' => 'Explore Kenya'],
        6 => ['country' => 'Ethiopia',  'title' => 'Simien Mountains',               'badge' => 'Off The Beaten Path',   'cta_text' => 'Explore Ethiopia'],
    ];

    for ($i = 1; $i <= 6; $i++) {
        $base_priority = 200 + ($i * 10);
        $def = $card_defaults[$i];

        // Image
        $wp_customize->add_setting("pride_destinations_card_{$i}_image", [
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control(
            new WP_Customize_Media_Control($wp_customize, "pride_destinations_card_{$i}_image", [
                'label'    => sprintf(esc_html__('Destination %d — Image', 'pride-of-africa'), $i),
                'section'  => 'pride_destinations_section',
                'mime_type'=> 'image',
                'priority' => $base_priority,
            ])
        );

        // Country
        $wp_customize->add_setting("pride_destinations_card_{$i}_country", [
            'default'           => $def['country'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_destinations_card_{$i}_country", [
            'label'    => sprintf(esc_html__('Destination %d — Country', 'pride-of-africa'), $i),
            'section'  => 'pride_destinations_section',
            'type'     => 'text',
            'priority' => $base_priority + 1,
        ]);

        // Title
        $wp_customize->add_setting("pride_destinations_card_{$i}_title", [
            'default'           => $def['title'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_destinations_card_{$i}_title", [
            'label'    => sprintf(esc_html__('Destination %d — Title', 'pride-of-africa'), $i),
            'section'  => 'pride_destinations_section',
            'type'     => 'text',
            'priority' => $base_priority + 2,
        ]);

        // Description
        $wp_customize->add_setting("pride_destinations_card_{$i}_description", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_destinations_card_{$i}_description", [
            'label'    => sprintf(esc_html__('Destination %d — Description', 'pride-of-africa'), $i),
            'section'  => 'pride_destinations_section',
            'type'     => 'textarea',
            'priority' => $base_priority + 3,
        ]);

        // Badge
        $wp_customize->add_setting("pride_destinations_card_{$i}_badge", [
            'default'           => $def['badge'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_destinations_card_{$i}_badge", [
            'label'       => sprintf(esc_html__('Destination %d — Badge Label (optional)', 'pride-of-africa'), $i),
            'section'     => 'pride_destinations_section',
            'type'        => 'text',
            'priority'    => $base_priority + 4,
        ]);

        // URL
        $wp_customize->add_setting("pride_destinations_card_{$i}_url", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_destinations_card_{$i}_url", [
            'label'    => sprintf(esc_html__('Destination %d — Link URL', 'pride-of-africa'), $i),
            'section'  => 'pride_destinations_section',
            'type'     => 'url',
            'priority' => $base_priority + 5,
        ]);

        // CTA Button Text
        $wp_customize->add_setting("pride_destinations_card_{$i}_cta_text", [
            'default'           => $def['cta_text'],
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_destinations_card_{$i}_cta_text", [
            'label'    => sprintf(esc_html__('Destination %d — Button Text', 'pride-of-africa'), $i),
            'section'  => 'pride_destinations_section',
            'type'     => 'text',
            'priority' => $base_priority + 6,
        ]);
    }
}

add_action('customize_register', 'pride_of_africa_destinations_customize_register', 14);
?>
