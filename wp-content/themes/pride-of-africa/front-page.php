<?php
/**
 * Front page / Homepage template
 *
 * Displays when a static homepage is set in Settings → Reading
 *
 * Homepage sections updated to use the poa-homepage-templates package.
 * The Hero section internally loads the Trip Planner bar itself
 * (template-parts/home/hero.php calls get_template_part for
 * template-parts/home/trip-planner), so it is not called separately here.
 * The previous sections are preserved, unused, in template-parts/home-legacy/.
 *
 * Section order (Phase 1 reorder): Hero+Trip Planner, Why Choose Us,
 * Trusted Partners, Top Destinations, Popular Tours, Featured Itineraries,
 * Plan Your Dream Trip, Safari Cost Estimator, International Safaris,
 * Testimonials, Leave a Review, Latest Blog, Gallery Preview, Office
 * Hours, Final CTA, Footer. "Leave a Review" and "Gallery Preview" aren't
 * named in the requested order — kept in place (not removed) right after
 * the sections they naturally extend (Testimonials, Blog).
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<!-- Hero Slider (loads the Trip Planner bar internally) -->
<?php get_template_part('template-parts/home/hero'); ?>

<!-- Why Choose Us / Trust -->
<?php get_template_part('template-parts/home/trust'); ?>

<!-- Trusted Partners -->
<?php get_template_part('template-parts/home/partners'); ?>

<!-- Top Destinations -->
<?php get_template_part('template-parts/home/destinations'); ?>

<!-- Popular Tours -->
<?php get_template_part('template-parts/home/popular-tours'); ?>

<!-- Featured Itineraries -->
<?php get_template_part('template-parts/home/featured-itineraries'); ?>

<!-- Plan Your Dream Trip -->
<?php get_template_part('template-parts/home/dream-trip'); ?>

<!-- Safari Cost Estimator -->
<?php get_template_part('template-parts/home/cost-estimator'); ?>

<!-- Explore Africa By Country -->
<?php get_template_part('template-parts/home/international'); ?>

<!-- Testimonials -->
<?php get_template_part('template-parts/home/testimonials'); ?>

<!-- Leave a Review (not in the named order — kept here, right after Testimonials) -->
<?php get_template_part('template-parts/home/review'); ?>

<!-- Latest Blog Posts -->
<?php get_template_part('template-parts/home/blog'); ?>

<!-- Gallery Preview (not in the named order — kept here, right after Blog) -->
<?php get_template_part('template-parts/home/gallery-preview'); ?>

<!-- Office Hours & Contact -->
<?php get_template_part('template-parts/home/office-hours'); ?>

<!-- Final CTA -->
<?php get_template_part('template-parts/home/final-cta'); ?>

<?php
get_footer();
?>
