<?php
/**
 * ============================================================
 * Pride Of Africa Theme â€” Refactored Functions
 * ============================================================
 *
 * Theme: Pride Of Africa Adventures & Safaris
 * Version: 1.0.0
 *
 * Compatible with:
 * - WordPress 6.3+ (tested up to 6.7)
 * - PHP 7.4+
 * - Bootstrap 5.3
 *
 * @package Pride_Of_Africa
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// =============================================================================
// CONSTANTS
// =============================================================================

/**
 * Define theme constants
 *
 * @since 1.0.0
 */
define('PRIDE_OF_AFRICA_VERSION', '1.0.0');
define('PRIDE_OF_AFRICA_DIR', get_template_directory());
define('PRIDE_OF_AFRICA_URI', get_template_directory_uri());
define('PRIDE_OF_AFRICA_ASSETS', PRIDE_OF_AFRICA_URI . '/assets');
define('PRIDE_OF_AFRICA_IMAGES', PRIDE_OF_AFRICA_ASSETS . '/images');

// =============================================================================
// INCLUDES
// =============================================================================

/**
 * Include theme configuration files
 *
 * @since 1.0.0
 */
require_once PRIDE_OF_AFRICA_DIR . '/inc/fallback-images.php';        // Fallback placeholder images
require_once PRIDE_OF_AFRICA_DIR . '/inc/content-helpers.php';         // Native content helpers
require_once PRIDE_OF_AFRICA_DIR . '/inc/customizer/hero-customizer.php'; // Hero customizer settings
require_once PRIDE_OF_AFRICA_DIR . '/inc/customizer/trip-architect-customizer.php'; // Trip Architect customizer settings
require_once PRIDE_OF_AFRICA_DIR . '/inc/customizer/why-choose-us-customizer.php'; // Why Choose Us customizer settings
require_once PRIDE_OF_AFRICA_DIR . '/inc/customizer/trusted-partners-customizer.php'; // Trusted Partners customizer settings
require_once PRIDE_OF_AFRICA_DIR . '/inc/customizer/destinations-customizer.php'; // Top Destinations customizer settings
require_once PRIDE_OF_AFRICA_DIR . '/inc/customizer/poa-new-sections-customizer.php'; // New homepage sections (poa-homepage-templates) settings

// =============================================================================
// THEME SETUP
// =============================================================================

/**
 * Set up theme defaults and register support for various WordPress features
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @return void
 */
function pride_of_africa_setup() {
    // Enable automatic feed links for posts and comments
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable featured images (post thumbnails)
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 800, true);

    // Enable custom logo with flexible dimensions
    add_theme_support('custom-logo', [
        'height'      => 45,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => ['site-title', 'site-description'],
    ]);

    // Enable HTML5 semantic markup for core features
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ]);

    // Enable responsive embeds (videos, iframes, etc.)
    add_theme_support('responsive-embeds');

    // Enable wide and full-width block alignment
    add_theme_support('align-wide');

    // Enable block editor styles
    add_theme_support('wp-block-styles');

    // Enable block templates and template parts
    add_theme_support('block-templates');

    // Enable block editor styles matching the front-end design
    add_theme_support('editor-styles');
    add_editor_style('assets/css/style.css');

    // Load theme text domain for translations
    load_theme_textdomain('pride-of-africa', PRIDE_OF_AFRICA_DIR . '/languages');
}
add_action('after_setup_theme', 'pride_of_africa_setup', 10);

// =============================================================================
// REGISTER IMAGE SIZES
// =============================================================================

/**
 * Register custom image sizes for theme
 *
 * Improves performance by allowing WordPress to create optimized images
 * of specific dimensions rather than using full-size images everywhere.
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/plugins/media/image-sizes/
 *
 * @return void
 */
