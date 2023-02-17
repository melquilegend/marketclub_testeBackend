<?php
$permission = Administracao::$permission;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id = $_GET['id'];
    $sql = Connection::conectar()->prepare("SELECT * FROM `usuario` WHERE id = ?");
    $sql->execute(array($id));
    $info = $sql->fetch();
}
if (in_array($_SESSION['permissao'], $permission['editar-usuario'])) {
} elseif (is_array($_SESSION['permissao']) && !empty($_SESSION['permissao'])) {
    
    $temPermissao = !empty(array_intersect($_SESSION['permissao'], $permission['editar-usuario']));
    if ($temPermissao) {
        
    } /*elseif(is_array($_SESSION['permissao']) && !empty($_SESSION['permissao'])) {
        var_dump($_SESSION['permissao'],$info['permissao']);
        $temPermissao = !empty(array_intersect($_SESSION['permissao'], explode( ',', $info['permissao'])));
    }*/else{
        header('Location: ' . INCLUDE_PATH . 'naotempermisao');
        exit();
    }
} else {

    header('Location: ' . INCLUDE_PATH . 'naotempermisao');
    exit();
}
?>
<?php

$adicionar = in_array(2,  $_SESSION['permissao']);
$editar = in_array(1,  $_SESSION['permissao']);
$apagar = in_array(0,  $_SESSION['permissao']);
?>
<form class="cadastro" method="post" enctype="multipart/form-data">
    <?php
    if (isset($_POST['acao'])) {
        //Enviei o meu formulário./
        $id;
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $status = $_POST['status'];
        $imagem = $_FILES['imagem'];
        $permissao = $_POST['permissao'];
        $imagem_atual = $_POST['imagem_atual'];
        $usuario = new Usuario();
        if ($imagem['name'] != '') {

            //Existe o upload de imagem.
            if (Administracao::imagemValida($imagem)) {
                Administracao::deleteFile($imagem_atual);
                $imagem = Administracao::uploadFile($imagem);

                if ($usuario->atualizarUsuario($nome, $cpf, $email, $senha, $status, $imagem, $permissao, $id)) {
                    $info['img'] = $imagem;
                    Administracao::alert('sucesso', 'Atualizado com sucesso junto com a imagem!');
                    header('Location: ' . INCLUDE_PATH);
                } else {
                    Administracao::alert('erro', 'Ocorreu um erro ao atualizar junto com a imagem');
                }
            } else {
                Administracao::alert('erro', 'O formato da imagem não é válido');
            }
        } else {
            $imagem = $imagem_atual;
            if ($usuario->atualizarUsuario($nome, $cpf, $email, $senha, $status, $imagem, $permissao, $id)) {
                Administracao::alert('sucesso', 'Atualizado com sucesso!');
                header('Location: ' . INCLUDE_PATH);
            } else {
                Administracao::alert('erro', 'Ocorreu um erro ao atualizar...');
            }
        }
    }
    ?>
    <div class="input">
        <label for="input_nome">Nome:</label>
        <input type="text" id="input_nome" name="nome" value="<?= $info['nome']; ?>" placeholder="Digite um nome">
    </div>
    <div class="input">
        <label for="input_cpf">CPF:</label>
        <input type="text" id="input_cpf" name="cpf" value="<?= $info['cpf']; ?>" placeholder="Digite um CPF">
    </div>
    <div class="input">
        <label for="input_email">E-mail:</label>
        <input type="text" id="input_email" name="email" value="<?= $info['email']; ?>" placeholder="Digite um e-mail">
    </div>
    <div class="input">
        <label for="input_senha">Mudar Senha:</label>
        <input type="password" id="input_senha" name="senha" value="" placeholder="Digite nova senha">
    </div>
    <div>
        <input class="custom-file-input" type="file" name="imagem">
        <input class="custom-file-input" type="hidden" name="imagem_atual" value="<?php echo $info['img']; ?>">
        <?php if ($info['img'] != '') : ?>
            <img src="<?php echo INCLUDE_PATH . 'uploads/' . $info['img']; ?>" width="150">
        <?php endif; ?>
    </div>
    <div class="select">
        <label for="input_status">Status</label>
        <select name="status" id="input_status">
            <option value="">Escolha uma opção</option>
            <option value="1" <?= ($info['status'] == 1) ? 'selected' : '' ?>>Ativo</option>
            <option value="0" <?= ($info['status'] == 2) ? 'selected' : '' ?>>Inativo</option>
        </select>
        <div class="seta"><img src="<?php echo INCLUDE_PATH; ?>images/seta.svg" alt=""></div>
    </div>

    <h2>Permissão</h2>
    <div class="permissao">
    <?php if ($adicionar) { ?>
        <div class="checkbox">
            <input type="checkbox" id="input_permissao_login" name="permissao[]" value="3" <?php if (strpos($info['permissao'], '3') !== false) echo 'checked'; ?>>
            <div class="check"><img src="<?php echo INCLUDE_PATH; ?>images/check.svg"></div>
            <label for="input_permissao_login">Login</label>
        </div>
    <?php } ?>
        <?php if ($adicionar) { ?>
            <div class="checkbox">
                <input type="checkbox" id="input_permissao_usuario_add" name="permissao[]" value="2" <?php if (strpos($info['permissao'], '2') !== false) echo 'checked'; ?>>
                <div class="check"><img src="<?php echo INCLUDE_PATH; ?>images/check.svg"></div>
                <label for="input_permissao_usuario_add">Add usuário</label>
            </div>
        <?php } ?>
        <?php if ($editar) { ?>
            <div class="checkbox">
                <input type="checkbox" id="input_permissao_usuario_editar" name="permissao[]" value="1" <?php if (strpos($info['permissao'], '1') !== false) echo 'checked'; ?>>
                <div class="check"><img src="<?php echo INCLUDE_PATH; ?>images/check.svg"></div>
                <label for="input_permissao_usuario_editar">Editar usuário</label>
            </div>
        <?php } ?>
        <?php if ($apagar) { ?>
            <div class="checkbox">
                <input type="checkbox" id="input_permissao_usuario_deletar" name="permissao[]" value="0" <?php if (strpos($info['permissao'], '0') !== false) echo 'checked'; ?>>
                <div class="check"><img src="<?php echo INCLUDE_PATH; ?>images/check.svg"></div>
                <label for="input_permissao_usuario_deletar">Deletar usuário</label>
            </div>
        <?php } ?>
    </div>

    <button type="submit" name="acao">SALVAR</button>
</form>