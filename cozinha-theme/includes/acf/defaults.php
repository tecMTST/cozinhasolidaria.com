<?php
/**
 * Valores padrao dos campos ACF.
 */

if (! defined('ABSPATH')) {
    exit;
}

function cozinha_solidaria_acf_default($field_name)
{
    $templates = array(
        'project_header_html' => 'page-o-projeto.php',
        'project_more_food_html' => 'page-o-projeto.php',
        'project_support_html' => 'page-o-projeto.php',
        'global_footer_html' => 'front-page.php',
    );

    if (empty($templates[$field_name])) {
        return '';
    }

    $template = get_template_directory() . '/' . $templates[$field_name];

    if (! is_readable($template)) {
        return '';
    }

    $contents = file_get_contents($template);

    if ($contents === false) {
        return '';
    }

    $target_pattern = '/<\\?php\\s+cozinha_solidaria_the_html_field\\(\\s*[\\\'"]' . preg_quote($field_name, '/') . '[\\\'"]\\s*,\\s*ob_get_clean\\(\\)\\s*(?:,\\s*[\\\'"]option[\\\'"]\\s*)?\\);\\s+\\?>/s';

    if (! preg_match($target_pattern, $contents, $target_match, PREG_OFFSET_CAPTURE)) {
        return '';
    }

    $target_position = $target_match[0][1];
    $prefix = substr($contents, 0, $target_position);

    if (! preg_match_all('/<\\?php\\s+ob_start\\(\\);\\s+\\?>/s', $prefix, $starts, PREG_OFFSET_CAPTURE)) {
        return '';
    }

    $last_start = end($starts[0]);
    $start_position = $last_start[1] + strlen($last_start[0]);

    $default = trim(substr($contents, $start_position, $target_position - $start_position));

    return cozinha_solidaria_acf_resolve_template_urls($default);
}

