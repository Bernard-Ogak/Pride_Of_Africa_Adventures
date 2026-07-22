<?php
/**
 * Template Name: Blog Listing
 *
 * @package Pride_Of_Africa
 */

get_header();

$posts = get_posts([
    'post_type'      => 'post',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
]);
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <header class="mb-5 text-center">
            <p class="text-uppercase text-primary fw-semibold mb-2">Blog</p>
            <h1 class="display-5 fw-bold mb-3">Travel guides, destination insights, and safari inspiration</h1>
            <p class="lead text-muted">A helpful library of stories and practical advice for planning your next African adventure.</p>
        </header>

        <?php if (!empty($posts)) : ?>
            <div class="row g-4">
                <?php foreach ($posts as $post_item) : ?>
                    <div class="col-md-6 col-lg-4">
                        <article class="card h-100 border-0 shadow-sm overflow-hidden">
                            <?php if (has_post_thumbnail($post_item->ID)) : ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url($post_item->ID, 'large')); ?>" class="card-img-top" alt="<?php echo esc_attr($post_item->post_title); ?>" style="height: 220px; object-fit: cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="text-muted small mb-2"><?php echo esc_html(get_the_date('', $post_item->ID)); ?></div>
                                <h2 class="h5 fw-bold"><a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>" class="text-decoration-none"><?php echo esc_html($post_item->post_title); ?></a></h2>
                                <p class="text-muted mb-3"><?php echo esc_html(wp_trim_words(wp_strip_all_tags($post_item->post_content), 24)); ?></p>
                                <a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>" class="btn btn-outline-primary btn-sm">Read article</a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info">Blog posts will appear here once content is published.</div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
