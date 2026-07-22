<?php
/**
 * Template for displaying 404 pages
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<div class="container-site py-5 text-center">
    <h1 class="display-4 mb-3"><?php esc_html_e('Page Not Found', 'pride-of-africa'); ?></h1>
    <p class="lead mb-4"><?php esc_html_e('Sorry, the page you are looking for does not exist.', 'pride-of-africa'); ?></p>
    <a href="<?php echo esc_url(home_url()); ?>" class="btn btn-primary btn-lg">
        <?php esc_html_e('Back to Home', 'pride-of-africa'); ?>
    </a>
</div>

<?php
get_footer();
?>
