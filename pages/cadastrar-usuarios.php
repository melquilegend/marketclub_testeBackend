<?php
$permission = Administracao::$permission;
if (in_array($_SESSION['permissao'], $permission['editar-usuario'])) {
} elseif (is_array($_SESSION['permissao']) && !empty($_SESSION['permissao'])) {
    $temPermissao = !empty(array_intersect($_SESSION['permissao'], $permission['cadastrar-usuarios']));

    if ($temPermissao) {
    } else {
        header('Location: ' . INCLUDE_PATH . 'naotempermisao');
        exit();
    }
} else {

    header('Location: ' . INCLUDE_PATH . 'naotempermisao');
    exit();
}
?>
<form method="post" enctype="multipart/form-data" class="cadastro">
    <?php
    if (isset($_POST['acao'])) {

        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $status = $_POST['status'];
        $imagem = $_FILES['imagem'];
        $permissao = isset($_POST['permissao']) ? $_POST['permissao'] : array();
        #var_dump($nome, $cpf, $email, $senha, $status, $imagem, $permissao);exit;

        if ($nome == '') {
            Administracao::alert('erro', 'O nome Esta Vázio');
        } else if ($cpf == '') {
            Administracao::alert('erro', 'O Username Esta Vázio');
        } else if ($email == '') {
            Administracao::alert('erro', 'O Email Esta Vázio');
        } else if ($senha == '') {
            Administracao::alert('erro', 'A senha Esta Vázia');
        } else if ($permissao == array()) {
            Administracao::alert('erro', 'O permissao precisa estar selecionado');
        } else if ($status == '') {
            Administracao::alert('erro', 'A status precisa ser selecionada');
        } elseif ($imagem['name'] == '') {
            Administracao::alert('erro', 'A imagem precisa ser selecionada');
        } else {
            if (Administracao::imagemValida($imagem) == false) {
                Administracao::alert('erro', 'O formato especificado não esta correcto');
            } else if (Usuario::emailExist($email)) {
                Administracao::alert('erro', 'Este email ja existe');
            } else if (Usuario::cpfexits($cpf)) {
                Administracao::alert('erro', 'O numero de CPF já esiste no sistema');
            } else {
                $usuario = new Usuario();
                $imagem = Administracao::uploadFile($imagem);
                $usuario->cadastrarUsuario($nome, $cpf, $email, $senha, $status, $imagem, $permissao);
                Administracao::alert('sucesso', 'O cadastro do Usuario Foi enviado com sucesso');
                header('Location: ' . INCLUDE_PATH);
            }
        }
    } elseif (isset($_POST['salvar'])) {
        $nome = $_POST['nome'];
        $user = $_POST['usuario'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $status = $_POST['status'];
        $imagem = $_FILES['imagem'];
        $permissao = isset($_POST['permissao']) ? $_POST['permissao'] : array();
    }
    ?>
    <div class="input">
        <label for="input_nome">Nome:</label>
        <input type="text" id="input_nome" name="nome" placeholder="Digite um nome">
    </div>
    <div class="input">
        <label for="input_cpf">CPF:</label>
        <input type="text" id="input_cpf" name="cpf" placeholder="Digite um CPF">
    </div>
    <div class="input">
        <label for="input_email">E-mail:</label>
        <input type="text" id="input_email" name="email" placeholder="Digite um e-mail">
    </div>
    <div class="input">
        <label for="input_senha">Senha:</label>
        <input type="password" id="input_senha" name="senha" placeholder="Digite uma senha">
    </div>
    <div class="select">
        <label for="input_status">Status</label>
        <select name="status" id="input_status">
            <option value="">Escolha uma opção</option>
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
        </select>
        <div class="seta"><img src="<?php echo INCLUDE_PATH; ?>images/seta.svg" alt=""></div>
    </div>
    <div class="">
        <input class="custom-file-input" type="file" name="imagem">
    </div>
    <h2>Permissão</h2>
    <div class="permissao">
        <div class="checkbox">
            <input type="checkbox" id="input_permissao_login" name="permissao[]" value="3">
            <div class="check"><img src="<?php echo INCLUDE_PATH; ?>images/check.svg"></div>
            <label for="input_permissao_login">Login</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="input_permissao_usuario_add" name="permissao[]" value="2" disabled>
            <div class="check"><img src="<?php echo INCLUDE_PATH; ?>images/check.svg"></div>
            <label for="input_permissao_usuario_add">Add usuário</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="input_permissao_usuario_editar" name="permissao[]" value="1" disabled>
            <div class="check"><img src="<?php echo INCLUDE_PATH; ?>images/check.svg"></div>
            <label for="input_permissao_usuario_editar">Editar usuário</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="input_permissao_usuario_deletar" name="permissao[]" value="0" disabled>
            <div class="check"><img src="<?php echo INCLUDE_PATH; ?>images/check.svg"></div>
            <label for="input_permissao_usuario_deletar">Deletar usuário</label>
        </div>
    </div>
    <button type="submit" name="acao">SALVAR</button>
</form>