<?php
/**
 * Why Choose Us Section Template Part
 *
 * Grid of feature cards highlighting company differentiators and value propositions.
 * Uses Font Awesome 4 icons from CDN. Centered text cards with rounded corners.
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
$section_enabled = get_theme_mod('pride_why_choose_us_enabled', true);
if (!$section_enabled) {
    return;
}

$section_eyebrow = get_theme_mod('pride_why_choose_us_eyebrow', 'WHY CHOOSE US');
$section_title = get_theme_mod('pride_why_choose_us_title', 'Why Choose Us');
$section_description = get_theme_mod('pride_why_choose_us_description', 'Your African adventure deserves local expertise');

// Default card data with Font Awesome 4 icons and content
$default_cards = [
    1 => [
        'title'       => 'Local Safari Experts',
        'description' => 'Born and raised in East Africa, our team knows every trail, lodge, and hidden gem across the savannah.',
        'icon'        => 'fa fa-map-marker',
    ],
    2 => [
        'title'       => 'Customized Itineraries',
        'description' => 'Every safari is tailored to your interests, pace, and budget — no cookie-cutter tours here.',
        'icon'        => 'fa fa-compass',
    ],
    3 => [
        'title'       => 'Trusted Travel Specialists',
        'description' => 'Licensed, insured, and recommended by thousands of international travelers since 2010.',
        'icon'        => 'fa fa-shield',
    ],
    4 => [
        'title'       => '24/7 Customer Support',
        'description' => 'From your first inquiry to your last game drive, our team is always just a message away.',
        'icon'        => 'fa fa-headphones',
    ],
    5 => [
        'title'       => 'Competitive Pricing',
        'description' => 'Direct operator rates with no middlemen — premium experiences at fair, transparent prices.',
        'icon'        => 'fa fa-usd',
    ],
    6 => [
        'title'       => 'Excellent Reviews',
        'description' => 'Rated 5 stars on TripAdvisor with hundreds of verified reviews from satisfied travelers worldwide.',
        'icon'        => 'star', // special handling for star rating
    ],
];

// Get cards (up to 6) with fallback to defaults
$cards = [];
for ($card = 1; $card <= 6; $card++) {
    $card_title = get_theme_mod("pride_why_choose_us_card_{$card}_title", $default_cards[$card]['title'] ?? '');
    
    // Skip if card title is empty (allows flexible number of cards)
    if (empty($card_title)) {
        continue;
    }
    
    $card_icon = get_theme_mod("pride_why_choose_us_card_{$card}_icon", $default_cards[$card]['icon'] ?? '');
    $card_description = get_theme_mod("pride_why_choose_us_card_{$card}_description", $default_cards[$card]['description'] ?? '');
    
    $cards[] = [
        'title'       => $card_title,
        'icon'        => $card_icon,
        'description' => $card_description,
        'number'      => $card,
    ];
}

// Only display section if we have cards
if (empty($cards)) {
    return;
}
?>

<section class="why-choose-us py-5" id="why-choose-us">
    <div class="container-site">
        
        <!-- Section Header -->
        <div class="section-header text-center mb-5">
            <?php if (!empty($section_eyebrow)) : ?>
                <div class="eyebrow mb-2">
                    <?php echo esc_html($section_eyebrow); ?>
                </div>
            <?php endif; ?>
            
            <h2 class="section-title">
                <?php echo esc_html($section_title); ?>
            </h2>
            
            <?php if (!empty($section_description)) : ?>
                <p class="section-description">
                    <?php echo esc_html($section_description); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Cards Grid -->
        <div class="row g-4">
            <?php foreach ($cards as $card) : ?>
                <div class="col-lg-6 col-xl-4">
                    <div class="why-choose-card card h-100">
                        
                        <!-- Card Header (Font Awesome 4 Icon) -->
                        <div class="card-header-custom">
                            <div class="card-icon">
                                <?php if ($card['icon'] === 'star') : ?>
                                    <!-- Five star display for Excellent Reviews -->
                                    <div class="card-stars">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                <?php elseif (strpos($card['icon'], '<') !== false) : ?>
                                    <?php echo $card['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- Sanitized via pride_of_africa_sanitize_svg_icon() on save. ?>
                                <?php else : ?>
                                    <i class="<?php echo esc_attr($card['icon']); ?>" aria-hidden="true"></i>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <h3 class="card-title">
                                <?php echo esc_html($card['title']); ?>
                            </h3>
                            
                            <?php if (!empty($card['description'])) : ?>
                                <p class="card-text">
                                    <?php echo esc_html($card['description']); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>