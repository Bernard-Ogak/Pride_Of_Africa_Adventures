<?php
/**
 * Template Part: Plan Your Dream Trip
 *
 * File:   template-parts/home/dream-trip.php
 * Rebuilt to match the "Plan Your Dream Trip" reference screenshot:
 * a single centered dark card with one large "describe your adventure"
 * textarea followed by a Travel Dates / Travelers / Destination row.
 *
 * @package Pride_Of_Africa
 */

// Reuse the same destination source as the hero trip-planner bar.
$destinations = get_posts( [
    'post_type'      => 'pride_destination',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'title',
    'order'          => 'ASC',
    'fields'         => 'ids',
] );
?>

<section class="c-dream-trip l-section" id="dream-trip" aria-labelledby="dream-trip-heading">
    <div class="c-dream-trip__bg" aria-hidden="true"></div>

    <div class="u-container">
        <div class="c-section-header c-section-header--light">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Dream Trip Planner', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="dream-trip-heading">
                <?php esc_html_e( 'Plan Your Dream Trip', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-section-header__desc">
                <?php esc_html_e( 'Tell us exactly the kind of adventure you\'re dreaming of. We\'ll craft a personalised itinerary just for you.', 'pride-of-africa' ); ?>
            </p>
        </div>

        <div class="c-dream-trip__card">
            <form
                id="dream-trip-form"
                class="c-form"
                novalidate
                data-dream-form
            >
                <div class="c-form__group">
                    <label class="c-form__label" for="dream-message">
                        <?php esc_html_e( 'Describe Your Ideal Adventure', 'pride-of-africa' ); ?> <span aria-hidden="true">*</span>
                    </label>
                    <textarea
                        class="c-form__textarea c-dream-trip__textarea"
                        id="dream-message"
                        name="message"
                        rows="4"
                        required
                        aria-required="true"
                        placeholder="<?php esc_attr_e( 'e.g. I want a 10-day luxury safari in Kenya and Tanzania with my partner, focusing on wildlife photography and ending with a beach holiday in Zanzibar. Budget around $5,000 per person…', 'pride-of-africa' ); ?>"
                    ></textarea>
                </div>

                <div class="c-form__row c-form__row--triple">
                    <div class="c-form__group">
                        <label class="c-form__label" for="dream-travel-dates">
                            <?php esc_html_e( 'Travel Dates', 'pride-of-africa' ); ?>
                        </label>
                        <input
                            class="c-form__input"
                            type="date"
                            id="dream-travel-dates"
                            name="travel_dates"
                            autocomplete="off"
                        >
                    </div>
                    <div class="c-form__group">
                        <label class="c-form__label" for="dream-travelers">
                            <?php esc_html_e( 'Travelers', 'pride-of-africa' ); ?>
                        </label>
                        <input
                            class="c-form__input"
                            type="number"
                            id="dream-travelers"
                            name="travelers"
                            min="1"
                            max="50"
                            placeholder="<?php esc_attr_e( 'e.g. 2', 'pride-of-africa' ); ?>"
                        >
                    </div>
                    <div class="c-form__group">
                        <label class="c-form__label" for="dream-destination">
                            <?php esc_html_e( 'Destination', 'pride-of-africa' ); ?>
                        </label>
                        <select class="c-form__select" id="dream-destination" name="destination">
                            <option value=""><?php esc_html_e( 'Any destination', 'pride-of-africa' ); ?></option>
                            <?php foreach ( $destinations as $dest_id ) : ?>
                            <option value="<?php echo esc_attr( get_post_field( 'post_name', $dest_id ) ); ?>">
                                <?php echo esc_html( get_the_title( $dest_id ) ); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button
                    class="c-button c-button--primary c-dream-trip__submit"
                    type="submit"
                    data-dream-submit
                >
                    <i class="bi bi-compass" aria-hidden="true"></i>
                    <?php esc_html_e( 'Send My Dream Trip', 'pride-of-africa' ); ?>
                </button>
            </form>
        </div>
    </div>
</section>
