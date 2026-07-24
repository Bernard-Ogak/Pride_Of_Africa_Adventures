<?php
/**
 * Shared Gallery Lightbox
 * File:   template-parts/gallery/lightbox.php
 *
 * Include this once per page anywhere gallery-card.php items appear
 * (the gallery archive, a destination page's gallery block, a tour
 * page's gallery block). It operates generically on whatever
 * [data-gallery-item] elements are currently in the DOM — including
 * only currently-visible ones (so it respects whatever the filter bar
 * has filtered down to) — so the same markup/script works everywhere
 * without per-page wiring.
 *
 * @package PrideOfAfrica
 */
?>
<div class="c-lightbox" id="gallery-lightbox" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Gallery viewer', 'pride-of-africa'); ?>" hidden>
    <div class="c-lightbox__backdrop" data-lightbox-close></div>

    <div class="c-lightbox__stage">
        <button type="button" class="c-lightbox__control c-lightbox__close" data-lightbox-close aria-label="<?php esc_attr_e('Close', 'pride-of-africa'); ?>">
            <i class="bi bi-x-lg" aria-hidden="true"></i>
        </button>
        <button type="button" class="c-lightbox__control c-lightbox__prev" data-lightbox-prev aria-label="<?php esc_attr_e('Previous', 'pride-of-africa'); ?>">
            <i class="bi bi-chevron-left" aria-hidden="true"></i>
        </button>
        <button type="button" class="c-lightbox__control c-lightbox__next" data-lightbox-next aria-label="<?php esc_attr_e('Next', 'pride-of-africa'); ?>">
            <i class="bi bi-chevron-right" aria-hidden="true"></i>
        </button>

        <div class="c-lightbox__media" data-lightbox-media>
            <img class="c-lightbox__image" data-lightbox-image alt="" hidden>
            <div class="c-lightbox__video-wrap" data-lightbox-video-wrap hidden></div>
        </div>

        <div class="c-lightbox__zoom-hint">
            <button type="button" class="c-lightbox__control c-lightbox__zoom" data-lightbox-zoom aria-label="<?php esc_attr_e('Toggle zoom', 'pride-of-africa'); ?>">
                <i class="bi bi-zoom-in" aria-hidden="true"></i>
            </button>
        </div>
    </div>

    <div class="c-lightbox__panel">
        <div class="c-lightbox__info">
            <h2 class="c-lightbox__title" data-lightbox-title></h2>
            <p class="c-lightbox__caption" data-lightbox-caption></p>
            <p class="c-lightbox__location" data-lightbox-location hidden><i class="bi bi-geo-alt" aria-hidden="true"></i> <span data-lightbox-location-text></span></p>
        </div>

        <div class="c-lightbox__actions">
            <button type="button" class="c-lightbox__action" data-lightbox-share aria-label="<?php esc_attr_e('Share', 'pride-of-africa'); ?>">
                <i class="bi bi-share" aria-hidden="true"></i> <span><?php esc_html_e('Share', 'pride-of-africa'); ?></span>
            </button>
            <a href="#" class="c-lightbox__action" data-lightbox-download download aria-label="<?php esc_attr_e('Download', 'pride-of-africa'); ?>">
                <i class="bi bi-download" aria-hidden="true"></i> <span><?php esc_html_e('Download', 'pride-of-africa'); ?></span>
            </a>
            <button type="button" class="c-lightbox__action" data-lightbox-favorite aria-pressed="false" aria-label="<?php esc_attr_e('Add to favorites', 'pride-of-africa'); ?>">
                <i class="bi bi-heart" aria-hidden="true"></i> <span><?php esc_html_e('Favorite', 'pride-of-africa'); ?></span>
            </button>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="c-button c-button--primary c-lightbox__book" data-lightbox-book>
                <?php esc_html_e('Book This Safari', 'pride-of-africa'); ?>
            </a>
        </div>

        <p class="c-lightbox__counter"><span data-lightbox-position>1</span> / <span data-lightbox-total>1</span></p>
    </div>
</div>

