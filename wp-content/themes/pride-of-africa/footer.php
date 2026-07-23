<?php
/**
 * Footer template
 *
 * @package Pride_Of_Africa
 */
?>

    </div><!-- .site-main -->

    <!-- ===== FOOTER ===== -->
    <footer class="site-footer" id="site-footer" role="contentinfo">
        <div class="footer-main text-white py-5">
            <div class="container-site">
                <div class="row g-4">
                    <!-- Column 1: Brand -->
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget">
                            <!-- Company Name -->
                            <h5 class="text-gold mb-2">
                                <?php esc_html_e('PRIDE OF AFRICA', 'pride-of-africa'); ?>
                            </h5>
                            <p class="small text-white-50 mb-3">
                                <?php esc_html_e('Adventures & Safaris', 'pride-of-africa'); ?>
                            </p>

                            <!-- Description -->
                            <p class="small mb-4 text-white-50">
                                <?php esc_html_e('Your premier safari tour operator in East Africa, serving adventurers from 40+ countries since 2010.', 'pride-of-africa'); ?>
                            </p>

                            <!-- Social Icons — same PNG-or-SVG icons as the header (pride_get_social_icon()) -->
                            <div class="footer-contact-icons d-flex gap-3">
                                <?php if (pride_get_social_link('facebook')) : $icon = pride_get_social_icon('facebook'); ?>
                                    <a href="<?php echo pride_get_social_link('facebook'); ?>" target="_blank" rel="noopener noreferrer" class="footer-social-icon" aria-label="Facebook">
                                        <?php if ($icon) : ?>
                                            <img src="<?php echo esc_url($icon); ?>" width="20" height="20" alt="" class="footer-social-icon-img">
                                        <?php else : ?>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>

                                <?php if (pride_get_social_link('instagram')) : $icon = pride_get_social_icon('instagram'); ?>
                                    <a href="<?php echo pride_get_social_link('instagram'); ?>" target="_blank" rel="noopener noreferrer" class="footer-social-icon" aria-label="Instagram">
                                        <?php if ($icon) : ?>
                                            <img src="<?php echo esc_url($icon); ?>" width="20" height="20" alt="" class="footer-social-icon-img">
                                        <?php else : ?>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                            <path d="M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-7" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                            <circle cx="18" cy="6" r="1" fill="currentColor"/>
                                        </svg>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>

                                <?php if (pride_get_social_link('youtube')) : $icon = pride_get_social_icon('youtube'); ?>
                                    <a href="<?php echo pride_get_social_link('youtube'); ?>" target="_blank" rel="noopener noreferrer" class="footer-social-icon" aria-label="YouTube">
                                        <?php if ($icon) : ?>
                                            <img src="<?php echo esc_url($icon); ?>" width="20" height="20" alt="" class="footer-social-icon-img">
                                        <?php else : ?>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                        </svg>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>

                                <?php if (pride_get_social_link('tiktok')) : $icon = pride_get_social_icon('tiktok'); ?>
                                    <a href="<?php echo pride_get_social_link('tiktok'); ?>" target="_blank" rel="noopener noreferrer" class="footer-social-icon" aria-label="TikTok">
                                        <?php if ($icon) : ?>
                                            <img src="<?php echo esc_url($icon); ?>" width="20" height="20" alt="" class="footer-social-icon-img">
                                        <?php else : ?>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.68v13.67a2.47 2.47 0 1 1-2.88-2.47v3.74c4.57 0 8.33-3.72 8.33-8.3V8.16c1.95 1.48 4.38 2.35 6.56 2.39v-3.72a4.85 4.85 0 0 1-3.56-1.54z"/>
                                        </svg>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>

                                <?php if (pride_get_social_link('linkedin')) : ?>
                                    <a href="<?php echo pride_get_social_link('linkedin'); ?>" target="_blank" rel="noopener noreferrer" class="footer-social-icon" aria-label="LinkedIn">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <!-- Newsletter Subscription -->
                            <form class="footer-newsletter" id="footer-newsletter-form" novalidate>
                                <label for="footer-newsletter-email" class="footer-newsletter__label">
                                    <?php esc_html_e('Subscribe to our newsletter', 'pride-of-africa'); ?>
                                </label>
                                <div class="footer-newsletter__row">
                                    <input
                                        type="email"
                                        id="footer-newsletter-email"
                                        name="email"
                                        class="footer-newsletter__input"
                                        placeholder="<?php esc_attr_e('Your email address', 'pride-of-africa'); ?>"
                                        aria-label="<?php esc_attr_e('Email address', 'pride-of-africa'); ?>"
                                        required
                                    >
                                    <button type="submit" class="footer-newsletter__submit">
                                        <?php esc_html_e('Subscribe', 'pride-of-africa'); ?>
                                    </button>
                                </div>
                                <p class="footer-newsletter__message" id="footer-newsletter-message" role="status" aria-live="polite"></p>
                            </form>
                        </div>
                    </div>

                    <!-- Column 2: Quick Links -->
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget">
                            <h5 class="text-gold mb-3"><?php esc_html_e('Quick Links', 'pride-of-africa'); ?></h5>
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'footer',
                                'container'      => false,
                                'menu_class'     => 'list-unstyled footer-menu',
                                'fallback_cb'    => function () {
                                    echo '<ul class="list-unstyled">';
                                    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'pride-of-africa') . '</a></li>';
                                    echo '<li><a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About Us', 'pride-of-africa') . '</a></li>';
                                    echo '<li><a href="' . esc_url(home_url('/tours')) . '">' . esc_html__('Tours', 'pride-of-africa') . '</a></li>';
                                    echo '<li><a href="' . esc_url(home_url('/destinations')) . '">' . esc_html__('Destinations', 'pride-of-africa') . '</a></li>';
                                    echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact', 'pride-of-africa') . '</a></li>';
                                    echo '</ul>';
                                },
                            ]);
                            ?>
                        </div>
                    </div>

                    <!-- Column 3: Destinations -->
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget">
                            <h5 class="text-gold mb-3"><?php esc_html_e('Destinations', 'pride-of-africa'); ?></h5>
                            <ul class="list-unstyled footer-menu">
                                <li><a href="<?php echo esc_url(home_url('/destinations/kenya')); ?>">Kenya</a></li>
                                <li><a href="<?php echo esc_url(home_url('/destinations/tanzania')); ?>">Tanzania</a></li>
                                <li><a href="<?php echo esc_url(home_url('/destinations/uganda')); ?>">Uganda</a></li>
                                <li><a href="<?php echo esc_url(home_url('/destinations/ethiopia')); ?>">Ethiopia</a></li>
                                <li><a href="<?php echo esc_url(home_url('/destinations/zanzibar')); ?>">Zanzibar</a></li>
                                <li><a href="<?php echo esc_url(home_url('/destinations/seychelles')); ?>">Seychelles</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Column 4: Contact Info -->
                    <div class="col-md-6 col-lg-3">
                        <div class="footer-widget">
                            <h5 class="text-gold mb-3"><?php esc_html_e('Contact Us', 'pride-of-africa'); ?></h5>
                            <div class="footer-contact-item mb-3 d-flex gap-2">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="flex-shrink-0 mt-1" style="color: var(--color-gold);">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <div class="small">
                                    <p class="mb-0"><a href="tel:<?php echo esc_attr(str_replace([' ', '-', '(', ')'], '', pride_get_phone_1())); ?>"><?php echo pride_get_phone_1(); ?></a></p>
                                    <p class="mb-0"><a href="tel:<?php echo esc_attr(str_replace([' ', '-', '(', ')'], '', pride_get_phone_2())); ?>"><?php echo pride_get_phone_2(); ?></a></p>
                                </div>
                            </div>

                            <div class="footer-contact-item mb-3 d-flex gap-2">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="flex-shrink-0 mt-1" style="color: var(--color-gold);">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                </svg>
                                <div class="small">
                                    <p class="mb-0"><a href="mailto:<?php echo esc_attr(pride_get_email()); ?>"><?php echo pride_get_email(); ?></a></p>
                                </div>
                            </div>

                            <div class="footer-contact-item d-flex gap-2">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="flex-shrink-0 mt-1" style="color: var(--color-gold);">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <div class="small">
                                    <p class="mb-0"><?php echo pride_get_address(); ?></p>
                                </div>
                            </div>

                            <div class="footer-review-qr mt-3">
                                <?php get_template_part( 'template-parts/cards/review-qr-code' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== MICRO FOOTER ===== -->
        <div class="micro-footer">
            <div class="container-site">
                <div class="micro-footer-content">
                    <span>&copy; 2026 Pride of Africa Adventures & Safaris. All rights reserved.</span>
                    <span class="micro-footer-separator">|</span>
                    <span>Visit Counter: <span id="visit-counter"><?php echo absint(get_option('pride_of_africa_visit_count', 0)); ?></span></span>
                    <span class="micro-footer-separator">|</span>
                    <span>Engineered by: <a href="https://wa.me/254702118611" target="_blank" rel="noopener noreferrer">Talk To the Developer</a></span>
                    <span class="micro-footer-separator">|</span>
                    <a href="<?php echo esc_url(home_url('/privacy')); ?>">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
    ( function () {
        'use strict';
        var form = document.getElementById( 'footer-newsletter-form' );
        if ( ! form ) return;

        var input   = document.getElementById( 'footer-newsletter-email' );
        var message = document.getElementById( 'footer-newsletter-message' );
        var button  = form.querySelector( '.footer-newsletter__submit' );

        form.addEventListener( 'submit', function ( e ) {
            e.preventDefault();

            message.textContent = '';
            message.classList.remove( 'is-error', 'is-success' );
            button.disabled = true;

            var data = new FormData();
            data.append( 'action', 'pride_subscribe_newsletter' );
            data.append( 'nonce', window.prideOfAfricaData ? window.prideOfAfricaData.nonce : '' );
            data.append( 'email', input.value );

            fetch( window.prideOfAfricaData ? window.prideOfAfricaData.ajaxUrl : '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: data,
                credentials: 'same-origin',
            } )
                .then( function ( res ) { return res.json(); } )
                .then( function ( json ) {
                    message.textContent = json.data && json.data.message ? json.data.message : '';
                    message.classList.add( json.success ? 'is-success' : 'is-error' );
                    if ( json.success ) form.reset();
                } )
                .catch( function () {
                    message.textContent = '<?php echo esc_js( __( 'Something went wrong. Please try again.', 'pride-of-africa' ) ); ?>';
                    message.classList.add( 'is-error' );
                } )
                .finally( function () {
                    button.disabled = false;
                } );
        } );
    } )();
    </script>

    <?php wp_footer(); ?>

</body>
</html>