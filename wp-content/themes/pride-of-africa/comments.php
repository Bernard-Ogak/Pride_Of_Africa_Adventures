<?php
/**
 * Comments template
 *
 * @package Pride_Of_Africa
 */

if (post_password_required()) {
    return;
}

// Count comments
$comment_count = wp_count_comments();
$total_comments = $comment_count->total_comments;
?>

<div class="container-site py-5 border-top">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">

            <?php if ($total_comments > 0) : ?>

                <h3 class="mb-4">
                    <?php
                    printf(
                        esc_html(_n('%d Comment', '%d Comments', $total_comments, 'pride-of-africa')),
                        $total_comments
                    );
                    ?>
                </h3>

                <ol class="list-unstyled mb-4">
                    <?php
                    wp_list_comments([
                        'callback' => 'pride_of_africa_comment_callback',
                        'type'     => 'all',
                    ]);
                    ?>
                </ol>

                <?php
                the_comments_pagination([
                    'prev_text' => esc_html__('&larr; Previous', 'pride-of-africa'),
                    'next_text' => esc_html__('Next &rarr;', 'pride-of-africa'),
                ]);
                ?>

            <?php endif; ?>

            <?php if (comments_open()) : ?>

                <h4 class="mb-4"><?php esc_html_e('Leave a Comment', 'pride-of-africa'); ?></h4>

                <?php
                comment_form([
                    'class_form'  => 'comment-form mb-4',
                    'class_submit' => 'btn btn-primary',
                ]);
                ?>

            <?php elseif (get_comments_number() && !comments_open()) : ?>

                <p class="alert alert-info mb-0">
                    <?php esc_html_e('Comments are closed.', 'pride-of-africa'); ?>
                </p>

            <?php endif; ?>

        </div>
    </div>
</div>
