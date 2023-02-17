<?php

class Usuario
{

	public function atualizarUsuario($nome, $cpf, $email, $senha, $status, $imagem, $permissao, $id)
	{
		if ($senha == empty($senha)) {
			$sql = Connection::conectar()->prepare("UPDATE `usuario` SET nome = ?, cpf = ?, email = ?, status= ?, permissao=?, img = ?, data_atualizacao =?	 WHERE id = ?");
			$permissoes_str = implode(",", $permissao);
			$data_atualizacao = date("Y-m-d h:i:sa");
			if ($sql->execute(array($nome, $cpf, $email, $status,  $permissoes_str, $imagem, $data_atualizacao, $id))) {
				return true;
			} else {
				return false;
			}
		} else {

			$sql = Connection::conectar()->prepare("UPDATE `usuario` SET nome = ?, cpf = ?, email = ?, senha = ?, status= ?, permissao=?, img = ?, data_atualizacao = ? WHERE id = ?");
			$permissoes_str = implode(",", $permissao);
			$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

			$data_atualizacao = date("Y-m-d h:i:sa");
			if ($sql->execute(array($nome, $cpf, $email, $senha_hash, $status,  $permissoes_str, $imagem, $data_atualizacao, $id))) {
				return true;
			} else {
				return false;
			}
		}
	}

	public static function userExists($user)
	{
		$sql = Connection::conectar()->prepare("SELECT `id` FROM `usuario` WHERE usuario=?");
		$sql->execute(array($user));
		if ($sql->rowCount() == 1)
			return true;
		else
			return false;
	}
	public static function emailExist($email)
	{
		$sql = Connection::conectar()->prepare("SELECT `id` FROM `usuario` WHERE email=?");
		$sql->execute(array($email));
		if ($sql->rowCount() == 1)
			return true;
		else
			return false;
	}
	public static function cpfexits($cpf)
	{
		$sql = Connection::conectar()->prepare("SELECT `id` FROM `usuario` WHERE cpf=?");
		$sql->execute(array($cpf));
		if ($sql->rowCount() == 1)
			return true;
		else
			return false;
	}

	public function cadastrarUsuario($nome, $cpf, $email, $senha, $status, $imagem, $permissao)
	{
		$sql = Connection::conectar()->prepare("INSERT INTO `usuario` (`nome`, `cpf`, `email`, `senha`, `status`, `img`,`permissao`,`data_criacao`) VALUES (?, ?, ?, ?, ?, ?, ?,?)");

		$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
		$permissoes_str = implode(",", $permissao);
		$data_criacao = date("Y-m-d h:i:sa");
		if ($sql->execute(array($nome, $cpf, $email, $senha_hash, $status, $imagem, $permissoes_str, $data_criacao))) {
			return true;
		} else {
			return false;
		}
	}

	/*public static function cadastrarUsuario($nome, $cpf, $email, $senha, $status, $imagem, $permissao)
	{
		$sql = Connection::conectar()->prepare("INSERT INTO `usuario` (`nome`, `cpf`, `email`, `senha`, `status`, `img`, `permissao`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$sql->execute(array($nome, $cpf, $email, $senha, $status, $imagem, $permissao));
	}*/
	public function listarUsuarios()
	{
		$sql = Connection::conectar()->prepare("SELECT * FROM `usuario`");
		$sql->execute();
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function deletarUsuario($id)
	{
		$sql = Connection::conectar()->prepare("DELETE FROM `usuario` WHERE id = ?");
		if ($sql->execute(array($id))) {
			return true;
		} else {
			return false;
		}
	}
}
