<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/normalize.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/header.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/' . $estiloPagina ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/css/footer.css' ?>">


</head>

<body <?php body_class(); ?>>
    <header class="site-header informations">
        <div class="container-odonto">
            <div style="gap: 50px;">
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
                        <div class="itens-information" style="color: white; gap: 5px;">
                            <img class="icon-content" width="20" height="20" src="<?php the_post_thumbnail_url()?>">
                      <div class="content-itens mt-3">
                      <?php
                        the_content();
                        ?>
                       </div>
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
            <nav class="menu-main" style="margin-left: -35%;">
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'menu-navegacao',
                        'menu_id' => 'menu-principal'
                    )
                );
                ?>
            </nav>
            <div class="button-appointment">
            <button type="button" class="btn btn-primary btn-appointment">Marcar Consulta</button>
            </div>
        </div>
    </header>