function pride_of_africa_register_image_sizes() {
    // Hero slider background images (full-screen, 16:9 aspect ratio)
    add_image_size('hero-slide', 1920, 1080, ['center', 'center']);

    // Destination and tour cards (3:2 aspect ratio)
    add_image_size('destination-card', 800, 533, ['center', 'center']);
    add_image_size('tour-card', 600, 400, ['center', 'center']);

    // Blog featured images (16:9 aspect ratio)
    add_image_size('blog-featured', 1000, 563, ['center', 'center']);

    // Testimonial avatars (1:1 square)
    add_image_size('testimonial-avatar', 96, 96, ['center', 'center']);

    // Gallery images (large and thumbnail versions)
    add_image_size('gallery-large', 1200, 900, ['center', 'center']);
    add_image_size('gallery-thumb', 300, 225, ['center', 'center']);
}
add_action('after_setup_theme', 'pride_of_africa_register_image_sizes', 11);

// =============================================================================
// REGISTER NAVIGATION MENUS
// =============================================================================

/**
 * Register navigation menu locations
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
 *
 * @return void
 */
function pride_of_africa_register_menus() {
    register_nav_menus([
        'primary' => esc_html__('Primary Menu (Desktop)', 'pride-of-africa'),
        'mobile'  => esc_html__('Mobile Menu', 'pride-of-africa'),
        'footer'  => esc_html__('Footer Menu', 'pride-of-africa'),
    ]);
}
add_action('init', 'pride_of_africa_register_menus', 10);

/**
 * Ensure the primary navigation has a usable default menu structure.
 *
 * This keeps the site fully navigable even when no menu has been created
 * manually in the WordPress admin.
 *
 * @return void
 */
function pride_of_africa_ensure_default_menu() {
    if (get_option('pride_of_africa_default_menu_ready')) {
        return;
    }

    $locations = get_theme_mod('nav_menu_locations');
    if (!empty($locations['primary'])) {
        update_option('pride_of_africa_default_menu_ready', 1);
        return;
    }

    $menu_name = esc_html__('Primary Navigation', 'pride-of-africa');
    $menu_obj = wp_get_nav_menu_object($menu_name);

    if (!$menu_obj) {
        $menu_id = wp_create_nav_menu($menu_name);
    } else {
        $menu_id = $menu_obj->term_id;
    }

    if (is_wp_error($menu_id)) {
        return;
    }

    $menu_items = [
        ['title' => __('Home', 'pride-of-africa'), 'slug' => ''],
        ['title' => __('About', 'pride-of-africa'), 'slug' => 'about'],
        [
            'title' => __('Destinations', 'pride-of-africa'),
            'slug' => 'destinations',
            'children' => [
                ['title' => __('Kenya', 'pride-of-africa'), 'slug' => 'destinations/kenya'],
                ['title' => __('Tanzania', 'pride-of-africa'), 'slug' => 'destinations/tanzania'],
                ['title' => __('Uganda', 'pride-of-africa'), 'slug' => 'destinations/uganda'],
                ['title' => __('Zanzibar', 'pride-of-africa'), 'slug' => 'destinations/zanzibar'],
            ],
        ],
        [
            'title' => __('Tours', 'pride-of-africa'),
            'slug' => 'tours',
            'children' => [
                ['title' => __('Safari Tours', 'pride-of-africa'), 'slug' => 'tours?safari'],
                ['title' => __('Beach Holidays', 'pride-of-africa'), 'slug' => 'tours?beach'],
                ['title' => __('Day Tours', 'pride-of-africa'), 'slug' => 'tours?nairobi'],
            ],
        ],
        ['title' => __('Blog', 'pride-of-africa'), 'slug' => 'blog'],
        ['title' => __('Gallery', 'pride-of-africa'), 'slug' => 'gallery'],
        [
            'title' => __('Resources', 'pride-of-africa'),
            'slug' => 'packing-guide',
            'children' => [
                ['title' => __('Planner', 'pride-of-africa'), 'slug' => 'planner'],
                ['title' => __('Packing Guide', 'pride-of-africa'), 'slug' => 'packing-guide'],
                ['title' => __('Review', 'pride-of-africa'), 'slug' => 'review'],
                ['title' => __('Contact', 'pride-of-africa'), 'slug' => 'contact'],
            ],
        ],
        ['title' => __('Contact', 'pride-of-africa'), 'slug' => 'contact'],
    ];

    $position = 0;
    foreach ($menu_items as $item) {
        $target_url = home_url($item['slug'] ? '/' . trim($item['slug'], '/') . '/' : '/');
        $page_obj = $item['slug'] ? get_page_by_path($item['slug']) : get_page_by_path('/');
        $menu_item_url = $page_obj ? get_permalink($page_obj->ID) : $target_url;

        $parent_id = wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title'     => $item['title'],
            'menu-item-classes'   => '',
            'menu-item-url'       => $menu_item_url,
            'menu-item-status'    => 'publish',
            'menu-item-type'      => $page_obj ? 'post_type' : 'custom',
            'menu-item-object'    => $page_obj ? 'page' : 'custom',
            'menu-item-object-id' => $page_obj ? $page_obj->ID : 0,
            'menu-item-position'  => $position,
        ]);

        if (!is_wp_error($parent_id) && !empty($item['children'])) {
            foreach ($item['children'] as $child_index => $child) {
                $child_target_url = home_url('/' . trim($child['slug'], '/') . '/');
                $child_page_obj = get_page_by_path($child['slug']);
                $child_menu_url = $child_page_obj ? get_permalink($child_page_obj->ID) : $child_target_url;

                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title'      => $child['title'],
                    'menu-item-classes'    => '',
                    'menu-item-url'        => $child_menu_url,
                    'menu-item-status'     => 'publish',
                    'menu-item-type'       => $child_page_obj ? 'post_type' : 'custom',
                    'menu-item-object'     => $child_page_obj ? 'page' : 'custom',
                    'menu-item-object-id'  => $child_page_obj ? $child_page_obj->ID : 0,
                    'menu-item-position'   => $child_index,
                    'menu-item-parent-id'  => $parent_id,
                ]);
            }
        }

        $position++;
    }

    set_theme_mod('nav_menu_locations', [
        'primary' => $menu_id,
        'mobile'  => $menu_id,
        'footer'  => $menu_id,
    ]);

    update_option('pride_of_africa_default_menu_ready', 1);
}
add_action('after_setup_theme', 'pride_of_africa_ensure_default_menu', 20);

