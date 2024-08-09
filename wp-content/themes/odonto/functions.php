<?php

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