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