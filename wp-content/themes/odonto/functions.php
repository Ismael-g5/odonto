<?php



//registrar taxonomias
function odonto_registrando_taxonomias(){
   register_taxonomy(
    'servicos',
    'servicos',
    array(
        'labels' => array('name' => 'Serviços'),
        'hierarchical' => true,
    )
   );
}

add_action('init', 'odonto_registrando_taxonomias');


//function para custom post type
function odonto_registrando_post_customizado(){
    register_post_type('servicos', array(
        'labels' => array('name' => 'Serviços'),
        'public' => true,
        'menu_positon' => 0,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-site'
    ));
    
}
add_action('init', 'odonto_registrando_post_customizado');
function odonto_theme_adicionando_recursos_ao_tema(){
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');

}
add_action('after_setup_theme', 'odonto_theme_adicionando_recursos_ao_tema');

function odonto_theme_registrando_menu(){
    register_nav_menu(
        'menu-navegacao',
        'Menu navegação'
    );
}

add_action('init', 'odonto_theme_registrando_menu');

//add o banner pra home

function odonto_registrando_post_customizado_banner(){
    register_post_type(
        'banners',
        array(
          'labels' => array('name' => 'Banner(Home)'),
          'public' => true,
          'menu_position' => 1,
          'menu_icon' => 'dashicons-format-image',
          'supports'=> array('title','thumbnail')
        )
    );
}
add_action('init','odonto_registrando_post_customizado_banner');

// post customizado sobre nos
function odonto_registrando_post_customizado_sobrenos(){
    register_post_type(
        'sobre_nos',
        array(
          'labels' => array('name' => 'Sobre Nós'),
          'public' => true,
          'menu_position' => 4,
          'menu_icon' => 'dashicons-format-image',
          'supports'=> array('title','editor', 'thumbnail')
        )
    );
}
add_action('init','odonto_registrando_post_customizado_sobrenos');

//Meta Box para segundo texto do Bloco 2
function odonto_registrando_metabox_block2() {
    add_meta_box(
        'ai_registrando_metabox_block2', 
        'Segundo Texto',                 
        'ai_funcao_callback_block2',     
        'sobre_nos'                       
    );
}
add_action('add_meta_boxes', 'odonto_registrando_metabox_block2');

// Função de callback para exibir o conteúdo do metabox
function ai_funcao_callback_block2($post) {
    $texto_home_1 = get_post_meta($post->ID, '_texto_block_2', true);
    ?>
    <label for="texto_block_2">Texto 2</label>
    <textarea name="texto_block_2" style="width: 100%; height: 150px;"><?php echo esc_textarea($texto_home_1); ?></textarea>
    <?php
}

// Função para salvar o valor do metabox
function odonto_salvando_dados_metabox_block2($post_id) {

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['texto_block_2'])) {
        update_post_meta($post_id, '_texto_block_2', sanitize_textarea_field($_POST['texto_block_2']));
    }
}
add_action('save_post', 'odonto_salvando_dados_metabox_block2');


//Fim do Meta Box


// Meta Box para ícones do Bloco 2
function odonto_registrando_metabox_icons_text() {
    add_meta_box(
        'ai_registrando_metabox_icons_text',
        'Ícones e Textos',
        'ai_funcao_callback_icons_text',
        'sobre_nos'
    );
}
add_action('add_meta_boxes', 'odonto_registrando_metabox_icons_text');

function ai_funcao_callback_icons_text($post) {
    $icons_text_data = get_post_meta($post->ID, '_icons_text_data', true) ?: [];
    ?>
    <div id="icons-text-container">
        <?php foreach ($icons_text_data as $index => $data): ?>
            <div class="icons-text-group">
                <label for="icons_text_<?= $index ?>_icon">Ícone</label>
                <input type="file" name="icons_text[<?= $index ?>][icon]" />
                <?php if (!empty($data['icon'])): ?>
                    <img src="<?= esc_url($data['icon']) ?>" style="max-width: 100px; max-height: 100px;" alt="Ícone atual" />
                <?php endif; ?>

                <label for="icons_text_<?= $index ?>_text">Texto</label>
                <textarea name="icons_text[<?= $index ?>][text]" style="width: 100%; height: 50px;"><?= esc_textarea($data['text']) ?></textarea>

                <button type="button" class="remove-icons-text">Remover</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" id="add-icons-text">Adicionar Ícone e Texto</button>

    <script>
        (function($){
            let index = <?= count($icons_text_data) ?>;

            $('#add-icons-text').click(function(){
                $('#icons-text-container').append(`
                    <div class="icons-text-group">
                        <label for="icons_text_${index}_icon">Ícone</label>
                        <input type="file" name="icons_text[${index}][icon]" />

                        <label for="icons_text_${index}_text">Texto</label>
                        <textarea name="icons_text[${index}][text]" style="width: 100%; height: 50px;"></textarea>

                        <button type="button" class="remove-icons-text">Remover</button>
                    </div>
                `);
                index++;
            });

            $('#icons-text-container').on('click', '.remove-icons-text', function(){
                $(this).closest('.icons-text-group').remove();
            });
        })(jQuery);
    </script>
    <?php
}

