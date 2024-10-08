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
        if (is_front_page()) {
            wp_enqueue_script('texto-banner-js', get_template_directory_uri() . '/assets/js/default.js', array(), false, true);
        }
    }
}

add_action('wp_enqueue_scripts', 'odonto_adicionando_scripts');


//tamanho customizado imagens card
function odonto_custom_image_sizes() {
    add_image_size('custom-size', 500, 700, true); // Largura 300px, altura 200px, hard crop
}
add_action('after_setup_theme', 'odonto_custom_image_sizes');
