<?php
$estiloPagina = 'home.css';
require_once 'header.php';
?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner slide-top">
        <div class="carousel-item active">

            <?php
            $argsBanner = array(
                'post_type' => 'banners',
                'post_status' => 'publish',
                'posts_per_page' => 1
            );

            $queryBanner = new WP_Query($argsBanner);


            if ($queryBanner->have_posts()):
                while ($queryBanner->have_posts()): $queryBanner->the_post();

                    $imagem_banner_1 = get_field('imagem_banner_1');

            ?>
                    <img class="img-slide-1" src="<?php echo esc_url($imagem_banner_1); ?>" alt="First slide">
            <?php

                endwhile;
            else :
                // Código para quando nenhum post é encontrado
                echo 'Nenhuma Imagem encontrada';
            endif;

            ?>

        </div>

            <!-- segundo slide -->
        <div class="carousel-item">
       
            <?php
            $argsBanner2 = array(
                'post_type' => 'banners',
                'post_status' => 'publish',
                'posts_per_page' => 1
            );

            $queryBanner2 = new WP_Query($argsBanner2);


            if ($queryBanner2->have_posts()):
                while ($queryBanner2->have_posts()): $queryBanner2->the_post();

                    $imagem_banner_2 = get_field('imagem_banner_2');

            ?>
                    <img class="image-slide-2" src="<?php echo esc_url($imagem_banner_2); ?>" alt="Second slide">
            <?php

                endwhile;
            else :
                // Código para quando nenhum post é encontrado
                echo 'Nenhuma Imagem encontrada';
            endif;

            ?>
       
       
        </div>



        <!-- terceiro slide -->
        <div class="carousel-item">

            <?php
            $argsBanner3 = array(
                'post_type' => 'banners',
                'post_status' => 'publish',
                'posts_per_page' => 1
            );

            $queryBanner3 = new WP_Query($argsBanner3);


            if ($queryBanner3->have_posts()):
                while ($queryBanner3->have_posts()): $queryBanner3->the_post();

                    $imagem_banner_3 = get_field('imagem_banner_3');

            ?>
                    <img class="image-slide-3" src="<?php echo esc_url($imagem_banner_3); ?>" alt="Third slide">
            <?php

                endwhile;
            else :
                // Código para quando nenhum post é encontrado
                echo 'Nenhuma Imagem encontrada';
            endif;

            ?>

        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>

<div class="container mt-5">
    <div class="row health-cpr">
        <div class="col-md-6 content-about-us">
            <?php
            // Recupera o valor do metabox para o tipo de post 'sobre_nos'
            $argsAB = array(
                'post_type' => 'sobre_nos',
                'post_status' => 'publish',
                'posts_per_page' => 1
            );

            $queryAB = new WP_Query($argsAB);

            if ($queryAB->have_posts()):
                while ($queryAB->have_posts()): $queryAB->the_post();

                    $post_id = get_the_ID();
                    $texto_block_2 = get_post_meta($post_id, '_texto_block_2', true);
                    $icons_text_data = get_post_meta($post_id, '_icons_text_data', true);
            ?>
                    <span class="center-title" style="color: #13297E; font-weight: 700; text-align: left;"><?php the_title(); ?></span>
                    <article class="center-title-con">
                        <h2 class="title-second-health">
                            <?php the_content(); ?>
                        </h2>
                    </article>
                    <div class="about-desc about-points d-flex align-items-center justify-content-center">
                        <?php echo esc_html($texto_block_2); ?>
                    </div>
                    <hr class="line-separation mt-5">

                    <div class="icons">
                        <?php
                        $icones_texto = get_field('icones_texto');
                        if ($icones_texto): ?>
                            <div id="icones_texto_itens" class="row icones_itens">
                                <div id="content-icon-1" class="col-md-4 icon-text-1">
                                    <div class="image-icon-1 d-flex align-items-center justify-content-center">
                                        <img src="<?php echo esc_url($icones_texto['icone_1']); ?>" alt="Icone 1" />
                                    </div>
                                    <div id="text-icon-1" class="content texto-1 text-center">
                                        <b><?php echo esc_html($icones_texto['texto_1']); ?></b>
                                    </div>
                                </div>

                                <div id="content-icon-2" class="col-md-4 icon-text-2">
                                    <div class="image-icon-2 d-flex align-items-center justify-content-center">
                                        <img src="<?php echo esc_url($icones_texto['icone_2']); ?>" alt="Icone 2" />
                                    </div>
                                    <div id="text-icon-2" class="content texto-2 text-center">
                                        <b><?php echo esc_html($icones_texto['texto_2']); ?></b>
                                    </div>
                                </div>
                                <div id="content-icon-3" class="col-md-4 icon-text-3">
                                    <div class="image-icon-3 d-flex align-items-center justify-content-center">
                                        <img src="<?php echo esc_url($icones_texto['icone_3']); ?>" alt="Icone 3" />
                                    </div>
                                    <div id="text-icon-3" class="content texto-3 text-center">
                                        <b><?php echo esc_html($icones_texto['texto_3']); ?></b>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
            <?php
                endwhile;
            endif;
            ?>
        </div>
        <div class="col-md-6 image-about-us d-none d-sm-block">
            <div class="img-second-block d-flex justify-content-center align-items-center" style="height: 70vh;">
                <img class="rounded image-abt" width="400" src="<?php the_post_thumbnail_url(); ?>">
            </div>
        </div>
    </div>
