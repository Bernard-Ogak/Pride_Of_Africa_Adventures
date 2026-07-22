<?php
/**
 * Archive template
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container-site">
    <header class="archive-header mb-5">
        <?php
        the_archive_title('<h1>', '</h1>');
        the_archive_description('<div class="lead">', '</div>');
        ?>
    </header>

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
                                <?php echo wp_kses_post(get_the_date()); ?> | <?php the_author(); ?>
                            </p>

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
            <?php esc_html_e('No posts found in this archive.', 'pride-of-africa'); ?>
        </div>

    <?php endif; ?>
</div>

    </div>
</main>

<?php
get_footer();
?>
