<?php
require_once 'includes/header.php';
?>

    <div id="site">
        <?php if (@$_GET['url'] == '') { ?>
            <header>
                <h1>USUÁRIOS</h1>
                <form class="busca" action="">
                    <i><img src="images/lupa.svg"></i>
                    <input type="text" name="pesquisa" placeholder="Pesquisar...">
                </form>
                <figure></figure>
                <a class="sair" href="<?php echo INCLUDE_PATH ?>?loggout">sair</a>
            </header>
        <?php } else { ?>
            <header>
                <a class="voltar" href="<?php echo INCLUDE_PATH; ?>"><img src="<?php echo INCLUDE_PATH; ?>images/voltar.svg"></a>
                <?php if (@$_GET['url'] == 'cadastrar-usuarios') { ?>
                    <h1 class="total">Salvar novo usuário</h1>
                <?php } else { ?>
                    <h1 class="total">Editar usuário</h1>
                <?php } ?>
                <figure></figure>
                <a class="sair" href="<?php echo INCLUDE_PATH ?>?loggout">sair</a>
            </header>
        <?php } ?>
        <?php Administracao::carregarPagina(); ?>
    </div>
    <?php
    require_once 'includes/footer.php';
    ?>