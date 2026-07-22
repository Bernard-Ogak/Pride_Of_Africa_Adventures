# Pride of Africa Adventures & Safaris — WordPress Theme

## Overview

Production-ready custom WordPress theme for Pride of Africa Adventures & Safaris. Built with Bootstrap 5.3, vanilla JavaScript, and PHP 8.3+.

**Version:** 1.0.0  
**Compatibility:** WordPress 6.3+, PHP 8.3+, Bootstrap 5.3

## Features

### Foundation Files Created

✅ **functions.php** — Complete theme setup with:
- Theme supports (featured images, custom logo, HTML5, responsive embeds, etc.)
- Navigation menus (primary, mobile, footer)
- Widget areas (sidebar, footer widgets)
- Bootstrap 5 and Google Fonts enqueuing
- Customizer settings for company contact information
- SVG upload support
- Custom menu walkers
- Template tags for dynamic content

✅ **style.css** — Master stylesheet with:
- Design system (CSS variables for brand colors)
- Reset and base styling
- Utility classes
- WordPress defaults
- Accessibility features
- Gold separator accents
- Button styles
- Custom scrollbar

✅ **header.php** — Complete header structure:
- Desktop top bar with contact info, WhatsApp, Call Now buttons
- Main sticky navigation with transparent-to-solid scroll effect
- Logo display
- Primary navigation menu with dropdown support
- Mobile hamburger menu
- Semantic HTML5 markup
- Skip-to-content accessibility link

✅ **header.css** — Header-specific styles:
- Top bar styling
- Main header styles with scroll state
- Navbar layout and animations
- Logo styling
- Navigation links and hover effects
- Dropdown menus (desktop)
- Mobile hamburger menu
- Responsive adjustments
- Accessibility focus states

✅ **header.js** — Header interactivity:
- Scroll detection for sticky header effect (50px threshold)
- Mobile menu toggle with aria attributes
- Dropdown menu functionality
- Close menus on outside clicks
- Keyboard navigation (Escape key)
- Window resize handling
- Smooth animations

✅ **footer.php** — Complete footer layout:
- 4-column footer grid
- Brand column with logo and social icons
- Quick links column
- Destinations column
- Contact information column
- Footer bottom with copyright and legal links
- Dynamic social media links

✅ **Template Files:**
- **index.php** — Main template for all pages
- **single.php** — Single post display
- **404.php** — Error page
- **search.php** — Search results
- **archive.php** — Post archives
- **comments.php** — Comments section

## Installation

### 1. Upload Theme Files

```bash
# Copy the entire theme folder to:
/wp-content/themes/pride-of-africa-adventures/
```

### 2. Activate Theme

- Go to **WordPress Dashboard**
- Navigate to **Appearance → Themes**
- Find "Pride of Africa Adventures & Safaris"
- Click **Activate**

### 3. Configure Theme Settings

#### Logo Setup
1. Go to **Appearance → Customize**
2. Click **Site Identity**
3. Upload your company logo
4. Recommended size: 200px × 45px (flex dimensions supported)

#### Navigation Menus
1. Go to **Appearance → Menus**
2. Create three menus:
   - **Primary Menu** — Main desktop navigation
   - **Mobile Menu** — Mobile navigation (optional)
   - **Footer Menu** — Footer links
3. Assign menus in **Appearance → Customize → Menus**

#### Company Information
1. Go to **Appearance → Customize**
2. Click **Company Information**
3. Configure:
   - Primary Phone
   - Secondary Phone
   - Email Address
   - WhatsApp Number (without spaces/+)
   - Business Address

#### Social Media Links
1. In **Customize**, click **Social Media Links**
2. Add your company profiles for:
   - Facebook
   - Instagram
   - YouTube
   - TikTok

## File Structure

```
pride-of-africa-adventures/
├── index.php                    # Main template
├── header.php                   # Header with top bar & nav
├── footer.php                   # Footer with 4 columns
├── single.php                   # Single post
├── archive.php                  # Post archives
├── search.php                   # Search results
├── 404.php                      # 404 error page
├── comments.php                 # Comments section
├── functions.php                # Theme functions & setup
├── style.css                    # Main stylesheet + design tokens
│
├── assets/
│   ├── css/
│   │   └── header.css          # Header-specific styles
│   ├── js/
│   │   ├── header.js           # Header functionality
│   │   └── main.js             # Global scripts
│   └── images/
│       └── favicon.png         # (to be added)
│
└── template-parts/             # Future: Page sections
    └── (to be built)
```

