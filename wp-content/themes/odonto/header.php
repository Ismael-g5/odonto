<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/css/global.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/css/normalize.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/css/header.css' ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/css/' . $estiloPagina ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/css/footer.css' ?>">
</head>

<body <?php body_class(); ?>>
    <header class="site-header informations d-none d-sm-block">
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
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                        <div class="itens-information" style="color: white; gap: 5px;">
                            <img class="icon-content" width="20" height="20" src="<?php the_post_thumbnail_url() ?>">
                            <div class="content-itens">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <?php $urlTemplate = esc_url(get_template_directory_uri()); ?>
            <div class="icon-socials" style="gap: 20px;">
                <div class="icon-whatsapp">
                    <a href="#">

                        <img src="<?php echo $urlTemplate; ?>/assets/images/icon-whz.png">
                    </a>
                </div>
                <div class="icon-instagram">
                    <a href="#">
                        <img src="<?php echo $urlTemplate; ?>/assets/images/icon-instagram.png">
                    </a>
                </div>
                <div class="icon-linkedIn">
                    <a href="#">
                        <img src="<?php echo $urlTemplate; ?>/assets/images/icon-lkn.png">
                    </a>
                </div>
                <div class="icon-facebook">
                    <a href="#">
                        <img src="<?php echo $urlTemplate; ?>/assets/images/icon-facebook.png">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <header class="site-header-main">
        <div class="container-odonto">
            <?php the_custom_logo(); ?>
            <div class="menu-desktop d-none d-sm-block">
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
            </div>
            <div class="button-appointment d-none d-sm-block mt-5 pt-2">
                <button type="button" class="btn btn-primary btn-appointment">Marcar Consulta</button>
            </div>

            <nav class="navbar navbar-dark d-sm-none d-block" style="background-color: white;">
                <div class="container-fluid" style="height: 50px;">
                    <button class="navbar-toggler" style="background-color:#13297e;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
    </header>

    <div class="collapse" id="navbarToggleExternalContent" data-bs-theme="light">
        <div class="bg-light p-4">
            <div class="itens-menu-mobile text-dark d-flex">
                <div class="menu-mobile-items">
                    <?php
                    wp_nav_menu(
                        array(
                            'menu' => 'menu-navegacao',
                            'menu_id' => 'menu-principal'
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>



    <?php wp_footer(); ?>
</body>

</html>