/**
 * Pride of Africa Theme — theme.js
 * Consolidated JavaScript: all header, navigation, hero slider,
 * and marquee functionality in one file.
 *
 * Sections:
 *   1. Theme Initialization
 *   2. Sticky Header / Scroll Detection
 *   3. Mobile Menu
 *   4. Dropdown Menus
 *   5. Keyboard Navigation
 *   6. Window Resize Handler
 *   7. Hero Slider
 *   8. Trusted Partners Marquee
 *   9. Utility Functions
 */

(function () {
    'use strict';

    /* =========================================================================
       1. THEME INITIALIZATION
       ========================================================================= */

    function init() {
        initHeader();
        initHeroSlider();
        initMarquee();
        initInquiryForms();
    }

    /* =========================================================================
       2. STICKY HEADER / SCROLL DETECTION
       ========================================================================= */

    var headerMain = document.getElementById('header-main');
    var topbar = document.getElementById('topbar');
    var wpAdminBar = document.getElementById('wpadminbar');

    /**
     * Measure the rendered heights of the WP admin bar (if present), the theme
     * topbar and the main header, then expose them as CSS variables so layout
     * (offsets) automatically respects the admin UI when viewing the site.
     */
    function syncHeaderMeasurements() {
        // WP admin toolbar (shown for logged-in users). Default to 0.
        if (wpAdminBar) {
            document.documentElement.style.setProperty('--wpadminbar-height', wpAdminBar.offsetHeight + 'px');
        } else {
            document.documentElement.style.setProperty('--wpadminbar-height', '0px');
        }

        if (topbar) {
            document.documentElement.style.setProperty('--topbar-height', topbar.offsetHeight + 'px');
        }

        if (headerMain) {
            document.documentElement.style.setProperty('--header-height', headerMain.offsetHeight + 'px');
        }
    }

    var SCROLL_THRESHOLD = 50;

    function handleHeaderScroll() {
        if (!headerMain) return;
        headerMain.classList.toggle('scrolled', window.scrollY > SCROLL_THRESHOLD);
    }

    function initHeader() {
        syncHeaderMeasurements();
        handleHeaderScroll();
        window.addEventListener('resize', syncHeaderMeasurements, false);
        window.addEventListener('scroll', handleHeaderScroll, { passive: true });
    }

    /* =========================================================================
       3. MOBILE MENU
       ========================================================================= */

    var mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    var navbarCollapse   = document.getElementById('navbar-collapse');

    function initMobileMenu() {
        if (!mobileMenuToggle) return;

        mobileMenuToggle.addEventListener('click', function () {
            var isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', String(!isExpanded));

            if (!isExpanded) {
                navbarCollapse && navbarCollapse.classList.add('show');
            } else {
                navbarCollapse && navbarCollapse.classList.remove('show');
            }
        });

        // Close when a non-dropdown nav-link is clicked
        var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                if (!this.classList.contains('dropdown-toggle')) {
                    mobileMenuToggle.setAttribute('aria-expanded', 'false');
                    navbarCollapse && navbarCollapse.classList.remove('show');
                }
            });
        });
    }

    /* =========================================================================
       4. DROPDOWN MENUS
       ========================================================================= */

    var dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    var dropdownHoverTimer = null;

    function initDropdowns() {
        // Desktop hover behaviour with 300ms delay
        if (window.innerWidth >= 992) {
            dropdownToggles.forEach(function (toggle) {
                var dropdown = toggle.closest('.dropdown');
                if (!dropdown) return;

                var menu = dropdown.querySelector('.dropdown-menu');
                if (!menu) return;

                // Mouse enter on dropdown - open after 300ms delay
                dropdown.addEventListener('mouseenter', function () {
                    clearTimeout(dropdownHoverTimer);
                    dropdownHoverTimer = setTimeout(function () {
                        // Close all other open dropdowns first
                        document.querySelectorAll('.dropdown-menu.show').forEach(function (openMenu) {
                            if (openMenu !== menu) {
                                openMenu.classList.remove('show');
                            }
                        });
                        menu.classList.add('show');
                    }, 300);
                });

                // Mouse leave on dropdown - close immediately
                dropdown.addEventListener('mouseleave', function () {
                    clearTimeout(dropdownHoverTimer);
                    menu.classList.remove('show');
                });

                // Focus management
                dropdown.addEventListener('focusin', function () {
                    clearTimeout(dropdownHoverTimer);
                    menu.classList.add('show');
                });

                dropdown.addEventListener('focusout', function (e) {
                    // Only close if focus leaves the entire dropdown
                    if (!dropdown.contains(e.relatedTarget)) {
                        menu.classList.remove('show');
                    }
                });
            });
        }

        // Mobile click behaviour
        dropdownToggles.forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                if (window.innerWidth < 992) {
                    e.preventDefault();
                    e.stopPropagation();

                    var menu = this.nextElementSibling;

                    // Close all other open dropdowns
                    dropdownToggles.forEach(function (other) {
                        if (other !== toggle) {
                            var otherMenu = other.nextElementSibling;
                            if (otherMenu) otherMenu.classList.remove('show');
                        }
                    });

                    if (menu) menu.classList.toggle('show');
                }
            });
        });

        // Close dropdowns on outside click
        document.addEventListener('click', function (e) {
            dropdownToggles.forEach(function (toggle) {
                var menu = toggle.nextElementSibling;
                if (menu && !toggle.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('show');
                }
            });
        });
    }

    /* =========================================================================
       5. KEYBOARD NAVIGATION
       ========================================================================= */

    function initKeyboard() {
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                // Close all dropdowns
                dropdownToggles.forEach(function (toggle) {
                    var menu = toggle.nextElementSibling;
                    if (menu) menu.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                });

                // Close mobile menu
                if (mobileMenuToggle) {
                    mobileMenuToggle.setAttribute('aria-expanded', 'false');
                    navbarCollapse && navbarCollapse.classList.remove('show');
                }
            }
        });
    }

    /* =========================================================================
       6. WINDOW RESIZE HANDLER
       ========================================================================= */

    function initResize() {
        var resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                if (window.innerWidth >= 992) {
                    if (mobileMenuToggle) {
                        mobileMenuToggle.setAttribute('aria-expanded', 'false');
                        navbarCollapse && navbarCollapse.classList.remove('show');
                    }
                    dropdownToggles.forEach(function (toggle) {
                        var menu = toggle.nextElementSibling;
                        if (menu) menu.classList.remove('show');
                    });
                }
            }, 250);
        });
    }

    /* =========================================================================
       7. HERO SLIDER
       ========================================================================= */

    function initHeroSlider() {
        var sliderEl = document.getElementById('hero-slider');
        if (!sliderEl) return;

        /**
         * HeroSlider class — encapsulates all slider behaviour.
         */
        function HeroSlider() {
            this.slider          = sliderEl;
            this.slidesContainer = sliderEl.querySelector('.hero-slides');
            this.slides          = Array.from(sliderEl.querySelectorAll('.hero-slide'));
            this.prevBtn         = document.getElementById('hero-nav-prev');
            this.nextBtn         = document.getElementById('hero-nav-next');
            this.indicators      = Array.from(sliderEl.querySelectorAll('.hero-indicator'));

            this.currentSlide  = 0;
            this.totalSlides   = this.slides.length;
            this.autoplayTimer = null;
            this.isAnimating   = false;
            this.touchStartX   = 0;
            this.touchEndX     = 0;
            this.autoplayDelay = (window.heroSliderConfig && window.heroSliderConfig.autoplayInterval) || 6000;

            this._bindMethods();
            this._attachEvents();
            this.updateSlide(0, false);
            this.startAutoplay();
        }

        HeroSlider.prototype._bindMethods = function () {
            this._onPrev           = this.prev.bind(this);
            this._onNext           = this.next.bind(this);
            this._onKeydown        = this.handleKeydown.bind(this);
            this._onTouchStart     = this.handleTouchStart.bind(this);
            this._onTouchEnd       = this.handleTouchEnd.bind(this);
            this._onMouseEnter     = this.pauseAutoplay.bind(this);
            this._onMouseLeave     = this.startAutoplay.bind(this);
            this._onFocusIn        = this.pauseAutoplay.bind(this);
            this._onFocusOut       = this.startAutoplay.bind(this);
        };

        HeroSlider.prototype._attachEvents = function () {
            var self = this;

            if (this.prevBtn) this.prevBtn.addEventListener('click', this._onPrev);
            if (this.nextBtn) this.nextBtn.addEventListener('click', this._onNext);

            this.indicators.forEach(function (indicator, index) {
                indicator.addEventListener('click', function () { self.goToSlide(index); });
            });

            document.addEventListener('keydown', this._onKeydown);
            this.slider.addEventListener('touchstart', this._onTouchStart, { passive: true });
            this.slider.addEventListener('touchend',   this._onTouchEnd,   { passive: true });
            this.slider.addEventListener('mouseenter', this._onMouseEnter);
            this.slider.addEventListener('mouseleave', this._onMouseLeave);
            this.slider.addEventListener('focusin',    this._onFocusIn);
            this.slider.addEventListener('focusout',   this._onFocusOut);
        };

        HeroSlider.prototype.goToSlide = function (index, animate) {
            if (animate === undefined) animate = true;
            if (index < 0 || index >= this.totalSlides || this.isAnimating) return;
            this.currentSlide = index;
            this.updateSlide(index, animate);
        };

        HeroSlider.prototype.updateSlide = function (index, animate) {
            if (animate === undefined) animate = true;
            var self = this;

            if (animate) {
                this.isAnimating = true;
                setTimeout(function () { self.isAnimating = false; }, 600);
            }

            this.slides.forEach(function (slide, i) {
                slide.classList.remove('active', 'prev');
                if (i === index) {
                    slide.classList.add('active');
                } else if (i === index - 1 || (index === 0 && i === self.totalSlides - 1)) {
                    slide.classList.add('prev');
                }
            });

            this.indicators.forEach(function (indicator, i) {
                indicator.classList.toggle('active', i === index);
                indicator.setAttribute('aria-selected', String(i === index));
            });
        };

        HeroSlider.prototype.prev = function () {
            if (this.isAnimating) return;
            var index = this.currentSlide - 1;
            if (index < 0) index = this.totalSlides - 1;
            this.goToSlide(index);
            this.restartAutoplay();
        };

        HeroSlider.prototype.next = function () {
            if (this.isAnimating) return;
            var index = this.currentSlide + 1;
            if (index >= this.totalSlides) index = 0;
            this.goToSlide(index);
            this.restartAutoplay();
        };

        HeroSlider.prototype.startAutoplay = function () {
            if (this.autoplayTimer) return;
            var self = this;
            this.autoplayTimer = setInterval(function () { self.next(); }, this.autoplayDelay);
        };

        HeroSlider.prototype.pauseAutoplay = function () {
            if (this.autoplayTimer) {
                clearInterval(this.autoplayTimer);
                this.autoplayTimer = null;
            }
        };

        HeroSlider.prototype.restartAutoplay = function () {
            this.pauseAutoplay();
            this.startAutoplay();
        };

        HeroSlider.prototype.handleKeydown = function (e) {
            if (e.key === 'ArrowLeft')  this.prev();
            if (e.key === 'ArrowRight') this.next();
        };

        HeroSlider.prototype.handleTouchStart = function (e) {
            this.touchStartX = e.changedTouches[0].screenX;
        };

        HeroSlider.prototype.handleTouchEnd = function (e) {
            this.touchEndX = e.changedTouches[0].screenX;
            var diff = this.touchStartX - this.touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) this.next();
                else          this.prev();
            }
        };

        HeroSlider.prototype.destroy = function () {
            this.pauseAutoplay();
            if (this.prevBtn) this.prevBtn.removeEventListener('click', this._onPrev);
            if (this.nextBtn) this.nextBtn.removeEventListener('click', this._onNext);
            document.removeEventListener('keydown',        this._onKeydown);
            this.slider.removeEventListener('touchstart',  this._onTouchStart);
            this.slider.removeEventListener('touchend',    this._onTouchEnd);
            this.slider.removeEventListener('mouseenter',  this._onMouseEnter);
            this.slider.removeEventListener('mouseleave',  this._onMouseLeave);
            this.slider.removeEventListener('focusin',     this._onFocusIn);
            this.slider.removeEventListener('focusout',    this._onFocusOut);
        };

        window.heroSlider = new HeroSlider();

        window.addEventListener('beforeunload', function () {
            if (window.heroSlider) window.heroSlider.destroy();
        });
    }

    /* =========================================================================
       8. TRUSTED PARTNERS MARQUEE
       ========================================================================= */

    function initMarquee() {
        var wrappers = document.querySelectorAll('.marquee-wrapper');
        if (!wrappers.length) return;

        // Respect reduce-motion system preference
        var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        wrappers.forEach(function (wrapper) {
            var track = wrapper.querySelector('.marquee-track');
            if (!track) return;

            if (prefersReducedMotion) {
                track.style.animationPlayState = 'paused';
                return;
            }

            // Pause on hover
            wrapper.addEventListener('mouseenter', function () { track.style.animationPlayState = 'paused'; });
            wrapper.addEventListener('mouseleave', function () { track.style.animationPlayState = 'running'; });

            // Pause on keyboard focus
            wrapper.addEventListener('focus',  function () { track.style.animationPlayState = 'paused'; },  true);
            wrapper.addEventListener('blur',   function () { track.style.animationPlayState = 'running'; }, true);

            // Pause on touch
            wrapper.addEventListener('touchstart', function () { track.style.animationPlayState = 'paused'; },  { passive: true });
            wrapper.addEventListener('touchend',   function () { track.style.animationPlayState = 'running'; }, { passive: true });
        });
    }

    /* =========================================================================
       9. INQUIRY FORMS
       ========================================================================= */

    function initInquiryForms() {
        // NOTE: '#dream-trip-form' was added when the poa-homepage-templates
        // package was integrated (see template-parts/home/dream-trip.php).
        // It previously posted to an unregistered admin-post.php action and
        // would have shown users a WordPress "Invalid Action" error page;
        // it now uses this same AJAX pathway as the other inquiry forms.
        var forms = document.querySelectorAll('#planner-form, #contact-form, #dream-trip-form');
        if (!forms.length) return;

        forms.forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                var submitButton = form.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.textContent = 'Sending...';
                }

                function fieldValue() {
                    for (var i = 0; i < arguments.length; i++) {
                        var el = form.querySelector('#' + arguments[i]);
                        if (el && el.value) return el.value;
                    }
                    return '';
                }

                var payload = new FormData();
                payload.append('action', 'pride_submit_inquiry');
                payload.append('nonce', window.prideOfAfricaData && window.prideOfAfricaData.nonce ? window.prideOfAfricaData.nonce : '');
                payload.append('name', fieldValue('contact-name', 'planner-name', 'dream-name'));
                payload.append('email', fieldValue('contact-email', 'dream-email'));
                payload.append('message', fieldValue('contact-message', 'planner-dream', 'dream-message'));
                payload.append('destination', fieldValue('contact-destination', 'dream-destination'));
                payload.append('travel_type', fieldValue('contact-travel_type'));
                payload.append('travelers', fieldValue('dream-travelers'));
                payload.append('travel_dates', fieldValue('dream-travel-dates'));

                fetch(window.prideOfAfricaData && window.prideOfAfricaData.ajaxUrl ? window.prideOfAfricaData.ajaxUrl : '/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    body: payload
                }).then(function () {
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Sent';
                    }
                }).catch(function () {
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Try Again';
                    }
                });
            });
        });
    }

    /* =========================================================================
       10. UTILITY FUNCTIONS
       ========================================================================= */

    /**
     * Debounce helper — used by resize handler above.
     * @param {Function} fn
     * @param {number} delay
     * @returns {Function}
     */
    function debounce(fn, delay) {
        var timer;
        return function () {
            clearTimeout(timer);
            timer = setTimeout(fn, delay);
        };
    }

    /* =========================================================================
       BOOT
       ========================================================================= */

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initMobileMenu();
            initDropdowns();
            initKeyboard();
            initResize();
            init();
        });
    } else {
        initMobileMenu();
        initDropdowns();
        initKeyboard();
        initResize();
        init();
    }

})();
