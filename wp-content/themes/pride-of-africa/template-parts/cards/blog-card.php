<?php
/**
 * Card: Blog Post
 * File:   template-parts/cards/blog-card.php
 * Spec:   03-Master-UI-Specification-v3.md §15
 *         Card Height: 480px | Image Height: 280px
 * @package PrideOfAfrica
 */

$post_id   = get_the_ID();
$img_id    = get_post_thumbnail_id();
$img_url   = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
$topics    = get_the_terms( $post_id, 'pride_blog_topic' );
$topic     = ( $topics && ! is_wp_error( $topics ) ) ? $topics[0] : null;
$destinations = get_the_terms( $post_id, 'pride_blog_destination' );
$destination  = ( $destinations && ! is_wp_error( $destinations ) ) ? $destinations[0] : null;
$read_time = pride_of_africa_reading_time( $post_id );
?>

<article class="c-blog-card" aria-label="<?php echo esc_attr( get_the_title() ); ?>">

    <a class="c-blog-card__image-link" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
        <div class="c-blog-card__image-wrap">
            <?php if ( $img_url ) : ?>
            <img class="c-blog-card__image"
                 src="<?php echo esc_url( $img_url ); ?>"
                 alt="<?php echo esc_attr( get_the_title() ); ?>"
                 loading="lazy" decoding="async">
            <?php endif; ?>
        </div>
    </a>

    <div class="c-blog-card__body">
        <div class="c-blog-card__badges">
            <?php if ( $topic ) : ?>
            <a class="c-badge c-badge--accent c-blog-card__cat" href="<?php echo esc_url( get_term_link( $topic ) ); ?>">
                <?php echo esc_html( $topic->name ); ?>
            </a>
            <?php endif; ?>
            <?php if ( $destination ) : ?>
            <a class="c-badge c-badge--country" href="<?php echo esc_url( get_term_link( $destination ) ); ?>">
                <i class="bi bi-geo-alt" aria-hidden="true"></i> <?php echo esc_html( $destination->name ); ?>
            </a>
            <?php endif; ?>
        </div>

        <div class="c-blog-card__meta">
            <time class="c-blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                <?php echo esc_html( get_the_date() ); ?>
            </time>
            <span class="c-blog-card__author"><?php the_author(); ?></span>
            <span class="c-blog-card__read-time">
                <?php echo esc_html( sprintf( __( '%d min read', 'pride-of-africa' ), $read_time ) ); ?>
            </span>
        </div>

        <h3 class="c-blog-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p class="c-blog-card__excerpt">
            <?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '…' ) ); ?>
        </p>

        <a href="<?php the_permalink(); ?>" class="c-blog-card__more"
           aria-label="<?php echo esc_attr( sprintf( __( 'Read more: %s', 'pride-of-africa' ), get_the_title() ) ); ?>">
            <?php esc_html_e( 'Read Article', 'pride-of-africa' ); ?>
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </a>
    </div>

</article>