function cozinha_solidaria_home_default($field_name)
{
    $asset = 'cozinha_solidaria_asset';
    $home_project_content = '<p><img class="alignleft" src="' . $asset('/img/programa-cozinha-solidaria.jpg') . '" alt="Programa Cozinha Solidária">Em 2024, firmamos um Termo de Colaboração com o Ministério do Desenvolvimento Social, no âmbito do Programa Cozinha Solidária, que garantiu apoio financeiro parcial a mais de 50 Cozinhas Solidárias durante o período de um ano, além de possibilitar a entrega regular de alimentos in natura provenientes do Programa de Aquisição de Alimentos (PAA). Essa política pública visa fortalecer ações de segurança alimentar e nutricional, promovendo o acesso a alimentos saudáveis e o combate à fome em comunidades em situação de vulnerabilidade social.</p><p>A partir de 2023, iniciativas de combate à fome voltaram a ter protagonismo e vimos os números da fome reduzirem. Entretanto, em um país de dimensões continentais como o Brasil, essa realidade não é uniforme e, em várias regiões, principalmente, nas periferias dos grandes centros, as Cozinhas Solidárias ainda cumprem um papel importante: o de garantir alimentação gratuita, de qualidade, rica em nutriente e afeto.</p><p>O projeto teve início no auge da pandemia, sendo a primeira Cozinha Solidária inaugurada em março de 2021. Nesses quase quatro anos, as Cozinhas Solidárias estão presentes em todas as regiões do país, contando hoje com 55 cozinhas que garantem alimentação de mais de 12 mil pessoas de baixa renda. São mais de 6 milhões de marmitas distribuídas e quase 4,5 milhões de quilos de alimentos produzidos. Além disso, o projeto oferece oficinas, rodas de conversa, atendimento jurídico, psicológico, e de saúde, saraus e cursos de alfabetização para a comunidade, funcionando como um equipamento social importante em locais carentes desses espaços de convivência.</p><p>As Cozinhas Solidárias estão presentes, ainda, nos momentos de maior dificuldade da população mais pobre do país. Estamos vendo, diariamente, notícias de chuvas incessantes e aumento das temperaturas, com enchentes e alagamentos com um número enorme de desabrigados. Por esse motivo, além das cozinhas que já funcionavam em atendimento à população vulnerável, também foram abertas Cozinhas Solidárias Emergenciais em várias regiões do Brasil, tais como Rio Grande do Sul, Minas Gerais, Acre, Rio de Janeiro, Pernambuco, Piauí e São Paulo, garantindo a alimentação de pessoas que, muitas vezes, perderam suas casas e família.</p><p>As Cozinhas Solidárias existem para suprir o vácuo deixado pelo poder público e por isso vem se expandindo, abrindo novas unidades e chegando a mais gente. Mas para seu pleno funcionamento, o projeto precisa muito de apoio. As doações são fundamentais para a manutenção das cozinhas e para a compra dos alimentos distribuídos.</p>';
    $press_defaults = cozinha_solidaria_home_press_group_default();
    $defaults = array(
        'home_top_banner_enabled' => 1,
        'home_top_banner_image_url' => $asset('/img/banner-apoio-cozinhas.webp'),
        'home_top_banner_link' => 'https://euapoioascozinhas.com/',
        'home_hero_text' => 'Enquanto houver emergência, haverá solidariedade. Participe da campanha para apoiar as vítimas das enchentes, garantindo refeições nutritivas em seus territórios.',
        'home_hero_button_text' => 'SOS Enchentes',
        'home_hero_button_link' => 'https://apoia.se/enchentes2025?fbclid=PAQ0xDSwLskUVleHRuA2FlbQIxMAABp8JkIg3zoFEHeTzX4KwjVXlJbYhaWMZxVbnxv4pQZ3OfIXF3WVsmvNp_5Fo-_aem_7THt3qdRBkr6_2b-3nlKLA',
        'home_hero_secondary_text' => 'Somos 55 cozinhas distribuindo refeições gratuitas em 14 estados e no DF, ajudando a combater a fome nas periferias.',
        'home_hero_secondary_button_text' => 'Contribua!',
        'home_hero_secondary_button_link' => 'https://apoia.se/cozinhasolidaria',
        'home_project_title' => 'O Projeto',
        'home_project_program_label' => 'PROGRAMA COZINHA SOLIDÁRIA',
        'home_project_button_text' => 'Saiba mais',
        'home_project_button_link' => '/o-projeto/',
        'home_project_content' => $home_project_content,
        'home_gallery_title' => 'Galeria',
        'home_gallery_button_text' => 'Ver mais',
        'home_gallery_button_link' => 'https://www.instagram.com/cozinhassolidariasmtst/',
        'home_gallery_image_1_url' => $asset('/img/cozinha-solidaria-1.jpg'),
        'home_gallery_image_2_url' => $asset('/img/cozinha-solidaria-2.jpg'),
        'home_gallery_image_3_url' => $asset('/img/cozinha-solidaria-3.jpg'),
        'home_gallery_image_4_url' => $asset('/img/cozinha-solidaria-4.jpg'),
        'home_gallery_image_5_url' => $asset('/img/cozinha-solidaria-5.jpg'),
        'home_gallery_image_6_url' => $asset('/img/cozinha-solidaria-6.jpg'),
        'home_videos_button_text' => 'Ver mais vídeos',
        'home_videos_button_link' => 'https://www.youtube.com/watch?v=NObqUoVIXPU&list=PLZsFOaKOvLj5Zjxc7SFv8TfSB6ghGB2xb',
        'home_video_1_youtube_id' => 'NObqUoVIXPU',
        'home_video_2_youtube_id' => 'ftXWFGSBQh8',
        'home_video_3_youtube_id' => 'aAtwYdNzgOc',
        'home_contribute_title' => 'Como posso contribuir?',
        'home_contribute_heading' => "Ajudar é fácil, faça a diferença e garanta sua doação pelo <a href=\"https://apoia.se/cozinhasolidaria\" target=\"_blank\" style=\"color:#fff\">'apoia.se'.</a>",
        'home_contribute_text' => 'Nossas Cozinhas Solidárias são o resultado do trabalho voluntário e das doações de diversas pessoas que acreditam na ação coletiva para um mundo melhor!',
        'home_contribute_button_text' => 'Colabore com esse projeto também!',
        'home_contribute_button_link' => 'https://apoia.se/cozinhasolidaria',
        'home_press_title' => 'Imprensa',
        'home_press_intro' => 'Venha saber mais da importância das nossas Cozinhas Solidárias nessas reportagens que estão na mídia:',
        'home_accountability_content' => '<p>Desde o início da pandemia é notório que as desigualdades sociais brasileiras foram expostas e, principalmente, intensificadas. A população periférica é a mais prejudicada, morta e invisibilizada, seja pelo vírus, pela fome ou pelo desprezo do governo. Frente a esse cenário, o MTST verificou a necessidade de resistir não apenas pelo direito à moradia, mas também, pelo direito à vida e à alimentação básica. Assim nasceram as Cozinhas Solidárias.</p><p><strong>Em pouco mais de dois anos, já foram servidas mais de 5.800.000 quentinhas e mais de 3.800.000 quilos de alimentos distribuídos para que milhares de famílias garantam, ao menos, uma refeição rica em nutrientes por dia.</strong></p>',
        'home_accountability_stat_1_number' => '5.800.000',
        'home_accountability_stat_1_label' => 'refeições',
        'home_accountability_stat_2_number' => '55',
        'home_accountability_stat_2_label' => 'Cozinhas Solidárias pelo Brasil',
        'home_accountability_stat_3_number' => '14',
        'home_accountability_stat_3_label' => 'Estados',
        'home_accountability_stat_4_number' => '97',
        'home_accountability_stat_4_label' => 'Cozinheiras',
        'home_accountability_stat_5_number' => '3.800.000',
        'home_accountability_stat_5_label' => 'quilos de alimentos',
        'home_accountability_note' => 'Dados compilados até 12/2024',
        'home_share_title_line_1' => 'Ajude',
        'home_share_title_line_2' => 'a divulgar!',
        'home_share_text' => 'Além de contribuir doando através do nosso <a class="link-apoia-se" href="https://apoia.se/cozinhasolidaria" target="_blank">FINANCIAMENTO COLETIVO</a>, você também pode ajudar compartilhando as cozinhas com seus amigos nas redes!',
        'home_share_button_text' => 'Compartilhe',
        'home_share_button_link' => 'http://cozinhasolidaria.com',
    );

    $defaults['home_press_news'] = $press_defaults;

    return array_key_exists($field_name, $defaults) ? $defaults[$field_name] : '';
}

