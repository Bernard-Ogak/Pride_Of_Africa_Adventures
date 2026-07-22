<?php
/**
 * Trip Architect Form Customizer Settings
 *
 * Provides customizer settings to manage Trip Architect form section content,
 * appearance, and form field labels.
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
 * Register Trip Architect form customizer settings and controls
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance
 * @return void
 */
function pride_of_africa_trip_architect_customize_register($wp_customize) {
    
    // =========================================================================
    // SECTION: TRIP ARCHITECT FORM
    // =========================================================================
    
    $wp_customize->add_section('pride_trip_architect_section', [
        'title'       => esc_html__('Trip Architect Form', 'pride-of-africa'),
        'description' => esc_html__('Configure Trip Architect inquiry form section displayed below hero slider', 'pride-of-africa'),
        'priority'    => 26,
    ]);

    // =========================================================================
    // ENABLE/DISABLE SECTION
    // =========================================================================

    $wp_customize->add_setting('pride_trip_architect_enabled', [
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trip_architect_enabled', [
        'label'       => esc_html__('Enable Trip Architect Section', 'pride-of-africa'),
        'section'     => 'pride_trip_architect_section',
        'type'        => 'checkbox',
        'priority'    => 10,
    ]);

    // =========================================================================
    // SECTION CONTENT
    // =========================================================================

    // Section Title
    $wp_customize->add_setting('pride_trip_architect_title', [
        'default'           => esc_html__('Plan Your Perfect African Safari', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trip_architect_title', [
        'label'    => esc_html__('Section Title', 'pride-of-africa'),
        'section'  => 'pride_trip_architect_section',
        'type'     => 'text',
        'priority' => 20,
    ]);

    // Section Subtitle
    $wp_customize->add_setting('pride_trip_architect_subtitle', [
        'default'           => esc_html__('Tell us your safari dreams and let our expert team curate the perfect itinerary.', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trip_architect_subtitle', [
        'label'    => esc_html__('Section Subtitle', 'pride-of-africa'),
        'section'  => 'pride_trip_architect_section',
        'type'     => 'textarea',
        'priority' => 30,
    ]);

    // =========================================================================
    // FORM CONTENT
    // =========================================================================

    // Form Title
    $wp_customize->add_setting('pride_trip_architect_form_title', [
        'default'           => esc_html__('Quick Safari Inquiry', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trip_architect_form_title', [
        'label'    => esc_html__('Form Title', 'pride-of-africa'),
        'section'  => 'pride_trip_architect_section',
        'type'     => 'text',
        'priority' => 40,
    ]);

    // Form Description
    $wp_customize->add_setting('pride_trip_architect_form_description', [
        'default'           => esc_html__('Share your travel preferences and we\'ll create a customized safari experience.', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trip_architect_form_description', [
        'label'    => esc_html__('Form Description', 'pride-of-africa'),
        'section'  => 'pride_trip_architect_section',
        'type'     => 'textarea',
        'priority' => 50,
    ]);

    // CTA Button Text
    $wp_customize->add_setting('pride_trip_architect_form_cta', [
        'default'           => esc_html__('Get Your Free Proposal', 'pride-of-africa'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_trip_architect_form_cta', [
        'label'    => esc_html__('Form Submit Button Text', 'pride-of-africa'),
        'section'  => 'pride_trip_architect_section',
        'type'     => 'text',
        'priority' => 60,
    ]);

}

// Hook into customize_register
add_action('customize_register', 'pride_of_africa_trip_architect_customize_register', 11);
?>
