<?php
$estiloPagina = 'home.css';
require_once 'header.php';

$args = array(
    'post_type' => 'banners',
    'post_status' => 'publish',
    'posts_per_page' => 1
);

$query = new WP_Query($args);
if($query->have_posts()):
    while($query->have_posts()): $query->the_post();
    ?>
    <main>
        <div class="imagem-banner">
        <img class="img-banner-home" style="height: 80vh; width: 100%;"  src="<?php the_post_thumbnail_url();?>">
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
    <div class="row">
        <div class="col-md-6">
            teste 1    
        </div>
        <div class="col-md-6">
            teste 2    
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>
