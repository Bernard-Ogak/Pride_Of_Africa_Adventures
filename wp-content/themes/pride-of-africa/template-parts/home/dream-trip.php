<?php
/**
 * Template Part: Plan Your Dream Trip
 *
 * File:   template-parts/home/dream-trip.php
 * Spec:   03-Master-UI-Specification-v3.md §11
 *         Background: Full Width dark | Content Width: 680px
 *         Form Width: 560px | Padding: 48px
 *
 * Source: ADAPTED — reads the theme's existing contact-info Customizer
 *         settings instead of the new/unset "poa_*" mods the original
 *         template expected. See also: the form-submission note below.
 *
 * @package PrideOfAfrica
 */

$whatsapp = function_exists( 'pride_get_whatsapp' ) ? pride_get_whatsapp() : get_theme_mod( 'pride_whatsapp', '' );
$phone    = function_exists( 'pride_get_phone_1' )  ? pride_get_phone_1()  : get_theme_mod( 'pride_phone_1', '' );
$email    = function_exists( 'pride_get_email' )    ? pride_get_email()    : get_theme_mod( 'pride_email', '' );
?>

<section class="c-dream-trip l-section" id="dream-trip" aria-labelledby="dream-trip-heading">
    <div class="c-dream-trip__bg" aria-hidden="true"></div>

    <div class="u-container">
        <div class="c-dream-trip__inner">

            <div class="c-dream-trip__content">
                <span class="c-badge c-badge--light"><?php esc_html_e( 'Let\'s Plan Together', 'pride-of-africa' ); ?></span>
                <h2 class="c-dream-trip__heading" id="dream-trip-heading">
                    <?php esc_html_e( 'Plan Your Dream Safari', 'pride-of-africa' ); ?>
                </h2>
                <p class="c-dream-trip__desc">
                    <?php esc_html_e( 'Tell us your travel dates, destinations, and budget. Our safari specialists will craft a bespoke itinerary just for you — completely free.', 'pride-of-africa' ); ?>
                </p>

                <ul class="c-dream-trip__features" aria-label="<?php esc_attr_e( 'What we offer', 'pride-of-africa' ); ?>">
                    <?php
                    $features = [
                        [ 'bi-check-circle', __( 'Free personalised itinerary', 'pride-of-africa' ) ],
                        [ 'bi-check-circle', __( 'No obligation consultation',  'pride-of-africa' ) ],
                        [ 'bi-check-circle', __( 'Response within 24 hours',    'pride-of-africa' ) ],
                        [ 'bi-check-circle', __( 'Expert local knowledge',      'pride-of-africa' ) ],
                    ];
                    foreach ( $features as $f ) : ?>
                    <li>
                        <i class="bi <?php echo esc_attr( $f[0] ); ?>" aria-hidden="true"></i>
                        <?php echo esc_html( $f[1] ); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <div class="c-dream-trip__contacts">
                    <?php if ( $whatsapp ) : ?>
                    <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D/', '', $whatsapp ) ); ?>"
                       class="c-button c-button--whatsapp" target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-whatsapp" aria-hidden="true"></i>
                        <?php esc_html_e( 'WhatsApp Us', 'pride-of-africa' ); ?>
                    </a>
                    <?php endif; ?>
                    <?php if ( $phone ) : ?>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/\D/', '', $phone ) ); ?>"
                       class="c-button c-button--secondary c-button--light">
                        <i class="bi bi-telephone" aria-hidden="true"></i>
                        <?php echo esc_html( $phone ); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div><!-- /.c-dream-trip__content -->

            <div class="c-dream-trip__form-wrap">
                <div class="c-dream-trip__form-card">
                    <h3 class="c-dream-trip__form-title">
                        <?php esc_html_e( 'Start Planning', 'pride-of-africa' ); ?>
                    </h3>

                    <form
                        id="dream-trip-form"
                        class="c-form c-dream-trip__form"
                        novalidate
                        data-dream-form
                    >

                        <div class="c-form__row">
                            <div class="c-form__group">
                                <label class="c-form__label" for="dream-name">
                                    <?php esc_html_e( 'Full Name', 'pride-of-africa' ); ?> <span aria-hidden="true">*</span>
                                </label>
                                <input
                                    class="c-form__input"
                                    type="text"
                                    id="dream-name"
                                    name="full_name"
                                    placeholder="<?php esc_attr_e( 'Jane Smith', 'pride-of-africa' ); ?>"
                                    required
                                    autocomplete="name"
                                    aria-required="true"
                                >
                            </div>
                            <div class="c-form__group">
                                <label class="c-form__label" for="dream-email">
                                    <?php esc_html_e( 'Email Address', 'pride-of-africa' ); ?> <span aria-hidden="true">*</span>
                                </label>
                                <input
                                    class="c-form__input"
                                    type="email"
                                    id="dream-email"
                                    name="email"
                                    placeholder="<?php esc_attr_e( 'jane@example.com', 'pride-of-africa' ); ?>"
                                    required
                                    autocomplete="email"
                                    aria-required="true"
                                >
                            </div>
                        </div>

                        <div class="c-form__row">
                            <div class="c-form__group">
                                <label class="c-form__label" for="dream-destination">
                                    <?php esc_html_e( 'Preferred Destination', 'pride-of-africa' ); ?>
                                </label>
                                <input
                                    class="c-form__input"
                                    type="text"
                                    id="dream-destination"
                                    name="destination"
                                    placeholder="<?php esc_attr_e( 'e.g. Kenya, Tanzania…', 'pride-of-africa' ); ?>"
                                >
                            </div>
                            <div class="c-form__group">
                                <label class="c-form__label" for="dream-travelers">
                                    <?php esc_html_e( 'Number of Travelers', 'pride-of-africa' ); ?>
                                </label>
                                <input
                                    class="c-form__input"
                                    type="number"
                                    id="dream-travelers"
                                    name="travelers"
                                    min="1"
                                    max="50"
                                    placeholder="2"
                                >
                            </div>
                        </div>

                        <div class="c-form__group">
                            <label class="c-form__label" for="dream-message">
                                <?php esc_html_e( 'Tell Us About Your Dream Safari', 'pride-of-africa' ); ?>
                            </label>
                            <textarea
                                class="c-form__textarea"
                                id="dream-message"
                                name="message"
                                rows="4"
                                placeholder="<?php esc_attr_e( 'Dates, budget, special requests…', 'pride-of-africa' ); ?>"
                            ></textarea>
                        </div>

                        <button
                            class="c-button c-button--primary c-form__submit"
                            type="submit"
                            data-dream-submit
                        >
                            <i class="bi bi-send" aria-hidden="true"></i>
                            <?php esc_html_e( 'Send My Inquiry', 'pride-of-africa' ); ?>
                        </button>

                        <p class="c-form__privacy">
                            <?php esc_html_e( 'We respect your privacy. No spam, ever.', 'pride-of-africa' ); ?>
                        </p>

                    </form>
                </div>
            </div><!-- /.c-dream-trip__form-wrap -->

        </div>
    </div>
</section>
