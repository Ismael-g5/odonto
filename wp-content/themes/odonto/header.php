<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/normalize.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/header.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/' . $estiloPagina ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/footer.css' ?>">


</head>

<body <?php body_class(); ?>>
    <header class="site-header informations">
        <div class="container-odonto">
            <div style="gap: 100px;">
                <?php

                $args = array(
                    'post_type' => 'cabecalho',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'ASC'
                );

                $query = new WP_Query($args);

                if ($query->have_posts()): ?>
                    <?php

                    while ($query->have_posts()): $query->the_post();
                    ?>
                        <div class="itens-information" style="color: white">
                         <img class="icon-content" width="20" height="20" src="<?php the_post_thumbnail_url()?>">

                        <?php
                        the_content();
                        ?>
                        </div>
                <?php
                    endwhile;
                endif;
                ?>
            </div>
            </nav>
        </div>
    </header>





    <header class="site-header-main">
        <div class="container-odonto">
            <?php
            the_custom_logo();
            ?>
            <nav>
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'menu-navegacao',
                        'menu_id' => 'menu-principal'
                    )
                );
                ?>
            </nav>
        </div>
    </header>