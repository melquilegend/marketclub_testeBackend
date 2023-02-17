<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
	$autoload = function($class)
	{
		include 'classes/'.$class.'.php';
	};

	spl_autoload_register($autoload);
	define('INCLUDE_PATH', 'http://localhost/projeto_teste/');
	define('INCLUDE_PATH_IMAGE', 'C:/wamp64/www/projeto_teste/');
	//CONECÇÃO DA BASE DE DADOS 
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASSWORD', '');
	define('DATABASE', 'db_teste');

	define('NOME_EMPRESA', 'Markclub');

	function pegaCargo($indice){

		return Administracao::$permissao[$indice];
	}


	function beautiful_date($data){
		$data_formatada = date("M d, Y H:i ", strtotime($data));
		return $data_formatada;
	}
	function formatar_cpf($cpf) {
		$parte1 = substr($cpf, 0, 3);
		$parte2 = substr($cpf, 3, 3);
		$parte3 = substr($cpf, 6, 3);
		$parte4 = substr($cpf, 9, 2);
	  
		return "$parte1.$parte2.$parte3-$parte4";
	  }
	
