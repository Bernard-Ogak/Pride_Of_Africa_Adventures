<?php
/**
 * Admin meta box for the Team Member CPT (About Us page).
 *
 * Name = post Title, photo = Featured Image, bio = the main content
 * editor, display order = native Order field. This box adds the
 * fields with no native equivalent: position, years of experience,
 * languages spoken, and specialties.
 *
 * @package Pride_Of_Africa
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('add_meta_boxes', function () {
    add_meta_box(
        'pride_team_member_details',
        __('Team Member Details', 'pride-of-africa'),
        'pride_of_africa_render_team_member_meta_box',
        'pride_team_member',
        'normal',
        'high'
    );
});

function pride_of_africa_render_team_member_meta_box($post) {
    wp_nonce_field('pride_team_member_meta_box', 'pride_team_member_meta_box_nonce');

    $position    = get_post_meta($post->ID, '_team_position', true);
    $experience  = get_post_meta($post->ID, '_team_experience', true);
    $languages   = get_post_meta($post->ID, '_team_languages', true);
    $specialties = get_post_meta($post->ID, '_team_specialties', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="pride_team_position"><?php esc_html_e('Position', 'pride-of-africa'); ?></label></th>
            <td><input type="text" class="regular-text" name="pride_team_position" id="pride_team_position" value="<?php echo esc_attr($position); ?>" placeholder="<?php esc_attr_e('Senior Safari Consultant', 'pride-of-africa'); ?>"></td>
        </tr>
        <tr>
            <th><label for="pride_team_experience"><?php esc_html_e('Years of Experience', 'pride-of-africa'); ?></label></th>
            <td><input type="text" class="regular-text" name="pride_team_experience" id="pride_team_experience" value="<?php echo esc_attr($experience); ?>" placeholder="<?php esc_attr_e('10+ years', 'pride-of-africa'); ?>"></td>
        </tr>
        <tr>
            <th><label for="pride_team_languages"><?php esc_html_e('Languages Spoken', 'pride-of-africa'); ?></label></th>
            <td><input type="text" class="regular-text" name="pride_team_languages" id="pride_team_languages" value="<?php echo esc_attr($languages); ?>" placeholder="<?php esc_attr_e('English, Swahili', 'pride-of-africa'); ?>"></td>
        </tr>
        <tr>
            <th><label for="pride_team_specialties"><?php esc_html_e('Specialties', 'pride-of-africa'); ?></label></th>
            <td><input type="text" class="regular-text" name="pride_team_specialties" id="pride_team_specialties" value="<?php echo esc_attr($specialties); ?>" placeholder="<?php esc_attr_e('Wildlife photography, Family safaris', 'pride-of-africa'); ?>"></td>
        </tr>
    </table>
    <?php
}

add_action('save_post_pride_team_member', function ($post_id) {
    if (!isset($_POST['pride_team_member_meta_box_nonce']) ||
        !wp_verify_nonce($_POST['pride_team_member_meta_box_nonce'], 'pride_team_member_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'pride_team_position'    => '_team_position',
        'pride_team_experience'  => '_team_experience',
        'pride_team_languages'   => '_team_languages',
        'pride_team_specialties' => '_team_specialties',
    ];
    foreach ($fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$post_key]));
        }
    }
});
