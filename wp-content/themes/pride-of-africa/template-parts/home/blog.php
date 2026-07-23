<?php
/**
 * Template Part: Latest Blog Posts
 * File:   template-parts/home/blog.php
 * Spec:   03-Master-UI-Specification-v3.md §15
 *         Desktop: 3 Columns | Gap: 32px
 *         Card Height: 480px | Image Height: 280px
 * @package PrideOfAfrica
 */

$posts = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
] );

if ( ! $posts->have_posts() ) {
    return;
}
?>

<section class="c-blog l-section" id="latest-blog" aria-labelledby="blog-heading">
    <div class="u-container">

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Blog', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="blog-heading"><?php esc_html_e( 'Latest From The Bush', 'pride-of-africa' ); ?></h2>
            <p class="c-section-header__desc"><?php esc_html_e( 'Tips, wildlife guides, destination spotlights and stories from the African wilderness.', 'pride-of-africa' ); ?></p>
        </div>

        <div class="c-blog__grid">
            <?php while ( $posts->have_posts() ) : $posts->the_post();
                get_template_part( 'template-parts/cards/blog-card' );
            endwhile; wp_reset_postdata(); ?>
        </div>

        <?php
        $blog_page_id  = get_option( 'page_for_posts' );
        $blog_page_url = $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/blog/' );
        ?>
        <div class="c-blog__footer">
            <a href="<?php echo esc_url( $blog_page_url ); ?>"
               class="c-button c-button--outline">
                <?php esc_html_e( 'Read All Articles', 'pride-of-africa' ); ?>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </div>
</section>