## Design System

### Color Palette (CSS Variables)

```css
--color-gold:             #009900    /* Primary accent */
--color-jungle:           #2A322E    /* Dark sections */
--color-bone:             #FCFBF8    /* Light backgrounds */
--color-obsidian:         #1B1B18    /* Text color */
--color-card:             #F9F8F6    /* Card backgrounds */
--color-muted:            #EBEFEE    /* Muted backgrounds */
--color-muted-fg:         #676B66    /* Secondary text */
--color-border:           #E5E2DC    /* Borders */

/* Social Colors */
--color-whatsapp:         #25D366
--color-facebook:         #1877F2
--color-instagram:        #E4405F
--color-youtube:          #FF0000
--color-tiktok:           #010101
```

### Typography

- **Font Family:** Poppins (Google Fonts)
- **Fallback:** system-ui, -apple-system, sans-serif
- **Display Font:** Playfair Display (for italics)

### Spacing & Sizing

```css
--topbar-height:          40px
--header-height:          72px
--container-max:          1400px
```

## Responsive Breakpoints

| Breakpoint | Size | Behavior |
|-----------|------|----------|
| Mobile | < 640px | Single column, hamburger menu |
| Tablet | 768px–1024px | 2-column grids, mobile nav hints |
| Desktop | 1024px+ | 3-column grids, desktop nav, social sidebar |
| XL | 1280px+ | Email visible in top bar |

## Navigation Structure

### Primary Menu Items (Configure in Customizer)

```
Home
About Us
Destinations (dropdown)
  └── Kenya, Tanzania, Uganda, Ethiopia, Zanzibar, Seychelles
Tours (dropdown)
  └── Safari, Beach Holiday, Day Tours
Blog
Resources (dropdown)
  └── Dashboard, Packing Guide, Group Departures, etc.
Contact
Language (globe icon with 12 languages)
```

## Header Behavior

### Scroll Detection

- **Threshold:** 50px
- **Transparent State:** Above 50px (full opacity, blurred background)
- **Solid State:** Below 50px (bone background with backdrop blur)
- **Transition:** 300ms smooth

### Mobile Menu

- **Breakpoint:** Below 992px
- **Trigger:** Hamburger icon click
- **Behavior:** Full-width collapsible drawer
- **Submenus:** Click chevron to expand/collapse
- **Accessibility:** Keyboard navigation (Escape to close)

## Top Bar (Desktop Only)

**Display:** Hidden on mobile/tablet, visible on desktop (lg breakpoint)

**Left Section:**
- Phone 1 (clickable tel: link)
- Phone 2 (clickable tel: link)
- Email (XL screens only)

**Right Section:**
- WhatsApp button (green, clickable to chat)
- Call Now button (bordered, phone link)
- Social icons (Facebook, Instagram, YouTube, TikTok)

## Customizer Settings

All company information is stored in the Customizer and pulled dynamically:

```php
// Retrieve company info anywhere:
pride_get_phone_1()           // Primary phone
pride_get_phone_2()           // Secondary phone
pride_get_email()             // Email
pride_get_whatsapp()          // WhatsApp number
pride_get_address()           // Business address
pride_get_social_link($platform)  // Social URLs
```

## WordPress Supports

Theme includes support for:

- ✅ Automatic feed links
- ✅ Dynamic title tags
- ✅ Featured images (post thumbnails)
- ✅ Custom logo
- ✅ HTML5 markup (search form, comment form, gallery, etc.)
- ✅ Responsive embeds
- ✅ Wide alignment blocks
- ✅ Block styles
- ✅ Block templates
- ✅ SVG upload support

## Widget Areas

Two widget areas registered and ready to use:

1. **Primary Sidebar** (ID: `primary-sidebar`)
2. **Footer Widget 1** (ID: `footer-1`)
3. **Footer Widget 2** (ID: `footer-2`)

Activate in **Appearance → Widgets**

## Enqueued Assets

### Stylesheets

1. **Bootstrap 5.3** — CDN (jsDelivr)
2. **Google Fonts** — Poppins + Playfair Display
3. **Main Theme CSS** — style.css
4. **Header CSS** — assets/css/header.css

