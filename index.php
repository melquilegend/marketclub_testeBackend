<?php
require_once 'config.php';
if (Administracao::logado()== false) {
	include 'login.php';
}else{
	include 'main.php';
}

?>