<?php
$estiloPagina = 'sobre_nos.css';
require_once 'header.php';


if (have_posts()):
?>
    <main class="main-sobre-nos">
        <?php
        while (have_posts()): the_post();
            the_post_thumbnail('post_thumbnail', array('class' => 'imagem-sobre-nos'));
            echo '<div class="conteudo container-odonto">';
                the_title('<h2>', '</h2>');
                the_content();
            echo '</div>';
        endwhile;
        ?>
    </main>
<?php
endif;
require_once 'footer.php';