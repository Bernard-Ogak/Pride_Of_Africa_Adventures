<?php
/**
 * Template Name: Packing Guide Page
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <div class="row g-5">
            <div class="col-lg-8">
                <p class="text-uppercase text-primary fw-semibold mb-2">Resources</p>
                <h1 class="display-5 fw-bold mb-3">Safari packing guide</h1>
                <p class="lead text-muted">A practical checklist to help you travel light while staying prepared for game drives, bush walks, and changing weather.</p>

                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h2 class="h5 fw-bold">Essentials</h2>
                                <ul class="mb-0">
                                    <li>Lightweight layers</li>
                                    <li>Neutral-colored clothing</li>
                                    <li>Sunhat and sunglasses</li>
                                    <li>Reusable water bottle</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h2 class="h5 fw-bold">Bush-ready gear</h2>
                                <ul class="mb-0">
                                    <li>Binoculars</li>
                                    <li>Camera with extra batteries</li>
                                    <li>Insect repellent</li>
                                    <li>Small daypack</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 bg-dark text-white">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold">Need a custom checklist?</h2>
                        <p class="text-white-50">We can tailor your packing list to your exact safari, season, and travel style.</p>
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-light">Ask our team</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
