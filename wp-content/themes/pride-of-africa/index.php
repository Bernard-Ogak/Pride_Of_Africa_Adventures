<?php
/**
 * Main template
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('container-site py-5'); ?>>

            <header class="entry-header mb-4">
                <h1 class="entry-title">
                    <?php the_title(); ?>
                </h1>
            </header>

            <div class="entry-content">
                <?php
                the_content(sprintf(
                    wp_kses(
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'pride-of-africa'),
                        [
                            'span' => [
                                'class' => [],
                            ],
                        ]
                    ),
                    wp_kses_post(get_the_title())
                ));
                ?>
            </div>

            <footer class="entry-footer mt-5 border-top pt-4">
                <?php
                wp_link_pages([
                    'before' => '<nav class="page-links">' . esc_html__('Pages:', 'pride-of-africa'),
                    'after'  => '</nav>',
                ]);
                ?>
            </footer>

        </article>

        <?php
        // If comments are open or there is at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>

    <?php endwhile; ?>

<?php else : ?>

    <div class="container-site py-5 text-center">
        <h2><?php esc_html_e('No posts found', 'pride-of-africa'); ?></h2>
        <p><?php esc_html_e('It looks like nothing was found at this location.', 'pride-of-africa'); ?></p>
    </div>

<?php endif; ?>

<?php
get_footer();
?>
