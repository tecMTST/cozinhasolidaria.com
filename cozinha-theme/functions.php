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
