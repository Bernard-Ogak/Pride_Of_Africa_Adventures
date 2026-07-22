<?php
/**
 * Trusted Partners Section Customizer Settings
 *
 * Provides customizer settings to manage Trusted Partners marquee section.
 * Supports up to 12 partner logos with name, image, and optional URL.
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
 * Register Trusted Partners customizer settings and controls
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance
 * @return void
 */
function pride_of_africa_trusted_partners_customize_register($wp_customize) {
    
    // =========================================================================
    // SECTION: TRUSTED PARTNERS
    // =========================================================================
    
    $wp_customize->add_section('pride_trusted_partners_section', [
        'title'       => esc_html__('Trusted Partners', 'pride-of-africa'),
        'description' => esc_html__('Configure Trusted Partners marquee section with partner logos', 'pride-of-africa'),
        'priority'    => 28,
    ]);

    // =========================================================================
    // ENABLE/DISABLE SECTION
    // =========================================================================

    $wp_customize->add_setting('pride_trusted_partners_enabled', [
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trusted_partners_enabled', [
        'label'       => esc_html__('Enable Trusted Partners Section', 'pride-of-africa'),
        'section'     => 'pride_trusted_partners_section',
        'type'        => 'checkbox',
        'priority'    => 10,
    ]);

    // =========================================================================
    // SECTION HEADER
    // =========================================================================

    // Section Title
    $wp_customize->add_setting('pride_trusted_partners_title', [
        'default'           => esc_html__('Our Trusted Partners', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trusted_partners_title', [
        'label'    => esc_html__('Section Title', 'pride-of-africa'),
        'section'  => 'pride_trusted_partners_section',
        'type'     => 'text',
        'priority' => 20,
    ]);

    // Section Description
    $wp_customize->add_setting('pride_trusted_partners_description', [
        'default'           => esc_html__('We work with leading hospitality, tourism, and conservation organizations across Africa.', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trusted_partners_description', [
        'label'    => esc_html__('Section Description', 'pride-of-africa'),
        'section'  => 'pride_trusted_partners_section',
        'type'     => 'textarea',
        'priority' => 30,
    ]);

    // =========================================================================
    // MARQUEE ANIMATION SPEED
    // =========================================================================

    $wp_customize->add_setting('pride_trusted_partners_speed', [
        'default'           => '40',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trusted_partners_speed', [
        'label'       => esc_html__('Marquee Speed (seconds)', 'pride-of-africa'),
        'description' => esc_html__('Lower = faster animation. Recommended: 40-60 seconds', 'pride-of-africa'),
        'section'     => 'pride_trusted_partners_section',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 20,
            'max'  => 120,
            'step' => 5,
        ],
        'priority'    => 40,
    ]);

    // =========================================================================
    // PARTNER LOGOS (up to 12)
    // =========================================================================

    for ($logo = 1; $logo <= 12; $logo++) {
        // Partner Logo Image
        $wp_customize->add_setting("pride_trusted_partners_logo_{$logo}_image", [
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control(
            new WP_Customize_Media_Control($wp_customize, "pride_trusted_partners_logo_{$logo}_image", [
                'label'       => sprintf(esc_html__('Partner %d — Logo Image', 'pride-of-africa'), $logo),
                'section'     => 'pride_trusted_partners_section',
                'mime_type'   => 'image',
                'priority'    => 100 + ($logo * 10),
            ])
        );

        // Partner Name
        $wp_customize->add_setting("pride_trusted_partners_logo_{$logo}_name", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_trusted_partners_logo_{$logo}_name", [
            'label'       => sprintf(esc_html__('Partner %d — Name (alt text)', 'pride-of-africa'), $logo),
            'section'     => 'pride_trusted_partners_section',
            'type'        => 'text',
            'priority'    => 100 + ($logo * 10) + 1,
        ]);

        // Partner URL (optional)
        $wp_customize->add_setting("pride_trusted_partners_logo_{$logo}_url", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_trusted_partners_logo_{$logo}_url", [
            'label'       => sprintf(esc_html__('Partner %d — Website URL (optional)', 'pride-of-africa'), $logo),
            'section'     => 'pride_trusted_partners_section',
            'type'        => 'url',
            'priority'    => 100 + ($logo * 10) + 2,
        ]);
    }
}

// Hook into customize_register
add_action('customize_register', 'pride_of_africa_trusted_partners_customize_register', 13);
?>
