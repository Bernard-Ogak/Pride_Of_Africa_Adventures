<?php
/**
 * Top Destinations Section Template Part
 *
 * Displays six premium safari destination cards (Kenya, Tanzania, Uganda,
 * Ethiopia, Zanzibar, Seychelles) in a responsive 3×2 grid with "Explore"
 * and "Maps" CTAs per card.
 *
 * @package Pride_Of_Africa
 * @subpackage Templates
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$section_enabled = get_theme_mod('pride_destinations_enabled', true);
if (!$section_enabled) {
    return;
}

$section_title       = get_theme_mod('pride_destinations_title',       'Top Destinations');
$section_description = get_theme_mod('pride_destinations_description', 'Explore East Africa\'s Most Extraordinary Destinations');

/**
 * Six hardcoded premium destinations.
 * Each entry includes title, description, image URL, and button labels/URLs.
 */
$destinations = [
    [
        'title'       => 'Kenya',
        'description' => 'Home of the Great Migration, the Maasai Mara, and iconic Big Five safaris.',
        'image'       => PRIDE_OF_AFRICA_IMAGES . '/default/destination-1.jpg',
        'explore_url' => home_url('/destinations/kenya'),
        'maps_url'    => 'https://maps.google.com/?q=Kenya',
    ],
    [
        'title'       => 'Tanzania',
        'description' => 'Serengeti plains, Ngorongoro Crater, and the majestic Mount Kilimanjaro.',
        'image'       => PRIDE_OF_AFRICA_IMAGES . '/default/destination-2.jpg',
        'explore_url' => home_url('/destinations/tanzania'),
        'maps_url'    => 'https://maps.google.com/?q=Tanzania',
    ],
    [
        'title'       => 'Uganda',
        'description' => 'The Pearl of Africa — gorilla trekking, pristine lakes, and lush rainforests.',
        'image'       => PRIDE_OF_AFRICA_IMAGES . '/default/destination-1.jpg',
        'explore_url' => home_url('/destinations/uganda'),
        'maps_url'    => 'https://maps.google.com/?q=Uganda',
    ],
    [
        'title'       => 'Ethiopia',
        'description' => 'Ancient rock churches, tribal cultures, and the Simien Mountains.',
        'image'       => PRIDE_OF_AFRICA_IMAGES . '/default/destination-2.jpg',
        'explore_url' => home_url('/destinations/ethiopia'),
        'maps_url'    => 'https://maps.google.com/?q=Ethiopia',
    ],
    [
        'title'       => 'Zanzibar',
        'description' => 'Pristine white sand beaches, spice tours, and romantic island escapes.',
        'image'       => PRIDE_OF_AFRICA_IMAGES . '/default/destination-1.jpg',
        'explore_url' => home_url('/destinations/zanzibar'),
        'maps_url'    => 'https://maps.google.com/?q=Zanzibar',
    ],
    [
        'title'       => 'Seychelles',
        'description' => 'Luxury island paradise with granite boulders, coral reefs, and private villas.',
        'image'       => PRIDE_OF_AFRICA_IMAGES . '/default/destination-2.jpg',
        'explore_url' => home_url('/destinations/seychelles'),
        'maps_url'    => 'https://maps.google.com/?q=Seychelles',
    ],
];
?>

<section class="top-destinations" id="top-destinations">
    <div class="container-site">

        <!-- Section Header -->
        <div class="section-header text-center">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <?php if (!empty($section_description)) : ?>
                <p class="section-description"><?php echo esc_html($section_description); ?></p>
            <?php endif; ?>
        </div>

        <!-- Destinations Grid -->
        <div class="destinations-grid">
            <?php foreach ($destinations as $dest) : ?>
                <article class="destination-card" aria-label="<?php echo esc_attr($dest['title']); ?>">

                    <!-- Background Image -->
                    <div class="destination-card__image"
                         style="background-image: url('<?php echo esc_url($dest['image']); ?>');"
                         role="img"
                         aria-label="<?php echo esc_attr($dest['title']); ?>">
                    </div>

                    <!-- Dark Gradient Overlay -->
                    <div class="destination-card__overlay" aria-hidden="true"></div>

                    <!-- Card Content -->
                    <div class="destination-card__content">
                        <h3 class="destination-card__title"><?php echo esc_html($dest['title']); ?></h3>

                        <p class="destination-card__description"><?php echo esc_html($dest['description']); ?></p>

                        <div class="destination-card__actions">
                            <a href="<?php echo esc_url($dest['explore_url']); ?>"
                               class="destination-card__btn destination-card__btn--primary"
                               aria-label="<?php echo esc_attr(sprintf('Explore %s', $dest['title'])); ?>">
                                <?php printf('Explore %s', esc_html($dest['title'])); ?>
                            </a>
                            <a href="<?php echo esc_url($dest['maps_url']); ?>"
                               class="destination-card__btn destination-card__btn--outline"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="<?php echo esc_attr(sprintf('Map of %s', $dest['title'])); ?>">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                Maps
                            </a>
                        </div>
                    </div>

                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>