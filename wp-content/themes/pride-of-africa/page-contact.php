<?php
/**
 * Template Name: Contact Page
 *
 * @package Pride_Of_Africa
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="py-5">
        <div class="container-site">
            <div class="row g-5 align-items-start">
                <div class="col-lg-7">
                    <h1 class="mb-3">Start Planning Your African Adventure</h1>
                    <p class="lead">Share your travel goals and our team will help you create a thoughtful itinerary.</p>
                    <form id="contact-form" class="row g-3 mt-4">
                        <div class="col-md-6">
                            <label class="form-label" for="contact-name">Name</label>
                            <input type="text" id="contact-name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="contact-email">Email</label>
                            <input type="email" id="contact-email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="contact-destination">Destination</label>
                            <input type="text" id="contact-destination" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="contact-travel_type">Travel Type</label>
                            <input type="text" id="contact-travel_type" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="contact-message">Message</label>
                            <textarea id="contact-message" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Send Inquiry</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="h5">Contact Details</h2>
                            <p><strong>Email:</strong> info@prideofafricaadventures.com</p>
                            <p><strong>Phone:</strong> +254 704 559 568</p>
                            <p><strong>Address:</strong> Josem Trust House, 3rd Floor, Masaba Road</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
