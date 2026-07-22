<?php
/**
 * Hero Slider Template Part
 *
 * Full-screen hero slider with 4 slides, autoplay, navigation, and animations
 *
 * This template displays the hero slider with dynamic content from the Customizer.
 * It does NOT enqueue any assets — all assets are enqueued conditionally in functions.php.
 *
 * @package Pride_Of_Africa
 * @subpackage Templates
 * @since 1.0.0
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get hero slider slides data from Customizer
 *
 * Fetches all 4 slides with their customizer content and provides fallbacks
 *
 * @since 1.0.0
 * @return array Array of slide data with all content and image URLs
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

// Get slides data
$slides = pride_of_africa_get_hero_slides();
?>

<section class="hero-slider" id="hero-slider" role="region" aria-label="<?php esc_attr_e('Hero Slider', 'pride-of-africa'); ?>">

    <!-- Hero Slides Container -->
    <div class="hero-slides-wrapper">
        <div class="hero-slides">

            <?php foreach ($slides as $index => $slide) : ?>

                <div class="hero-slide" data-slide="<?php echo esc_attr($index); ?>" role="tabpanel" aria-label="<?php echo esc_attr(sprintf(__('Slide %d of %d', 'pride-of-africa'), $index + 1, count($slides))); ?>">

                    <!-- Background Image with Lazy Loading -->
                    <div class="hero-slide-bg"
                         style="background-image: url('<?php echo esc_attr($slide['image_url']); ?>');"
                         role="img"
                         aria-label="<?php echo esc_attr($slide['title']); ?>">
                    </div>

                    <!-- Dark Gradient Overlay -->
                    <div class="hero-slide-overlay"></div>

                    <!-- Slide Content -->
                    <div class="hero-slide-content">
                        <div class="container-site h-100 d-flex align-items-center">
                            <div class="hero-content">

                                <!-- Eyebrow Label with Gold Separator Line -->
                                <?php if (!empty($slide['eyebrow'])) : ?>
                                    <div class="hero-eyebrow-wrapper">
                                        <span class="gold-separator-inline" aria-hidden="true"></span>
                                        <span class="eyebrow">
                                            <?php echo esc_html($slide['eyebrow']); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <!-- Main Heading (h1 for first slide, h2 for others for SEO) -->
                                <?php
                                $heading_tag = $index === 0 ? 'h1' : 'h2';
                                printf(
                                    '<%s class="hero-title">%s</%s>',
                                    esc_html($heading_tag),
                                    esc_html($slide['title']),
                                    esc_html($heading_tag)
                                );
                                ?>

                                <!-- Description -->
                                <p class="hero-description">
                                    <?php echo esc_html($slide['description']); ?>
                                </p>

                                <!-- CTA Buttons -->
                                <div class="hero-buttons">
                                    <a href="<?php echo esc_url($slide['btn_primary_url']); ?>"
                                       class="btn btn-primary hero-btn-primary"
                                       aria-label="<?php echo esc_attr($slide['btn_primary_text']); ?>">
                                        <?php echo esc_html($slide['btn_primary_text']); ?>
                                    </a>
                                    <a href="<?php echo esc_url($slide['btn_secondary_url']); ?>"
                                       class="btn btn-outline hero-btn-secondary"
                                       aria-label="<?php echo esc_attr($slide['btn_secondary_text']); ?>">
                                        <?php echo esc_html($slide['btn_secondary_text']); ?>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>
    </div>

    <!-- Navigation: Previous Slide Button -->
    <button class="hero-nav-btn hero-nav-prev"
            id="hero-nav-prev"
            type="button"
            aria-label="<?php esc_attr_e('Previous Slide', 'pride-of-africa'); ?>"
            aria-controls="hero-slider">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>

    <!-- Navigation: Next Slide Button -->
    <button class="hero-nav-btn hero-nav-next"
            id="hero-nav-next"
            type="button"
            aria-label="<?php esc_attr_e('Next Slide', 'pride-of-africa'); ?>"
            aria-controls="hero-slider">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </button>

    <!-- Progress Indicators (Slide Dots) -->
    <div class="hero-indicators" role="tablist" aria-label="<?php esc_attr_e('Slide Indicators', 'pride-of-africa'); ?>">
        <?php foreach ($slides as $index => $slide) : ?>
            <button class="hero-indicator<?php echo $index === 0 ? ' active' : ''; ?>"
                    data-slide="<?php echo esc_attr($index); ?>"
                    type="button"
                    role="tab"
                    aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                    aria-label="<?php echo esc_attr(sprintf(__('Go to slide %d', 'pride-of-africa'), $index + 1)); ?>"
                    aria-controls="hero-slider">
                <span class="sr-only"><?php echo esc_html(sprintf(__('Slide %d', 'pride-of-africa'), $index + 1)); ?></span>
            </button>
        <?php endforeach; ?>
    </div>

</section>

<?php
// NOTE: Asset enqueueing (CSS and JS) happens in functions.php via
// pride_of_africa_enqueue_home_assets() which is hooked to wp_enqueue_scripts.
// This template contains ONLY presentation logic and markup.
?>