</div>

<section class="services front-service mt-5" id="front-service">
    <article class="center-title-con">
        <span class="center-title service">Nossos Serviços</span>
        <h2 class="center-heading serv">Serviços de atendimento integral para sua saúde</h2>
    </article>

    <?php
    // Bloco de serviços
    $args = array(
        'post_type' => 'servicos',
    );

    $query = new WP_Query($args);
    if ($query->have_posts()):
        echo '<main class="services-con">';
        echo '<div class="row gap-5 services-odonto d-flex align-items-center justify-content-center">';
        while ($query->have_posts()): $query->the_post();

            $servico_title = get_the_title();
            echo '<div class="col-md-3 card-servicos" data-servico="' . esc_attr($servico_title) . '">';
            echo '<div class="card card-service">';

            echo '<div class="card-icon">';
            $icones_card = get_field('icone_card');
            echo '<img src="' . esc_url($icones_card) . '">';
            echo '</div>';

            echo '<div class="card-title">';
            the_title('<h3 class="titulo-servicos">', '</h3>');
            echo '</div>';

            echo '<div class="card-desc">';
            $content = get_the_content(); // Pega o conteúdo completo
            $trimmed_content = wp_trim_words($content, 15, '...'); // Limita a 15 palavras e adiciona '...' no final
            echo '<p>' . esc_html($trimmed_content) . '</p>';
            echo '</div>';

            $urlSM = get_field('linksaiba_mais');
            echo '<a href="' . esc_url($urlSM) . '" class=" btn__text front-service-btn">';
            echo 'Saiba Mais';
            echo '</a>';

            echo '</div>';
            echo '</div>';

        endwhile;
        echo '</div>';
        echo '</main>';
    endif;
    // Fim do bloco de serviços
    ?>

    <!-- Adiciona o formulário do Contact Form 7 aqui -->
    <div class="contact-form-section">
        <?php echo do_shortcode('[contact-form-7 id="4dd9e4f" title="Contact form 1"]'); ?>
    </div>
    
</section>

<script>
    jQuery(document).ready(function($) {
        $('#pesquisar').click(function(e) {
            e.preventDefault();

            var selectedService = $('#servicos').val().toLowerCase();

            $('.card-servicos').each(function() {
                var servicoTitle = $(this).data('servico').toLowerCase();

                if (selectedService === "" || servicoTitle === selectedService) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

<?php
require_once 'footer.php';
?>