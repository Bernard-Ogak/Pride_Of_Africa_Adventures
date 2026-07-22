<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>

<body <?php body_class('has-topbar'); ?>>
    <?php wp_body_open(); ?>

    <!-- Skip to main content link for accessibility -->
    <a href="#main-content" class="skip-to-content"><?php esc_html_e('Skip to main content', 'pride-of-africa'); ?></a>

    <!-- ===== TOP BAR (DESKTOP ONLY) ===== -->
    <div class="topbar d-none d-lg-block" id="topbar">
        <div class="container-site h-100">
            <div class="row h-100 align-items-center justify-content-between">
                <!-- Left: Contact Info -->
                <div class="col-auto">
                    <div class="topbar-left d-flex align-items-center gap-3">
                        <!-- Phone 1 -->
                        <div class="topbar-item">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <a href="tel:<?php echo esc_attr(str_replace([' ', '-', '(', ')'], '', pride_get_phone_1())); ?>" class="topbar-link">
                                <?php echo pride_get_phone_1(); ?>
                            </a>
                        </div>

                        <!-- Phone 2 -->
                        <div class="topbar-item">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <a href="tel:<?php echo esc_attr(str_replace([' ', '-', '(', ')'], '', pride_get_phone_2())); ?>" class="topbar-link">
                                <?php echo pride_get_phone_2(); ?>
                            </a>
                        </div>

                        <!-- Email (XL screens only) -->
                        <div class="topbar-item d-none d-xl-block">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <a href="mailto:<?php echo esc_attr(pride_get_email()); ?>" class="topbar-link">
                                <?php echo pride_get_email(); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Buttons & Social -->
                <div class="col-auto">
                    <div class="topbar-right d-flex align-items-center gap-2">
                        <!-- Call Now Button -->
                        <a href="tel:<?php echo esc_attr(str_replace([' ', '-', '(', ')'], '', pride_get_phone_1())); ?>" class="btn btn-call-now btn-sm">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <?php esc_html_e('Call Now', 'pride-of-africa'); ?>
                        </a>

                        <!-- Social Icons with Brand Colours -->
                        <div class="topbar-social d-flex align-items-center gap-2 ms-2 ps-2 border-start border-secondary">
                            <!-- WhatsApp — placeholder link/icon; replace href and icon with your preferred values -->
                            <a href="#" class="social-icon" aria-label="WhatsApp">
                                <i class="bi bi-whatsapp" aria-hidden="true"></i>
                            </a>

                            <?php if (pride_get_social_link('facebook')) : $icon = pride_get_social_icon('facebook'); ?>
                                <a href="<?php echo pride_get_social_link('facebook'); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook">
                                    <?php if ($icon) : ?>
                                        <img src="<?php echo esc_url($icon); ?>" width="16" height="16" alt="" class="social-icon-img">
                                    <?php else : ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>

                            <?php if (pride_get_social_link('instagram')) : $icon = pride_get_social_icon('instagram'); ?>
                                <a href="<?php echo pride_get_social_link('instagram'); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram">
                                    <?php if ($icon) : ?>
                                        <img src="<?php echo esc_url($icon); ?>" width="16" height="16" alt="" class="social-icon-img">
                                    <?php else : ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-7" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                        <circle cx="18" cy="6" r="1" fill="currentColor"/>
                                    </svg>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>

                            <?php if (pride_get_social_link('youtube')) : $icon = pride_get_social_icon('youtube'); ?>
                                <a href="<?php echo pride_get_social_link('youtube'); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="YouTube">
                                    <?php if ($icon) : ?>
                                        <img src="<?php echo esc_url($icon); ?>" width="16" height="16" alt="" class="social-icon-img">
                                    <?php else : ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>

                            <?php if (pride_get_social_link('tiktok')) : $icon = pride_get_social_icon('tiktok'); ?>
                                <a href="<?php echo pride_get_social_link('tiktok'); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="TikTok">
                                    <?php if ($icon) : ?>
                                        <img src="<?php echo esc_url($icon); ?>" width="16" height="16" alt="" class="social-icon-img">
                                    <?php else : ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.68v13.67a2.47 2.47 0 1 1-2.88-2.47v3.74c4.57 0 8.33-3.72 8.33-8.3V8.16c1.95 1.48 4.38 2.35 6.56 2.39v-3.72a4.85 4.85 0 0 1-3.56-1.54z"/>
                                    </svg>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>

                            <?php if (pride_get_social_link('linkedin')) : ?>
                                <a href="<?php echo pride_get_social_link('linkedin'); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="LinkedIn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MAIN HEADER / NAVIGATION ===== -->
    <!-- This header is intentionally fixed so it remains visible at the top of the viewport. -->
    <header class="header-main" id="header-main">
        <nav class="navbar navbar-expand-lg">
            <div class="container-site header-nav-container">
                <!-- Logo -->
                <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand" rel="home">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id) {
                        echo wp_get_attachment_image($custom_logo_id, 'medium', false, [
                            'class' => 'logo-image',
                            'alt'   => get_bloginfo('name'),
                        ]);
                    } else {
                        echo '<span class="logo-text">' . esc_html(get_bloginfo('name')) . '</span>';
                    }
                    ?>
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" id="mobile-menu-toggle" aria-label="<?php esc_attr_e('Toggle navigation menu', 'pride-of-africa'); ?>" aria-expanded="false" aria-controls="navbar-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <?php
                    wp_nav_menu([
                        'theme_location'  => 'primary',
                        'container'       => false,
                        'menu_class'      => 'navbar-nav ms-auto align-items-lg-center',
                        'fallback_cb'     => 'wp_page_menu',
                        'depth'           => 3,
                        'walker'          => new PRIDE_Of_Africa_Menu_Walker(),
                    ]);
                    ?>

                    <!-- Language selector — placeholder UI, not wired to a
                         translation plugin yet. Swap the "#" hrefs and item
                         list once a language/i18n setup exists. -->
                    <ul class="navbar-nav align-items-lg-center">
                        <li class="nav-item dropdown">
                            <a
                                href="#"
                                class="nav-link dropdown-toggle"
                                id="lang-switcher-toggle"
                                role="button"
                                aria-haspopup="true"
                                aria-expanded="false"
                                aria-label="<?php esc_attr_e('Select language', 'pride-of-africa'); ?>"
                            >
                                <i class="bi bi-globe2" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-label="<?php esc_attr_e('Language selector', 'pride-of-africa'); ?>">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Français</a></li>
                                <li><a class="dropdown-item" href="#">Deutsch</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div id="main-content" class="site-main">
