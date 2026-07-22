<?php
/**
 * Blog preview section template part.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

$posts = get_posts([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
]);

if (empty($posts)) {
    return;
}
?>

<section class="blog-preview py-5 bg-light" id="blog-preview">
    <div class="container-site">
        <div class="section-header text-center mb-5">
            <div class="eyebrow mb-2">FROM THE BLOG</div>
            <h2 class="section-title">Travel Guides & Inspiration</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($posts as $post) : setup_postdata($post); ?>
                <article class="col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="text-muted"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                        </div>
                    </div>
                </article>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
