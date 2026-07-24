<?php
/**
 * Template Name: Gallery Page
 * File:   page-gallery.php
 *
 * The main gallery archive: hero, collections showcase, a sticky
 * filter bar (media type / destination / park / wildlife / safari
 * type / activity / season / collection + search + sort), a grid/
 * masonry layout toggle, numbered pagination, and the shared lightbox.
 * Filtering is server-side AJAX (see gallery-ajax.php) so it stays
 * fast regardless of how large the media library grows.
 *
 * @package Pride_Of_Africa
 */

get_header();

$settings = function_exists('pride_gallery_get_settings') ? pride_gallery_get_settings() : ['layout' => 'grid', 'per_page' => 24, 'default_sort' => 'recent'];

$initial_query = new WP_Query([
    'post_type'      => 'pride_gallery_item',
    'post_status'    => 'publish',
    'posts_per_page' => (int) $settings['per_page'],
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$collections = get_terms(['taxonomy' => 'pride_gallery_collection', 'hide_empty' => true, 'number' => 12]);
$collections = is_wp_error($collections) ? [] : $collections;

$filter_taxonomies = [
    'country'     => ['label' => __('Destination', 'pride-of-africa'), 'taxonomy' => 'pride_gallery_country'],
    'park'        => ['label' => __('National Park', 'pride-of-africa'), 'taxonomy' => 'pride_gallery_park'],
    'wildlife'    => ['label' => __('Wildlife', 'pride-of-africa'), 'taxonomy' => 'pride_gallery_wildlife'],
    'safari_type' => ['label' => __('Safari Type', 'pride-of-africa'), 'taxonomy' => 'pride_gallery_safari_type'],
    'activity'    => ['label' => __('Activity', 'pride-of-africa'), 'taxonomy' => 'pride_gallery_activity'],
    'season'      => ['label' => __('Season', 'pride-of-africa'), 'taxonomy' => 'pride_gallery_season'],
];
?>

<main id="primary">

<!-- Hero -->
<section class="c-gallery-hero">
    <div class="u-container">
        <span class="c-badge c-badge--accent"><?php esc_html_e('Gallery', 'pride-of-africa'); ?></span>
        <h1 class="c-gallery-hero__title"><?php esc_html_e('Moments from the field, the camps, and the journey', 'pride-of-africa'); ?></h1>
        <p class="c-gallery-hero__subtitle"><?php esc_html_e('A visual glimpse into the landscapes, wildlife, and experiences that shape every Pride of Africa safari.', 'pride-of-africa'); ?></p>
        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="c-button c-button--primary"><?php esc_html_e('Plan Your Own Trip', 'pride-of-africa'); ?></a>
    </div>
</section>

<?php if (!empty($collections)) : ?>
<!-- Collections -->
<section class="l-section--compact">
    <div class="u-container">
        <h2 class="c-gallery-collections__title"><?php esc_html_e('Curated Collections', 'pride-of-africa'); ?></h2>
        <div class="c-gallery-collections">
            <?php foreach ($collections as $collection) : ?>
            <button type="button" class="c-gallery-collections__chip" data-gallery-filter-shortcut="collection" data-value="<?php echo esc_attr($collection->slug); ?>">
                <?php echo esc_html($collection->name); ?>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Sticky filter bar -->
<div class="c-gallery-filterbar" id="gallery-filterbar" data-gallery-filterbar>
    <div class="u-container c-gallery-filterbar__inner">

        <div class="c-gallery-filterbar__search">
            <i class="bi bi-search" aria-hidden="true"></i>
            <input type="search" id="gallery-search" placeholder="<?php esc_attr_e('Search lion, migration, sunset, Amboseli…', 'pride-of-africa'); ?>" aria-label="<?php esc_attr_e('Search gallery', 'pride-of-africa'); ?>" data-gallery-filter="search">
        </div>

        <div class="c-gallery-filterbar__pills" role="group" aria-label="<?php esc_attr_e('Filter by media type', 'pride-of-africa'); ?>">
            <?php foreach (['' => __('All', 'pride-of-africa'), 'photo' => __('Photos', 'pride-of-africa'), 'video' => __('Videos', 'pride-of-africa'), 'drone' => __('Drone', 'pride-of-africa'), '360' => __('360°', 'pride-of-africa')] as $val => $label) : ?>
            <button type="button" class="c-gallery-filterbar__pill<?php echo ('' === $val) ? ' is-active' : ''; ?>" data-gallery-filter="media_type" data-value="<?php echo esc_attr($val); ?>"><?php echo esc_html($label); ?></button>
            <?php endforeach; ?>
        </div>

        <div class="c-gallery-filterbar__selects">
            <?php foreach ($filter_taxonomies as $key => $conf) :
                $terms = get_terms(['taxonomy' => $conf['taxonomy'], 'hide_empty' => true]);
                $terms = is_wp_error($terms) ? [] : $terms;
                if (empty($terms)) continue;
            ?>
            <select class="c-gallery-filterbar__select" data-gallery-filter="<?php echo esc_attr($key); ?>" aria-label="<?php echo esc_attr($conf['label']); ?>">
                <option value=""><?php echo esc_html($conf['label']); ?></option>
                <?php foreach ($terms as $term) : ?>
                <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></option>
                <?php endforeach; ?>
            </select>
            <?php endforeach; ?>

            <select class="c-gallery-filterbar__select" data-gallery-filter="sort" aria-label="<?php esc_attr_e('Sort', 'pride-of-africa'); ?>">
                <?php foreach (['recent' => __('Newest', 'pride-of-africa'), 'oldest' => __('Oldest', 'pride-of-africa'), 'featured' => __('Featured', 'pride-of-africa'), 'popular' => __('Most Popular', 'pride-of-africa'), 'az' => __('A–Z', 'pride-of-africa')] as $val => $label) : ?>
                <option value="<?php echo esc_attr($val); ?>" <?php selected($settings['default_sort'], $val); ?>><?php echo esc_html($label); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="c-gallery-filterbar__layout" role="group" aria-label="<?php esc_attr_e('Layout', 'pride-of-africa'); ?>">
            <button type="button" class="c-gallery-filterbar__layout-btn<?php echo ('grid' === $settings['layout']) ? ' is-active' : ''; ?>" data-gallery-layout="grid" aria-label="<?php esc_attr_e('Grid layout', 'pride-of-africa'); ?>"><i class="bi bi-grid-3x3-gap-fill" aria-hidden="true"></i></button>
            <button type="button" class="c-gallery-filterbar__layout-btn<?php echo ('masonry' === $settings['layout']) ? ' is-active' : ''; ?>" data-gallery-layout="masonry" aria-label="<?php esc_attr_e('Masonry layout', 'pride-of-africa'); ?>"><i class="bi bi-layout-wtf" aria-hidden="true"></i></button>
        </div>

    </div>
</div>

<section class="l-section">
    <div class="u-container">

        <div class="c-gallery-grid c-gallery-grid--<?php echo esc_attr($settings['layout']); ?>" id="gallery-grid" data-gallery-grid data-layout="<?php echo esc_attr($settings['layout']); ?>">
            <?php if ($initial_query->have_posts()) :
                while ($initial_query->have_posts()) : $initial_query->the_post();
                    get_template_part('template-parts/gallery/gallery-card');
                endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="c-gallery-grid__empty"><?php esc_html_e('No gallery items yet — add some under Gallery in wp-admin.', 'pride-of-africa'); ?></p>
            <?php endif; ?>
        </div>

        <p class="c-gallery-grid__empty" id="gallery-empty" hidden><?php esc_html_e('No items match your search or filters.', 'pride-of-africa'); ?></p>

        <nav class="c-gallery-pagination" id="gallery-pagination" data-gallery-pagination aria-label="<?php esc_attr_e('Gallery pagination', 'pride-of-africa'); ?>">
            <button type="button" class="c-button c-button--outline" data-gallery-page-prev hidden><?php esc_html_e('Previous', 'pride-of-africa'); ?></button>
            <span class="c-gallery-pagination__status" data-gallery-page-status></span>
            <button type="button" class="c-button c-button--outline" data-gallery-page-next hidden><?php esc_html_e('Next', 'pride-of-africa'); ?></button>
        </nav>

    </div>
</section>

<?php get_template_part('template-parts/gallery/lightbox'); ?>

<script>
( function () {
    'use strict';

    var grid       = document.getElementById( 'gallery-grid' );
    var empty      = document.getElementById( 'gallery-empty' );
    var filterBar  = document.getElementById( 'gallery-filterbar' );
    var pagination = document.getElementById( 'gallery-pagination' );
    if ( ! grid || ! filterBar ) return;

    var state = { page: 1 };
    var searchTimer = null;

    function collectFilters() {
        var data = {};
        filterBar.querySelectorAll( '[data-gallery-filter]' ).forEach( function ( el ) {
            var key = el.dataset.galleryFilter;
            if ( el.tagName === 'BUTTON' ) {
                if ( el.classList.contains( 'is-active' ) ) data[ key ] = el.dataset.value || '';
            } else {
                data[ key ] = el.value || '';
            }
        } );
        return data;
    }

    function fetchPage( page ) {
        state.page = page;
        var filters = collectFilters();
        var body = new URLSearchParams();
        body.append( 'action', 'pride_gallery_filter' );
        body.append( 'nonce', window.prideOfAfricaData ? window.prideOfAfricaData.nonce : '' );
        body.append( 'page', page );
        Object.keys( filters ).forEach( function ( k ) { body.append( k, filters[ k ] ); } );

        grid.setAttribute( 'aria-busy', 'true' );

        fetch( window.prideOfAfricaData ? window.prideOfAfricaData.ajaxUrl : '/wp-admin/admin-ajax.php', {
            method: 'POST', body: body, credentials: 'same-origin',
        } )
            .then( function ( res ) { return res.json(); } )
            .then( function ( json ) {
                if ( ! json.success ) return;
                grid.innerHTML = json.data.html;
                empty.hidden = json.data.found !== 0;

                var prevBtn = pagination.querySelector( '[data-gallery-page-prev]' );
                var nextBtn = pagination.querySelector( '[data-gallery-page-next]' );
                var status  = pagination.querySelector( '[data-gallery-page-status]' );
                prevBtn.hidden = json.data.page <= 1;
                nextBtn.hidden = json.data.page >= json.data.max_pages;
                status.textContent = json.data.max_pages > 1 ? ( 'Page ' + json.data.page + ' of ' + json.data.max_pages ) : '';

                window.scrollTo( { top: grid.offsetTop - 140, behavior: 'smooth' } );
            } )
            .finally( function () { grid.removeAttribute( 'aria-busy' ); } );
    }

    // Pill buttons (media type)
    filterBar.querySelectorAll( '.c-gallery-filterbar__pill' ).forEach( function ( btn ) {
        btn.addEventListener( 'click', function () {
            filterBar.querySelectorAll( '.c-gallery-filterbar__pill' ).forEach( function ( b ) { b.classList.remove( 'is-active' ); } );
            btn.classList.add( 'is-active' );
            fetchPage( 1 );
        } );
    } );

    // Selects
    filterBar.querySelectorAll( 'select[data-gallery-filter]' ).forEach( function ( sel ) {
        sel.addEventListener( 'change', function () { fetchPage( 1 ); } );
    } );

    // Search (debounced)
    var searchInput = document.getElementById( 'gallery-search' );
    if ( searchInput ) {
        searchInput.addEventListener( 'input', function () {
            clearTimeout( searchTimer );
            searchTimer = setTimeout( function () { fetchPage( 1 ); }, 350 );
        } );
    }

    // Collection shortcut chips
    document.querySelectorAll( '[data-gallery-filter-shortcut]' ).forEach( function ( chip ) {
        chip.addEventListener( 'click', function () {
            var key = chip.dataset.galleryFilterShortcut;
            var hiddenSelect = filterBar.querySelector( '[data-gallery-filter="' + key + '"]' );
            // Collection isn't one of the visible dropdowns — inject a hidden filter value.
            if ( ! hiddenSelect ) {
                var input = filterBar.querySelector( 'input[data-gallery-filter="' + key + '"]' );
                if ( ! input ) {
                    input = document.createElement( 'input' );
                    input.type = 'hidden';
                    input.dataset.galleryFilter = key;
                    filterBar.appendChild( input );
                }
                input.value = chip.dataset.value;
            } else {
                hiddenSelect.value = chip.dataset.value;
            }
            filterBar.scrollIntoView( { behavior: 'smooth', block: 'start' } );
            fetchPage( 1 );
        } );
    } );

    // Layout toggle
    filterBar.querySelectorAll( '[data-gallery-layout]' ).forEach( function ( btn ) {
        btn.addEventListener( 'click', function () {
            filterBar.querySelectorAll( '[data-gallery-layout]' ).forEach( function ( b ) { b.classList.remove( 'is-active' ); } );
            btn.classList.add( 'is-active' );
            grid.dataset.layout = btn.dataset.galleryLayout;
            grid.className = 'c-gallery-grid c-gallery-grid--' + btn.dataset.galleryLayout;
        } );
    } );

    // Pagination
    pagination.querySelector( '[data-gallery-page-prev]' ).addEventListener( 'click', function () { fetchPage( Math.max( 1, state.page - 1 ) ); } );
    pagination.querySelector( '[data-gallery-page-next]' ).addEventListener( 'click', function () { fetchPage( state.page + 1 ); } );

    // Sticky filter bar shadow once scrolled past it
    var stickyObserver = new IntersectionObserver( function ( entries ) {
        filterBar.classList.toggle( 'is-stuck', entries[0].intersectionRatio < 1 );
    }, { threshold: [1] } );
    stickyObserver.observe( filterBar );
} )();
</script>

<?php get_footer(); ?>