function odonto_salvando_dados_icons_text($post_id) {
    if (isset($_POST['icons_text']) && is_array($_POST['icons_text'])) {
        $icons_text_data = [];

        foreach ($_POST['icons_text'] as $index => $data) {
            if (isset($_FILES['icons_text']['name'][$index]['icon']) && $_FILES['icons_text']['name'][$index]['icon']) {
                $upload = wp_upload_bits($_FILES['icons_text']['name'][$index]['icon'], null, file_get_contents($_FILES['icons_text']['tmp_name'][$index]['icon']));
                if (!$upload['error']) {
                    $data['icon'] = $upload['url'];
                }
            } else {
                $data['icon'] = sanitize_text_field($data['icon']);
            }

            $icons_text_data[] = [
                'icon' => esc_url_raw($data['icon']),
                'text' => sanitize_textarea_field($data['text']),
            ];
        }

        update_post_meta($post_id, '_icons_text_data', $icons_text_data);
    } else {
        delete_post_meta($post_id, '_icons_text_data');
    }
}
add_action('save_post', 'odonto_salvando_dados_icons_text');




function odonto_registrando_post_informacoes(){
    register_post_type('cabecalho', array(
        'labels' => array('name' => 'Cabeçalho(Informações)'),
        'public' => true,
        'menu_positon' => 3,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-site'
    ));
    
}
add_action('init', 'odonto_registrando_post_informacoes');

function odonto_registrando_metabox(){
    add_meta_box(
        'ai_registrando_metabox',
        'Texto para a home',
        'ai_funcao_callback',
        'banners'
    );
}
add_action('add_meta_boxes','odonto_registrando_metabox');
function ai_funcao_callback($post){

    $texto_home_1 = get_post_meta($post->ID,'_texto_home_1', true);
    $texto_home_2 = get_post_meta($post->ID,'_texto_home_2', true);
    ?>
    <label for="texto_home_1">Texto 1</label>
    <input type="text" name="texto_home_1" style="width: 100%" value="<?= $texto_home_1 ?>"/>
    <br>
    <br>
    <label for="texto_home_2">Texto 2</label>
    <input type="text" name="texto_home_2" style="width: 100%" value="<?= $texto_home_2 ?>"/>
    <?php
}

function odonto_salvando_dados_metabox($post_id){
    foreach( $_POST as $key=>$value){
        if($key !== 'texto_home_1' && $key !== 'texto_home_2'){
            continue;
        }

        update_post_meta(
              $post_id,
            '_'. $key,
            $_POST[$key]
        );
    }
}
add_action('save_post','odonto_salvando_dados_metabox');
function pegandoTextosParaBanner()
{

    $args = array(
        'post_type' => 'banners',
        'post_status' => 'publish',
        'posts_per_page' => 1
    );

    $query = new WP_Query($args);
    if ($query->have_posts()):
        while ($query->have_posts()): $query->the_post();
            $texto1 = get_post_meta(get_the_ID(), '_texto_home_1', true);
            $texto2 = get_post_meta(get_the_ID(), '_texto_home_2', true);
            return array(
                'texto_1' => $texto1,
                'texto_2' => $texto2
            );
        endwhile;
    endif;
}
function odonto_adicionando_scripts()
{

    $textosBanner = pegandoTextosParaBanner();

    if (is_front_page()) {
        wp_enqueue_script('typed-js', get_template_directory_uri() . '/assets/js/typed.min.js', array(), false, true);
        wp_enqueue_script('texto-banner-js', get_template_directory_uri() . '/assets/js/texto-banner.js', array('typed-js'), false, true);
        wp_localize_script('texto-banner-js', 'data', $textosBanner);
    }
}

add_action('wp_enqueue_scripts', 'odonto_adicionando_scripts');