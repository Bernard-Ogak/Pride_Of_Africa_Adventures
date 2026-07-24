<?php
/**
 * Template Name: Contact Page
 * File:   page-contact.php
 *
 * Rebuilt to match the reference design: dark hero, inquiry form +
 * contact details / WhatsApp CTA / office-hours card, a map embed, and
 * a "How It Works" step row. Reuses the shared .c-form styles already
 * used by the homepage Dream Trip form, and the existing
 * pride_submit_inquiry AJAX handler (extended here to also capture
 * phone and travel date).
 *
 * @package Pride_Of_Africa
 */

get_header();

$destinations = get_posts([
    'post_type' => 'pride_destination', 'posts_per_page' => -1,
    'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC',
]);

$address_query = rawurlencode(function_exists('pride_get_address') ? pride_get_address() : 'Nairobi, Kenya');
$whatsapp_digits = preg_replace('/\D/', '', function_exists('pride_get_whatsapp') ? pride_get_whatsapp() : '');

$steps = [
    ['icon' => 'bi-clipboard-check', 'label' => __('Step 1', 'pride-of-africa'), 'title' => __('Submit Inquiry', 'pride-of-africa')],
    ['icon' => 'bi-file-earmark-text', 'label' => __('Step 2', 'pride-of-africa'), 'title' => __('Receive Proposal', 'pride-of-africa')],
    ['icon' => 'bi-gear', 'label' => __('Step 3', 'pride-of-africa'), 'title' => __('Customize Itinerary', 'pride-of-africa')],
    ['icon' => 'bi-ticket-perforated', 'label' => __('Step 4', 'pride-of-africa'), 'title' => __('Confirm Booking', 'pride-of-africa')],
    ['icon' => 'bi-emoji-smile', 'label' => __('Step 5', 'pride-of-africa'), 'title' => __('Enjoy Your Safari', 'pride-of-africa')],
];
?>

<main id="primary">

<!-- Hero -->
<section class="c-contact-hero">
    <div class="u-container">
        <span class="c-badge c-badge--accent"><?php esc_html_e('Contact Us', 'pride-of-africa'); ?></span>
        <h1 class="c-contact-hero__title"><?php esc_html_e('Start Planning Your African Adventure', 'pride-of-africa'); ?></h1>
        <p class="c-contact-hero__subtitle"><?php esc_html_e('Get in touch with our safari experts. We respond to every inquiry within 24 hours.', 'pride-of-africa'); ?></p>
    </div>
</section>

