<?php


/* Meta-Box for post count views Shoive starts */

function post_views_count_metabox()
{
    add_meta_box(
        'post_views_count',
        'Post Views',
        'post_views_count_metabox_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'post_views_count_metabox');

function post_views_count_metabox_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'post_views_count_metabox_nonce');
    $value = get_post_meta($post->ID, 'post_views_count', true);
    echo '<input type="number" name="post_views_count" id="post_views_count" class="widefat" value="' . esc_attr($value) . '">';
}

function savepost_views_count($post_id)
{
    if (!isset($_POST['post_views_count_metabox_nonce']) || !wp_verify_nonce($_POST['post_views_count_metabox_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    $field_name = 'post_views_count';
    if (isset($_POST[$field_name])) {
        update_post_meta($post_id, 'post_views_count', sanitize_text_field($_POST[$field_name]));
    }
}
add_action('save_post', 'savepost_views_count');

/* Meta-Box for post count views Shoive ends */
