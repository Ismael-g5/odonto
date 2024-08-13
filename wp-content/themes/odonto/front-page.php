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
            <div class="imagem-banner">
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
<div class="container">
    <div class="row services">
        <div class="col-md-6">

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
                    <div class="icons-about-us d-flex">
                        <?php
                        if (!empty($icons_text_data)) {
                            foreach ($icons_text_data as $item) {
                                ?>
                                <div class="icon-text-item">
                                    <?
                                    $teste = $item['icon'];
                                    print_r($teste);?>
                                    <img src="<?php echo esc_url($item['icon']); ?>" alt="Ícone" style="max-width: 50px; max-height: 50px; margin-right: 10px;">
                                    <p><?php echo esc_html($item['text']); ?></p>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
            <?php
                endwhile;
            endif;
            ?>

        </div>
        <div class="col-md-6 text-center">
            <img width="400" height="500" src="<?php the_post_thumbnail_url();?>">
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