<!-- Form + Contact Details -->
<section class="c-contact-section l-section">
    <div class="u-container">
        <div class="c-contact__layout">

            <div class="c-contact__form-col">
                <form id="contact-form" class="c-form" novalidate data-contact-form>
                    <div class="c-form__row">
                        <div class="c-form__group">
                            <label class="c-form__label" for="contact-name"><?php esc_html_e('Full Name', 'pride-of-africa'); ?> <span aria-hidden="true">*</span></label>
                            <input class="c-form__input" type="text" id="contact-name" name="name" required aria-required="true">
                        </div>
                        <div class="c-form__group">
                            <label class="c-form__label" for="contact-email"><?php esc_html_e('Email', 'pride-of-africa'); ?> <span aria-hidden="true">*</span></label>
                            <input class="c-form__input" type="email" id="contact-email" name="email" required aria-required="true">
                        </div>
                    </div>
                    <div class="c-form__row">
                        <div class="c-form__group">
                            <label class="c-form__label" for="contact-phone"><?php esc_html_e('Phone', 'pride-of-africa'); ?></label>
                            <input class="c-form__input" type="tel" id="contact-phone" name="phone" autocomplete="tel">
                        </div>
                        <div class="c-form__group">
                            <label class="c-form__label" for="contact-destination"><?php esc_html_e('Destination', 'pride-of-africa'); ?></label>
                            <select class="c-form__select" id="contact-destination" name="destination">
                                <option value=""><?php esc_html_e('Select', 'pride-of-africa'); ?></option>
                                <?php foreach ($destinations as $dest) : ?>
                                <option value="<?php echo esc_attr($dest->post_title); ?>"><?php echo esc_html($dest->post_title); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="c-form__row">
                        <div class="c-form__group">
                            <label class="c-form__label" for="contact-travel-date"><?php esc_html_e('Travel Date', 'pride-of-africa'); ?></label>
                            <input class="c-form__input" type="date" id="contact-travel-date" name="travel_date" autocomplete="off">
                        </div>
                        <div class="c-form__group">
                            <label class="c-form__label" for="contact-travel-type"><?php esc_html_e('Travel Type', 'pride-of-africa'); ?></label>
                            <select class="c-form__select" id="contact-travel-type" name="travel_type">
                                <option value=""><?php esc_html_e('Select', 'pride-of-africa'); ?></option>
                                <option value="Safari"><?php esc_html_e('Safari', 'pride-of-africa'); ?></option>
                                <option value="Beach"><?php esc_html_e('Beach', 'pride-of-africa'); ?></option>
                                <option value="Honeymoon"><?php esc_html_e('Honeymoon', 'pride-of-africa'); ?></option>
                                <option value="Family"><?php esc_html_e('Family', 'pride-of-africa'); ?></option>
                                <option value="Group"><?php esc_html_e('Group', 'pride-of-africa'); ?></option>
                                <option value="Trekking"><?php esc_html_e('Trekking', 'pride-of-africa'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="c-form__group">
                        <label class="c-form__label" for="contact-message"><?php esc_html_e('Message', 'pride-of-africa'); ?> <span aria-hidden="true">*</span></label>
                        <textarea class="c-form__textarea" id="contact-message" name="message" rows="5" required aria-required="true"></textarea>
                    </div>
                    <p class="c-form__error" id="contact-form-error" role="alert" hidden></p>
                    <div class="c-contact-form__submit-row">
                        <button type="submit" class="c-button c-button--primary" data-contact-submit>
                            <i class="bi bi-send" aria-hidden="true"></i>
                            <?php esc_html_e('Plan My Trip', 'pride-of-africa'); ?>
                        </button>
                    </div>
                </form>
            </div>

            <div class="c-contact__details-col">
                <div class="c-contact-card">
                    <h2 class="c-contact-card__title"><?php esc_html_e('Contact Details', 'pride-of-africa'); ?></h2>
                    <ul class="c-contact-card__list">
                        <li><i class="bi bi-telephone-fill" aria-hidden="true"></i> <a href="tel:<?php echo esc_attr(preg_replace('/\D/', '', pride_get_phone_1())); ?>"><?php echo pride_get_phone_1(); ?></a></li>
                        <li class="c-contact-card__list-secondary"><a href="tel:<?php echo esc_attr(preg_replace('/\D/', '', pride_get_phone_2())); ?>"><?php echo pride_get_phone_2(); ?></a></li>
                        <li><i class="bi bi-envelope-fill" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr(antispambot(pride_get_email())); ?>"><?php echo antispambot(pride_get_email()); ?></a></li>
                        <li><i class="bi bi-geo-alt-fill" aria-hidden="true"></i> <span><?php echo pride_get_address(); ?></span></li>
                    </ul>

                    <?php if ($whatsapp_digits) : ?>
                    <a href="https://wa.me/<?php echo esc_attr($whatsapp_digits); ?>" target="_blank" rel="noopener noreferrer" class="c-button c-button--primary c-contact-card__whatsapp">
                        <i class="bi bi-chat-dots-fill" aria-hidden="true"></i>
                        <?php esc_html_e('Speak to a Safari Expert', 'pride-of-africa'); ?>
                    </a>
                    <?php endif; ?>

                    <div class="c-contact-card__hours">
                        <h3><?php esc_html_e('Office Hours', 'pride-of-africa'); ?></h3>
                        <p><i class="bi bi-clock-history" aria-hidden="true"></i> <?php esc_html_e("We're available 24/7 — every day of the year.", 'pride-of-africa'); ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Map (intentionally full-bleed — no .u-container wrapper) -->
<section class="c-contact-section l-section--compact">
    <div class="c-contact-map">
        <iframe
            src="https://www.google.com/maps?q=<?php echo esc_attr($address_query); ?>&output=embed"
            width="100%" height="380" style="border:0;" allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="<?php esc_attr_e('Map to our office', 'pride-of-africa'); ?>">
        </iframe>
    </div>
</section>

<!-- How It Works -->
<section class="c-contact-section l-section l-section--alt">
    <div class="u-container">
        <div class="c-section-header">
            <h2 class="c-section-header__title"><?php esc_html_e('How It Works', 'pride-of-africa'); ?></h2>
        </div>
        <div class="c-contact-steps">
            <?php foreach ($steps as $step) : ?>
            <div class="c-contact-step">
                <div class="c-contact-step__icon"><i class="bi <?php echo esc_attr($step['icon']); ?>" aria-hidden="true"></i></div>
                <span class="c-contact-step__label"><?php echo esc_html($step['label']); ?></span>
                <span class="c-contact-step__title"><?php echo esc_html($step['title']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

</main>

<script>
( function () {
    'use strict';
    var form = document.getElementById( 'contact-form' );
    if ( ! form ) return;

    var error = document.getElementById( 'contact-form-error' );
    var submitBtn = form.querySelector( '[data-contact-submit]' );

    form.addEventListener( 'submit', function ( e ) {
        e.preventDefault();
        error.hidden = true;
        submitBtn.disabled = true;

        var data = new FormData();
        data.append( 'action', 'pride_submit_inquiry' );
        data.append( 'nonce', window.prideOfAfricaData ? window.prideOfAfricaData.nonce : '' );
        data.append( 'name', form.name.value );
        data.append( 'email', form.email.value );
        data.append( 'phone', form.phone.value );
        data.append( 'destination', form.destination.value );
        data.append( 'travel_date', form.travel_date.value );
        data.append( 'travel_type', form.travel_type.value );
        data.append( 'message', form.message.value );

        fetch( window.prideOfAfricaData ? window.prideOfAfricaData.ajaxUrl : '/wp-admin/admin-ajax.php', {
            method: 'POST', body: data, credentials: 'same-origin',
        } )
            .then( function ( res ) { return res.json(); } )
            .then( function ( json ) {
                if ( json.success ) {
                    form.reset();
                    error.hidden = true;
                    alert( json.data && json.data.message ? json.data.message : 'Thank you! We will be in touch shortly.' );
                } else {
                    error.textContent = json.data && json.data.message ? json.data.message : 'Something went wrong. Please try again.';
                    error.hidden = false;
                }
            } )
            .catch( function () {
                error.textContent = 'Something went wrong. Please try again.';
                error.hidden = false;
            } )
            .finally( function () {
                submitBtn.disabled = false;
            } );
    } );
} )();
</script>

<?php get_footer(); ?>