// =============================================================================
// =============================================================================
// ENQUEUE GLOBAL STYLES
// =============================================================================

/**
 * Enqueue global stylesheets.
 *
 * Loads Bootstrap, Google Fonts, and the single consolidated stylesheet
 * assets/css/style.css â€” which replaces style.css, header.css, and all
 * per-section CSS files that previously lived in assets/css/home/.
 *
 * @since 1.0.0
 * @return void
 */
function pride_of_africa_enqueue_global_styles() {
    $theme_style_path = get_template_directory() . '/assets/css/style.css';
    $theme_style_version = file_exists($theme_style_path) ? filemtime($theme_style_path) : PRIDE_OF_AFRICA_VERSION;

    // Bootstrap 5.3 CSS
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        [],
        '5.3.0'
    );

    // Bootstrap Icons
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        [],
        '1.11.3'
    );

    // Font Awesome 4 (free icons)
    wp_enqueue_style(
        'font-awesome-4',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        [],
        '4.7.0'
    );

    // Google Fonts: Poppins + Playfair Display
    wp_enqueue_style(
        'pride-of-africa-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap',
        [],
        null,
        'all'
    );

    // Consolidated theme stylesheet â€” single file for all components & sections
    wp_enqueue_style(
        'pride-of-africa-theme',
        PRIDE_OF_AFRICA_ASSETS . '/css/style.css',
        ['bootstrap', 'bootstrap-icons', 'pride-of-africa-fonts'],
        $theme_style_version
    );
}
add_action('wp_enqueue_scripts', 'pride_of_africa_enqueue_global_styles', 10);

// =============================================================================
// ENQUEUE POA HOMEPAGE TEMPLATE STYLES
// =============================================================================

/**
 * Enqueue the poa-homepage-templates package styles.
 *
 * Loaded only on the front page, after the theme's global stylesheet so
 * the shared --poa-* / component tokens never affect any other page.
 *
 * @since 1.0.0
 * @return void
 */
