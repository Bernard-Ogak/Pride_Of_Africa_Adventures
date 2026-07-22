<?php
/**
 * Trusted Partners Section Template Part
 *
 * Marquee display of partner company logos with smooth continuous scrolling.
 * Features responsive layout, pause-on-hover, and accessibility support.
 *
 * @package Pride_Of_Africa
 * @subpackage Templates
 * @since 1.0.0
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Fetch customizer content
$section_enabled = get_theme_mod('pride_trusted_partners_enabled', true);
if (!$section_enabled) {
    return;
}

$section_title = get_theme_mod('pride_trusted_partners_title', 'Our Trusted Partners');
$section_description = get_theme_mod('pride_trusted_partners_description', 'We work with leading hospitality, tourism, and conservation organizations across Africa.');
$marquee_speed = absint(get_theme_mod('pride_trusted_partners_speed', 40));

// Get partners (up to 12)
$partners = [];
for ($partner = 1; $partner <= 12; $partner++) {
    $partner_image_id = get_theme_mod("pride_trusted_partners_logo_{$partner}_image", '');
    
    // Skip if no image is set
    if (empty($partner_image_id)) {
        continue;
    }
    
    $partner_image_url = wp_get_attachment_image_url($partner_image_id, 'full');
    $partner_name = get_theme_mod("pride_trusted_partners_logo_{$partner}_name", '');
    $partner_url = get_theme_mod("pride_trusted_partners_logo_{$partner}_url", '');

    if (!empty($partner_image_url)) {
        $partners[] = [
            'name'      => $partner_name,
            'image_url' => esc_url($partner_image_url),
            'url'       => esc_url($partner_url),
            'number'    => $partner,
        ];
    }
}

// Only display section if we have partners
if (empty($partners)) {
    return;
}
?>

<section class="trusted-partners py-5" id="trusted-partners">
    <div class="container-site">
        
        <!-- Section Header -->
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <?php echo esc_html($section_title); ?>
            </h2>
            
            <?php if (!empty($section_description)) : ?>
                <p class="section-description">
                    <?php echo esc_html($section_description); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Marquee Container -->
        <div class="marquee-wrapper" role="region" aria-label="<?php esc_attr_e('Trusted Partners', 'pride-of-africa'); ?>">
            <div class="marquee-track" style="--marquee-speed: <?php echo esc_attr($marquee_speed); ?>s;">
                
                <!-- Partner Logos (duplicated for seamless loop) -->
                <div class="marquee-content">
                    <?php 
                    // First pass: original logos
                    foreach ($partners as $partner) : 
                    ?>
                        <div class="partner-logo-item">
                            <?php if (!empty($partner['url'])) : ?>
                                <a href="<?php echo esc_url($partner['url']); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="partner-logo-link"
                                   aria-label="<?php echo esc_attr($partner['name']); ?>">
                                    <img src="<?php echo esc_url($partner['image_url']); ?>" 
                                         alt="<?php echo esc_attr($partner['name']); ?>"
                                         class="partner-logo-image"
                                         loading="lazy">
                                </a>
                            <?php else : ?>
                                <div class="partner-logo-static">
                                    <img src="<?php echo esc_url($partner['image_url']); ?>" 
                                         alt="<?php echo esc_attr($partner['name']); ?>"
                                         class="partner-logo-image"
                                         loading="lazy">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Duplicate for seamless loop (aria-hidden to avoid screen reader duplication) -->
                <div class="marquee-content" aria-hidden="true">
                    <?php 
                    // Second pass: duplicated logos for seamless scrolling
                    foreach ($partners as $partner) : 
                    ?>
                        <div class="partner-logo-item">
                            <?php if (!empty($partner['url'])) : ?>
                                <a href="<?php echo esc_url($partner['url']); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="partner-logo-link"
                                   tabindex="-1">
                                    <img src="<?php echo esc_url($partner['image_url']); ?>" 
                                         alt=""
                                         class="partner-logo-image"
                                         loading="lazy">
                                </a>
                            <?php else : ?>
                                <div class="partner-logo-static">
                                    <img src="<?php echo esc_url($partner['image_url']); ?>" 
                                         alt=""
                                         class="partner-logo-image"
                                         loading="lazy">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

        <!-- Pause Indicator (for accessibility) -->
        <p class="marquee-pause-hint">
            <?php esc_html_e('Marquee pauses on hover', 'pride-of-africa'); ?>
        </p>

    </div>
</section>

<?php
// NOTE: Asset enqueueing (CSS and JS) happens in functions.php via
// pride_of_africa_enqueue_trusted_partners_assets() which is hooked to wp_enqueue_scripts.
// This template contains ONLY presentation logic and markup.
?>
