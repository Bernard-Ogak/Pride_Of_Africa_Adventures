<?php
/**
 * Template Name: About Page
 * File:   page-about.php
 *
 * Reuses the homepage design system (poa-tokens / sections / cards /
 * forms — see the enqueue condition in functions.php) rather than
 * introducing new colors, spacing, or component patterns. Testimonials
 * and Why Choose Us reuse the same homepage template parts directly;
 * Team Members come from the pride_team_member CPT.
 *
 * @package Pride_Of_Africa
 */

get_header();

$hero_image = wp_get_attachment_image_url(123, 'full') ?: PRIDE_OF_AFRICA_IMAGES . '/default/hero-1.jpg';
$story_image = wp_get_attachment_image_url(116, 'large');
$conservation_image = wp_get_attachment_image_url(44, 'large');

$team_members = new WP_Query([
    'post_type' => 'pride_team_member', 'post_status' => 'publish',
    'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC',
]);
?>

<main id="primary" class="site-main">

<!-- 1. HERO -->
<section class="c-about-hero" style="background-image:url('<?php echo esc_url($hero_image); ?>');">
    <div class="c-about-hero__overlay" aria-hidden="true"></div>
    <div class="u-container c-about-hero__inner">
        <span class="c-badge c-badge--light"><?php esc_html_e('About Pride of Africa', 'pride-of-africa'); ?></span>
        <h1 class="c-about-hero__title"><?php esc_html_e('Meet the Safari Experts Behind Your African Adventure', 'pride-of-africa'); ?></h1>
        <p class="c-about-hero__subtitle"><?php esc_html_e('Local knowledge, global standards — since 2010.', 'pride-of-africa'); ?></p>
        <div class="c-about-hero__actions">
            <a href="<?php echo esc_url(home_url('/planner')); ?>" class="c-button c-button--primary c-button--xl">
                <?php esc_html_e('Plan Your Safari', 'pride-of-africa'); ?> <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="c-button c-button--outline c-button--light c-button--xl">
                <?php esc_html_e('Contact Our Experts', 'pride-of-africa'); ?>
            </a>
        </div>
    </div>
    <a href="#our-story" class="c-about-hero__scroll" aria-label="<?php esc_attr_e('Scroll to content', 'pride-of-africa'); ?>">
        <i class="bi bi-chevron-down" aria-hidden="true"></i>
    </a>
</section>