function pride_of_africa_enqueue_poa_home_styles() {
    if (!is_front_page()) {
        return;
    }

    $poa_dir = get_template_directory() . '/assets/css/poa';
    $poa_uri = PRIDE_OF_AFRICA_ASSETS . '/css/poa';

    $version = file_exists($poa_dir . '/poa-tokens.css')
        ? filemtime($poa_dir . '/poa-tokens.css')
        : PRIDE_OF_AFRICA_VERSION;

    // Tokens must load first — every other file in this folder depends on it.
    wp_enqueue_style(
        'poa-tokens',
        $poa_uri . '/poa-tokens.css',
        ['pride-of-africa-theme'],
        $version
    );

    $components = ['hero', 'trip-planner', 'sections', 'cards', 'forms'];
    foreach ($components as $component) {
        $path = $poa_dir . "/{$component}.css";
        wp_enqueue_style(
            "poa-{$component}",
            $poa_uri . "/{$component}.css",
            ['poa-tokens'],
            file_exists($path) ? filemtime($path) : PRIDE_OF_AFRICA_VERSION
        );
    }
}
add_action('wp_enqueue_scripts', 'pride_of_africa_enqueue_poa_home_styles', 12);

// =============================================================================
// ENQUEUE GLOBAL SCRIPTS
// =============================================================================

/**
 * Enqueue global JavaScript.
 *
 * Loads Bootstrap JS and the single consolidated theme script
 * assets/js/theme.js â€” which replaces header.js, main.js, home/hero.js,
 * and home/trusted-partners.js.
 *
 * @since 1.0.0
 * @return void
 */
function pride_of_africa_enqueue_global_scripts() {
    $theme_script_path = get_template_directory() . '/assets/js/theme.js';
    $theme_script_version = file_exists($theme_script_path) ? filemtime($theme_script_path) : PRIDE_OF_AFRICA_VERSION;

    // Bootstrap 5.3 JS bundle (includes Popper.js)
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.0',
        [
            'strategy'  => 'defer',
            'in_footer' => true,
        ]
    );

    // Consolidated theme script â€” header, nav, hero slider, marquee
    wp_enqueue_script(
        'pride-of-africa-theme',
        PRIDE_OF_AFRICA_ASSETS . '/js/theme.js',
        ['bootstrap-js'],
        $theme_script_version,
        [
            'strategy'  => 'defer',
            'in_footer' => true,
        ]
    );

    // Global JS data
    wp_localize_script('pride-of-africa-theme', 'prideOfAfricaData', [
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('pride-of-africa-nonce'),
        'siteUrl'   => home_url(),
        'themeUri'  => PRIDE_OF_AFRICA_URI,
        'assetsUri' => PRIDE_OF_AFRICA_ASSETS,
    ]);

    // Hero slider config (used by theme.js initHeroSlider)
    wp_localize_script('pride-of-africa-theme', 'heroSliderConfig', [
        'autoplayInterval' => intval(get_theme_mod('pride_hero_autoplay_interval', 6000)),
        'slidesCount'      => 4,
        'defaultImages'    => [
            1 => PRIDE_OF_AFRICA_IMAGES . '/default/hero-1.jpg',
            2 => PRIDE_OF_AFRICA_IMAGES . '/default/hero-2.jpg',
            3 => PRIDE_OF_AFRICA_IMAGES . '/default/hero-3.jpg',
            4 => PRIDE_OF_AFRICA_IMAGES . '/default/hero-4.jpg',
        ],
    ]);
}
add_action('wp_enqueue_scripts', 'pride_of_africa_enqueue_global_scripts', 11);


// =============================================================================
// SITE ICON / FAVICON SUPPORT
// =============================================================================

/**
 * Output fallback favicon if no site icon is set
 *
 * The Site Icon (favicon) feature is built into WordPress core since 4.3
 * and is always available via Customizer > Site Identity — no theme
 * support flag is required. This just provides a fallback icon for
 * installations where no Site Icon has been uploaded yet.
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/plugins/hooks/action-hooks/
 *
 * @return void
 */
function pride_of_africa_fallback_favicon() {
    // Only output if no site icon is set
    if (has_site_icon()) {
        return;
    }

    $favicon_path = PRIDE_OF_AFRICA_IMAGES . '/default/favicon.png';
    ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url($favicon_path); ?>">
    <?php
}
add_action('wp_head', 'pride_of_africa_fallback_favicon', 5);

