<?php
/**
 * Fallback Images Configuration
 *
 * This file generates placeholder images if default hero or destination
 * images don't exist. This is executed during theme setup to ensure
 * fallback images are available for sections with Customizer-managed
 * images (Hero Slider, Explore Africa destination cards).
 *
 * @package Pride_Of_Africa
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create fallback hero and destination images if they don't exist
 *
 * Uses WP core functions to generate color-based placeholder images
 * in case the designer hasn't uploaded real images via the Customizer yet.
 * This prevents broken images from appearing on the site.
 *
 * @since 1.0.0
 * @return void
 */
function pride_of_africa_create_fallback_images() {
    // Check if directory exists
    $images_dir = PRIDE_OF_AFRICA_DIR . '/assets/images/default';

    if (!file_exists($images_dir)) {
        // Create directory recursively
        wp_mkdir_p($images_dir);
    }

    // Define fallback images with descriptive names
    // Each image uses a different color scheme to distinguish slides
    $fallback_images = [
        'hero-1.jpg' => [
            'color'   => '#8B6F47',  // Safari brown/earth tone
            'label'   => 'Hero Slide 1',
        ],
        'hero-2.jpg' => [
            'color'   => '#2A5A3A',  // Forest green
            'label'   => 'Hero Slide 2',
        ],
        'hero-3.jpg' => [
            'color'   => '#D4A574',  // Warm tan/desert
            'label'   => 'Hero Slide 3',
        ],
        'hero-4.jpg' => [
            'color'   => '#4A6FA5',  // Mountain blue
            'label'   => 'Hero Slide 4',
        ],
    ];

    pride_of_africa_generate_placeholder_set($images_dir, $fallback_images, 1920, 1080);

    // Destination card placeholders (Explore Africa section) — matches the
    // 'destination-card' image size registered in functions.php (800x533).
    $destination_images = [
        'destination-1.jpg' => ['color' => '#8B6F47', 'label' => 'Kenya'],
        'destination-2.jpg' => ['color' => '#2A5A3A', 'label' => 'Tanzania'],
        'destination-3.jpg' => ['color' => '#3A5A4A', 'label' => 'Uganda'],
        'destination-4.jpg' => ['color' => '#A5622A', 'label' => 'Ethiopia'],
        'destination-5.jpg' => ['color' => '#2A7A9A', 'label' => 'Zanzibar'],
        'destination-6.jpg' => ['color' => '#1A6A8A', 'label' => 'Seychelles'],
    ];

    pride_of_africa_generate_placeholder_set($images_dir, $destination_images, 800, 533);

    // Fallback favicon (used when no Site Icon is set via Customizer).
    $favicon_images = [
        'favicon.png' => ['color' => '#009900', 'label' => ''],
    ];

    pride_of_africa_generate_placeholder_set($images_dir, $favicon_images, 32, 32);
}

/**
 * Generate a set of solid-color placeholder JPEGs for the given filenames
 * if they don't already exist on disk.
 *
 * @since 1.0.0
 * @param string $images_dir Absolute path to the target images directory.
 * @param array  $images     Map of filename => ['color' => '#hex', 'label' => 'Text'].
 * @param int    $width      Placeholder width in pixels.
 * @param int    $height     Placeholder height in pixels.
 * @return void
 */
function pride_of_africa_generate_placeholder_set($images_dir, $images, $width, $height) {
    foreach ($images as $filename => $image_data) {
        $filepath = $images_dir . '/' . $filename;

        // Only create if it doesn't exist
        if (!file_exists($filepath)) {
            // Create a solid color placeholder image
            $image = imagecreatetruecolor($width, $height);

            // Parse hex color
            $color_hex = ltrim($image_data['color'], '#');
            $r = hexdec(substr($color_hex, 0, 2));
            $g = hexdec(substr($color_hex, 2, 2));
            $b = hexdec(substr($color_hex, 4, 2));

            // Allocate color and fill
            $color = imagecolorallocate($image, $r, $g, $b);
            imagefill($image, 0, 0, $color);

            // Add text label
            $white = imagecolorallocate($image, 255, 255, 255);
            $font_size = 5; // Use built-in font size
            $text = $image_data['label'];
            $text_x = imagesx($image) / 2 - (strlen($text) * 15) / 2;
            $text_y = imagesy($image) / 2 - 10;
            imagestring($image, $font_size, intval($text_x), intval($text_y), $text, $white);

            // Save image
            imagejpeg($image, $filepath, 80);
            imagedestroy($image);
        }
    }
}

// Run during theme setup
add_action('after_setup_theme', 'pride_of_africa_create_fallback_images', 5);

?>
