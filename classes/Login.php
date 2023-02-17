<?php
class Login
{
    public static function login($cpf, $senha)
    {

        $sql = Connection::conectar()->prepare("SELECT * FROM `usuario` WHERE `cpf` = ?");
        $sql->execute(array($cpf));

        if ($sql->rowCount() == 1) {
            $info = $sql->fetch();

            if (password_verify($senha, $info['senha'])) {
                $permissao = explode(",", $info['permissao']);

                if (in_array("3", $permissao)) {
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $info['id'];
                    $_SESSION['nome'] = $info['nome'];
                    $_SESSION['uuid'] = $info['uuid'];
                    $_SESSION['cpf'] = $cpf;
                    $_SESSION['status'] = $info['status'];
                    $_SESSION['img'] = $info['img'];
                    $_SESSION['permissao'] = $permissao;
                    if (isset($_POST['lembrar'])) {
                        setcookie('lembrar', true, time() + (60 * 60 * 24), '/');
                        setcookie('cpf', $cpf, time() + (60 * 60 * 24), '/');
                        setcookie('senha', $senha, time() + (60 * 60 * 24), '/');
                    }

                    return true;
                } else {
                    return "Você não tem permissão para fazer login.";
                }
            } else {
                return "Senha incorreta.";
            }
        } else {
            return "Usuário não encontrado.";
        }
    }
}