// =============================================================================
// REGISTER WIDGET AREAS
// =============================================================================

/**
 * Register widget areas (sidebars)
 *
 * Widget areas allow users to add custom widgets in admin
 * for flexible content management.
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/themes/functionality/sidebars-widgets/
 *
 * @return void
 */
function pride_of_africa_register_widgets() {
    // Primary sidebar for blog posts and pages
    register_sidebar([
        'name'          => esc_html__('Primary Sidebar', 'pride-of-africa'),
        'id'            => 'primary-sidebar',
        'description'   => esc_html__('Primary sidebar for pages and posts', 'pride-of-africa'),
        'before_widget' => '<div id="%1$s" class="widget %2$s card card-widget mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title card-header">',
        'after_title'   => '</h5>',
    ]);

    // Footer widget area 1
    register_sidebar([
        'name'          => esc_html__('Footer Widget 1', 'pride-of-africa'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Footer widget area 1', 'pride-of-africa'),
        'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title footer-widget-title">',
        'after_title'   => '</h5>',
    ]);

    // Footer widget area 2
    register_sidebar([
        'name'          => esc_html__('Footer Widget 2', 'pride-of-africa'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Footer widget area 2', 'pride-of-africa'),
        'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title footer-widget-title">',
        'after_title'   => '</h5>',
    ]);
}
add_action('widgets_init', 'pride_of_africa_register_widgets', 10);

// =============================================================================
// CUSTOM MENU WALKER FOR BOOTSTRAP
// =============================================================================

/**
 * Custom menu walker for Bootstrap 5 navbar structure
 *
 * Extends Walker_Nav_Menu to output proper Bootstrap navbar HTML with
 * dropdown menus, proper ARIA attributes, and semantic markup.
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/plugins/menus/custom-menu-walker/
 */
class PRIDE_Of_Africa_Menu_Walker extends Walker_Nav_Menu {

    /**
     * Start the output of an unordered list
     *
     * Output ul element with proper Bootstrap classes and ARIA attributes
     *
     * @since 1.0.0
     *
     * @param string $output      Passed by reference. Used to append additional content
     * @param int    $depth       Depth of menu item. Used for padding
     * @param object $args        An object of wp_nav_menu() arguments
     * @return void
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
            parent::start_lvl($output, $depth, $args);
            return;
        }

        $indent = str_repeat("\t", $depth);
        $output .= "\n" . $indent . '<ul class="dropdown-menu" aria-label="submenu">' . "\n";
    }

    /**
     * End the output of a submenu list.
     *
     * @param string $output Passed by reference. Used to append additional content
     * @param int    $depth  Depth of menu item. Used for padding
     * @param object $args   An object of wp_nav_menu() arguments
     * @return void
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
            parent::end_lvl($output, $depth, $args);
            return;
        }

        $indent = str_repeat("\t", $depth);
        $output .= $indent . "</ul>\n";
    }

    /**
     * Start an individual list item element
     *
     * Output li element with proper Bootstrap classes and ARIA attributes
     *
     * @since 1.0.0
     *
     * @param string $output Passed by reference. Used to append additional content
     * @param object $item   Menu item data object
     * @param int    $depth  Depth of menu item
     * @param object $args   An object of wp_nav_menu() arguments
     * @param int    $id     Item ID
     * @return void
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
            parent::start_el($output, $item, $depth, $args, $id);
            return;
        }

        $indent      = $depth > 0 ? str_repeat("\t", $depth) : '';
        $has_children = in_array('menu-item-has-children', $item->classes, true);
        $item_id     = 'nav-item-' . esc_attr($item->ID);
        $link_class  = $depth === 0 ? 'nav-link' : 'dropdown-item';
        $li_class    = $depth === 0 ? 'nav-item' : '';

        if ($has_children && $depth === 0) {
            $li_class .= ' dropdown';
            $link_class .= ' dropdown-toggle';
        }

        if ($depth > 0) {
            $output .= $indent . '<li>';
            $output .= '<a class="' . esc_attr($link_class) . '" href="' . esc_url($item->url) . '">';
            $output .= esc_html($item->title);
            $output .= '</a>';
            return;
        }

        $output .= $indent . '<li class="' . esc_attr(trim($li_class)) . '">';
        $output .= '<a class="' . esc_attr($link_class) . '" href="' . esc_url($item->url) . '" id="' . $item_id . '"';

        if ($has_children) {
            $output .= ' role="button" data-bs-toggle="dropdown" aria-expanded="false"';
        }

        $output .= '>';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }

    /**
     * End an individual list item element
     *
     * @since 1.0.0
     *
     * @param string $output Passed by reference. Used to append additional content
     * @param object $item   Menu item data object
     * @param int    $depth  Depth of menu item
     * @param object $args   An object of wp_nav_menu() arguments
     * @return void
     */
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
            parent::end_el($output, $item, $depth, $args);
            return;
        }

        $output .= "</li>\n";
    }
}

