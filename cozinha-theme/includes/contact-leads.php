<?php
/**
 * Registro e envio dos contatos recebidos pelo site.
 */

if (! defined('ABSPATH')) {
    exit;
}

function cozinha_solidaria_contact_recipients()
{
    return array(
        'contato@cozinhasolidaria.com',
        'falecomomtst@gmail.com',
    );
}

function cozinha_solidaria_register_contact_post_type()
{
    register_post_type('cozinha_contato', array(
        'labels' => array(
            'name' => 'Contatos',
            'singular_name' => 'Contato',
            'menu_name' => 'Contatos',
            'add_new_item' => 'Adicionar contato',
            'edit_item' => 'Ver contato',
            'view_item' => 'Ver contato',
            'search_items' => 'Buscar contatos',
            'not_found' => 'Nenhum contato encontrado',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-email-alt',
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'supports' => array('title'),
    ));
}
add_action('init', 'cozinha_solidaria_register_contact_post_type');

function cozinha_solidaria_save_contact_lead($name, $email, $message)
{
    $post_id = wp_insert_post(array(
        'post_type' => 'cozinha_contato',
        'post_status' => 'publish',
        'post_title' => sprintf('%s - %s', $name, $email),
    ));

    if (is_wp_error($post_id) || ! $post_id) {
        return 0;
    }

    update_post_meta($post_id, '_cozinha_contact_name', $name);
    update_post_meta($post_id, '_cozinha_contact_email', $email);
    update_post_meta($post_id, '_cozinha_contact_message', $message);
    update_post_meta($post_id, '_cozinha_contact_source', wp_get_referer() ?: home_url('/'));
    update_post_meta($post_id, '_cozinha_contact_ip', sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? ''));
    update_post_meta($post_id, '_cozinha_contact_user_agent', sanitize_text_field($_SERVER['HTTP_USER_AGENT'] ?? ''));

    return $post_id;
}

function cozinha_solidaria_send_contact_email($name, $email, $message)
{
    $subject = 'Formulario Site Cozinha Solidaria: ' . $name;
    $body = "Voce recebeu uma nova mensagem do formulario de contato do site.\n\n";
    $body .= "Nome: {$name}\n\n";
    $body .= "Email: {$email}\n\n";
    $body .= "Mensagem:\n{$message}\n";

    $headers = array(
        'From: Cozinha Solidaria <noreply@cozinhasolidaria.com>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    return wp_mail(cozinha_solidaria_contact_recipients(), $subject, $body, $headers);
}

function cozinha_solidaria_handle_contact_form()
{
    check_ajax_referer('cozinha_solidaria_contact', 'nonce');

    $name = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));

    if ($name === '' || $message === '' || ! is_email($email)) {
        wp_send_json_error(array('message' => 'Dados invalidos.'), 400);
    }

    $lead_id = cozinha_solidaria_save_contact_lead($name, $email, $message);
    $sent = cozinha_solidaria_send_contact_email($name, $email, $message);

    if (! $lead_id || ! $sent) {
        wp_send_json_error(array('message' => 'Nao foi possivel enviar a mensagem.'), 500);
    }

    wp_send_json_success(array('lead_id' => $lead_id));
}
add_action('wp_ajax_cozinha_solidaria_contact', 'cozinha_solidaria_handle_contact_form');
add_action('wp_ajax_nopriv_cozinha_solidaria_contact', 'cozinha_solidaria_handle_contact_form');

function cozinha_solidaria_contact_admin_columns($columns)
{
    return array(
        'cb' => $columns['cb'],
        'title' => 'Contato',
        'email' => 'Email',
        'message' => 'Mensagem',
        'source' => 'Origem',
        'date' => 'Data',
    );
}
add_filter('manage_cozinha_contato_posts_columns', 'cozinha_solidaria_contact_admin_columns');

function cozinha_solidaria_contact_admin_column_content($column, $post_id)
{
    if ($column === 'email') {
        $email = get_post_meta($post_id, '_cozinha_contact_email', true);

        if ($email !== '') {
            printf('<a href="mailto:%1$s">%1$s</a>', esc_attr($email));
        }
    }

    if ($column === 'message') {
        $message = get_post_meta($post_id, '_cozinha_contact_message', true);
        echo esc_html(wp_trim_words($message, 18));
    }

    if ($column === 'source') {
        $source = get_post_meta($post_id, '_cozinha_contact_source', true);

        if ($source !== '') {
            printf('<a href="%1$s" target="_blank">%2$s</a>', esc_url($source), esc_html(wp_parse_url($source, PHP_URL_HOST) ?: $source));
        }
    }
}
add_action('manage_cozinha_contato_posts_custom_column', 'cozinha_solidaria_contact_admin_column_content', 10, 2);

