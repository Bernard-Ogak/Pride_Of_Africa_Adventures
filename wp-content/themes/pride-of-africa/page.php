<?php
/**
 * Default page template.
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container-site">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>">
                <header class="mb-4">
                    <h1><?php the_title(); ?></h1>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>
