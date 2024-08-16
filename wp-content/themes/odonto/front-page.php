<?php
$estiloPagina = 'home.css';
require_once 'header.php';



$args = array(
    'post_type' => 'banners',
    'post_status' => 'publish',
    'posts_per_page' => 1
);

$query = new WP_Query($args);
if ($query->have_posts()):
    while ($query->have_posts()): $query->the_post();
?>
        <main>
            <div class="imagem-banner img-fluid">
                <img class="img-banner-home" style="height: 80vh; width: 100%;" src="<?php the_post_thumbnail_url(); ?>">
            </div>
            <div class="texto-banner-dinamico">
                <span id="texto-banner"></span>
            </div>
        </main>
<?php
    endwhile;
endif;
?>
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
                    <div class="about-desc">
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
</div>

<section class="services front-service mt-5" id="front-service">

    <article class="center-title-con">
        <span class="center-title service">Nossos Serviços</span>
        <h2 class="center-heading serv">Serviços de atendimento integral para sua saúde</h2>
    </article>
    <?php
    //inicio bloco serviços
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
            echo '<div  class="card card-service">';

            echo '<div class="card-icon">';
            $icones_card = get_field('icone_card');
            echo '<img src="' . $icones_card . '">';
            echo '</div>';

            echo '<div class="card-title">';
            the_title('<h3 class="titulo-servicos">', '</h3>');
            echo '</div>';

            echo '<div class="card-desc">';
            $content = get_the_content(); // Pega o conteúdo completo
            $trimmed_content = wp_trim_words($content, 15, '...'); // Limita a 20 palavras e adiciona '...' no final
            echo '<p>' . $trimmed_content . '</p>';
            echo '</div>';

            $urlSM = get_field('linksaiba_mais');
            echo '<a href="' . $urlSM . '" class=" btn__text front-service-btn">';
            echo 'Saiba Mais';
            echo '</a>';

            echo '</div>';
            echo '</div>';

        endwhile;
        echo '</div>';
        echo '</main>';
    endif;
    //fim bloco servicos
    ?>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        $('#pesquisar').click(function(e) {
            e.preventDefault();

            var selectedService = $('#servicos').val().toLowerCase();

            $('.servicos').each(function() {
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


</div>



<?php
require_once 'footer.php';
?>