<!-- 2. OUR STORY -->
<section class="l-section" id="our-story">
    <div class="u-container">
        <div class="c-about-story">
            <div class="c-about-story__image-wrap" data-fade-up>
                <?php if ($story_image) : ?>
                <img src="<?php echo esc_url($story_image); ?>" alt="<?php esc_attr_e('Safari guide with guests in the Maasai Mara', 'pride-of-africa'); ?>" class="c-about-story__image" loading="lazy" decoding="async">
                <?php endif; ?>
            </div>
            <div class="c-about-story__body" data-fade-up>
                <span class="c-badge c-badge--accent"><?php esc_html_e('Our Story', 'pride-of-africa'); ?></span>
                <h2 class="c-about-story__title"><?php esc_html_e('Born in the Heart of Africa', 'pride-of-africa'); ?></h2>
                <p><?php esc_html_e('Pride of Africa Adventures & Safaris was founded in 2010 as a small, family-run operation with deep roots in the Maasai Mara. What began as a passion for sharing Africa\'s beauty has grown into one of East Africa\'s most trusted safari companies.', 'pride-of-africa'); ?></p>
                <p><?php esc_html_e('We specialize in customized luxury, family, honeymoon, adventure, and photography safaris across Kenya, Tanzania, Uganda, Ethiopia, Zanzibar, and Seychelles.', 'pride-of-africa'); ?></p>
                <p><?php esc_html_e('Every itinerary is hand-crafted by our team of local experts who know these landscapes intimately.', 'pride-of-africa'); ?></p>
                <p><?php esc_html_e('Today, we serve travelers from over 40 countries, with a 4.9-star TripAdvisor rating and thousands of satisfied guests. Our commitment remains the same: deliver authentic, life-changing African experiences with the warmth and professionalism our guests deserve.', 'pride-of-africa'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- 3. COMPANY ACHIEVEMENTS -->
<section class="l-section l-section--alt">
    <div class="u-container">
        <div class="c-about-stats">
            <?php
            $stats = [
                ['icon' => 'bi-calendar-check', 'number' => '14+', 'label' => __('Years Experience', 'pride-of-africa'), 'sub' => __('Guiding safaris since 2010', 'pride-of-africa')],
                ['icon' => 'bi-globe2', 'number' => '6', 'label' => __('Countries Served', 'pride-of-africa'), 'sub' => __('Across East Africa & the Indian Ocean', 'pride-of-africa')],
                ['icon' => 'bi-people-fill', 'number' => '5,000+', 'label' => __('Happy Travelers', 'pride-of-africa'), 'sub' => __('From over 40 countries', 'pride-of-africa')],
                ['icon' => 'bi-star-fill', 'number' => '4.9★', 'label' => __('TripAdvisor Rating', 'pride-of-africa'), 'sub' => __('Rated by our guests', 'pride-of-africa')],
            ];
            foreach ($stats as $s) : ?>
            <div class="c-about-stats__card" data-fade-up>
                <i class="bi <?php echo esc_attr($s['icon']); ?>" aria-hidden="true"></i>
                <span class="c-about-stats__number"><?php echo esc_html($s['number']); ?></span>
                <span class="c-about-stats__label"><?php echo esc_html($s['label']); ?></span>
                <span class="c-about-stats__sub"><?php echo esc_html($s['sub']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 4. MISSION & VISION -->
<section class="l-section">
    <div class="u-container">
        <div class="c-about-mv">
            <div class="c-about-mv__card" data-fade-up>
                <i class="bi bi-bullseye" aria-hidden="true"></i>
                <h2><?php esc_html_e('Our Mission', 'pride-of-africa'); ?></h2>
                <p><?php esc_html_e('To provide world-class, customized safari experiences that connect international travelers with the authentic beauty, wildlife, and cultures of East Africa while supporting local communities and conservation efforts.', 'pride-of-africa'); ?></p>
            </div>
            <div class="c-about-mv__card" data-fade-up>
                <i class="bi bi-binoculars" aria-hidden="true"></i>
                <h2><?php esc_html_e('Our Vision', 'pride-of-africa'); ?></h2>
                <p><?php esc_html_e('To be East Africa\'s most trusted and recommended safari company, known for exceptional service, sustainable tourism, and life-changing travel experiences that inspire a deep love for Africa.', 'pride-of-africa'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- 5. OUR VALUES -->
<section class="l-section l-section--alt">
    <div class="u-container">
        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e('What Drives Us', 'pride-of-africa'); ?></span>
            <h2 class="c-section-header__title"><?php esc_html_e('Our Values', 'pride-of-africa'); ?></h2>
        </div>
        <ul class="c-trust__grid">
            <?php
            $values = [
                ['icon' => 'bi-heart-fill', 'title' => __('Passion', 'pride-of-africa'), 'desc' => __('We are passionate about sharing Africa\'s beauty with travelers from around the world.', 'pride-of-africa')],
                ['icon' => 'bi-shield-check', 'title' => __('Safety', 'pride-of-africa'), 'desc' => __('Your safety is our top priority on every safari, trek, and beach holiday.', 'pride-of-africa')],
                ['icon' => 'bi-award', 'title' => __('Excellence', 'pride-of-africa'), 'desc' => __('We deliver world-class service with attention to every detail of your journey.', 'pride-of-africa')],
                ['icon' => 'bi-tree-fill', 'title' => __('Sustainability', 'pride-of-africa'), 'desc' => __('We operate responsibly, supporting local communities and wildlife conservation.', 'pride-of-africa')],
            ];
            foreach ($values as $v) : ?>
            <li>
                <article class="c-trust__card" data-fade-up>
                    <div class="c-trust__icon-wrap"><i class="bi <?php echo esc_attr($v['icon']); ?>" aria-hidden="true"></i></div>
                    <h3 class="c-trust__card-title"><?php echo esc_html($v['title']); ?></h3>
                    <p class="c-trust__card-desc"><?php echo esc_html($v['desc']); ?></p>
                </article>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- 6. TRUST & CREDENTIALS -->
<section class="l-section">
    <div class="u-container">
        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e('Why Travelers Trust Us', 'pride-of-africa'); ?></span>
            <h2 class="c-section-header__title"><?php esc_html_e('Trust & Credentials', 'pride-of-africa'); ?></h2>
        </div>
        <div class="c-about-credentials">
            <?php
            $credentials = [
                ['icon' => 'bi-patch-check-fill', 'title' => __('Licensed Tour Operator', 'pride-of-africa'), 'desc' => __('Registered and licensed to operate safaris across East Africa.', 'pride-of-africa')],
                ['icon' => 'bi-star-fill', 'title' => __('TripAdvisor Excellence', 'pride-of-africa'), 'desc' => __('Rated 4.9 stars by hundreds of verified travelers.', 'pride-of-africa')],
                ['icon' => 'bi-globe-americas', 'title' => __('KATO Member', 'pride-of-africa'), 'desc' => __('Member of the Kenya Association of Tour Operators.', 'pride-of-africa')],
                ['icon' => 'bi-check-circle-fill', 'title' => __('SafariBookings Verified', 'pride-of-africa'), 'desc' => __('Verified operator profile on SafariBookings.', 'pride-of-africa')],
            ];
            foreach ($credentials as $c) : ?>
            <div class="c-about-credential" data-fade-up>
                <i class="bi <?php echo esc_attr($c['icon']); ?>" aria-hidden="true"></i>
                <h3><?php echo esc_html($c['title']); ?></h3>
                <p><?php echo esc_html($c['desc']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 7. OUR TEAM -->
<?php if ($team_members->have_posts()) : ?>
<section class="l-section l-section--alt">
    <div class="u-container">
        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e('Meet The Team', 'pride-of-africa'); ?></span>
            <h2 class="c-section-header__title"><?php esc_html_e('Our Safari Specialists', 'pride-of-africa'); ?></h2>
        </div>
        <div class="c-about-team">
            <?php while ($team_members->have_posts()) : $team_members->the_post();
                $tid = get_the_ID();
                $position = get_post_meta($tid, '_team_position', true);
                $experience = get_post_meta($tid, '_team_experience', true);
                $languages = get_post_meta($tid, '_team_languages', true);
                $specialties = get_post_meta($tid, '_team_specialties', true);
                $photo = get_the_post_thumbnail_url($tid, 'medium');
            ?>
            <article class="c-about-team__card" data-fade-up>
                <div class="c-about-team__avatar">
                    <?php if ($photo) : ?>
                        <img src="<?php echo esc_url($photo); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    <?php else : ?>
                        <i class="bi bi-person-fill" aria-hidden="true"></i>
                    <?php endif; ?>
                </div>
                <h3 class="c-about-team__name"><?php the_title(); ?></h3>
                <?php if ($position) : ?><p class="c-about-team__position"><?php echo esc_html($position); ?></p><?php endif; ?>
                <?php if ($experience) : ?><p class="c-about-team__experience"><?php echo esc_html($experience); ?></p><?php endif; ?>
                <?php if (get_the_content()) : ?><p class="c-about-team__bio"><?php echo esc_html(get_the_content()); ?></p><?php endif; ?>
                <?php if ($languages) : ?><p class="c-about-team__meta"><i class="bi bi-translate" aria-hidden="true"></i> <?php echo esc_html($languages); ?></p><?php endif; ?>
                <?php if ($specialties) : ?><p class="c-about-team__meta"><i class="bi bi-star" aria-hidden="true"></i> <?php echo esc_html($specialties); ?></p><?php endif; ?>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 8. WHY CHOOSE US -->
<section class="l-section">
    <div class="u-container">
        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e('Why Choose Us', 'pride-of-africa'); ?></span>
            <h2 class="c-section-header__title"><?php esc_html_e('The Pride of Africa Difference', 'pride-of-africa'); ?></h2>
        </div>
        <ul class="c-trust__grid">
            <?php
            $why = [
                ['icon' => 'bi-map', 'title' => __('100% Tailor-Made Safaris', 'pride-of-africa')],
                ['icon' => 'bi-binoculars', 'title' => __('Local Safari Experts', 'pride-of-africa')],
                ['icon' => 'bi-headset', 'title' => __('24/7 Guest Support', 'pride-of-africa')],
                ['icon' => 'bi-building', 'title' => __('Luxury Lodges', 'pride-of-africa')],
                ['icon' => 'bi-person-badge', 'title' => __('Professional Guides', 'pride-of-africa')],
                ['icon' => 'bi-signpost-2', 'title' => __('Flexible Itineraries', 'pride-of-africa')],
                ['icon' => 'bi-tree', 'title' => __('Conservation Focus', 'pride-of-africa')],
                ['icon' => 'bi-wallet2', 'title' => __('Best Value Guarantee', 'pride-of-africa')],
            ];
            foreach ($why as $w) : ?>
            <li>
                <article class="c-trust__card c-trust__card--compact" data-fade-up>
                    <div class="c-trust__icon-wrap"><i class="bi <?php echo esc_attr($w['icon']); ?>" aria-hidden="true"></i></div>
                    <h3 class="c-trust__card-title"><?php echo esc_html($w['title']); ?></h3>
                </article>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- 9. CONSERVATION & COMMUNITY -->
<section class="l-section l-section--alt">
    <div class="u-container">
        <div class="c-about-story c-about-story--reverse">
            <div class="c-about-story__image-wrap" data-fade-up>
                <?php if ($conservation_image) : ?>
                <img src="<?php echo esc_url($conservation_image); ?>" alt="<?php esc_attr_e('Wildlife conservation area supported by community tourism', 'pride-of-africa'); ?>" class="c-about-story__image" loading="lazy" decoding="async">
                <?php endif; ?>
            </div>
            <div class="c-about-story__body" data-fade-up>
                <span class="c-badge c-badge--accent"><?php esc_html_e('Conservation & Community', 'pride-of-africa'); ?></span>
                <h2 class="c-about-story__title"><?php esc_html_e('Travel That Gives Back', 'pride-of-africa'); ?></h2>
                <p><?php esc_html_e('We believe responsible tourism is the only sustainable way to experience Africa\'s wildlife and wild places. Every itinerary we design supports the local communities and conservancies that protect these landscapes.', 'pride-of-africa'); ?></p>
                <p><?php esc_html_e('That means prioritizing local employment, working with community-owned conservancies, and choosing partners who share our commitment to ethical, low-impact travel.', 'pride-of-africa'); ?></p>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="c-button c-button--primary">
                    <?php esc_html_e('Learn About Our Impact', 'pride-of-africa'); ?> <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 10. TESTIMONIALS (reused from the homepage) -->
<?php get_template_part('template-parts/home/testimonials'); ?>

<!-- 11. FINAL CTA -->
<section class="c-final-cta l-section" style="background-image:url('<?php echo esc_url($hero_image); ?>');">
    <div class="c-final-cta__overlay" aria-hidden="true"></div>
    <div class="u-container c-final-cta__inner" style="text-align:center;">
        <h2 class="c-final-cta__heading"><?php esc_html_e("Let's Create Your African Adventure", 'pride-of-africa'); ?></h2>
        <p class="c-final-cta__desc"><?php esc_html_e("Whether you're planning your first safari or returning for another unforgettable journey, our local experts are ready to help.", 'pride-of-africa'); ?></p>
        <div class="c-final-cta__actions">
            <a href="<?php echo esc_url(home_url('/planner')); ?>" class="c-button c-button--surface c-button--xl">
                <?php esc_html_e('Plan My Safari', 'pride-of-africa'); ?>
            </a>
            <a href="https://wa.me/<?php echo esc_attr(preg_replace('/\D/', '', function_exists('pride_get_whatsapp') ? pride_get_whatsapp() : '')); ?>" target="_blank" rel="noopener noreferrer" class="c-button c-button--outline c-button--light c-button--xl">
                <i class="bi bi-whatsapp" aria-hidden="true"></i> <?php esc_html_e('WhatsApp Us', 'pride-of-africa'); ?>
            </a>
        </div>
    </div>
</section>

</main>

<script type="application/ld+json">
<?php
$social_links = array_filter([
    function_exists('pride_get_social_link') ? pride_get_social_link('facebook') : '',
    function_exists('pride_get_social_link') ? pride_get_social_link('instagram') : '',
    function_exists('pride_get_social_link') ? pride_get_social_link('youtube') : '',
    function_exists('pride_get_social_link') ? pride_get_social_link('tiktok') : '',
]);
echo wp_json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'TravelAgency',
            'name' => get_bloginfo('name'),
            'url' => home_url('/'),
            'logo' => get_theme_mod('custom_logo') ? wp_get_attachment_url(get_theme_mod('custom_logo')) : '',
            'sameAs' => array_values($social_links),
            'foundingDate' => '2010',
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'About Us', 'item' => get_permalink()],
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
</script>

<script>
( function () {
    'use strict';
    var items = document.querySelectorAll( '[data-fade-up]' );
    var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

    if ( reduceMotion || typeof IntersectionObserver === 'undefined' ) {
        items.forEach( function ( el ) { el.classList.add( 'is-visible' ); } );
        return;
    }

    var observer = new IntersectionObserver( function ( entries ) {
        entries.forEach( function ( entry ) {
            if ( entry.isIntersecting ) {
                entry.target.classList.add( 'is-visible' );
                observer.unobserve( entry.target );
            }
        } );
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' } );

    items.forEach( function ( el, i ) {
        el.style.transitionDelay = ( i % 4 ) * 80 + 'ms';
        observer.observe( el );
    } );
} )();
</script>

<?php get_footer(); ?>