function cozinha_solidaria_contact_details_meta_box()
{
    add_meta_box(
        'cozinha_contact_details',
        'Dados do contato',
        'cozinha_solidaria_render_contact_details_meta_box',
        'cozinha_contato',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cozinha_solidaria_contact_details_meta_box');

function cozinha_solidaria_render_contact_details_meta_box($post)
{
    $name = get_post_meta($post->ID, '_cozinha_contact_name', true);
    $email = get_post_meta($post->ID, '_cozinha_contact_email', true);
    $message = get_post_meta($post->ID, '_cozinha_contact_message', true);
    $source = get_post_meta($post->ID, '_cozinha_contact_source', true);
    ?>
    <p><strong>Nome:</strong> <?php echo esc_html($name); ?></p>
    <p><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
    <p><strong>Origem:</strong> <?php echo $source ? '<a href="' . esc_url($source) . '" target="_blank">' . esc_html($source) . '</a>' : ''; ?></p>
    <p><strong>Mensagem:</strong></p>
    <div style="white-space:pre-wrap;background:#fff;border:1px solid #ccd0d4;padding:12px;"><?php echo esc_html($message); ?></div>
    <?php
}

function cozinha_solidaria_contact_export_button($post_type)
{
    if ($post_type !== 'cozinha_contato' || ! current_user_can('edit_posts')) {
        return;
    }

    $url = wp_nonce_url(
        admin_url('admin-post.php?action=cozinha_solidaria_export_contacts'),
        'cozinha_solidaria_export_contacts'
    );

    echo '<a class="button button-primary" href="' . esc_url($url) . '" style="margin-left:8px;">Exportar XLSX</a>';
}
add_action('restrict_manage_posts', 'cozinha_solidaria_contact_export_button');

function cozinha_solidaria_contact_export_xml($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_XML1, 'UTF-8');
}

function cozinha_solidaria_contact_export_cell($cell, $value)
{
    return '<c r="' . cozinha_solidaria_contact_export_xml($cell) . '" t="inlineStr"><is><t xml:space="preserve">' . cozinha_solidaria_contact_export_xml($value) . '</t></is></c>';
}

function cozinha_solidaria_contact_export_column_name($index)
{
    $name = '';

    while ($index > 0) {
        $index--;
        $name = chr(65 + ($index % 26)) . $name;
        $index = (int) floor($index / 26);
    }

    return $name;
}

function cozinha_solidaria_contact_export_sheet_xml($rows)
{
    $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
    $xml .= '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">';
    $xml .= '<sheetData>';

    foreach ($rows as $row_index => $row) {
        $row_number = $row_index + 1;
        $xml .= '<row r="' . $row_number . '">';

        foreach ($row as $column_index => $value) {
            $cell = cozinha_solidaria_contact_export_column_name($column_index + 1) . $row_number;
            $xml .= cozinha_solidaria_contact_export_cell($cell, $value);
        }

        $xml .= '</row>';
    }

    $xml .= '</sheetData></worksheet>';

    return $xml;
}

function cozinha_solidaria_contact_export_rows()
{
    $rows = array(
        array('Data', 'Nome', 'Email', 'Mensagem', 'Origem'),
    );

    $contacts = get_posts(array(
        'post_type' => 'cozinha_contato',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'no_found_rows' => true,
    ));

    foreach ($contacts as $contact) {
        $rows[] = array(
            get_date_from_gmt(get_gmt_from_date($contact->post_date), 'd/m/Y H:i'),
            get_post_meta($contact->ID, '_cozinha_contact_name', true),
            get_post_meta($contact->ID, '_cozinha_contact_email', true),
            get_post_meta($contact->ID, '_cozinha_contact_message', true),
            get_post_meta($contact->ID, '_cozinha_contact_source', true),
        );
    }

    return $rows;
}

function cozinha_solidaria_handle_contact_export()
{
    if (! current_user_can('edit_posts')) {
        wp_die('Voce nao tem permissao para exportar contatos.');
    }

    check_admin_referer('cozinha_solidaria_export_contacts');

    if (! class_exists('ZipArchive')) {
        wp_die('A extensao ZipArchive do PHP e necessaria para gerar arquivos XLSX.');
    }

    $temp_file = wp_tempnam('contatos-cozinha-solidaria.xlsx');

    if (! $temp_file) {
        wp_die('Nao foi possivel criar o arquivo temporario da exportacao.');
    }

    $zip = new ZipArchive();

    if ($zip->open($temp_file, ZipArchive::OVERWRITE) !== true) {
        wp_die('Nao foi possivel gerar o arquivo XLSX.');
    }

    $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/></Types>');
    $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>');
    $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets><sheet name="Contatos" sheetId="1" r:id="rId1"/></sheets></workbook>');
    $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/></Relationships>');
    $zip->addFromString('xl/worksheets/sheet1.xml', cozinha_solidaria_contact_export_sheet_xml(cozinha_solidaria_contact_export_rows()));
    $zip->close();

    while (ob_get_level()) {
        ob_end_clean();
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="contatos-cozinha-solidaria-' . gmdate('Y-m-d') . '.xlsx"');
    header('Content-Length: ' . filesize($temp_file));
    header('Cache-Control: max-age=0');

    readfile($temp_file);
    unlink($temp_file);
    exit;
}
add_action('admin_post_cozinha_solidaria_export_contacts', 'cozinha_solidaria_handle_contact_export');
