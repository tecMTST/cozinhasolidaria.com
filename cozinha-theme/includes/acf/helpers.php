<?php
/**
 * Helpers para conteudo gerenciado via ACF.
 */

if (! defined('ABSPATH')) {
    exit;
}

function cozinha_solidaria_get_field($field_name, $fallback = '', $post_id = false)
{
    if (! function_exists('get_field')) {
        return $fallback;
    }

    $value = get_field($field_name, $post_id, false);

    if ($value === null || $value === false || $value === '') {
        return $fallback;
    }

    return $value;
}

function cozinha_solidaria_get_formatted_field($field_name, $fallback = '', $post_id = false)
{
    if (! function_exists('get_field')) {
        return $fallback;
    }

    $value = get_field($field_name, $post_id, true);

    if ($value === null || $value === false || $value === '') {
        return $fallback;
    }

    return $value;
}

function cozinha_solidaria_get_image_url($field_name, $fallback = '', $post_id = false)
{
    $image = cozinha_solidaria_get_field($field_name, '', $post_id);

    return cozinha_solidaria_image_url($image, $fallback);
}

function cozinha_solidaria_get_image_alt($field_name, $fallback = '', $post_id = false)
{
    $image = cozinha_solidaria_get_field($field_name, '', $post_id);

    if (is_array($image) && ! empty($image['alt'])) {
        return $image['alt'];
    }

    if (is_numeric($image)) {
        $alt = get_post_meta((int) $image, '_wp_attachment_image_alt', true);
        return $alt !== '' ? $alt : $fallback;
    }

    return $fallback;
}

function cozinha_solidaria_image_url($image, $fallback = '')
{
    if (empty($image)) {
        return $fallback;
    }

    if (is_array($image) && ! empty($image['url'])) {
        return $image['url'];
    }

    if (is_numeric($image)) {
        $url = wp_get_attachment_image_url((int) $image, 'full');
        return $url ?: $fallback;
    }

    if (is_string($image) && $image !== '') {
        return $image;
    }

    return $fallback;
}

function cozinha_solidaria_get_rows($field_name, $fallback = array(), $post_id = false)
{
    if (! function_exists('get_field')) {
        return $fallback;
    }

    $value = get_field($field_name, $post_id);

    if (! is_array($value) || empty($value)) {
        return $fallback;
    }

    return $value;
}

function cozinha_solidaria_sub_image_url($row, $field_name, $fallback = '')
{
    if (! is_array($row) || empty($row[$field_name])) {
        return $fallback;
    }

    return cozinha_solidaria_image_url($row[$field_name], $fallback);
}

function cozinha_solidaria_youtube_thumbnail_url($youtube_id)
{
    $youtube_id = trim((string) $youtube_id);

    if ($youtube_id === '') {
        return '';
    }

    return 'https://img.youtube.com/vi/' . rawurlencode($youtube_id) . '/maxresdefault.jpg';
}

function cozinha_solidaria_youtube_embed_url($youtube_id)
{
    $youtube_id = trim((string) $youtube_id);

    if ($youtube_id === '') {
        return '#';
    }

    return 'https://www.youtube-nocookie.com/embed/' . rawurlencode($youtube_id);
}

function cozinha_solidaria_the_html_field($field_name, $fallback = '', $post_id = false)
{
    $html = cozinha_solidaria_get_field($field_name, $fallback, $post_id);
    echo do_shortcode($html);
}

function cozinha_solidaria_acf_is_enabled($field_name, $default = true, $post_id = false)
{
    if (! function_exists('get_field')) {
        return $default;
    }

    $value = get_field($field_name, $post_id);

    if ($value === null || $value === '') {
        return $default;
    }

    return (bool) $value;
}
