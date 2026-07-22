<?php
/**
 * Trip Architect Form Template Part
 *
 * Horizontal single-row planning bar positioned between the hero slider
 * and the Why Choose Us section. Fields: Destination, Travel Type,
 * Duration, Travel Date, Travelers, Email, Phone + Plan My Trip button.
 *
 * @package Pride_Of_Africa
 * @subpackage Templates
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_enabled = get_theme_mod( 'pride_trip_architect_enabled', true );
if ( ! $section_enabled ) {
    return;
}

$section_title       = get_theme_mod( 'pride_trip_architect_title', esc_html__( 'Plan Your Perfect African Safari', 'pride-of-africa' ) );
$section_subtitle    = get_theme_mod( 'pride_trip_architect_subtitle', esc_html__( 'Tell us your safari dreams and let our expert team curate the perfect itinerary.', 'pride-of-africa' ) );
$form_title          = get_theme_mod( 'pride_trip_architect_form_title', esc_html__( 'Quick Safari Inquiry', 'pride-of-africa' ) );
$form_description    = get_theme_mod( 'pride_trip_architect_form_description', esc_html__( 'Share your travel preferences and we\'ll create a customized safari experience.', 'pride-of-africa' ) );
$form_cta_text       = get_theme_mod( 'pride_trip_architect_form_cta', esc_html__( 'Get Your Free Proposal', 'pride-of-africa' ) );
?>

<section class="trip-planner-bar" id="trip-architect" aria-label="<?php echo esc_attr( $section_title ); ?>">
    <div class="trip-planner-bar__inner">
        <h2 class="sr-only"><?php echo esc_html( $section_title ); ?></h2>
        <p class="sr-only"><?php echo esc_html( $section_subtitle ); ?></p>
        <p id="tpb-form-description" class="sr-only"><?php echo esc_html( $form_description ); ?></p>
        <form class="trip-planner-bar__form" method="POST" novalidate aria-label="<?php echo esc_attr( $form_title ); ?>" aria-describedby="tpb-form-description">
            <?php wp_nonce_field( 'trip_architect_inquiry', 'trip_architect_nonce' ); ?>

            <!-- Destination -->
            <div class="tpb-field">
                <label class="tpb-label" for="tpb_destination">
                    <?php esc_html_e( 'DESTINATION', 'pride-of-africa' ); ?>
                </label>
                <select class="tpb-select" id="tpb_destination" name="destination">
                    <option value=""><?php esc_html_e( 'Select', 'pride-of-africa' ); ?></option>
                    <option value="kenya"><?php esc_html_e( 'Kenya', 'pride-of-africa' ); ?></option>
                    <option value="tanzania"><?php esc_html_e( 'Tanzania', 'pride-of-africa' ); ?></option>
                    <option value="south-africa"><?php esc_html_e( 'South Africa', 'pride-of-africa' ); ?></option>
                    <option value="botswana"><?php esc_html_e( 'Botswana', 'pride-of-africa' ); ?></option>
                    <option value="zimbabwe"><?php esc_html_e( 'Zimbabwe', 'pride-of-africa' ); ?></option>
                    <option value="zambia"><?php esc_html_e( 'Zambia', 'pride-of-africa' ); ?></option>
                    <option value="rwanda"><?php esc_html_e( 'Rwanda', 'pride-of-africa' ); ?></option>
                    <option value="uganda"><?php esc_html_e( 'Uganda', 'pride-of-africa' ); ?></option>
                    <option value="namibia"><?php esc_html_e( 'Namibia', 'pride-of-africa' ); ?></option>
                    <option value="multi"><?php esc_html_e( 'Multi-Country', 'pride-of-africa' ); ?></option>
                </select>
            </div>

            <div class="tpb-divider" aria-hidden="true"></div>

            <!-- Travel Type -->
            <div class="tpb-field">
                <label class="tpb-label" for="tpb_travel_type">
                    <?php esc_html_e( 'TRAVEL TYPE', 'pride-of-africa' ); ?>
                </label>
                <select class="tpb-select" id="tpb_travel_type" name="travel_type">
                    <option value=""><?php esc_html_e( 'Select', 'pride-of-africa' ); ?></option>
                    <option value="safari"><?php esc_html_e( 'Safari', 'pride-of-africa' ); ?></option>
                    <option value="beach"><?php esc_html_e( 'Beach & Safari', 'pride-of-africa' ); ?></option>
                    <option value="gorilla"><?php esc_html_e( 'Gorilla Trekking', 'pride-of-africa' ); ?></option>
                    <option value="honeymoon"><?php esc_html_e( 'Honeymoon', 'pride-of-africa' ); ?></option>
                    <option value="family"><?php esc_html_e( 'Family Safari', 'pride-of-africa' ); ?></option>
                    <option value="luxury"><?php esc_html_e( 'Luxury Safari', 'pride-of-africa' ); ?></option>
                    <option value="budget"><?php esc_html_e( 'Budget Safari', 'pride-of-africa' ); ?></option>
                    <option value="walking"><?php esc_html_e( 'Walking Safari', 'pride-of-africa' ); ?></option>
                </select>
            </div>

            <div class="tpb-divider" aria-hidden="true"></div>

            <!-- Duration -->
            <div class="tpb-field">
                <label class="tpb-label" for="tpb_duration">
                    <?php esc_html_e( 'DURATION', 'pride-of-africa' ); ?>
                </label>
                <select class="tpb-select" id="tpb_duration" name="duration">
                    <option value=""><?php esc_html_e( 'Select', 'pride-of-africa' ); ?></option>
                    <option value="3-5"><?php esc_html_e( '3–5 Days', 'pride-of-africa' ); ?></option>
                    <option value="6-8"><?php esc_html_e( '6–8 Days', 'pride-of-africa' ); ?></option>
                    <option value="9-12"><?php esc_html_e( '9–12 Days', 'pride-of-africa' ); ?></option>
                    <option value="13-16"><?php esc_html_e( '13–16 Days', 'pride-of-africa' ); ?></option>
                    <option value="17+"><?php esc_html_e( '17+ Days', 'pride-of-africa' ); ?></option>
                </select>
            </div>

            <div class="tpb-divider" aria-hidden="true"></div>

            <!-- Travel Date -->
            <div class="tpb-field">
                <label class="tpb-label" for="tpb_travel_date">
                    <?php esc_html_e( 'TRAVEL DATE', 'pride-of-africa' ); ?>
                </label>
                <input
                    type="date"
                    class="tpb-input"
                    id="tpb_travel_date"
                    name="travel_date"
                    aria-label="<?php esc_attr_e( 'Travel date', 'pride-of-africa' ); ?>"
                >
            </div>

            <div class="tpb-divider" aria-hidden="true"></div>

            <!-- Travelers -->
            <div class="tpb-field tpb-field--short">
                <label class="tpb-label" for="tpb_travelers">
                    <?php esc_html_e( 'TRAVELERS', 'pride-of-africa' ); ?>
                </label>
                <input
                    type="number"
                    class="tpb-input"
                    id="tpb_travelers"
                    name="travelers"
                    min="1"
                    max="50"
                    placeholder="2"
                    aria-label="<?php esc_attr_e( 'Number of travelers', 'pride-of-africa' ); ?>"
                >
            </div>

            <div class="tpb-divider" aria-hidden="true"></div>

            <!-- Email -->
            <div class="tpb-field">
                <label class="tpb-label" for="tpb_email">
                    <?php esc_html_e( 'EMAIL', 'pride-of-africa' ); ?>
                </label>
                <input
                    type="email"
                    class="tpb-input"
                    id="tpb_email"
                    name="email"
                    placeholder="<?php esc_attr_e( 'email', 'pride-of-africa' ); ?>"
                    aria-label="<?php esc_attr_e( 'Email address', 'pride-of-africa' ); ?>"
                >
            </div>

            <div class="tpb-divider" aria-hidden="true"></div>

            <!-- Phone -->
            <div class="tpb-field">
                <label class="tpb-label" for="tpb_phone">
                    <?php esc_html_e( 'PHONE', 'pride-of-africa' ); ?>
                </label>
                <input
                    type="tel"
                    class="tpb-input"
                    id="tpb_phone"
                    name="phone"
                    placeholder="<?php esc_attr_e( '+1...', 'pride-of-africa' ); ?>"
                    aria-label="<?php esc_attr_e( 'Phone number', 'pride-of-africa' ); ?>"
                >
            </div>

            <!-- Submit -->
            <div class="tpb-submit">
                <button type="submit" class="tpb-btn">
                    <svg class="tpb-btn__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <?php echo esc_html( $form_cta_text ); ?>
                </button>
            </div>

        </form>
    </div>
</section>
