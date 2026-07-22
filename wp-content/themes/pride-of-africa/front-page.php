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

<!-- Explore Africa By Country -->
<?php get_template_part('template-parts/home/international'); ?>

<!-- Safari Cost Estimator -->
<?php get_template_part('template-parts/home/cost-estimator'); ?>

<!-- Testimonials -->
<?php get_template_part('template-parts/home/testimonials'); ?>

<!-- Plan Your Dream Trip -->
<?php get_template_part('template-parts/home/dream-trip'); ?>

<!-- Leave a Review -->
<?php get_template_part('template-parts/home/review'); ?>

<!-- Office Hours & Contact -->
<?php get_template_part('template-parts/home/office-hours'); ?>

<!-- Final CTA -->
<?php get_template_part('template-parts/home/final-cta'); ?>

<!-- Latest Blog Posts -->
<?php get_template_part('template-parts/home/blog'); ?>

<!-- Gallery Preview (unchanged from previous build) -->
<?php get_template_part('template-parts/home/gallery-preview'); ?>

<?php
get_footer();
?>