<script>
( function () {
    'use strict';

    var lightbox = document.getElementById( 'gallery-lightbox' );
    if ( ! lightbox ) return;

    var stageImage   = lightbox.querySelector( '[data-lightbox-image]' );
    var videoWrap    = lightbox.querySelector( '[data-lightbox-video-wrap]' );
    var titleEl      = lightbox.querySelector( '[data-lightbox-title]' );
    var captionEl    = lightbox.querySelector( '[data-lightbox-caption]' );
    var locationWrap = lightbox.querySelector( '[data-lightbox-location]' );
    var locationText = lightbox.querySelector( '[data-lightbox-location-text]' );
    var downloadLink = lightbox.querySelector( '[data-lightbox-download]' );
    var bookLink     = lightbox.querySelector( '[data-lightbox-book]' );
    var positionEl   = lightbox.querySelector( '[data-lightbox-position]' );
    var totalEl      = lightbox.querySelector( '[data-lightbox-total]' );
    var zoomBtn      = lightbox.querySelector( '[data-lightbox-zoom]' );
    var favoriteBtn  = lightbox.querySelector( '[data-lightbox-favorite]' );
    var shareBtn     = lightbox.querySelector( '[data-lightbox-share]' );

    var items = [];
    var currentIndex = -1;
    var favorites = JSON.parse( localStorage.getItem( 'poaGalleryFavorites' ) || '[]' );

    function visibleItems() {
        return Array.prototype.slice.call( document.querySelectorAll( '[data-gallery-item]' ) )
            .filter( function ( el ) { return el.offsetParent !== null; } );
    }

    function openAt( index ) {
        items = visibleItems();
        if ( ! items.length ) return;
        currentIndex = ( index + items.length ) % items.length;
        render();
        lightbox.hidden = false;
        document.body.style.overflow = 'hidden';
    }

    function close() {
        lightbox.hidden = true;
        document.body.style.overflow = '';
        videoWrap.innerHTML = '';
    }

    function render() {
        var el = items[ currentIndex ];
        if ( ! el ) return;

        var mediaType = el.dataset.mediaType || 'photo';
        var videoUrl  = el.dataset.videoUrl || '';

        videoWrap.innerHTML = '';
        videoWrap.hidden = true;
        stageImage.hidden = true;
        stageImage.classList.remove( 'is-zoomed' );

        if ( 'photo' !== mediaType && videoUrl ) {
            videoWrap.hidden = false;
            videoWrap.innerHTML = buildVideoEmbed( videoUrl );
        } else {
            stageImage.hidden = false;
            stageImage.src = el.dataset.full || '';
            stageImage.alt = el.dataset.title || '';
        }

        titleEl.textContent = el.dataset.title || '';
        captionEl.textContent = el.dataset.caption || '';

        if ( el.dataset.location ) {
            locationWrap.hidden = false;
            locationText.textContent = el.dataset.location;
        } else {
            locationWrap.hidden = true;
        }

        downloadLink.href = el.dataset.full || '#';
        bookLink.href = el.dataset.permalink && el.dataset.relatedTourUrl ? el.dataset.relatedTourUrl : bookLink.href;

        positionEl.textContent = currentIndex + 1;
        totalEl.textContent = items.length;

        var isFav = favorites.indexOf( el.dataset.id ) !== -1;
        favoriteBtn.setAttribute( 'aria-pressed', isFav ? 'true' : 'false' );
        favoriteBtn.querySelector( 'i' ).className = isFav ? 'bi bi-heart-fill' : 'bi bi-heart';
    }

    function buildVideoEmbed( url ) {
        if ( url.indexOf( 'youtube.com/embed' ) !== -1 ) {
            return '<iframe src="' + url + '" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen loading="lazy" title="Video"></iframe>';
        }
        if ( url.indexOf( 'player.vimeo.com' ) !== -1 ) {
            return '<iframe src="' + url + '" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy" title="Video"></iframe>';
        }
        return '<video src="' + url + '" controls playsinline></video>';
    }

    // Open triggers
    document.addEventListener( 'click', function ( e ) {
        var trigger = e.target.closest( '[data-gallery-trigger]' );
        if ( ! trigger ) return;
        var card = trigger.closest( '[data-gallery-item]' );
        if ( ! card ) return;
        var all = visibleItems();
        openAt( all.indexOf( card ) );
    } );

    lightbox.querySelectorAll( '[data-lightbox-close]' ).forEach( function ( btn ) {
        btn.addEventListener( 'click', close );
    } );
    lightbox.querySelector( '[data-lightbox-prev]' ).addEventListener( 'click', function () { openAt( currentIndex - 1 ); } );
    lightbox.querySelector( '[data-lightbox-next]' ).addEventListener( 'click', function () { openAt( currentIndex + 1 ); } );

    zoomBtn.addEventListener( 'click', function () {
        stageImage.classList.toggle( 'is-zoomed' );
    } );

    favoriteBtn.addEventListener( 'click', function () {
        var el = items[ currentIndex ];
        if ( ! el ) return;
        var id = el.dataset.id;
        var idx = favorites.indexOf( id );
        if ( idx === -1 ) { favorites.push( id ); } else { favorites.splice( idx, 1 ); }
        localStorage.setItem( 'poaGalleryFavorites', JSON.stringify( favorites ) );
        render();
    } );

    shareBtn.addEventListener( 'click', function () {
        var el = items[ currentIndex ];
        if ( ! el ) return;
        var shareData = { title: el.dataset.title, url: el.dataset.permalink || window.location.href };
        if ( navigator.share ) {
            navigator.share( shareData ).catch( function () {} );
        } else if ( navigator.clipboard ) {
            navigator.clipboard.writeText( shareData.url );
            shareBtn.querySelector( 'span' ).textContent = '<?php echo esc_js( __( 'Copied!', 'pride-of-africa' ) ); ?>';
            setTimeout( function () { shareBtn.querySelector( 'span' ).textContent = '<?php echo esc_js( __( 'Share', 'pride-of-africa' ) ); ?>'; }, 1500 );
        }
    } );

    // Keyboard navigation
    document.addEventListener( 'keydown', function ( e ) {
        if ( lightbox.hidden ) return;
        if ( e.key === 'Escape' ) close();
        if ( e.key === 'ArrowLeft' ) openAt( currentIndex - 1 );
        if ( e.key === 'ArrowRight' ) openAt( currentIndex + 1 );
    } );

    // Touch swipe
    var touchStartX = 0;
    lightbox.addEventListener( 'touchstart', function ( e ) { touchStartX = e.changedTouches[0].clientX; }, { passive: true } );
    lightbox.addEventListener( 'touchend', function ( e ) {
        var dx = e.changedTouches[0].clientX - touchStartX;
        if ( Math.abs( dx ) > 50 ) {
            openAt( currentIndex + ( dx < 0 ? 1 : -1 ) );
        }
    }, { passive: true } );
} )();
</script>
