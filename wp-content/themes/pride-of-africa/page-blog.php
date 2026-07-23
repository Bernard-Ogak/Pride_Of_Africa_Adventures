<?php
/**
 * Template Name: Blog Listing
 * File:   page-blog.php
 *
 * Magazine-style archive: hero, search, Topic/Destination filters,
 * sort, one Featured Story, card grid, and a sticky sidebar. All
 * published posts are rendered in the DOM (reasonable at this site's
 * scale) and filtered/sorted/searched entirely client-side — the same
 * approach already used for the homepage Popular Tours filter pills.
 *
 * @package Pride_Of_Africa
 */

get_header();

$featured_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
    'meta_key'       => '_post_featured',
    'meta_value'     => '1',
]);
$featured_post = $featured_query->have_posts() ? $featured_query->posts[0] : null;

$posts_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 50,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post__not_in'   => $featured_post ? [$featured_post->ID] : [],
]);

$topics = get_terms(['taxonomy' => 'pride_blog_topic', 'hide_empty' => true]);
$topics = is_wp_error($topics) ? [] : $topics;

$destinations = get_terms(['taxonomy' => 'pride_blog_destination', 'hide_empty' => true]);
$destinations = is_wp_error($destinations) ? [] : $destinations;

$popular_posts = get_posts([
    'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 5,
    'meta_key' => '_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC',
]);
$recent_posts = get_posts(['post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 5, 'orderby' => 'date', 'order' => 'DESC']);
$oldest_posts = get_posts(['post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 5, 'orderby' => 'date', 'order' => 'ASC']);
$featured_posts = get_posts(['post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 5, 'meta_key' => '_post_featured', 'meta_value' => '1']);
$tags = get_terms(['taxonomy' => 'post_tag', 'hide_empty' => true, 'number' => 20]);
$tags = is_wp_error($tags) ? [] : $tags;
?>

<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="c-blog-hero l-section--compact">
        <div class="u-container">
            <div class="c-section-header">
                <span class="c-badge c-badge--accent"><?php esc_html_e('Blog', 'pride-of-africa'); ?></span>
                <h1 class="c-section-header__title"><?php esc_html_e('Latest From The Bush', 'pride-of-africa'); ?></h1>
                <p class="c-section-header__desc">
                    <?php esc_html_e('Safari planning guides, destination inspiration, wildlife stories, travel advice, conservation insights, and African adventure tips from our local experts.', 'pride-of-africa'); ?>
                </p>
            </div>

            <div class="c-blog-hero__tools">
                <div class="c-blog-hero__search">
                    <i class="bi bi-search" aria-hidden="true"></i>
                    <input type="search" id="blog-search" placeholder="<?php esc_attr_e('Search articles…', 'pride-of-africa'); ?>" aria-label="<?php esc_attr_e('Search articles', 'pride-of-africa'); ?>">
                </div>
                <select id="blog-filter-topic" class="c-blog-hero__select" aria-label="<?php esc_attr_e('Filter by topic', 'pride-of-africa'); ?>">
                    <option value=""><?php esc_html_e('All Topics', 'pride-of-africa'); ?></option>
                    <?php foreach ($topics as $t) : ?>
                    <option value="<?php echo esc_attr($t->slug); ?>"><?php echo esc_html($t->name); ?></option>
                    <?php endforeach; ?>
                </select>
                <select id="blog-filter-destination" class="c-blog-hero__select" aria-label="<?php esc_attr_e('Filter by destination', 'pride-of-africa'); ?>">
                    <option value=""><?php esc_html_e('All Destinations', 'pride-of-africa'); ?></option>
                    <?php foreach ($destinations as $d) : ?>
                    <option value="<?php echo esc_attr($d->slug); ?>"><?php echo esc_html($d->name); ?></option>
                    <?php endforeach; ?>
                </select>
                <select id="blog-sort" class="c-blog-hero__select" aria-label="<?php esc_attr_e('Sort articles', 'pride-of-africa'); ?>">
                    <option value="recent"><?php esc_html_e('Most Recent', 'pride-of-africa'); ?></option>
                    <option value="oldest"><?php esc_html_e('Oldest', 'pride-of-africa'); ?></option>
                    <option value="featured"><?php esc_html_e('Featured', 'pride-of-africa'); ?></option>
                    <option value="popular"><?php esc_html_e('Most Popular', 'pride-of-africa'); ?></option>
                    <option value="commented"><?php esc_html_e('Most Commented', 'pride-of-africa'); ?></option>
                    <option value="az"><?php esc_html_e('A–Z', 'pride-of-africa'); ?></option>
                </select>
            </div>
        </div>
    </section>

    <div class="u-container">
        <div class="c-blog-archive__layout">

            <div class="c-blog-archive__main">

                <?php if ($featured_post) :
                    $fp_id = $featured_post->ID;
                    $fp_img = get_the_post_thumbnail_url($fp_id, 'large');
                    $fp_excerpt = has_excerpt($fp_id) ? get_the_excerpt($fp_id) : wp_trim_words(strip_shortcodes($featured_post->post_content), 30, '…');
                ?>
                <article class="c-blog-featured">
                    <?php if ($fp_img) : ?>
                    <a href="<?php echo esc_url(get_permalink($fp_id)); ?>" class="c-blog-featured__image-wrap">
                        <img src="<?php echo esc_url($fp_img); ?>" alt="<?php echo esc_attr(get_the_title($fp_id)); ?>" loading="lazy" decoding="async" class="c-blog-featured__image">
                    </a>
                    <?php endif; ?>
                    <div class="c-blog-featured__body">
                        <span class="c-badge c-badge--accent c-blog-featured__badge"><?php esc_html_e('Featured Story', 'pride-of-africa'); ?></span>
                        <h2 class="c-blog-featured__title"><a href="<?php echo esc_url(get_permalink($fp_id)); ?>"><?php echo esc_html(get_the_title($fp_id)); ?></a></h2>
                        <p class="c-blog-featured__excerpt"><?php echo esc_html(wp_trim_words($fp_excerpt, 30, '…')); ?></p>
                        <a href="<?php echo esc_url(get_permalink($fp_id)); ?>" class="c-button c-button--primary">
                            <?php esc_html_e('Read Article', 'pride-of-africa'); ?> <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
                <?php endif; ?>

                <div class="c-blog__grid" id="blog-grid" data-blog-grid>
                    <?php if ($posts_query->have_posts()) : while ($posts_query->have_posts()) : $posts_query->the_post();
                        $post_id = get_the_ID();
                        $post_topics = get_the_terms($post_id, 'pride_blog_topic');
                        $post_dests  = get_the_terms($post_id, 'pride_blog_destination');
                        $search_blob = mb_strtolower(get_the_title() . ' ' . wp_strip_all_tags(get_the_content()) . ' ' . ($post_dests && !is_wp_error($post_dests) ? implode(' ', wp_list_pluck($post_dests, 'name')) : '') . ' ' . implode(' ', wp_list_pluck(get_the_tags() ?: [], 'name')));
                    ?>
                    <div class="c-blog-card-wrap"
                         data-topic="<?php echo esc_attr(($post_topics && !is_wp_error($post_topics)) ? $post_topics[0]->slug : ''); ?>"
                         data-destination="<?php echo esc_attr(($post_dests && !is_wp_error($post_dests)) ? $post_dests[0]->slug : ''); ?>"
                         data-date="<?php echo esc_attr(get_the_date('U')); ?>"
                         data-title="<?php echo esc_attr(get_the_title()); ?>"
                         data-featured="<?php echo esc_attr(get_post_meta($post_id, '_post_featured', true) ? 1 : 0); ?>"
                         data-views="<?php echo esc_attr((int) get_post_meta($post_id, '_post_views_count', true)); ?>"
                         data-comments="<?php echo esc_attr((int) get_comments_number($post_id)); ?>"
                         data-search="<?php echo esc_attr($search_blob); ?>"
                    >
                        <?php get_template_part('template-parts/cards/blog-card'); ?>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>

                <p class="c-blog-archive__empty" id="blog-empty" hidden><?php esc_html_e('No articles match your search or filters.', 'pride-of-africa'); ?></p>
            </div>

            <!-- Sidebar -->
            <aside class="c-blog-sidebar">

                <div class="c-blog-sidebar__widget">
                    <h3 class="c-blog-sidebar__title"><?php esc_html_e('Categories', 'pride-of-africa'); ?></h3>
                    <ul class="c-blog-sidebar__list">
                        <?php foreach ($topics as $t) : ?>
                        <li><a href="<?php echo esc_url(get_term_link($t)); ?>"><?php echo esc_html($t->name); ?> <span>(<?php echo (int) $t->count; ?>)</span></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="c-blog-sidebar__widget">
                    <h3 class="c-blog-sidebar__title"><?php esc_html_e('Destinations', 'pride-of-africa'); ?></h3>
                    <ul class="c-blog-sidebar__list">
                        <?php foreach ($destinations as $d) : ?>
                        <li><a href="<?php echo esc_url(get_term_link($d)); ?>"><?php echo esc_html($d->name); ?> <span>(<?php echo (int) $d->count; ?>)</span></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if (!empty($popular_posts)) : ?>
                <div class="c-blog-sidebar__widget">
                    <h3 class="c-blog-sidebar__title"><?php esc_html_e('Popular Articles', 'pride-of-africa'); ?></h3>
                    <ul class="c-blog-sidebar__list c-blog-sidebar__list--posts">
                        <?php foreach ($popular_posts as $p) : ?>
                        <li><a href="<?php echo esc_url(get_permalink($p)); ?>"><?php echo esc_html(get_the_title($p)); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="c-blog-sidebar__widget">
                    <h3 class="c-blog-sidebar__title"><?php esc_html_e('Recent Posts', 'pride-of-africa'); ?></h3>
                    <ul class="c-blog-sidebar__list c-blog-sidebar__list--posts">
                        <?php foreach ($recent_posts as $p) : ?>
                        <li><a href="<?php echo esc_url(get_permalink($p)); ?>"><?php echo esc_html(get_the_title($p)); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if (!empty($featured_posts)) : ?>
                <div class="c-blog-sidebar__widget">
                    <h3 class="c-blog-sidebar__title"><?php esc_html_e('Featured Posts', 'pride-of-africa'); ?></h3>
                    <ul class="c-blog-sidebar__list c-blog-sidebar__list--posts">
                        <?php foreach ($featured_posts as $p) : ?>
                        <li><a href="<?php echo esc_url(get_permalink($p)); ?>"><?php echo esc_html(get_the_title($p)); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="c-blog-sidebar__widget">
                    <h3 class="c-blog-sidebar__title"><?php esc_html_e('Oldest Posts', 'pride-of-africa'); ?></h3>
                    <ul class="c-blog-sidebar__list c-blog-sidebar__list--posts">
                        <?php foreach ($oldest_posts as $p) : ?>
                        <li><a href="<?php echo esc_url(get_permalink($p)); ?>"><?php echo esc_html(get_the_title($p)); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if (!empty($tags)) : ?>
                <div class="c-blog-sidebar__widget">
                    <h3 class="c-blog-sidebar__title"><?php esc_html_e('Tags', 'pride-of-africa'); ?></h3>
                    <div class="c-blog-sidebar__tags">
                        <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_term_link($tag)); ?>" class="c-badge c-badge--tag"><?php echo esc_html($tag->name); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="c-blog-sidebar__widget">
                    <h3 class="c-blog-sidebar__title"><?php esc_html_e('Share This Website', 'pride-of-africa'); ?></h3>
                    <div class="c-article__share-bar c-article__share-bar--inline">
                        <?php $home_url = rawurlencode(home_url('/')); ?>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($home_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo esc_attr($home_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"><i class="bi bi-twitter-x" aria-hidden="true"></i></a>
                        <a href="https://wa.me/?text=<?php echo esc_attr($home_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="bi bi-whatsapp" aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="c-blog-sidebar__widget c-blog-sidebar__widget--newsletter">
                    <h3 class="c-blog-sidebar__title"><?php esc_html_e('Newsletter', 'pride-of-africa'); ?></h3>
                    <form class="footer-newsletter" id="sidebar-newsletter-form">
                        <div class="footer-newsletter__row">
                            <input type="email" class="footer-newsletter__input" placeholder="<?php esc_attr_e('Your email', 'pride-of-africa'); ?>" required>
                            <button type="submit" class="footer-newsletter__submit"><?php esc_html_e('Join', 'pride-of-africa'); ?></button>
                        </div>
                        <p class="footer-newsletter__message"></p>
                    </form>
                </div>

            </aside>

        </div>
    </div>

</main>

<script>
( function () {
    'use strict';
    var grid   = document.getElementById( 'blog-grid' );
    var empty  = document.getElementById( 'blog-empty' );
    if ( ! grid ) return;

    var cards  = Array.prototype.slice.call( grid.querySelectorAll( '.c-blog-card-wrap' ) );
    var search = document.getElementById( 'blog-search' );
    var topicSel = document.getElementById( 'blog-filter-topic' );
    var destSel   = document.getElementById( 'blog-filter-destination' );
    var sortSel    = document.getElementById( 'blog-sort' );

    function apply() {
        var term  = search.value.trim().toLowerCase();
        var topic = topicSel.value;
        var dest  = destSel.value;
        var visible = 0;

        cards.forEach( function ( card ) {
            var matchesSearch = ! term || card.dataset.search.indexOf( term ) !== -1;
            var matchesTopic  = ! topic || card.dataset.topic === topic;
            var matchesDest   = ! dest || card.dataset.destination === dest;
            var show = matchesSearch && matchesTopic && matchesDest;
            card.style.display = show ? '' : 'none';
            if ( show ) visible++;
        } );

        if ( empty ) empty.hidden = visible !== 0;

        var sorted = cards.slice().sort( function ( a, b ) {
            switch ( sortSel.value ) {
                case 'oldest':    return a.dataset.date - b.dataset.date;
                case 'featured':  return b.dataset.featured - a.dataset.featured;
                case 'popular':   return b.dataset.views - a.dataset.views;
                case 'commented': return b.dataset.comments - a.dataset.comments;
                case 'az':        return a.dataset.title.localeCompare( b.dataset.title );
                default:          return b.dataset.date - a.dataset.date;
            }
        } );
        sorted.forEach( function ( card ) { grid.appendChild( card ); } );
    }

    [ search, topicSel, destSel, sortSel ].forEach( function ( el ) {
        el.addEventListener( 'input', apply );
        el.addEventListener( 'change', apply );
    } );

    apply();
} )();

( function () {
    'use strict';
    var form = document.getElementById( 'sidebar-newsletter-form' );
    if ( ! form ) return;
    var message = form.querySelector( '.footer-newsletter__message' );

    form.addEventListener( 'submit', function ( e ) {
        e.preventDefault();
        var email = form.querySelector( 'input[type="email"]' ).value;
        var data = new FormData();
        data.append( 'action', 'pride_subscribe_newsletter' );
        data.append( 'nonce', window.prideOfAfricaData ? window.prideOfAfricaData.nonce : '' );
        data.append( 'email', email );

        fetch( window.prideOfAfricaData ? window.prideOfAfricaData.ajaxUrl : '/wp-admin/admin-ajax.php', { method: 'POST', body: data, credentials: 'same-origin' } )
            .then( function ( res ) { return res.json(); } )
            .then( function ( json ) {
                message.textContent = json.data && json.data.message ? json.data.message : '';
                if ( json.success ) form.reset();
            } );
    } );
} )();
</script>

<?php get_footer(); ?>
