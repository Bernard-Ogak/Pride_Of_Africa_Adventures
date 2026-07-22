<?php
/**
 * Single post template
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Article Hero / Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail-wrapper" style="position: relative; height: 400px; overflow: hidden;">
                    <?php
                    the_post_thumbnail('full', [
                        'class' => 'w-100 h-100',
                        'style' => 'object-fit: cover; object-position: center;',
                    ]);
                    ?>
                </div>
            <?php endif; ?>

            <!-- Article Content -->
            <div class="container-site py-5">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

                        <!-- Article Header -->
                        <header class="entry-header mb-4">
                            <h1 class="entry-title mb-3">
                                <?php the_title(); ?>
                            </h1>

                            <div class="entry-meta text-muted small d-flex gap-3 flex-wrap">
                                <span><?php esc_html_e('Posted on', 'pride-of-africa'); ?> <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time></span>
                                <span><?php esc_html_e('by', 'pride-of-africa'); ?> <span class="author vcard"><?php the_author(); ?></span></span>
                                <?php if (has_category()) : ?>
                                    <span><?php esc_html_e('in', 'pride-of-africa'); ?> <?php the_category(', '); ?></span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <!-- Article Content -->
                        <div class="entry-content mb-5">
                            <?php
                            the_content();

                            wp_link_pages([
                                'before'      => '<nav class="pagination mt-4">',
                                'after'       => '</nav>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ]);
                            ?>
                        </div>

                        <!-- Article Footer -->
                        <footer class="entry-footer border-top pt-4 mb-5">
                            <?php
                            if (has_tag()) {
                                echo '<div class="mb-3">';
                                echo '<strong>' . esc_html__('Tags:', 'pride-of-africa') . '</strong> ';
                                the_tags('<span class="badge bg-secondary me-2">', '</span> <span class="badge bg-secondary me-2">', '</span>');
                                echo '</div>';
                            }
                            ?>
                        </footer>

                    </div>
                </div>
            </div>

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
        <h2><?php esc_html_e('Post not found', 'pride-of-africa'); ?></h2>
    </div>

<?php endif; ?>

<?php
get_footer();
?>
