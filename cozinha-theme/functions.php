<?php
/**
 * Funcoes do tema Cozinha Solidaria.
 */

if (! defined('ABSPATH')) {
    exit;
}

function cozinha_solidaria_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
}
add_action('after_setup_theme', 'cozinha_solidaria_setup');

function cozinha_solidaria_asset($path = '')
{
    return get_template_directory_uri() . '/assets' . $path;
}

function cozinha_solidaria_disable_front_page_editor()
{
    $post_id = 0;

    if (isset($_GET['post'])) {
        $post_id = absint(wp_unslash($_GET['post']));
    } elseif (isset($_POST['post_ID'])) {
        $post_id = absint(wp_unslash($_POST['post_ID']));
    }

    if (! $post_id || (int) get_option('page_on_front') !== $post_id) {
        return;
    }

    remove_post_type_support('page', 'editor');
}
add_action('admin_init', 'cozinha_solidaria_disable_front_page_editor');

require_once get_template_directory() . '/includes/acf/helpers.php';
require_once get_template_directory() . '/includes/acf/defaults.php';
require_once get_template_directory() . '/includes/acf/fields.php';
