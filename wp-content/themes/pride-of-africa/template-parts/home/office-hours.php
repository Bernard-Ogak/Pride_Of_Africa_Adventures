<?php
/**
 * Template Part: Office Hours & Contact
 * File:   template-parts/home/office-hours.php
 * Spec:   03-Master-UI-Specification-v3.md §16
 *         Columns: 2 | Gap: 64px
 *         Schedule Width: 420px | Contact Card: 380px
 * Source: ADAPTED — reads the theme's existing contact-info Customizer
 *         settings (pride_phone_1, pride_email, pride_whatsapp, pride_address)
 *         via their existing helper functions, instead of the new/unset
 *         "poa_*" mods the original template expected.
 *
 * @package PrideOfAfrica
 */

$phone     = function_exists( 'pride_get_phone_1' )  ? pride_get_phone_1()  : get_theme_mod( 'pride_phone_1', '' );
$email     = function_exists( 'pride_get_email' )    ? pride_get_email()    : get_theme_mod( 'pride_email', '' );
$whatsapp  = function_exists( 'pride_get_whatsapp' )  ? pride_get_whatsapp() : get_theme_mod( 'pride_whatsapp', '' );
$address   = function_exists( 'pride_get_address' )   ? pride_get_address()  : get_theme_mod( 'pride_address', '' );

$hours = [
    __( 'Monday – Friday',  'pride-of-africa' ) => __( '8:00 AM – 6:00 PM EAT', 'pride-of-africa' ),
    __( 'Saturday',         'pride-of-africa' ) => __( '9:00 AM – 4:00 PM EAT', 'pride-of-africa' ),
    __( 'Sunday',           'pride-of-africa' ) => __( 'By appointment only',    'pride-of-africa' ),
];
?>

<section class="c-office l-section l-section--alt" id="office-hours" aria-labelledby="office-heading">
    <div class="u-container">

        <div class="c-section-header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Get In Touch', 'pride-of-africa' ); ?></span>
            <h2 class="c-section-header__title" id="office-heading"><?php esc_html_e( 'Our Office Hours', 'pride-of-africa' ); ?></h2>
        </div>

        <div class="c-office__grid">

            <!-- Schedule -->
            <div class="c-office__schedule">
                <h3 class="c-office__sub-title">
                    <i class="bi bi-clock" aria-hidden="true"></i>
                    <?php esc_html_e( 'When We\'re Available', 'pride-of-africa' ); ?>
                </h3>
                <dl class="c-office__hours-list">
                    <?php foreach ( $hours as $day => $time ) : ?>
                    <div class="c-office__hours-row">
                        <dt class="c-office__day"><?php echo esc_html( $day ); ?></dt>
                        <dd class="c-office__time"><?php echo esc_html( $time ); ?></dd>
                    </div>
                    <?php endforeach; ?>
                </dl>
                <p class="c-office__timezone">
                    <i class="bi bi-globe2" aria-hidden="true"></i>
                    <?php esc_html_e( 'All times in East Africa Time (UTC+3).', 'pride-of-africa' ); ?>
                </p>
            </div>

            <!-- Contact Card -->
            <div class="c-office__contact-card">
                <h3 class="c-office__sub-title">
                    <i class="bi bi-headset" aria-hidden="true"></i>
                    <?php esc_html_e( 'Contact Us Directly', 'pride-of-africa' ); ?>
                </h3>

                <ul class="c-office__contact-list">
                    <?php if ( $phone ) : ?>
                    <li class="c-office__contact-item">
                        <i class="bi bi-telephone" aria-hidden="true"></i>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/\D/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if ( $email ) : ?>
                    <li class="c-office__contact-item">
                        <i class="bi bi-envelope" aria-hidden="true"></i>
                        <a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if ( $whatsapp ) : ?>
                    <li class="c-office__contact-item">
                        <i class="bi bi-whatsapp" aria-hidden="true"></i>
                        <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D/', '', $whatsapp ) ); ?>"
                           target="_blank" rel="noopener noreferrer"><?php echo esc_html( $whatsapp ); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if ( $address ) : ?>
                    <li class="c-office__contact-item c-office__contact-item--address">
                        <i class="bi bi-geo-alt" aria-hidden="true"></i>
                        <address><?php echo esc_html( $address ); ?></address>
                    </li>
                    <?php endif; ?>
                </ul>

                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="c-button c-button--primary">
                    <?php esc_html_e( 'Send Us A Message', 'pride-of-africa' ); ?>
                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

        </div>
    </div>
</section>
