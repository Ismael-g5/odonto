<?php
$estiloPagina = 'servicos.css';
require_once 'header.php';
?>
    <form action="#" class="container-odonto formulario-pesquisa-servicos">
        <h2>Conheça nossos destinos</h2>
        <select name="servicos" id="servicos">
            <option value="">--Selecione--</option>
            <?php
            // pega todos os termos da taxonomia 'servicos'
            $servico = get_terms(array('taxonomy' => 'servicos'));
            foreach ($servico as $servicos):?>
                <option value="<?= $servicos->name ?>"
                <?= !empty($_GET['servicos']) && $_GET['servicos'] === $servicos->name ? 'selected' : '' ?>><?= $servicos->name ?></option>
            <?php endforeach;
            ?>
        </select>
        <input type="submit" value="Pesquisar" id="pesquisar">
    </form>

<?php
$args = array(
    'post_type' => 'servicos',
);

$query = new WP_Query($args);
if ($query->have_posts()):
    echo '<main class="page-servicos">';
    echo '<ul class="lista-servicos container-odonto">';
    while ($query->have_posts()): $query->the_post();

    $servico_title = get_the_title(); 
        echo '<li class="col-md-3 servicos" data-servico="' . esc_attr($servico_title) . '">';
        the_post_thumbnail();
        the_title('<p class="titulo-servicos">', '</p>');
        the_content();
        echo '</li>';
    endwhile;
    echo '</ul>';
    echo '</main>';
endif;
require_once 'footer.php';
?>

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
