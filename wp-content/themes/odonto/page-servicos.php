<?php
$estiloPagina = 'servicos.css';
require_once 'header.php';
?>

<div class="row submit d-flex justify-content-center align-items-center px-5">
<h2 class="title-services text-center">Conheça nossos Serviços</h2>

    <div class="col-md-3 mb-3">
    <form action="#" class="container-odonto formulario-pesquisa-servicos">
        <select name="servicos" id="servicos">
            <option value="">--Selecione--</option>
            <?php
            // pega todos os termos da taxonomia 'servicos'
            $servico = get_terms(array('taxonomy' => 'servicos'));
            foreach ($servico as $servicos): ?>
                <option value="<?= $servicos->name ?>"
                    <?= !empty($_GET['servicos']) && $_GET['servicos'] === $servicos->name ? 'selected' : '' ?>><?= $servicos->name ?></option>
            <?php endforeach;
            ?>
        </select>

    </form>
    </div>
    <div class="col-md-3 mt-4 pt-3">
    <div class="button-submit mb-3">
        <button type="submit" id="pesquisar" style="border: none; background: none;">
            <i class="fas fa-search" style="font-size: 24px;"></i>
        </button>
    </div>
</div>

</div>

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