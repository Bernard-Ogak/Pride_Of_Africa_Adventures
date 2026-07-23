<?php
/**
 * Single blog post template
 * File:   single.php
 *
 * Hero image, topic/destination badges, meta (date, author, reading
 * time), a sticky desktop share bar, a scroll reading-progress bar,
 * the article body, social share links, related articles, and
 * previous/next navigation. Comments render via comments.php.
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<div class="c-reading-progress" id="reading-progress" aria-hidden="true"></div>

<?php if (have_posts()) : while (have_posts()) : the_post();
    $post_id    = get_the_ID();
    $topics     = get_the_terms($post_id, 'pride_blog_topic');
    $topic      = ($topics && !is_wp_error($topics)) ? $topics[0] : null;
    $destinations = get_the_terms($post_id, 'pride_blog_destination');
    $destination  = ($destinations && !is_wp_error($destinations)) ? $destinations[0] : null;
    $reading_time = pride_of_africa_reading_time($post_id);
    $permalink    = get_permalink();
    $share_title  = rawurlencode(get_the_title());
    $share_url    = rawurlencode($permalink);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-article'); ?>>

    <?php if (has_post_thumbnail()) : ?>
    <div class="c-article__hero">
        <?php the_post_thumbnail('full', ['class' => 'c-article__hero-image', 'alt' => get_the_title()]); ?>
    </div>
    <?php endif; ?>

    <div class="u-container">
        <div class="c-article__layout">

            <div class="c-article__main">

                <header class="c-article__header">
                    <div class="c-article__badges">
                        <?php if ($topic) : ?>
                        <a class="c-badge c-badge--accent" href="<?php echo esc_url(get_term_link($topic)); ?>"><?php echo esc_html($topic->name); ?></a>
                        <?php endif; ?>
                        <?php if ($destination) : ?>
                        <a class="c-badge c-badge--country" href="<?php echo esc_url(get_term_link($destination)); ?>">
                            <i class="bi bi-geo-alt" aria-hidden="true"></i> <?php echo esc_html($destination->name); ?>
                        </a>
                        <?php endif; ?>
                    </div>

                    <h1 class="c-article__title"><?php the_title(); ?></h1>

                    <div class="c-article__meta">
                        <span><i class="bi bi-calendar3" aria-hidden="true"></i> <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time></span>
                        <span><i class="bi bi-person" aria-hidden="true"></i> <?php the_author(); ?></span>
                        <span><i class="bi bi-clock" aria-hidden="true"></i> <?php echo esc_html(sprintf(__('%d min read', 'pride-of-africa'), $reading_time)); ?></span>
                    </div>
                </header>

                <!-- Sticky share bar (desktop) -->
                <div class="c-article__share-bar" aria-label="<?php esc_attr_e('Share this article', 'pride-of-africa'); ?>">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($share_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo esc_attr($share_url); ?>&text=<?php echo esc_attr($share_title); ?>" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"><i class="bi bi-twitter-x" aria-hidden="true"></i></a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_attr($share_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="bi bi-linkedin" aria-hidden="true"></i></a>
                    <a href="https://wa.me/?text=<?php echo esc_attr($share_title . ' ' . $permalink); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="bi bi-whatsapp" aria-hidden="true"></i></a>
                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_attr($share_url); ?>&description=<?php echo esc_attr($share_title); ?>" target="_blank" rel="noopener noreferrer" aria-label="Pinterest"><i class="bi bi-pinterest" aria-hidden="true"></i></a>
                    <a href="mailto:?subject=<?php echo esc_attr($share_title); ?>&body=<?php echo esc_attr($permalink); ?>" aria-label="Email"><i class="bi bi-envelope" aria-hidden="true"></i></a>
                    <button type="button" class="c-article__copy-link" data-copy-link="<?php echo esc_attr($permalink); ?>" aria-label="<?php esc_attr_e('Copy link', 'pride-of-africa'); ?>"><i class="bi bi-link-45deg" aria-hidden="true"></i></button>
                </div>

                <div class="c-article__content">
                    <?php
                    the_content();
                    wp_link_pages([
                        'before' => '<nav class="c-article__pages">',
                        'after'  => '</nav>',
                    ]);
                    ?>
                </div>

                <?php if (has_tag()) : ?>
                <div class="c-article__tags">
                    <?php the_tags('<span class="c-article__tags-label">' . esc_html__('Tags:', 'pride-of-africa') . '</span> <span class="c-badge c-badge--tag">', '</span><span class="c-badge c-badge--tag">', '</span>'); ?>
                </div>
                <?php endif; ?>

                <!-- Share this article (repeated inline for mobile, where the sticky bar is hidden) -->
                <div class="c-article__share-inline">
                    <span class="c-article__share-label"><?php esc_html_e('Share this article', 'pride-of-africa'); ?></span>
                    <div class="c-article__share-bar c-article__share-bar--inline">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($share_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo esc_attr($share_url); ?>&text=<?php echo esc_attr($share_title); ?>" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"><i class="bi bi-twitter-x" aria-hidden="true"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_attr($share_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="bi bi-linkedin" aria-hidden="true"></i></a>
                        <a href="https://wa.me/?text=<?php echo esc_attr($share_title . ' ' . $permalink); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="bi bi-whatsapp" aria-hidden="true"></i></a>
                        <button type="button" class="c-article__copy-link" data-copy-link="<?php echo esc_attr($permalink); ?>" aria-label="<?php esc_attr_e('Copy link', 'pride-of-africa'); ?>"><i class="bi bi-link-45deg" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Previous / Next -->
                <?php
                $prev = pride_of_africa_get_adjacent_post($post_id, 'previous');
                $next = pride_of_africa_get_adjacent_post($post_id, 'next');
                if ($prev || $next) :
                ?>
                <nav class="c-article__adjacent" aria-label="<?php esc_attr_e('More articles', 'pride-of-africa'); ?>">
                    <?php if ($prev) : ?>
                    <a class="c-article__adjacent-link c-article__adjacent-link--prev" href="<?php echo esc_url(get_permalink($prev)); ?>">
                        <span class="c-article__adjacent-dir"><i class="bi bi-arrow-left" aria-hidden="true"></i> <?php esc_html_e('Previous Article', 'pride-of-africa'); ?></span>
                        <span class="c-article__adjacent-title"><?php echo esc_html(get_the_title($prev)); ?></span>
                    </a>
                    <?php else : ?><span></span><?php endif; ?>
                    <?php if ($next) : ?>
                    <a class="c-article__adjacent-link c-article__adjacent-link--next" href="<?php echo esc_url(get_permalink($next)); ?>">
                        <span class="c-article__adjacent-dir"><?php esc_html_e('Next Article', 'pride-of-africa'); ?> <i class="bi bi-arrow-right" aria-hidden="true"></i></span>
                        <span class="c-article__adjacent-title"><?php echo esc_html(get_the_title($next)); ?></span>
                    </a>
                    <?php endif; ?>
                </nav>
                <?php endif; ?>

                <?php
                $related = pride_of_africa_get_related_posts($post_id, 3);
                if (!empty($related)) :
                ?>
                <div class="c-article__related">
                    <h2 class="c-article__related-title"><?php esc_html_e('Related Articles', 'pride-of-africa'); ?></h2>
                    <div class="c-blog__grid">
                        <?php foreach ($related as $related_post) : setup_postdata($related_post); global $post; $post = $related_post; ?>
                            <?php get_template_part('template-parts/cards/blog-card'); ?>
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (comments_open() || get_comments_number()) : ?>
                    <?php comments_template(); ?>
                <?php endif; ?>

            </div>

        </div>
    </div>

</article>

<?php endwhile; else : ?>

    <div class="u-container" style="padding-block: var(--space-9);">
        <h1><?php esc_html_e('Post not found', 'pride-of-africa'); ?></h1>
    </div>

<?php endif; ?>

<script>
( function () {
    'use strict';

    // Reading progress bar
    var bar = document.getElementById( 'reading-progress' );
    var article = document.querySelector( '.c-article__content' );
    if ( bar && article ) {
        window.addEventListener( 'scroll', function () {
            var rect = article.getBoundingClientRect();
            var total = rect.height - window.innerHeight;
            var scrolled = Math.min( Math.max( -rect.top, 0 ), Math.max( total, 1 ) );
            var pct = total > 0 ? ( scrolled / total ) * 100 : 0;
            bar.style.width = pct + '%';
        }, { passive: true } );
    }

    // Copy link buttons
    document.querySelectorAll( '[data-copy-link]' ).forEach( function ( btn ) {
        btn.addEventListener( 'click', function () {
            var url = btn.getAttribute( 'data-copy-link' );
            if ( navigator.clipboard ) {
                navigator.clipboard.writeText( url ).then( function () {
                    var icon = btn.querySelector( 'i' );
                    icon.className = 'bi bi-check2';
                    setTimeout( function () { icon.className = 'bi bi-link-45deg'; }, 1500 );
                } );
            }
        } );
    } );
} )();
</script>

<?php get_footer(); ?>