function cozinha_solidaria_acf_clean_url($url)
{
    return function_exists('esc_url') ? esc_url($url) : $url;
}

function cozinha_solidaria_acf_home_url($path)
{
    if (function_exists('home_url')) {
        return home_url($path);
    }

    return $path;
}

function cozinha_solidaria_acf_resolve_template_urls($html)
{
    $html = preg_replace_callback(
        '/<\\?php\\s+echo\\s+esc_url\\(cozinha_solidaria_asset\\(\\s*[\\\'"]([^\\\'"]+)[\\\'"]\\s*\\)\\);\\s+\\?>/',
        function ($matches) {
            return cozinha_solidaria_acf_clean_url(cozinha_solidaria_asset($matches[1]));
        },
        $html
    );

    $html = preg_replace_callback(
        '/<\\?php\\s+echo\\s+esc_url\\(home_url\\(\\s*[\\\'"]([^\\\'"]+)[\\\'"]\\s*\\)\\);\\s+\\?>/',
        function ($matches) {
            return cozinha_solidaria_acf_clean_url(cozinha_solidaria_acf_home_url($matches[1]));
        },
        $html
    );

    return $html;
}

function cozinha_solidaria_home_press_defaults()
{
    $asset = 'cozinha_solidaria_asset';

    return array(
        array('image_url' => $asset('/img/image_processing20220627-30869-1rtwszj.jpeg'), 'source' => 'Brasil de Fato', 'description' => 'Conheça as cozinhas solidárias do MTST que distribuem refeições gratuitas por todo o Brasil', 'link' => 'https://www.brasildefato.com.br/2022/06/27/conheca-as-cozinhas-solidarias-do-mtst-que-distribuem-refeicoes-gratuitas-por-todo-o-brasil'),
        array('image_url' => $asset('/img/cozinha-5.webp'), 'source' => 'Portal G1', 'description' => 'Cozinhas solidárias proporcionam refeições a pessoas em insegurança alimentar em Fortaleza', 'link' => 'https://g1.globo.com/ce/ceara/noticia/2022/07/24/cozinhas-solidarias-proporcionam-refeicoes-a-pessoas-em-inseguranca-alimentar-em-fortaleza.ghtml'),
        array('image_url' => $asset('/img/image-h5pyx9.jpeg'), 'source' => 'Brasil de Fato', 'description' => 'Cozinhas Solidárias são um recurso de sobrevivências', 'link' => 'https://www.brasildefato.com.br/2022/07/18/cozinhas-solidarias-sao-um-recurso-de-sobrevivencia'),
        array('image_url' => $asset('/img/image_processing20220826-4411-1tjztp.jpeg'), 'source' => 'Brasil de Fato', 'description' => 'Combate à fome: um dia na rotina da Cozinha Solidária do MTST', 'link' => 'https://www.brasildefators.com.br/2022/08/26/combate-a-fome-um-dia-na-rotina-da-cozinha-solidaria-do-mtst'),
        array('image_url' => $asset('/img/user-campaign-about-desc-foto-apoia-20210511-09153161.webp'), 'source' => 'Portal G1', 'description' => 'MTST inaugura Cozinha Solidária em Uberlândia; 150 refeições serão servidas diariamente', 'link' => 'https://g1.globo.com/ce/ceara/noticia/2022/07/24/cozinhas-solidarias-proporcionam-refeicoes-a-pessoas-em-inseguranca-alimentar-em-fortaleza.ghtml'),
        array('image_url' => $asset('/img/thumb-uol.webp'), 'source' => 'Portal UOL', 'description' => 'Como cozinhas comunitárias têm atuado para aplacar a fome pelo Brasil', 'link' => 'https://www.uol.com.br/ecoa/ultimas-noticias/2021/04/27/como-cozinhas-comunitarias-tem-atuado-para-aplacar-a-fome-pelo-brasil.htm'),
        array('image_url' => $asset('/img/ne1-globo.jpg'), 'source' => 'Globo NE1', 'description' => 'Cozinha Solidária do MTST ajuda a alimentar famílias pobres, no Recife', 'link' => 'https://globoplay.globo.com/v/9608976/'),
        array('image_url' => $asset('/img/thumb-folha.jpg'), 'source' => 'Folha de S.Paulo', 'description' => 'MTST inaugura unidades das cozinhas solidárias', 'link' => '#'),
        array('image_url' => $asset('/img/thumb-brasil-atual.jpg'), 'source' => 'Brasil Atual', 'description' => 'Mais do que matar a fome, cozinhas solidárias são espaços de resistência', 'link' => 'https://www.redebrasilatual.com.br/cidadania/2021/04/mais-do-que-matar-a-fome-cozinhas-solidarias-sao-espacos-de-resistencia/'),
        array('image_url' => $asset('/img/thumb-anf.jpg'), 'source' => 'Portal ANF', 'description' => 'MTST lança campanha para abrir 16 Cozinhas Solidárias no Brasil', 'link' => 'https://www.anf.org.br/mtst-lanca-campanha-para-abrir-16-cozinhas-solidarias-no-brasil/'),
        array('image_url' => $asset('/img/noticia-sptv.jpeg'), 'source' => 'Globo SPTV', 'description' => 'Cozinhas solidárias ajudam a matar a fome na Grande São Paulo', 'link' => 'https://globoplay.globo.com/v/9608976/'),
        array('image_url' => $asset('/img/thumb-brasil-de-fato.jpeg'), 'source' => 'Brasil de Fato', 'description' => 'Para combater “pandemia da fome”, MTST inaugura cozinha solidária em SP', 'link' => 'https://www.brasildefato.com.br/2021/03/13/para-combater-pandemia-da-fome-mtst-inaugura-cozinha-solidaria-em-sp/'),
        array('image_url' => $asset('/img/thumb-metropoles.jpg'), 'source' => 'Metrópoles', 'description' => 'MTST inaugura mais uma cozinha solidária em São Paulo', 'link' => 'https://www.metropoles.com/brasil/mtst-inaugura-mais-uma-cozinha-solidaria-em-sao-paulo'),
    );
}

