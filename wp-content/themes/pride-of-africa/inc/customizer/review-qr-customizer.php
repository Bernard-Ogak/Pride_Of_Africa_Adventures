<?php
/**
 * Review QR Code Customizer Settings
 *
 * Controls the destination URL the QR code links to (defaults to the
 * Review Hub page) and lets an admin upload a branded QR image instead
 * of the auto-generated one.
 *
 * @package Pride_Of_Africa
 * @subpackage Customizer
 */

if (!defined('ABSPATH')) {
    exit;
}

function pride_of_africa_review_qr_customize_register($wp_customize) {

    $wp_customize->add_section('pride_review_qr_section', [
        'title'       => esc_html__('Review QR Code', 'pride-of-africa'),
        'description' => esc_html__('Controls the "Scan to Leave a Review" QR code shown in the footer and on the Review Hub page.', 'pride-of-africa'),
        'priority'    => 32,
    ]);

    $wp_customize->add_setting('pride_review_qr_url', [
        'default'           => home_url('/reviews'),
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_review_qr_url', [
        'label'       => esc_html__('QR Destination URL', 'pride-of-africa'),
        'description' => esc_html__('Where the QR code sends visitors. Defaults to the Review Hub page.', 'pride-of-africa'),
        'section'     => 'pride_review_qr_section',
        'type'        => 'url',
    ]);

    $wp_customize->add_setting('pride_review_qr_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pride_review_qr_image', [
        'label'       => esc_html__('Custom QR Code Image', 'pride-of-africa'),
        'description' => esc_html__('Optional. Upload a branded QR image (SVG or PNG). Leave empty to auto-generate one from the destination URL above.', 'pride-of-africa'),
        'section'     => 'pride_review_qr_section',
    ]));
}
add_action('customize_register', 'pride_of_africa_review_qr_customize_register', 15);
