<?php
$estiloPagina = 'servicos.css';
require_once 'header.php';
?>

<form action="#" class="container-odonto formulario-pesquisa-servicos">
    <h2>Conheça nossos destinos</h2>
    <select name="servicos" id="servicos">
        <option value="">--Selecione--</option>
        <?php
            $servicos = get_terms(array('taxonomy' => 'servicos'));
            foreach($servicos as $servico):?>
                <option value="<?= $servico->name ?>"><?= $servico->name ?></option>
            <?php endforeach;
        ?>
    </select>
    <input type="submit" value="Pesquisar">
</form>

<?php
$args = array('post_type' => 'servicos' );
$query = new WP_Query($args);
if ($query->have_posts()):
    echo '<main class="page-servicos">';
    echo '<ul class="lista-servicos container-odonto">';
    while($query->have_posts()): $query->the_post();
        echo '<li class="col-md-3 servicos" >';
        the_post_thumbnail();
        the_title('<p class="titulo-servicos">','</p>');
        the_content();
        echo '</li>';
    endwhile;
    echo '</ul>';
    echo '</main>';
endif;
require_once 'footer.php';