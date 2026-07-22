<?php
/**
 * Why Choose Us Section Customizer Settings
 *
 * Provides customizer settings to manage Why Choose Us feature cards section.
 * Supports up to 6 cards, each with title, icon (SVG), and description.
 *
 * @package Pride_Of_Africa
 * @subpackage Customizer
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sanitize the Why Choose Us card icon field.
 *
 * Accepts either a Font Awesome class string (e.g. "fa fa-map-marker") or
 * pasted SVG markup. Plain `wp_kses_post()` strips `<svg>`/`<path>` tags
 * since they are not part of the default post tag allowlist, so SVG input
 * is run through a dedicated allowlist instead.
 *
 * @param string $input Raw control value.
 * @return string Sanitized value.
 */
function pride_of_africa_sanitize_svg_icon($input) {
    if (empty($input)) {
        return '';
    }

    // Not markup — treat as a Font Awesome (or similar) icon class name.
    if (strpos($input, '<') === false) {
        return sanitize_text_field($input);
    }

    $allowed_svg_tags = [
        'svg'      => ['class' => true, 'width' => true, 'height' => true, 'viewbox' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true, 'xmlns' => true, 'aria-hidden' => true, 'focusable' => true],
        'path'     => ['d' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true, 'stroke-linecap' => true, 'stroke-linejoin' => true],
        'circle'   => ['cx' => true, 'cy' => true, 'r' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true],
        'rect'     => ['x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true, 'ry' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true],
        'line'     => ['x1' => true, 'y1' => true, 'x2' => true, 'y2' => true, 'stroke' => true, 'stroke-width' => true],
        'polyline' => ['points' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true],
        'polygon'  => ['points' => true, 'fill' => true, 'stroke' => true, 'stroke-width' => true],
        'g'        => ['fill' => true, 'stroke' => true],
    ];

    return wp_kses($input, $allowed_svg_tags);
}

/**
 * Register Why Choose Us customizer settings and controls
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance
 * @return void
 */
function pride_of_africa_why_choose_us_customize_register($wp_customize) {
    
    // =========================================================================
    // SECTION: WHY CHOOSE US
    // =========================================================================
    
    $wp_customize->add_section('pride_why_choose_us_section', [
        'title'       => esc_html__('Why Choose Us', 'pride-of-africa'),
        'description' => esc_html__('Configure Why Choose Us feature cards section', 'pride-of-africa'),
        'priority'    => 27,
    ]);

    // =========================================================================
    // ENABLE/DISABLE SECTION
    // =========================================================================

    $wp_customize->add_setting('pride_why_choose_us_enabled', [
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_why_choose_us_enabled', [
        'label'       => esc_html__('Enable Why Choose Us Section', 'pride-of-africa'),
        'section'     => 'pride_why_choose_us_section',
        'type'        => 'checkbox',
        'priority'    => 10,
    ]);

    // =========================================================================
    // SECTION CONTENT (Header)
    // =========================================================================

    // Eyebrow/Label
    $wp_customize->add_setting('pride_why_choose_us_eyebrow', [
        'default'           => esc_html__('WHY CHOOSE US', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_why_choose_us_eyebrow', [
        'label'    => esc_html__('Eyebrow Label', 'pride-of-africa'),
        'section'  => 'pride_why_choose_us_section',
        'type'     => 'text',
        'priority' => 20,
    ]);

    // Section Title
    $wp_customize->add_setting('pride_why_choose_us_title', [
        'default'           => esc_html__('Why Pride of Africa Adventures', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_why_choose_us_title', [
        'label'    => esc_html__('Section Title', 'pride-of-africa'),
        'section'  => 'pride_why_choose_us_section',
        'type'     => 'text',
        'priority' => 30,
    ]);

    // Section Description
    $wp_customize->add_setting('pride_why_choose_us_description', [
        'default'           => esc_html__('We combine local expertise with international standards to deliver unforgettable African safari experiences.', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_why_choose_us_description', [
        'label'    => esc_html__('Section Description', 'pride-of-africa'),
        'section'  => 'pride_why_choose_us_section',
        'type'     => 'textarea',
        'priority' => 40,
    ]);

    // =========================================================================
    // FEATURE CARDS (up to 6)
    // =========================================================================

    $card_defaults = [
        1 => [
            'title'       => esc_html__('Expert Local Guides', 'pride-of-africa'),
            'description' => esc_html__('Our guides are native Africans with decades of experience and deep knowledge of wildlife behavior and ecosystems.', 'pride-of-africa'),
        ],
        2 => [
            'title'       => esc_html__('Customized Itineraries', 'pride-of-africa'),
            'description' => esc_html__('We craft bespoke safari experiences tailored to your interests, budget, and travel style.', 'pride-of-africa'),
        ],
        3 => [
            'title'       => esc_html__('Luxury & Budget Options', 'pride-of-africa'),
            'description' => esc_html__('From intimate luxury lodges to value-packed group safaris, we have options for every budget.', 'pride-of-africa'),
        ],
        4 => [
            'title'       => esc_html__('24/7 Customer Support', 'pride-of-africa'),
            'description' => esc_html__('Our team is available round-the-clock to assist with any questions before, during, or after your safari.', 'pride-of-africa'),
        ],
        5 => [
            'title'       => esc_html__('Safety & Comfort', 'pride-of-africa'),
            'description' => esc_html__('We prioritize your safety and comfort with modern vehicles, professional guides, and quality accommodations.', 'pride-of-africa'),
        ],
        6 => [
            'title'       => esc_html__('Transparent Pricing', 'pride-of-africa'),
            'description' => esc_html__('No hidden fees. We provide detailed quotes and clear communication about what\'s included in every package.', 'pride-of-africa'),
        ],
    ];

    for ($card = 1; $card <= 6; $card++) {
        $default_title = isset($card_defaults[$card]['title']) ? $card_defaults[$card]['title'] : '';
        $default_desc  = isset($card_defaults[$card]['description']) ? $card_defaults[$card]['description'] : '';

        // Card Title
        $wp_customize->add_setting("pride_why_choose_us_card_{$card}_title", [
            'default'           => $default_title,
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_why_choose_us_card_{$card}_title", [
            'label'       => sprintf(esc_html__('Card %d — Title', 'pride-of-africa'), $card),
            'section'     => 'pride_why_choose_us_section',
            'type'        => 'text',
            'priority'    => 100 + ($card * 10),
        ]);

        // Card Icon (SVG code or Font Awesome class)
        $wp_customize->add_setting("pride_why_choose_us_card_{$card}_icon", [
            'default'           => '',
            'sanitize_callback' => 'pride_of_africa_sanitize_svg_icon',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_why_choose_us_card_{$card}_icon", [
            'label'       => sprintf(esc_html__('Card %d — Icon (SVG Code)', 'pride-of-africa'), $card),
            'description' => esc_html__('Paste SVG code or leave blank for default circle icon. Keep SVG simple (48x48px recommended).', 'pride-of-africa'),
            'section'     => 'pride_why_choose_us_section',
            'type'        => 'textarea',
            'priority'    => 100 + ($card * 10) + 1,
        ]);

        // Card Description
        $wp_customize->add_setting("pride_why_choose_us_card_{$card}_description", [
            'default'           => $default_desc,
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_why_choose_us_card_{$card}_description", [
            'label'       => sprintf(esc_html__('Card %d — Description', 'pride-of-africa'), $card),
            'section'     => 'pride_why_choose_us_section',
            'type'        => 'textarea',
            'priority'    => 100 + ($card * 10) + 2,
        ]);
    }
}

// Hook into customize_register
add_action('customize_register', 'pride_of_africa_why_choose_us_customize_register', 12);
?>