function cozinha_solidaria_home_press_group_default()
{
    $press_defaults = array();

    foreach (cozinha_solidaria_home_press_defaults() as $index => $press_item) {
        $press_defaults['news_' . ($index + 1)] = $press_item;
    }

    return $press_defaults;
}

function cozinha_solidaria_acf_field_default($field)
{
    if (! empty($field['name'])) {
        $default = cozinha_solidaria_acf_default($field['name']);

        if ($default !== '') {
            $field['default_value'] = $default;
        }
    }

    return $field;
}

function cozinha_solidaria_acf_load_default_value($value, $post_id, $field)
{
    if ($value !== null && $value !== false && $value !== '') {
        return $value;
    }

    if (empty($field['name'])) {
        return $value;
    }

    $default = cozinha_solidaria_acf_default($field['name']);

    return $default !== '' ? $default : $value;
}

$cozinha_solidaria_default_fields = array(
    'project_header_html',
    'project_more_food_html',
    'project_support_html',
    'global_footer_html',
);

foreach ($cozinha_solidaria_default_fields as $cozinha_solidaria_default_field) {
    add_filter('acf/prepare_field/name=' . $cozinha_solidaria_default_field, 'cozinha_solidaria_acf_field_default');
    add_filter('acf/load_value/name=' . $cozinha_solidaria_default_field, 'cozinha_solidaria_acf_load_default_value', 10, 3);
}

