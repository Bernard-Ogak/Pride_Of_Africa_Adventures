<?php
/**
 * Shared helper functions for the blog archive and single post templates.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Estimated reading time for a post, in whole minutes (minimum 1).
 */
function pride_of_africa_reading_time($post_id) {
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(wp_strip_all_tags(strip_shortcodes($content)));
    return max(1, (int) ceil($word_count / 200));
}

/**
 * Up to $limit other published posts sharing a Topic or Destination term
 * with $post_id, newest first, current post excluded. Falls back to the
 * most recent other posts if there's no taxonomy overlap.
 */
function pride_of_africa_get_related_posts($post_id, $limit = 3) {
    $topic_ids = wp_get_post_terms($post_id, 'pride_blog_topic', ['fields' => 'ids']);
    $dest_ids  = wp_get_post_terms($post_id, 'pride_blog_destination', ['fields' => 'ids']);
    $tag_ids   = wp_get_post_terms($post_id, 'post_tag', ['fields' => 'ids']);

    $tax_query = ['relation' => 'OR'];
    if (!empty($topic_ids)) {
        $tax_query[] = ['taxonomy' => 'pride_blog_topic', 'field' => 'term_id', 'terms' => $topic_ids];
    }
    if (!empty($dest_ids)) {
        $tax_query[] = ['taxonomy' => 'pride_blog_destination', 'field' => 'term_id', 'terms' => $dest_ids];
    }
    if (!empty($tag_ids)) {
        $tax_query[] = ['taxonomy' => 'post_tag', 'field' => 'term_id', 'terms' => $tag_ids];
    }

    $related = [];
    if (count($tax_query) > 1) {
        $related = get_posts([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $limit,
            'post__not_in'   => [$post_id],
            'tax_query'      => $tax_query,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);
    }

    if (count($related) < $limit) {
        $exclude = array_merge([$post_id], wp_list_pluck($related, 'ID'));
        $fallback = get_posts([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $limit - count($related),
            'post__not_in'   => $exclude,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);
        $related = array_merge($related, $fallback);
    }

    return $related;
}

/**
 * The single most recently published post other than $post_id (for
 * "Previous Article" navigation, in publish-date order rather than ID
 * order so it stays correct regardless of import order).
 */
function pride_of_africa_get_adjacent_post($post_id, $direction = 'previous') {
    $post_date = get_post_field('post_date', $post_id);
    $args = [
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'date_query'     => [
            $direction === 'previous'
                ? ['before' => $post_date, 'inclusive' => false]
                : ['after'  => $post_date, 'inclusive' => false],
        ],
        'orderby' => 'date',
        'order'   => $direction === 'previous' ? 'DESC' : 'ASC',
    ];
    $posts = get_posts($args);
    return !empty($posts) ? $posts[0] : null;
}
