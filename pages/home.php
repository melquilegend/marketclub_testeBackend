<?php
$permission = Administracao::$permission;

if (isset($_GET['delete'])) {
    
    if (is_array($_SESSION['permissao']) && !empty($_SESSION['permissao'])) {
        $temPermissao = !empty(array_intersect($_SESSION['permissao'], $permission['editar-usuario']));
        
    if ($temPermissao) {
        $id = $_GET['delete'];

        $usuario = new Usuario();
        $usuario->deletarUsuario($id);
        if ($usuario->deletarUsuario($id)) {

            Administracao::alert('sucesso', 'Usuario deletado com sucesso');
            header('Location: ' . INCLUDE_PATH);
        } else {
            Administracao::alert('sucesso', 'Erro');
        }
    }
    } elseif (is_array($_SESSION['permissao']) && !empty($_SESSION['permissao'])) {
        $temPermissao = !empty(array_intersect($_SESSION['permissao'], $permission['delete']));
        if ($temPermissao) {
        } else {
            header('Location: ' . INCLUDE_PATH . 'naotempermisao');
            exit();
        }
    } else {
        header('Location: ' . INCLUDE_PATH . 'naotempermisao');
        exit();
    }
}
?>
<ul>
    <li class="titulo">
        <div class="texto nome">Nome</div>
        <div class="texto cpf">CPF</div>
        <div class="texto email">E-MAIL</div>
        <div class="texto data">DATA</div>
        <div class="texto status">STATUS</div>
        <div class="editar"></div>
        <div class="deletar"></div>
    </li>
    <?php
    $adicionar = in_array(2,  $_SESSION['permissao']);
    $editar = in_array(1,  $_SESSION['permissao']);
    $apagar = in_array(0,  $_SESSION['permissao']);
    $usuario = new Usuario();
    $usuariosPainel = $usuario->listarUsuarios();
    $numUsuarios = count($usuariosPainel);
    foreach ($usuariosPainel as $key => $value) {
    ?>
        <li class="dado">
            <div class="texto nome"><?php echo $value['nome'] ?></div>
            <div class="texto cpf"><?php echo formatar_cpf($value['cpf']) ?></div>
            <div class="texto email"><?php echo $value['email'] ?></div>
            <div class="texto data"><?php echo beautiful_date($value['data_criacao']) ?></div>
            <div class="texto status"><?php if ($value['status'] == 1) {
                                            echo "Ativo";
                                        } else {
                                            echo "Desativado";
                                        }
                                        ?></div>
            <?php if ($editar) { ?>
                
                    <div class="editar"><a href="<?php echo INCLUDE_PATH; ?>editar-usuario?id=<?= $value['id']; ?>"><img src="images/editar.svg"></a></div>
                
            <?php } ?>
            <?php if ($apagar) { ?>
                
                <?php if ($_SESSION['id'] != $value['id']) { ?>
                    <div class="deletar"><a href="<?php echo INCLUDE_PATH; ?>?delete=<?= $value['id']; ?>"><img src="images/deletar.svg"></a></div>
                <?php } ?>
            <?php } ?>
        </li>
    <?php } ?>
</ul>
<div class="pagina">
    <p class="resultado"><?= $numUsuarios; ?> resultados</p>
    <a href="">Anterior</a>
    <a href="">Próxima</a>
</div>
<?php if ($adicionar) { ?>
    <a class="botao_add"  href="<?php echo INCLUDE_PATH; ?>cadastrar-usuarios">Adicionar Usuario</a>
<?php } ?>