/**
 * Automatically apply the right page template for the main public routes.
 *
 * This ensures pages such as About, Contact, Destinations, Tours, Blog,
 * Gallery, Review, Planner, and Packing Guide render their dedicated
 * layouts even when they were created without manually selecting a template.
 *
 * @param string $template Located template path.
 * @return string Template path to use.
 */
function pride_of_africa_apply_route_templates($template) {
    if (!is_page()) {
        return $template;
    }

    $page = get_queried_object();
    if (!$page instanceof WP_Post) {
        return $template;
    }

    $assigned_template = get_page_template_slug($page->ID);
    if (!empty($assigned_template) && $assigned_template !== 'default') {
        return $template;
    }

    $slug = $page->post_name;
    $template_map = [
        'about'          => get_template_directory() . '/page-about.php',
        'contact'        => get_template_directory() . '/page-contact.php',
        'destinations'   => get_template_directory() . '/page-destinations.php',
        'tours'          => get_template_directory() . '/page-tours.php',
        'blog'           => get_template_directory() . '/page-blog.php',
        'gallery'        => get_template_directory() . '/page-gallery.php',
        'review'         => get_template_directory() . '/page-review.php',
        'planner'        => get_template_directory() . '/page-planner.php',
        'packing-guide'  => get_template_directory() . '/page-packing-guide.php',
    ];

    if (isset($template_map[$slug]) && file_exists($template_map[$slug])) {
        return $template_map[$slug];
    }

    return $template;
}
add_filter('template_include', 'pride_of_africa_apply_route_templates', 20);

// =============================================================================
// CUSTOMIZER SETTINGS
// =============================================================================

/**
 * Register Customizer settings for company information and social links
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/themes/customize-api/
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance
 * @return void
 */
