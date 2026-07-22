<?php
/**
 * Single destination template — full detail page (hero, why visit,
 * top attractions, best time to visit, cost guide, safari route map,
 * FAQs, closing CTA), matching the reference destination page design.
 *
 * @package Pride_Of_Africa
 */

get_header();

while (have_posts()) : the_post();
    $post_id = get_the_ID();

    $tagline    = get_post_meta($post_id, '_destination_tagline', true);
    $why_visit  = array_filter(array_map('trim', explode("\n", get_post_meta($post_id, '_destination_why_visit', true))));
    $attractions = pride_of_africa_parse_pipe_lines(get_post_meta($post_id, '_destination_attractions', true));
    $best_time   = pride_of_africa_parse_pipe_lines(get_post_meta($post_id, '_destination_best_time', true));
    $best_time_note = get_post_meta($post_id, '_destination_best_time_note', true);
    $cost_guide  = pride_of_africa_parse_pipe_lines(get_post_meta($post_id, '_destination_cost_guide', true));
    $cost_note   = get_post_meta($post_id, '_destination_cost_note', true);
    $route_intro = get_post_meta($post_id, '_destination_route_intro', true);
    $route_stops = pride_of_africa_parse_pipe_lines(get_post_meta($post_id, '_destination_route_stops', true));
    $route_note  = get_post_meta($post_id, '_destination_route_note', true);
    $faqs        = pride_of_africa_parse_pipe_lines(get_post_meta($post_id, '_destination_faqs', true));
    $cta_heading = get_post_meta($post_id, '_destination_cta_heading', true) ?: sprintf(__('Ready to Explore %s?', 'pride-of-africa'), get_the_title());
    $cta_text    = get_post_meta($post_id, '_destination_cta_text', true);
    $cta_label   = get_post_meta($post_id, '_destination_cta_label', true) ?: __('Plan My Safari', 'pride-of-africa');

    $img_id  = get_post_thumbnail_id();
    $img_url = $img_id ? wp_get_attachment_image_url($img_id, 'large') : '';
    ?>

    <!-- ── Hero ─────────────────────────────────── -->
    <section class="c-dest-hero" style="<?php echo $img_url ? 'background-image:url(' . esc_url($img_url) . ');' : ''; ?>">
        <div class="c-dest-hero__scrim" aria-hidden="true"></div>
        <div class="u-container c-dest-hero__inner">
            <?php if ($tagline) : ?>
            <p class="c-dest-hero__tagline"><?php echo esc_html($tagline); ?></p>
            <?php endif; ?>
            <h1 class="c-dest-hero__title"><?php the_title(); ?></h1>
            <p class="c-dest-hero__intro"><?php echo esc_html(get_the_excerpt()); ?></p>
        </div>
    </section>

    <!-- ── Why Visit ────────────────────────────── -->
    <?php if (!empty($why_visit)) : ?>
    <section class="c-dest-section l-section">
        <div class="u-container">
            <h2 class="c-dest-section__title"><?php echo esc_html(sprintf(__('Why Visit %s', 'pride-of-africa'), get_the_title())); ?></h2>
            <ul class="c-dest-why-visit">
                <?php foreach ($why_visit as $reason) : ?>
                <li><i class="bi bi-check-circle-fill" aria-hidden="true"></i> <?php echo esc_html($reason); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Top Attractions ──────────────────────── -->
    <?php if (!empty($attractions)) : ?>
    <section class="c-dest-section l-section l-section--alt">
        <div class="u-container">
            <h2 class="c-dest-section__title"><?php esc_html_e('Top Attractions', 'pride-of-africa'); ?></h2>
            <div class="c-dest-attractions">
                <?php foreach ($attractions as $row) : ?>
                <div class="c-dest-attraction">
                    <h3><?php echo esc_html($row[0] ?? ''); ?></h3>
                    <p><?php echo esc_html($row[1] ?? ''); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Best Time To Visit ───────────────────── -->
    <?php if (!empty($best_time)) : ?>
    <section class="c-dest-section l-section">
        <div class="u-container">
            <h2 class="c-dest-section__title"><?php esc_html_e('Best Time to Visit', 'pride-of-africa'); ?></h2>
            <div class="c-dest-seasons">
                <?php foreach ($best_time as $row) : ?>
                <div class="c-dest-season">
                    <h3><?php echo esc_html($row[0] ?? ''); ?></h3>
                    <p class="c-dest-season__range"><?php echo esc_html($row[1] ?? ''); ?></p>
                    <p class="c-dest-season__desc"><?php echo esc_html($row[2] ?? ''); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if ($best_time_note) : ?>
            <p class="c-dest-section__note"><?php echo esc_html($best_time_note); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Cost Guide ───────────────────────────── -->
    <?php if (!empty($cost_guide)) : ?>
    <section class="c-dest-section l-section l-section--alt">
        <div class="u-container">
            <h2 class="c-dest-section__title"><?php esc_html_e('Cost Guide', 'pride-of-africa'); ?></h2>
            <div class="c-dest-costs">
                <?php foreach ($cost_guide as $row) : ?>
                <div class="c-dest-cost">
                    <h3><?php echo esc_html($row[0] ?? ''); ?></h3>
                    <p><?php echo esc_html($row[1] ?? ''); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if ($cost_note) : ?>
            <p class="c-dest-section__note"><?php echo esc_html($cost_note); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Safari Route Map ─────────────────────── -->
    <?php if (!empty($route_stops)) : ?>
    <section class="c-dest-section l-section">
        <div class="u-container">
            <h2 class="c-dest-section__title"><?php esc_html_e('Safari Route Map', 'pride-of-africa'); ?></h2>
            <?php if ($route_intro) : ?>
            <p class="c-dest-route__intro"><?php echo esc_html($route_intro); ?></p>
            <?php endif; ?>
            <p class="c-dest-route__hint"><?php esc_html_e('Click a destination to learn more', 'pride-of-africa'); ?></p>
            <div class="c-dest-route">
                <?php foreach ($route_stops as $i => $row) : ?>
                <div class="c-dest-route__stop">
                    <span class="c-dest-route__num"><?php echo esc_html($i + 1); ?></span>
                    <h3><?php echo esc_html($row[0] ?? ''); ?></h3>
                    <p><?php echo esc_html($row[1] ?? ''); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if ($route_note) : ?>
            <p class="c-dest-section__note"><?php echo esc_html($route_note); ?></p>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── FAQs ─────────────────────────────────── -->
    <?php if (!empty($faqs)) : ?>
    <section class="c-dest-section l-section l-section--alt">
        <div class="u-container">
            <h2 class="c-dest-section__title"><?php esc_html_e('Frequently Asked Questions', 'pride-of-africa'); ?></h2>
            <div class="c-dest-faqs">
                <?php foreach ($faqs as $i => $row) : ?>
                <details class="c-dest-faq" <?php echo (0 === $i) ? 'open' : ''; ?>>
                    <summary><?php echo esc_html($row[0] ?? ''); ?></summary>
                    <p><?php echo esc_html($row[1] ?? ''); ?></p>
                </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Closing CTA ──────────────────────────── -->
    <section class="c-dest-cta l-section">
        <div class="u-container c-dest-cta__inner">
            <h2><?php echo esc_html($cta_heading); ?></h2>
            <?php if ($cta_text) : ?>
            <p><?php echo esc_html($cta_text); ?></p>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="c-button c-button--primary c-button--xl">
                <?php echo esc_html($cta_label); ?>
            </a>
        </div>
    </section>

<?php endwhile;

get_footer();
