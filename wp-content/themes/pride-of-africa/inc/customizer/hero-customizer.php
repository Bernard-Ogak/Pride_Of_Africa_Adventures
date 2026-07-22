<?php
/**
 * Hero Slider Customizer Settings
 *
 * @package Pride_Of_Africa
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register hero slider customizer settings
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance
 */
function pride_of_africa_hero_customize_register($wp_customize) {
    // Create hero section
    $wp_customize->add_section('pride_hero_slider', [
        'title'       => esc_html__('Hero Slider', 'pride-of-africa'),
        'description' => esc_html__('Configure hero slider content and settings', 'pride-of-africa'),
        'priority'    => 25,
    ]);

    // Loop through 4 slides
    for ($slide = 1; $slide <= 4; $slide++) {
        $slide_key = "slide_$slide";

        // Slide eyebrow/label
        $wp_customize->add_setting("pride_hero_{$slide_key}_eyebrow", [
            'default'           => pride_of_africa_get_default_hero_eyebrow($slide),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_hero_{$slide_key}_eyebrow", [
            'label'       => sprintf(esc_html__('Slide %d — Eyebrow Label', 'pride-of-africa'), $slide),
            'section'     => 'pride_hero_slider',
            'type'        => 'text',
            'priority'    => 10 + ($slide * 100),
        ]);

        // Slide title
        $wp_customize->add_setting("pride_hero_{$slide_key}_title", [
            'default'           => pride_of_africa_get_default_hero_title($slide),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_hero_{$slide_key}_title", [
            'label'       => sprintf(esc_html__('Slide %d — Heading', 'pride-of-africa'), $slide),
            'section'     => 'pride_hero_slider',
            'type'        => 'textarea',
            'priority'    => 20 + ($slide * 100),
        ]);

        // Slide description
        $wp_customize->add_setting("pride_hero_{$slide_key}_description", [
            'default'           => pride_of_africa_get_default_hero_description($slide),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_hero_{$slide_key}_description", [
            'label'       => sprintf(esc_html__('Slide %d — Description', 'pride-of-africa'), $slide),
            'section'     => 'pride_hero_slider',
            'type'        => 'textarea',
            'priority'    => 30 + ($slide * 100),
        ]);

        // Slide background image
        $wp_customize->add_setting("pride_hero_{$slide_key}_image", [
            'default'           => '',
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control(
            new WP_Customize_Media_Control($wp_customize, "pride_hero_{$slide_key}_image", [
                'label'       => sprintf(esc_html__('Slide %d — Background Image', 'pride-of-africa'), $slide),
                'section'     => 'pride_hero_slider',
                'mime_type'   => 'image',
                'priority'    => 40 + ($slide * 100),
            ])
        );

        // Slide primary button text
        $wp_customize->add_setting("pride_hero_{$slide_key}_btn_primary_text", [
            'default'           => esc_html__('Plan My Safari', 'pride-of-africa'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_hero_{$slide_key}_btn_primary_text", [
            'label'       => sprintf(esc_html__('Slide %d — Primary Button Text', 'pride-of-africa'), $slide),
            'section'     => 'pride_hero_slider',
            'type'        => 'text',
            'priority'    => 50 + ($slide * 100),
        ]);

        // Slide primary button URL
        $wp_customize->add_setting("pride_hero_{$slide_key}_btn_primary_url", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_hero_{$slide_key}_btn_primary_url", [
            'label'       => sprintf(esc_html__('Slide %d — Primary Button URL', 'pride-of-africa'), $slide),
            'section'     => 'pride_hero_slider',
            'type'        => 'url',
            'priority'    => 60 + ($slide * 100),
        ]);

        // Slide secondary button text
        $wp_customize->add_setting("pride_hero_{$slide_key}_btn_secondary_text", [
            'default'           => esc_html__('Get Free Safari Proposal', 'pride-of-africa'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_hero_{$slide_key}_btn_secondary_text", [
            'label'       => sprintf(esc_html__('Slide %d — Secondary Button Text', 'pride-of-africa'), $slide),
            'section'     => 'pride_hero_slider',
            'type'        => 'text',
            'priority'    => 70 + ($slide * 100),
        ]);

        // Slide secondary button URL
        $wp_customize->add_setting("pride_hero_{$slide_key}_btn_secondary_url", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control("pride_hero_{$slide_key}_btn_secondary_url", [
            'label'       => sprintf(esc_html__('Slide %d — Secondary Button URL', 'pride-of-africa'), $slide),
            'section'     => 'pride_hero_slider',
            'type'        => 'url',
            'priority'    => 80 + ($slide * 100),
        ]);
    }

    // Autoplay interval
    $wp_customize->add_setting('pride_hero_autoplay_interval', [
        'default'           => 6000,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_hero_autoplay_interval', [
        'label'       => esc_html__('Autoplay Interval (milliseconds)', 'pride-of-africa'),
        'section'     => 'pride_hero_slider',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 3000,
            'max'  => 15000,
            'step' => 500,
        ],
        'priority'    => 500,
    ]);
}

/**
 * Get default eyebrow for slide
 *
 * @param int $slide Slide number
 * @return string
 */
function pride_of_africa_get_default_hero_eyebrow($slide) {
    $eyebrows = [
        1 => esc_html__('DISCOVER', 'pride-of-africa'),
        2 => esc_html__('AUTHENTIC', 'pride-of-africa'),
        3 => esc_html__('LUXURY', 'pride-of-africa'),
        4 => esc_html__('EXPERIENCE', 'pride-of-africa'),
    ];
    return $eyebrows[$slide] ?? '';
}

/**
 * Get default title for slide
 *
 * @param int $slide Slide number
 * @return string
 */
function pride_of_africa_get_default_hero_title($slide) {
    $titles = [
        1 => esc_html__('From Big Five Safaris to Tropical Beach Escapes', 'pride-of-africa'),
        2 => esc_html__('Authentic African Safaris Designed by Local Safari Experts', 'pride-of-africa'),
        3 => esc_html__('Luxury & Budget Safaris', 'pride-of-africa'),
        4 => esc_html__("Discover Africa's Most Extraordinary Wildlife Experiences", 'pride-of-africa'),
    ];
    return $titles[$slide] ?? '';
}

/**
 * Get default description for slide
 *
 * @param int $slide Slide number
 * @return string
 */
function pride_of_africa_get_default_hero_description($slide) {
    $descriptions = [
        1 => esc_html__('Combine thrilling safari adventures with world-class beaches in Zanzibar and Seychelles.', 'pride-of-africa'),
        2 => esc_html__('Explore Kenya, Tanzania, Uganda, Ethiopia, Zanzibar and Seychelles through customized luxury, family and adventure safari experiences.', 'pride-of-africa'),
        3 => esc_html__('From intimate luxury lodges to value-packed group safaris — we craft the perfect African experience for every budget.', 'pride-of-africa'),
        4 => esc_html__('Private safaris, luxury lodges, family adventures and unforgettable African journeys tailored around your travel dreams.', 'pride-of-africa'),
    ];
    return $descriptions[$slide] ?? '';
}

/**
 * Assemble hero slides from Customizer settings for template-parts/home/hero.php.
 *
 * Lives here (rather than the orphaned template-parts/home-legacy/hero.php copy)
 * so it is actually loaded via functions.php's require_once of this file.
 *
 * @return array
 */
function pride_of_africa_get_hero_slides() {
    $slides = [];

    for ($slide = 1; $slide <= 4; $slide++) {
        $slide_key  = "slide_$slide";
        $image_id   = get_theme_mod("pride_hero_{$slide_key}_image", '');
        $image_url  = $image_id ? wp_get_attachment_image_url($image_id, 'hero-slide') : '';

        // Use fallback image if no image is set in customizer
        if (empty($image_url)) {
            $fallback_images = [
                1 => PRIDE_OF_AFRICA_IMAGES . '/default/hero-1.jpg',
                2 => PRIDE_OF_AFRICA_IMAGES . '/default/hero-2.jpg',
                3 => PRIDE_OF_AFRICA_IMAGES . '/default/hero-3.jpg',
                4 => PRIDE_OF_AFRICA_IMAGES . '/default/hero-4.jpg',
            ];
            $image_url = isset($fallback_images[$slide]) ? $fallback_images[$slide] : '';
        }

        $slides[] = [
            'eyebrow'            => get_theme_mod(
                "pride_hero_{$slide_key}_eyebrow",
                pride_of_africa_get_default_hero_eyebrow($slide)
            ),
            'title'              => get_theme_mod(
                "pride_hero_{$slide_key}_title",
                pride_of_africa_get_default_hero_title($slide)
            ),
            'description'        => get_theme_mod(
                "pride_hero_{$slide_key}_description",
                pride_of_africa_get_default_hero_description($slide)
            ),
            'image_url'          => esc_url($image_url),
            'btn_primary_text'   => get_theme_mod(
                "pride_hero_{$slide_key}_btn_primary_text",
                esc_html__('Plan My Safari', 'pride-of-africa')
            ),
            'btn_primary_url'    => esc_url(
                get_theme_mod("pride_hero_{$slide_key}_btn_primary_url", home_url('/contact'))
            ),
            'btn_secondary_text' => get_theme_mod(
                "pride_hero_{$slide_key}_btn_secondary_text",
                esc_html__('Get Free Safari Proposal', 'pride-of-africa')
            ),
            'btn_secondary_url'  => esc_url(
                get_theme_mod("pride_hero_{$slide_key}_btn_secondary_url", home_url('/contact'))
            ),
            'slide_number'       => $slide,
        ];
    }

    return $slides;
}

// Hook into customize_register
add_action('customize_register', 'pride_of_africa_hero_customize_register');

?>
