<?php
/**
 * Customizer settings for the new poa-homepage-templates sections.
 *
 * These are genuinely new fields introduced by the poa-homepage-templates
 * package — final CTA background image and review-site links — that have
 * no equivalent among the theme's existing Customizer settings.
 *
 * @package Pride_Of_Africa
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register new-section customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance
 */
function pride_of_africa_poa_new_sections_customize_register($wp_customize) {
    $wp_customize->add_section('poa_new_sections', [
        'title'       => esc_html__('New Homepage Sections', 'pride-of-africa'),
        'description' => esc_html__('Settings for the Final CTA background and review links added with the new homepage template package.', 'pride-of-africa'),
        'priority'    => 30,
    ]);

    // Final CTA background image
    $wp_customize->add_setting('poa_final_cta_image', [
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'poa_final_cta_image',
        [
            'label'    => esc_html__('Final CTA Background Image', 'pride-of-africa'),
            'section'  => 'poa_new_sections',
            'priority' => 10,
        ]
    ));

    // TripAdvisor review URL
    $wp_customize->add_setting('poa_tripadvisor_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('poa_tripadvisor_url', [
        'label'       => esc_html__('TripAdvisor Review URL', 'pride-of-africa'),
        'description' => esc_html__('Leave blank to hide the TripAdvisor button on the "Leave a Review" section.', 'pride-of-africa'),
        'section'     => 'poa_new_sections',
        'type'        => 'url',
        'priority'    => 20,
    ]);

    // Google review URL
    $wp_customize->add_setting('poa_google_review_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('poa_google_review_url', [
        'label'       => esc_html__('Google Review URL', 'pride-of-africa'),
        'description' => esc_html__('Leave blank to hide the Google Reviews button on the "Leave a Review" section.', 'pride-of-africa'),
        'section'     => 'poa_new_sections',
        'type'        => 'url',
        'priority'    => 30,
    ]);
}
add_action('customize_register', 'pride_of_africa_poa_new_sections_customize_register');