function pride_of_africa_customize_register($wp_customize) {
    // =========================================================================
    // COMPANY INFORMATION SECTION
    // =========================================================================

    $wp_customize->add_section('pride_company_info', [
        'title'       => esc_html__('Company Information', 'pride-of-africa'),
        'description' => esc_html__('Configure company contact details and information', 'pride-of-africa'),
        'priority'    => 30,
    ]);

    // Primary phone number
    $wp_customize->add_setting('pride_phone_1', [
        'default'           => '+254 704 559 568',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_phone_1', [
        'label'   => esc_html__('Primary Phone', 'pride-of-africa'),
        'section' => 'pride_company_info',
        'type'    => 'text',
    ]);

    // Secondary phone number
    $wp_customize->add_setting('pride_phone_2', [
        'default'           => '+254 705 756 681',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_phone_2', [
        'label'   => esc_html__('Secondary Phone', 'pride-of-africa'),
        'section' => 'pride_company_info',
        'type'    => 'text',
    ]);

    // Email address
    $wp_customize->add_setting('pride_email', [
        'default'           => 'info@prideofafricaadventures.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_email', [
        'label'   => esc_html__('Email Address', 'pride-of-africa'),
        'section' => 'pride_company_info',
        'type'    => 'email',
    ]);

    // WhatsApp number (for contact links)
    $wp_customize->add_setting('pride_whatsapp', [
        'default'           => '+254704559568',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_whatsapp', [
        'label'       => esc_html__('WhatsApp Number', 'pride-of-africa'),
        'description' => esc_html__('Without spaces, dashes, or + sign (e.g., 254704559568)', 'pride-of-africa'),
        'section'     => 'pride_company_info',
        'type'        => 'text',
    ]);

    // Business address
    $wp_customize->add_setting('pride_address', [
        'default'           => 'Josem Trust House, 3rd Floor, Masaba Road, Nairobi, Kenya',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('pride_address', [
        'label'   => esc_html__('Business Address', 'pride-of-africa'),
        'section' => 'pride_company_info',
        'type'    => 'textarea',
    ]);

    // =========================================================================
    // SOCIAL MEDIA LINKS SECTION
    // =========================================================================

    $wp_customize->add_section('pride_social_links', [
        'title'       => esc_html__('Social Media Links', 'pride-of-africa'),
        'description' => esc_html__('Add URLs to your social media profiles', 'pride-of-africa'),
        'priority'    => 31,
    ]);

    // Define social networks
    $social_networks = ['facebook', 'instagram', 'youtube', 'tiktok'];

    foreach ($social_networks as $social) {
        $wp_customize->add_setting('pride_' . $social, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control('pride_' . $social, [
            'label'   => ucfirst($social) . esc_html__(' URL', 'pride-of-africa'),
            'section' => 'pride_social_links',
            'type'    => 'url',
        ]);
    }
}
add_action('customize_register', 'pride_of_africa_customize_register', 10);

// =============================================================================
// TEMPLATE TAGS / HELPER FUNCTIONS
// =============================================================================

/**
 * Get a Customizer setting with optional default fallback
 *
 * Safely retrieves a theme modification with a default value if not set
 *
 * @since 1.0.0
 *
 * @param string $mod_key The key of the theme modification to retrieve
 * @param string $default Default value if not set
 * @return mixed The theme modification or default value
 */
function pride_get_theme_mod($mod_key, $default = '') {
    return get_theme_mod($mod_key, $default);
}

/**
 * Get primary phone number
 *
 * @since 1.0.0
 *
 * @return string Escaped phone number HTML
 */
function pride_get_phone_1() {
    return esc_html(pride_get_theme_mod('pride_phone_1', '+254 704 559 568'));
}

/**
 * Get secondary phone number
 *
 * @since 1.0.0
 *
 * @return string Escaped phone number HTML
 */
function pride_get_phone_2() {
    return esc_html(pride_get_theme_mod('pride_phone_2', '+254 705 756 681'));
}

/**
 * Get email address
 *
 * @since 1.0.0
 *
 * @return string Escaped email HTML
 */
function pride_get_email() {
    return esc_html(pride_get_theme_mod('pride_email', 'info@prideofafricaadventures.com'));
}

/**
 * Get WhatsApp number
 *
 * @since 1.0.0
 *
 * @return string Escaped WhatsApp number HTML
 */
function pride_get_whatsapp() {
    return esc_html(pride_get_theme_mod('pride_whatsapp', '+254704559568'));
}

/**
 * Get company address
 *
 * @since 1.0.0
 *
 * @return string Escaped address HTML
 */
function pride_get_address() {
    return esc_html(pride_get_theme_mod('pride_address', 'Josem Trust House, 3rd Floor, Masaba Road, Nairobi, Kenya'));
}

/**
 * Get social media link URL
 *
 * @since 1.0.0
 *
 * @param string $platform The social media platform (facebook, instagram, youtube, tiktok)
 * @return string Escaped URL
 */
function pride_get_social_link($platform) {
    return esc_url(pride_get_theme_mod('pride_' . sanitize_key($platform), ''));
}

// =============================================================================
// MEDIA / FILE UPLOAD ENHANCEMENTS
// =============================================================================

/**
 * Allow SVG file uploads (with security validation)
 *
 * Allows SVG files to be uploaded to the media library while maintaining
 * security by only declaring the MIME type. WordPress still sanitizes uploads.
 *
 * @since 1.0.0
 *
 * @param array $mimes Existing MIME types
 * @return array Updated MIME types
 */
function pride_of_africa_allow_svg_uploads($mimes) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'pride_of_africa_allow_svg_uploads', 10, 1);

/**
 * Fix SVG display in WordPress media library admin
 *
 * Ensures SVG thumbnails display properly in admin media library
 *
 * @since 1.0.0
 *
 * @return void
 */
function pride_of_africa_fix_svg_admin_display() {
    ?>
    <style>
        td.media-icon img[src$=".svg"],
        img.attachment-post-thumbnail[src$=".svg"] {
            max-height: 200px;
            width: auto;
        }
    </style>
    <?php
}
add_action('admin_head', 'pride_of_africa_fix_svg_admin_display', 10);

// =============================================================================
// SEARCH FORM FILTER
// =============================================================================

/**
 * Customize WordPress search form output
 *
 * Replaces default search form with Bootstrap-styled version
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/plugins/hooks/filter-hooks/
 *
 * @param string $form Default search form HTML
 * @return string Modified search form HTML
 */
function pride_of_africa_custom_search_form($form) {
    $form = '
    <form role="search" method="get" action="' . esc_url(home_url('/')) . '" class="search-form mb-3">
        <div class="input-group input-group-sm">
            <input type="search" class="form-control form-control-sm" placeholder="' . esc_attr__('Search...', 'pride-of-africa') . '" value="' . get_search_query() . '" name="s" />
            <button type="submit" class="btn btn-outline-secondary btn-sm">' . esc_html__('Search', 'pride-of-africa') . '</button>
        </div>
    </form>
    ';
    return $form;
}
add_filter('get_search_form', 'pride_of_africa_custom_search_form', 10, 1);

// =============================================================================
// ARCHIVE PAGE TITLES
// =============================================================================

/**
 * Modify archive page titles for better formatting
 *
 * Removes "Category:", "Tag:", etc. prefixes and displays cleaner titles
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/plugins/hooks/filter-hooks/
 *
 * @param string $title The archive title
 * @return string Modified archive title
 */
function pride_of_africa_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_year()) {
        $title = get_the_date(_x('Y', 'yearly archives date format', 'pride-of-africa'));
    } elseif (is_month()) {
        $title = get_the_date(_x('F Y', 'monthly archives date format', 'pride-of-africa'));
    } elseif (is_day()) {
        $title = get_the_date(_x('F j, Y', 'daily archives date format', 'pride-of-africa'));
    }
    return $title;
}
add_filter('get_the_archive_title', 'pride_of_africa_archive_title', 10, 1);

// =============================================================================
// COMMENT CALLBACK
// =============================================================================

/**
 * Custom comment display callback for theme
 *
 * Displays comments with Bootstrap card styling
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/plugins/hooks/action-hooks/
 *
 * @param object $comment Comment object
 * @param array  $args    Comment display arguments
 * @param int    $depth   Comment depth
 * @return void
 */
function pride_of_africa_comment_callback($comment, $args, $depth) {
    // phpcs:disable WordPress.Variables.VariableAnalysis.Undefined -- Fixed on extract
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
    ?>
    <li id="li-comment-<?php comment_ID(); ?>" class="comment-item mb-3">
        <div class="comment-body card">
            <div class="card-header">
                <strong><?php comment_author_link(); ?></strong>
                <small class="text-muted"><?php comment_date('F j, Y'); ?></small>
            </div>
            <div class="card-body">
                <?php comment_text(); ?>
                <?php
                comment_reply_link(
                    array_merge(
                        $args,
                        [
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                        ]
                    )
                );
                ?>
            </div>
        </div>
    </li>
    <?php
    // phpcs:enable
}

// =============================================================================
// EXCERPT FILTERS
// =============================================================================

/**
 * Set custom excerpt length (in words)
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/plugins/hooks/filter-hooks/
 *
 * @param int $length Default excerpt length in words
 * @return int New excerpt length
 */
function pride_of_africa_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'pride_of_africa_excerpt_length', 10, 1);

/**
 * Customize the excerpt "more" link
 *
 * @since 1.0.0
 * @link https://developer.wordpress.org/plugins/hooks/filter-hooks/
 *
 * @param string $more Default more text
 * @return string Modified more text
 */
function pride_of_africa_excerpt_more($more) {
    return ' <a href="' . esc_url(get_the_permalink()) . '" class="read-more">' . esc_html__('Read More', 'pride-of-africa') . '</a>';
}
add_filter('excerpt_more', 'pride_of_africa_excerpt_more', 10, 1);

?>

