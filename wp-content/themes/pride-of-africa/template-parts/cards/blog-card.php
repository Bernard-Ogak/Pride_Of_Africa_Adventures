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
$category  = get_the_category();
$cat_name  = ! empty( $category ) ? $category[0]->name : '';
$cat_link  = ! empty( $category ) ? get_category_link( $category[0]->term_id ) : '';
$read_time = max( 1, (int) ceil( str_word_count( get_the_content() ) / 200 ) );
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
        <div class="c-blog-card__meta">
            <?php if ( $cat_name ) : ?>
            <a class="c-badge c-badge--accent c-blog-card__cat" href="<?php echo esc_url( $cat_link ); ?>">
                <?php echo esc_html( $cat_name ); ?>
            </a>
            <?php endif; ?>
            <time class="c-blog-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                <?php echo esc_html( get_the_date() ); ?>
            </time>
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
