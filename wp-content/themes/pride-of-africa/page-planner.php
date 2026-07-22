<?php
/**
 * Template Name: Trip Planner Page
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <section class="container-site">
        <div class="row g-5 align-items-start">
            <div class="col-lg-7">
                <p class="text-uppercase text-primary fw-semibold mb-2">Trip Planner</p>
                <h1 class="display-5 fw-bold mb-3">Let us shape a safari around your travel style</h1>
                <p class="lead text-muted">Tell us where you want to go, the pace you prefer, and the kind of experience you are dreaming of.</p>

                <form id="planner-form" class="row g-3 mt-4">
                    <div class="col-md-6">
                        <label class="form-label" for="planner-name">Name</label>
                        <input type="text" id="planner-name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="planner-email">Email</label>
                        <input type="email" id="planner-email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="planner-destination">Destination</label>
                        <input type="text" id="planner-destination" class="form-control" placeholder="Kenya, Tanzania, Uganda...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="planner-travelers">Travelers</label>
                        <input type="number" id="planner-travelers" class="form-control" min="1" max="20" value="2">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="planner-dream">Your dream safari</label>
                        <textarea id="planner-dream" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Send My Planner Request</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold mb-3">What we’ll help you decide</h2>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Best country or region for your dates</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Ideal safari style, pace, and comfort level</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Estimated cost range and ideal trip length</li>
                            <li><i class="bi bi-check-circle-fill text-primary me-2"></i>Custom activities, transfers, and upgrade options</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
