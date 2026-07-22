<?php
/**
 * Planner / dream trip section template part.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="planner-section py-5 bg-dark text-white" id="planner">
    <div class="container-site">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="eyebrow mb-2">TRIP PLANNER</div>
                <h2 class="section-title text-white">Let Us Design Your Perfect Journey</h2>
                <p class="section-description text-white-50">Tell us your dream safari and we will shape a tailored itinerary around your preferred experiences, timing, and travel style.</p>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form id="planner-form" class="row g-3">
                            <div class="col-12">
                                <label class="form-label" for="planner-dream">Your dream safari</label>
                                <textarea id="planner-dream" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="planner-date">Travel date</label>
                                <input type="date" id="planner-date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="planner-travelers">Travelers</label>
                                <input type="number" id="planner-travelers" class="form-control" min="1" max="20" value="2">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Send My Dream Trip</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
