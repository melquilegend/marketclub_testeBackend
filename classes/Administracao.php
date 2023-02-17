<?php
	
	class Administracao
	{
		public static $permissao = ['0' => 'Administrador','1' => 'Sub Administrador','2' => 'Tecnico','3' => 'Usuario Normal'];
		public static $permission = array(
			'cadastrar-usuarios' => array(2), 
			'editar-usuario' => array(1), 
			'delete' => array(0),     
		  );
		public static function logado(){

			return isset($_SESSION['login']) ? true : false;
		}
		public static function loggout(){
			setcookie('lembrar','true',time()-1,'/');
			session_destroy();
			header('Location: '.INCLUDE_PATH);
		}
		public static function carregarPagina(){
			if (isset($_GET['url'])) {
				$url = explode('/', $_GET['url']);
				if (file_exists('pages/'.$url[0].'.php')) {
					include ('pages/'.$url[0].'.php');
				}else{
					header('Location: '.INCLUDE_PATH);
				}
			}else{
				include ('pages/home.php');
			}
		}
		

		
		public static function alert($tipo,$mensagem, $redirecionar=null){
			if($tipo == 'sucesso'){
				#echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> '.$mensagem.'</div>';
				echo "<script type='text/javascript'>alert('$mensagem');</script>";
				if ( $redirecionar) {
					header('Location: ' . $redirecionar . 'naotempermisao');
				}
			}else if($tipo == 'erro'){
				echo "<script type='text/javascript'>alert('$mensagem');</script>";
				if ( $redirecionar) {
					header('Location: ' . $redirecionar . 'naotempermisao');
				}
			}
		}
		public static function imagemValida($imagem){
			if($imagem['type'] == 'image/jpeg' ||
				$imagem['type'] == 'imagem/jpg' ||
				$imagem['type'] == 'imagem/PNG'){
					return true;
			}else{
				return true;
			}
		}

		public static function uploadFile($file){
			#$formatoArquivo = explode('.',$file['name']);
			#$imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
			$imagemNome = $file['name'];
			$uploadDir = INCLUDE_PATH_IMAGE . 'uploads/';
			$destination = $uploadDir . $imagemNome;
			
			if ($file['error'] === UPLOAD_ERR_OK) {
				$imagemNome = basename($file['name']);
				if(move_uploaded_file($file['tmp_name'], $destination)) {
					return $imagemNome;
				} else {
					return false;
				}
			} else {
				
				return false;
			}
			
		}
		public static function deleteFile($file){
			@unlink('uploads/'.$file);
		}
	}

?>