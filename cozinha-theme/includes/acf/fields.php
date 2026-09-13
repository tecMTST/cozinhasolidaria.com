<?php
/**
 * Campos ACF locais do tema.
 */

if (! defined('ABSPATH')) {
    exit;
}

add_filter('acf/location/rule_types', function ($choices) {
    $choices['Page']['page_slug'] = 'Page Slug';
    return $choices;
});

add_filter('acf/location/rule_values/page_slug', function ($choices) {
    $pages = get_pages(array('post_status' => array('publish', 'draft', 'pending', 'private')));

    foreach ($pages as $page) {
        $choices[$page->post_name] = $page->post_title . ' (' . $page->post_name . ')';
    }

    $choices['o-projeto'] = 'O Projeto (o-projeto)';

    return $choices;
});

add_filter('acf/location/rule_match/page_slug', function ($match, $rule, $options) {
    if (empty($options['post_id'])) {
        return false;
    }

    $post = get_post($options['post_id']);

    if (! $post) {
        return false;
    }

    $is_match = $post->post_name === $rule['value'];

    return $rule['operator'] === '!=' ? ! $is_match : $is_match;
}, 10, 3);

function cozinha_solidaria_home_press_acf_fields()
{
    $news_sub_fields = array();
    $press_defaults = cozinha_solidaria_home_press_group_default();

    for ($index = 1; $index <= 13; $index++) {
        $field_name = 'news_' . $index;
        $press_item_default = $press_defaults[$field_name] ?? array();

        $news_sub_fields[] = array(
            'key' => 'field_home_press_' . $field_name,
            'label' => 'Noticia ' . $index,
            'name' => $field_name,
            'type' => 'group',
            'layout' => 'block',
            'default_value' => $press_item_default,
            'sub_fields' => array(
                array('key' => 'field_home_press_' . $field_name . '_image', 'label' => 'Imagem', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
                array('key' => 'field_home_press_' . $field_name . '_image_url', 'label' => 'URL alternativa da imagem', 'name' => 'image_url', 'type' => 'url', 'default_value' => $press_item_default['image_url'] ?? ''),
                array('key' => 'field_home_press_' . $field_name . '_source', 'label' => 'Titulo/fonte', 'name' => 'source', 'type' => 'text', 'default_value' => $press_item_default['source'] ?? ''),
                array('key' => 'field_home_press_' . $field_name . '_description', 'label' => 'Descricao', 'name' => 'description', 'type' => 'textarea', 'rows' => 2, 'default_value' => $press_item_default['description'] ?? ''),
                array('key' => 'field_home_press_' . $field_name . '_link', 'label' => 'Link da noticia', 'name' => 'link', 'type' => 'text', 'default_value' => $press_item_default['link'] ?? ''),
            ),
        );
    }

    $fields = array(
        array('key' => 'field_home_press_tab', 'label' => 'Secao Imprensa', 'type' => 'tab', 'placement' => 'top'),
        array('key' => 'field_home_press_title', 'label' => 'Titulo', 'name' => 'home_press_title', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_press_title')),
        array('key' => 'field_home_press_intro', 'label' => 'Texto introdutorio', 'name' => 'home_press_intro', 'type' => 'textarea', 'rows' => 2, 'new_lines' => 'br', 'default_value' => cozinha_solidaria_home_default('home_press_intro')),
        array(
            'key' => 'field_home_press_news',
            'label' => 'Noticias',
            'name' => 'home_press_news',
            'type' => 'group',
            'instructions' => 'Edite ate 13 noticias fixas exibidas no carrossel da home.',
            'layout' => 'block',
            'default_value' => cozinha_solidaria_home_default('home_press_news'),
            'sub_fields' => $news_sub_fields,
        ),
    );

    return $fields;
}

add_action('acf/init', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'Cozinha Solidaria',
            'menu_title' => 'Cozinha Solidaria',
            'menu_slug' => 'cozinha-solidaria',
            'capability' => 'edit_posts',
            'redirect' => false,
        ));
    }

    acf_add_local_field_group(array(
        'key' => 'group_cozinha_home',
        'title' => 'Conteudo da Home',
        'fields' => array(
            array('key' => 'field_home_top_banner_tab', 'label' => 'Banner do topo', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_home_top_banner_enabled', 'label' => 'Exibir banner do topo', 'name' => 'home_top_banner_enabled', 'type' => 'true_false', 'default_value' => 1, 'ui' => 1),
            array('key' => 'field_home_top_banner_image', 'label' => 'Imagem do banner', 'name' => 'home_top_banner_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'library' => 'all'),
            array('key' => 'field_home_top_banner_image_url', 'label' => 'URL alternativa da imagem', 'name' => 'home_top_banner_image_url', 'type' => 'url', 'default_value' => cozinha_solidaria_home_default('home_top_banner_image_url')),
            array('key' => 'field_home_top_banner_link', 'label' => 'Link do banner', 'name' => 'home_top_banner_link', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_top_banner_link')),

            array('key' => 'field_home_hero_tab', 'label' => 'Secao topo', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_home_hero_text', 'label' => 'Texto', 'name' => 'home_hero_text', 'type' => 'textarea', 'rows' => 4, 'new_lines' => 'br', 'default_value' => cozinha_solidaria_home_default('home_hero_text')),
            array('key' => 'field_home_hero_button_text', 'label' => 'Texto do botao', 'name' => 'home_hero_button_text', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_hero_button_text')),
            array('key' => 'field_home_hero_button_link', 'label' => 'Link do botao', 'name' => 'home_hero_button_link', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_hero_button_link')),
            array('key' => 'field_home_hero_secondary_text', 'label' => 'Texto secundario', 'name' => 'home_hero_secondary_text', 'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => cozinha_solidaria_home_default('home_hero_secondary_text')),
            array('key' => 'field_home_hero_secondary_button_text', 'label' => 'Texto do botao secundario', 'name' => 'home_hero_secondary_button_text', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_hero_secondary_button_text')),
            array('key' => 'field_home_hero_secondary_button_link', 'label' => 'Link do botao secundario', 'name' => 'home_hero_secondary_button_link', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_hero_secondary_button_link')),

            array('key' => 'field_home_project_tab', 'label' => 'Secao O Projeto', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_home_project_title', 'label' => 'Titulo', 'name' => 'home_project_title', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_project_title')),
            array('key' => 'field_home_project_program_label', 'label' => 'Titulo do programa', 'name' => 'home_project_program_label', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_project_program_label')),
            array(
                'key' => 'field_home_project_content',
                'label' => 'Conteudo do editor visual',
                'name' => 'home_project_content',
                'type' => 'wysiwyg',
                'instructions' => 'Use este editor para alterar a imagem alinhada a esquerda e todo o texto da secao.',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
                'default_value' => cozinha_solidaria_home_default('home_project_content'),
            ),
            array('key' => 'field_home_project_button_text', 'label' => 'Texto do botao', 'name' => 'home_project_button_text', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_project_button_text')),
            array('key' => 'field_home_project_button_link', 'label' => 'Link do botao', 'name' => 'home_project_button_link', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_project_button_link')),

            array('key' => 'field_home_gallery_tab', 'label' => 'Galeria e videos', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_home_gallery_title', 'label' => 'Titulo da galeria', 'name' => 'home_gallery_title', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_gallery_title')),
            array('key' => 'field_home_gallery_image_1', 'label' => 'Imagem 1', 'name' => 'home_gallery_image_1', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
            array('key' => 'field_home_gallery_image_1_url', 'label' => 'URL alternativa da imagem 1', 'name' => 'home_gallery_image_1_url', 'type' => 'url', 'default_value' => cozinha_solidaria_home_default('home_gallery_image_1_url')),
            array('key' => 'field_home_gallery_image_2', 'label' => 'Imagem 2', 'name' => 'home_gallery_image_2', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
            array('key' => 'field_home_gallery_image_2_url', 'label' => 'URL alternativa da imagem 2', 'name' => 'home_gallery_image_2_url', 'type' => 'url', 'default_value' => cozinha_solidaria_home_default('home_gallery_image_2_url')),
            array('key' => 'field_home_gallery_image_3', 'label' => 'Imagem 3', 'name' => 'home_gallery_image_3', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
            array('key' => 'field_home_gallery_image_3_url', 'label' => 'URL alternativa da imagem 3', 'name' => 'home_gallery_image_3_url', 'type' => 'url', 'default_value' => cozinha_solidaria_home_default('home_gallery_image_3_url')),
            array('key' => 'field_home_gallery_image_4', 'label' => 'Imagem 4', 'name' => 'home_gallery_image_4', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
            array('key' => 'field_home_gallery_image_4_url', 'label' => 'URL alternativa da imagem 4', 'name' => 'home_gallery_image_4_url', 'type' => 'url', 'default_value' => cozinha_solidaria_home_default('home_gallery_image_4_url')),
            array('key' => 'field_home_gallery_image_5', 'label' => 'Imagem 5', 'name' => 'home_gallery_image_5', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
            array('key' => 'field_home_gallery_image_5_url', 'label' => 'URL alternativa da imagem 5', 'name' => 'home_gallery_image_5_url', 'type' => 'url', 'default_value' => cozinha_solidaria_home_default('home_gallery_image_5_url')),
            array('key' => 'field_home_gallery_image_6', 'label' => 'Imagem 6', 'name' => 'home_gallery_image_6', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
            array('key' => 'field_home_gallery_image_6_url', 'label' => 'URL alternativa da imagem 6', 'name' => 'home_gallery_image_6_url', 'type' => 'url', 'default_value' => cozinha_solidaria_home_default('home_gallery_image_6_url')),
            array('key' => 'field_home_gallery_button_text', 'label' => 'Texto do botao da galeria', 'name' => 'home_gallery_button_text', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_gallery_button_text')),
            array('key' => 'field_home_gallery_button_link', 'label' => 'Link do botao da galeria', 'name' => 'home_gallery_button_link', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_gallery_button_link')),
            array('key' => 'field_home_video_1_youtube_id', 'label' => 'ID do YouTube - video principal', 'name' => 'home_video_1_youtube_id', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_video_1_youtube_id')),
            array('key' => 'field_home_video_2_youtube_id', 'label' => 'ID do YouTube - video 2', 'name' => 'home_video_2_youtube_id', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_video_2_youtube_id')),
            array('key' => 'field_home_video_3_youtube_id', 'label' => 'ID do YouTube - video 3', 'name' => 'home_video_3_youtube_id', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_video_3_youtube_id')),
            array('key' => 'field_home_videos_button_text', 'label' => 'Texto do botao de videos', 'name' => 'home_videos_button_text', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_videos_button_text')),
            array('key' => 'field_home_videos_button_link', 'label' => 'Link do botao de videos', 'name' => 'home_videos_button_link', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_videos_button_link')),

            array('key' => 'field_home_contribute_tab', 'label' => 'Secao Como contribuir', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_home_contribute_title', 'label' => 'Titulo', 'name' => 'home_contribute_title', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_contribute_title')),
            array('key' => 'field_home_contribute_image', 'label' => 'Imagem', 'name' => 'home_contribute_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'library' => 'all'),
            array('key' => 'field_home_contribute_heading', 'label' => 'Chamada', 'name' => 'home_contribute_heading', 'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => cozinha_solidaria_home_default('home_contribute_heading')),
            array('key' => 'field_home_contribute_text', 'label' => 'Texto', 'name' => 'home_contribute_text', 'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => cozinha_solidaria_home_default('home_contribute_text')),
            array('key' => 'field_home_contribute_button_text', 'label' => 'Texto do botao', 'name' => 'home_contribute_button_text', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_contribute_button_text')),
            array('key' => 'field_home_contribute_button_link', 'label' => 'Link do botao', 'name' => 'home_contribute_button_link', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_contribute_button_link')),

            ...cozinha_solidaria_home_press_acf_fields(),

            array('key' => 'field_home_accountability_tab', 'label' => 'Prestacao de contas', 'type' => 'tab', 'placement' => 'top'),
            array(
                'key' => 'field_home_accountability_content',
                'label' => 'Texto da secao',
                'name' => 'home_accountability_content',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
                'default_value' => cozinha_solidaria_home_default('home_accountability_content'),
            ),
            array('key' => 'field_home_accountability_stat_1_number', 'label' => 'Dado 1 - numero', 'name' => 'home_accountability_stat_1_number', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_1_number')),
            array('key' => 'field_home_accountability_stat_1_label', 'label' => 'Dado 1 - descricao', 'name' => 'home_accountability_stat_1_label', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_1_label')),
            array('key' => 'field_home_accountability_stat_2_number', 'label' => 'Dado 2 - numero', 'name' => 'home_accountability_stat_2_number', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_2_number')),
            array('key' => 'field_home_accountability_stat_2_label', 'label' => 'Dado 2 - descricao', 'name' => 'home_accountability_stat_2_label', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_2_label')),
            array('key' => 'field_home_accountability_stat_3_number', 'label' => 'Dado 3 - numero', 'name' => 'home_accountability_stat_3_number', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_3_number')),
            array('key' => 'field_home_accountability_stat_3_label', 'label' => 'Dado 3 - descricao', 'name' => 'home_accountability_stat_3_label', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_3_label')),
            array('key' => 'field_home_accountability_stat_4_number', 'label' => 'Dado 4 - numero', 'name' => 'home_accountability_stat_4_number', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_4_number')),
            array('key' => 'field_home_accountability_stat_4_label', 'label' => 'Dado 4 - descricao', 'name' => 'home_accountability_stat_4_label', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_4_label')),
            array('key' => 'field_home_accountability_stat_5_number', 'label' => 'Dado 5 - numero', 'name' => 'home_accountability_stat_5_number', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_5_number')),
            array('key' => 'field_home_accountability_stat_5_label', 'label' => 'Dado 5 - descricao', 'name' => 'home_accountability_stat_5_label', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_stat_5_label')),
            array('key' => 'field_home_accountability_note', 'label' => 'Atualizacao dos dados', 'name' => 'home_accountability_note', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_accountability_note')),

            array('key' => 'field_home_share_tab', 'label' => 'Ajude a divulgar', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_home_share_image', 'label' => 'Imagem', 'name' => 'home_share_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'library' => 'all'),
            array('key' => 'field_home_share_title_line_1', 'label' => 'Titulo linha 1', 'name' => 'home_share_title_line_1', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_share_title_line_1')),
            array('key' => 'field_home_share_title_line_2', 'label' => 'Titulo linha 2', 'name' => 'home_share_title_line_2', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_share_title_line_2')),
            array('key' => 'field_home_share_text', 'label' => 'Texto', 'name' => 'home_share_text', 'type' => 'textarea', 'rows' => 4, 'new_lines' => 'br', 'default_value' => cozinha_solidaria_home_default('home_share_text')),
            array('key' => 'field_home_share_button_text', 'label' => 'Texto do botao', 'name' => 'home_share_button_text', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_share_button_text')),
            array('key' => 'field_home_share_button_link', 'label' => 'Link do botao', 'name' => 'home_share_button_link', 'type' => 'text', 'default_value' => cozinha_solidaria_home_default('home_share_button_link')),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_cozinha_o_projeto',
        'title' => 'Conteudo da Pagina O Projeto',
        'fields' => array(
            array(
                'key' => 'field_project_header_html',
                'label' => 'Cabecalho da pagina',
                'name' => 'project_header_html',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'instructions' => 'Opcional. Se vazio, o tema usa o HTML padrao atual.',
                'default_value' => cozinha_solidaria_acf_default('project_header_html'),
            ),
            array(
                'key' => 'field_project_more_food_html',
                'label' => 'Secao Mais que comida',
                'name' => 'project_more_food_html',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'default_value' => cozinha_solidaria_acf_default('project_more_food_html'),
            ),
            array(
                'key' => 'field_project_support_html',
                'label' => 'Secao Quem faz acontecer',
                'name' => 'project_support_html',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'default_value' => cozinha_solidaria_acf_default('project_support_html'),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-o-projeto.php',
                ),
            ),
            array(
                array(
                    'param' => 'page_slug',
                    'operator' => '==',
                    'value' => 'o-projeto',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_cozinha_global',
        'title' => 'Conteudo global',
        'fields' => array(
            array(
                'key' => 'field_global_contact_intro',
                'label' => 'Texto do modal de contato',
                'name' => 'global_contact_intro',
                'type' => 'textarea',
                'rows' => 3,
                'new_lines' => 'br',
                'default_value' => 'Quer ajudar de outra forma, saber mais das nossas Cozinhas Solidárias ou se informar sobre os locais para doações de alimentos e utensílios? Entre em contato com a gente:',
            ),
            array(
                'key' => 'field_global_footer_html',
                'label' => 'Rodape',
                'name' => 'global_footer_html',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'instructions' => 'Opcional. Se vazio, o tema usa o rodape padrao.',
                'default_value' => cozinha_solidaria_acf_default('global_footer_html'),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'cozinha-solidaria',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
});
