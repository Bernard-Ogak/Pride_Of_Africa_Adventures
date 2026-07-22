<?php
/**
 * Content helpers for native WordPress-driven homepage sections.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Retrieve posts from a custom post type.
 *
 * @param string $post_type Post type slug.
 * @param array  $args      Optional WP_Query args.
 * @return array<int, array<string, mixed>>
 */
function pride_of_africa_get_cpt_posts($post_type, $args = []) {
    $query_args = wp_parse_args($args, [
        'post_type'           => $post_type,
        'post_status'         => 'publish',
        'posts_per_page'      => 6,
        'orderby'             => 'date',
        'order'               => 'DESC',
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    ]);

    $query = new WP_Query($query_args);

    if (!$query->have_posts()) {
        wp_reset_postdata();
        return [];
    }

    $items = [];

    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $terms = wp_get_post_terms($post_id, ['pride_country', 'pride_safari_type', 'pride_duration'], ['fields' => 'names']);

        $default_image = $post_type === 'pride_tour'
            ? PRIDE_OF_AFRICA_IMAGES . '/default/destination-2.jpg'
            : PRIDE_OF_AFRICA_IMAGES . '/default/destination-1.jpg';

        $items[] = [
            'id'                => $post_id,
            'title'             => get_the_title(),
            'excerpt'           => wp_strip_all_tags(get_the_excerpt()),
            'content'           => wp_kses_post(get_the_content()),
            'permalink'         => get_permalink(),
            'featured_image'    => get_the_post_thumbnail_url($post_id, 'destination-card') ?: get_the_post_thumbnail_url($post_id, 'large') ?: $default_image,
            'featured_image_id' => get_post_thumbnail_id($post_id),
            'terms'             => is_array($terms) ? $terms : [],
        ];
    }

    wp_reset_postdata();

    return $items;
}

/**
 * Fetch featured destination posts for the homepage.
 *
 * @param int $limit Number of posts to return.
 * @return array<int, array<string, mixed>>
 */
function pride_of_africa_get_home_destinations($limit = 6) {
    return pride_of_africa_get_cpt_posts('pride_destination', [
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
    ]);
}

/**
 * Fetch featured tour posts for the homepage.
 *
 * @param int $limit Number of posts to return.
 * @return array<int, array<string, mixed>>
 */
function pride_of_africa_get_home_tours($limit = 6) {
    return pride_of_africa_get_cpt_posts('pride_tour', [
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
    ]);
}

/**
 * Fetch featured testimonials for the homepage.
 *
 * @param int $limit Number of posts to return.
 * @return array<int, array<string, mixed>>
 */
function pride_of_africa_get_home_testimonials($limit = 6) {
    return pride_of_africa_get_cpt_posts('pride_testimonial', [
        'posts_per_page' => $limit,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);
}
