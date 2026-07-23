<?php
/**
 * Comments template
 * File:   comments.php
 *
 * Rebuilt for the new article layout. Previous version counted
 * comments site-wide (wp_count_comments()->total_comments) instead of
 * for the current post — fixed to use get_comments_number(), which is
 * scoped to the post in context.
 *
 * @package Pride_Of_Africa
 */

if (post_password_required()) {
    return;
}

$comment_count = get_comments_number();
?>

<div class="c-comments" id="comments">

    <h2 class="c-comments__title">
        <?php
        if ($comment_count > 0) {
            printf(esc_html(_n('%d Comment', '%d Comments', $comment_count, 'pride-of-africa')), $comment_count);
        } else {
            esc_html_e('Comments', 'pride-of-africa');
        }
        ?>
    </h2>

    <?php if ($comment_count > 0) : ?>

        <ol class="c-comments__list">
            <?php
            wp_list_comments([
                'callback' => 'pride_of_africa_comment_callback',
                'type'     => 'comment',
            ]);
            ?>
        </ol>

        <?php the_comments_pagination([
            'prev_text' => esc_html__('← Previous', 'pride-of-africa'),
            'next_text' => esc_html__('Next →', 'pride-of-africa'),
        ]); ?>

    <?php else : ?>

        <p class="c-comments__empty"><?php esc_html_e('No comments yet. Be the first to share your experience.', 'pride-of-africa'); ?></p>

    <?php endif; ?>

    <?php if (comments_open()) : ?>

        <div class="c-comments__form-wrap">
            <h3 class="c-comments__form-title"><?php esc_html_e('Leave a Comment', 'pride-of-africa'); ?></h3>
            <p class="c-comments__form-note"><?php esc_html_e('Your comment will appear after it has been reviewed by our team.', 'pride-of-africa'); ?></p>
            <?php
            comment_form([
                'class_form'   => 'c-comment-form',
                'class_submit' => 'c-button c-button--primary',
                'title_reply'  => '',
                'comment_field' => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'pride-of-africa') . '</label><textarea id="comment" name="comment" class="c-form__textarea" rows="6" required></textarea></p>',
            ]);
            ?>
        </div>

    <?php elseif ($comment_count) : ?>

        <p class="c-comments__closed"><?php esc_html_e('Comments are closed.', 'pride-of-africa'); ?></p>

    <?php endif; ?>

</div>
