<?php
/**
 * Template Part: Why Choose Us / Trust Section
 *
 * File:   template-parts/home/trust.php
 * Spec:   03-Master-UI-Specification-v3.md §6
 *         Section Width: 1240px | Heading Width: 540px
 *         Feature Grid: 4 Columns | Card Gap: 32px
 *         Icon: 56px | Card Padding: 32px
 *
 * @package PrideOfAfrica
 */

$features = [
    [
        'icon'  => 'bi-shield-check',
        'title' => __( 'Expert Local Guides', 'pride-of-africa' ),
        'desc'  => __( 'Our guides are born and raised in Africa with decades of wildlife knowledge and unmatched passion for the continent.', 'pride-of-africa' ),
    ],
    [
        'icon'  => 'bi-award',
        'title' => __( 'Luxury Guaranteed', 'pride-of-africa' ),
        'desc'  => __( 'From tented camps to five-star lodges, every property is hand-picked and personally inspected by our team.', 'pride-of-africa' ),
    ],
    [
        'icon'  => 'bi-headset',
        'title' => __( '24 / 7 Support', 'pride-of-africa' ),
        'desc'  => __( 'Our dedicated support team is available around the clock before, during, and after your safari adventure.', 'pride-of-africa' ),
    ],
    [
        'icon'  => 'bi-globe2',
        'title' => __( '15+ Destinations', 'pride-of-africa' ),
        'desc'  => __( 'From the Masai Mara to the Okavango Delta — we cover every iconic wildlife destination across the continent.', 'pride-of-africa' ),
    ],
];
?>

<section class="c-trust l-section" id="why-choose-us" aria-labelledby="trust-heading">
    <div class="u-container">

        <div class="c-trust__header">
            <span class="c-badge c-badge--accent"><?php esc_html_e( 'Why Choose Us', 'pride-of-africa' ); ?></span>
            <h2 class="c-trust__heading" id="trust-heading">
                <?php esc_html_e( 'Africa\'s Most Trusted Safari Operator', 'pride-of-africa' ); ?>
            </h2>
            <p class="c-trust__subheading">
                <?php esc_html_e( 'With over 20 years of experience and thousands of satisfied travellers, Pride of Africa delivers unforgettable journeys.', 'pride-of-africa' ); ?>
            </p>
        </div>

        <div class="c-trust__grid" role="list">
            <?php foreach ( $features as $feature ) : ?>
            <div class="c-trust__card" role="listitem">
                <div class="c-trust__icon-wrap" aria-hidden="true">
                    <i class="bi <?php echo esc_attr( $feature['icon'] ); ?>"></i>
                </div>
                <h3 class="c-trust__card-title"><?php echo esc_html( $feature['title'] ); ?></h3>
                <p class="c-trust__card-desc"><?php echo esc_html( $feature['desc'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
