<?php
/**
 * Search results template
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<div class="container-site py-5">
    <h1 class="mb-4">
        <?php
        printf(
            esc_html__('Search Results for: %s', 'pride-of-africa'),
            '<span>' . get_search_query() . '</span>'
        );
        ?>
    </h1>

    <?php if (have_posts()) : ?>

        <div class="row g-4">

            <?php while (have_posts()) : the_post(); ?>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="card-img-top" style="height: 200px; overflow: hidden;">
                                <?php the_post_thumbnail('medium', ['style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                    <?php the_title(); ?>
                                </a>
                            </h5>

                            <p class="card-text text-muted small">
                                <?php the_excerpt(); ?>
                            </p>
                        </div>

                        <div class="card-footer bg-transparent">
                            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-primary">
                                <?php esc_html_e('Read More', 'pride-of-africa'); ?>
                            </a>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

        </div>

        <?php
        the_posts_pagination([
            'prev_text' => esc_html__('&larr; Previous', 'pride-of-africa'),
            'next_text' => esc_html__('Next &rarr;', 'pride-of-africa'),
        ]);
        ?>

    <?php else : ?>

        <div class="alert alert-info">
            <?php esc_html_e('No search results found. Try different keywords.', 'pride-of-africa'); ?>
        </div>

    <?php endif; ?>
</div>

<?php
get_footer();
?>
