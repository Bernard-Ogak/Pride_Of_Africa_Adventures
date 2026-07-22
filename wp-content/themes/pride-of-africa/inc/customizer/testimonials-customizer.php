<?php
/**
 * Testimonials Section Customizer Settings
 *
 * Lets an admin add and manage homepage testimonials manually from
 * Appearance → Customize, without touching the Testimonials CPT.
 * Supports up to 12 manual entries, each with a message, star rating,
 * reviewer name, reviewer avatar, and source platform.
 *
 * @package Pride_Of_Africa
 * @subpackage Customizer
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Clamp a Customizer rating value to the 1–5 range.
 */
function pride_of_africa_sanitize_testimonial_rating($value) {
    $value = absint($value);
    return min(5, max(1, $value ?: 5));
}

/**
 * Register Testimonials customizer settings and controls
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance
 * @return void
 */
function pride_of_africa_testimonials_customize_register($wp_customize) {

    $wp_customize->add_section('pride_testimonials_section', [
        'title'       => esc_html__('Testimonials', 'pride-of-africa'),
        'description' => esc_html__('Manually add and manage the reviews shown in the homepage Testimonials section.', 'pride-of-africa'),
        'priority'    => 29,
    ]);

    $wp_customize->add_setting('pride_testimonials_enabled', [
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_testimonials_enabled', [
        'label'    => esc_html__('Enable Testimonials Section', 'pride-of-africa'),
        'section'  => 'pride_testimonials_section',
        'type'     => 'checkbox',
        'priority' => 10,
    ]);

    $platform_choices = [
        'tripadvisor'    => esc_html__('TripAdvisor', 'pride-of-africa'),
        'safaribookings' => esc_html__('SafariBookings', 'pride-of-africa'),
        'trustpilot'     => esc_html__('Trustpilot', 'pride-of-africa'),
    ];

    // Up to 12 manually managed testimonials.
    for ($i = 1; $i <= 12; $i++) {

        // 1. Message
        $wp_customize->add_setting("pride_testimonials_{$i}_message", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_testimonials_{$i}_message", [
            'label'    => sprintf(esc_html__('Testimonial %d — Message', 'pride-of-africa'), $i),
            'section'  => 'pride_testimonials_section',
            'type'     => 'textarea',
            'priority' => 100 + ($i * 10),
        ]);

        // 2. Number of Stars
        $wp_customize->add_setting("pride_testimonials_{$i}_rating", [
            'default'           => 5,
            'sanitize_callback' => 'pride_of_africa_sanitize_testimonial_rating',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_testimonials_{$i}_rating", [
            'label'       => sprintf(esc_html__('Testimonial %d — Number of Stars', 'pride-of-africa'), $i),
            'section'     => 'pride_testimonials_section',
            'type'        => 'number',
            'input_attrs' => [
                'min' => 1,
                'max' => 5,
                'step' => 1,
            ],
            'priority'    => 100 + ($i * 10) + 1,
        ]);

        // 3. Reviewer's Name
        $wp_customize->add_setting("pride_testimonials_{$i}_name", [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_testimonials_{$i}_name", [
            'label'    => sprintf(esc_html__('Testimonial %d — Reviewer Name', 'pride-of-africa'), $i),
            'section'  => 'pride_testimonials_section',
            'type'     => 'text',
            'priority' => 100 + ($i * 10) + 2,
        ]);

        // 4. Reviewer's Avatar or Picture
        $wp_customize->add_setting("pride_testimonials_{$i}_avatar", [
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control(
            new WP_Customize_Media_Control($wp_customize, "pride_testimonials_{$i}_avatar", [
                'label'     => sprintf(esc_html__('Testimonial %d — Reviewer Avatar/Picture', 'pride-of-africa'), $i),
                'section'   => 'pride_testimonials_section',
                'mime_type' => 'image',
                'priority'  => 100 + ($i * 10) + 3,
            ])
        );

        // 5. Platform
        $wp_customize->add_setting("pride_testimonials_{$i}_platform", [
            'default'           => 'tripadvisor',
            'sanitize_callback' => 'sanitize_key',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_testimonials_{$i}_platform", [
            'label'    => sprintf(esc_html__('Testimonial %d — Platform', 'pride-of-africa'), $i),
            'section'  => 'pride_testimonials_section',
            'type'     => 'select',
            'choices'  => $platform_choices,
            'priority' => 100 + ($i * 10) + 4,
        ]);
    }
}

add_action('customize_register', 'pride_of_africa_testimonials_customize_register', 13);