function cozinha_solidaria_acf_home_load_default_value($value, $post_id, $field)
{
    if ($value !== null && $value !== false && $value !== '') {
        if (! empty($field['name']) && $field['name'] === 'home_project_content') {
            $value = preg_replace(
                '/\\s+src=(["\\\'])(?:[^"\\\']*\\/assets\\/img\\/image\\.(?:webp|png))\\1/i',
                ' src="' . esc_url(cozinha_solidaria_asset('/img/programa-cozinha-solidaria.jpg')) . '"',
                (string) $value
            );
        }

        if (! empty($field['name']) && $field['name'] === 'home_project_content' && strpos((string) $value, '<img') === false) {
            $default = cozinha_solidaria_home_default($field['name']);
            return $default !== '' ? $default : $value;
        }

        return $value;
    }

    if (empty($field['name'])) {
        return $value;
    }

    $default = cozinha_solidaria_home_default($field['name']);

    return $default !== '' ? $default : $value;
}

function cozinha_solidaria_acf_home_field_default($field)
{
    if (! empty($field['name'])) {
        $default = cozinha_solidaria_home_default($field['name']);

        if ($default !== '' && ! is_array($default)) {
            $field['default_value'] = $default;
        }
    }

    return $field;
}

$cozinha_solidaria_home_default_fields = array(
    'home_top_banner_enabled',
    'home_top_banner_image_url',
    'home_top_banner_link',
    'home_hero_text',
    'home_hero_button_text',
    'home_hero_button_link',
    'home_hero_secondary_text',
    'home_hero_secondary_button_text',
    'home_hero_secondary_button_link',
    'home_project_title',
    'home_project_program_label',
    'home_project_button_text',
    'home_project_button_link',
    'home_project_content',
    'home_gallery_title',
    'home_gallery_button_text',
    'home_gallery_button_link',
    'home_gallery_image_1_url',
    'home_gallery_image_2_url',
    'home_gallery_image_3_url',
    'home_gallery_image_4_url',
    'home_gallery_image_5_url',
    'home_gallery_image_6_url',
    'home_videos_button_text',
    'home_videos_button_link',
    'home_video_1_youtube_id',
    'home_video_2_youtube_id',
    'home_video_3_youtube_id',
    'home_contribute_title',
    'home_contribute_heading',
    'home_contribute_text',
    'home_contribute_button_text',
    'home_contribute_button_link',
    'home_press_title',
    'home_press_intro',
    'home_press_news',
    'home_accountability_content',
    'home_accountability_stat_1_number',
    'home_accountability_stat_1_label',
    'home_accountability_stat_2_number',
    'home_accountability_stat_2_label',
    'home_accountability_stat_3_number',
    'home_accountability_stat_3_label',
    'home_accountability_stat_4_number',
    'home_accountability_stat_4_label',
    'home_accountability_stat_5_number',
    'home_accountability_stat_5_label',
    'home_accountability_note',
    'home_share_title_line_1',
    'home_share_title_line_2',
    'home_share_text',
    'home_share_button_text',
    'home_share_button_link',
);

foreach ($cozinha_solidaria_home_default_fields as $cozinha_solidaria_home_default_field) {
    add_filter('acf/prepare_field/name=' . $cozinha_solidaria_home_default_field, 'cozinha_solidaria_acf_home_field_default');
    add_filter('acf/load_value/name=' . $cozinha_solidaria_home_default_field, 'cozinha_solidaria_acf_home_load_default_value', 10, 3);
}

add_action('acf/init', function () {
    if (! function_exists('update_field') || ! function_exists('get_field')) {
        return;
    }

    $project_page = get_page_by_path('o-projeto');

    if (! $project_page) {
        return;
    }

    foreach (array('project_header_html', 'project_more_food_html', 'project_support_html') as $field_name) {
        $current_value = get_field($field_name, $project_page->ID, false);

        if ($current_value !== null && $current_value !== false && $current_value !== '') {
            continue;
        }

        $default_value = cozinha_solidaria_acf_default($field_name);

        if ($default_value !== '') {
            update_field($field_name, $default_value, $project_page->ID);
        }
    }
});

add_action('acf/init', function () use ($cozinha_solidaria_home_default_fields) {
    if (! function_exists('update_field') || ! function_exists('get_field')) {
        return;
    }

    $front_page_id = (int) get_option('page_on_front');

    if ($front_page_id <= 0) {
        return;
    }

    foreach ($cozinha_solidaria_home_default_fields as $field_name) {
        $current_value = get_field($field_name, $front_page_id, false);

        if ($current_value !== null && $current_value !== false && $current_value !== '') {
            continue;
        }

        $default_value = cozinha_solidaria_home_default($field_name);

        if ($default_value !== '') {
            update_field($field_name, $default_value, $front_page_id);
        }
    }
});