### Scripts

1. **Bootstrap JS Bundle** — CDN (jsDelivr)
2. **Header JS** — assets/js/header.js
3. **Main JS** — assets/js/main.js

## Accessibility Features

✅ **Semantic HTML5** — Proper heading hierarchy, landmarks  
✅ **ARIA Labels** — Buttons, navigation, dropdowns  
✅ **Keyboard Navigation** — Tab through menu, Escape to close  
✅ **Focus States** — Gold outline on focused elements  
✅ **Skip Links** — Jump to main content  
✅ **Color Contrast** — WCAG AA compliant  
✅ **SVG Icons** — With proper alt text  

## SEO-Ready Structure

- ✅ Proper meta tags in header.php
- ✅ Semantic HTML landmarks (header, nav, main, footer)
- ✅ Custom logo support
- ✅ Automatic title tags
- ✅ Breadcrumb-ready structure
- ✅ Mobile-responsive viewport
- ✅ Schema.org ready (for future implementations)

## Performance

- ✅ Minimal JavaScript (vanilla, no jQuery)
- ✅ Optimized CSS with custom properties
- ✅ Google Fonts with display=swap
- ✅ Bootstrap CDN for faster delivery
- ✅ Semantic, lean HTML
- ✅ CSS Grid & Flexbox (no bloat)

## Browser Compatibility

- ✅ Chrome/Edge (latest 2 versions)
- ✅ Firefox (latest 2 versions)
- ✅ Safari (latest 2 versions)
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## Next Steps

### Build Homepage Sections (Future Phase)

1. Hero Slider (auto-rotating, 6-second intervals)
2. Trip Architect Form (inquiry capture)
3. Why Choose Us (6 feature cards)
4. Trusted Partners (marquee logos)
5. Top Destinations (6 country cards)
6. Popular Tours (filterable tabs)
7. Featured Itineraries (3 premium packages)
8. Dream Trip Planner (free-text form)
9. Trip Estimator (cost calculator)
10. International Safaris (15 country blocks)
11. Testimonials (filterable carousel)
12. Blog Preview (5 post cards)
13. Business Hours (live table + world clock)
14. Final CTA (conversion section)

### Additional Pages

- About page
- Destinations detail pages (6 countries)
- Tours listing & detail pages
- Blog system
- Gallery & lightbox
- Contact page
- Dashboard (admin)
- Etc.

## Support & Customization

### Adding Custom CSS

1. Create `assets/css/custom.css`
2. Enqueue in functions.php:

```php
wp_enqueue_style('custom-css', PRIDE_OF_AFRICA_ASSETS . '/css/custom.css', [], PRIDE_OF_AFRICA_VERSION);
```

### Adding Custom JavaScript

1. Create `assets/js/custom.js`
2. Enqueue in functions.php:

```php
wp_enqueue_script('custom-js', PRIDE_OF_AFRICA_ASSETS . '/js/custom.js', [], PRIDE_OF_AFRICA_VERSION, true);
```

### Modifying Colors

Edit CSS variables in `style.css`:

```css
:root {
    --color-gold: #009900;  /* Change primary color */
    /* etc. */
}
```

## Troubleshooting

### Logo Not Showing

- Check file upload size (recommended max 500KB)
- Verify image dimensions (at least 200×45px)
- Try JPG or PNG format

### Menus Not Appearing

- Ensure menus are created in **Appearance → Menus**
- Assign to correct locations in Customizer
- Check theme location names in functions.php

### Styles Not Loading

- Clear WordPress cache if using caching plugin
- Check browser console for CSS errors
- Verify Bootstrap CDN is accessible

### Mobile Menu Not Working

- Check JavaScript is enabled
- Verify Bootstrap JS is loading (check console)
- Clear browser cache

## License

GNU General Public License v2 or later

## Author

Pride of Africa Adventures & Safaris

## Version History

### 1.0.0 (Initial Release)
- Foundation theme with header, footer, navigation
- Top bar with contact info
- Sticky header with scroll detection
- Mobile-responsive hamburger menu
- Bootstrap 5.3 integration
- Google Fonts (Poppins + Playfair Display)
- Design system with CSS variables
- Customizer for company information
- Complete accessibility support
- SEO-ready structure
- Production-ready code

---

**Ready to customize and deploy!** 🚀
