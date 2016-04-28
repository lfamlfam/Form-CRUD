<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
session_start();

include_once('functions/funcoes_db.php');

if(!isset($_POST['entrar']) && !isset($_SESSION['codProfessor'])){	//Exite a tela de login
	require('templates/login_form_template.php');
}else{	//Caso o usuário tenha preenchido o login e 
	//clicado em "entrar" verifique suas credenciais
	
	if(!isset($_SESSION['codProfessor'])){//verifica usuário e senha
		$q = db_consulta($db_resource, "SELECT codProfessor 
										FROM Professor 
										WHERE email = '{$_POST['login']}' 
										AND senha = HASHBYTES('SHA1','{$_POST['senha']}')");
		$r = db_le_resultado($q);
		if(!empty($r['codProfessor'])){//se existir usuário e a senha estiver correta entra no sistema
			$_SESSION['codProfessor'] = $r['codProfessor'];
			require('templates/menu.php');
		}else{//caso contrário mostra mensagem de error
			$msg_erro = 'Login e/ou Senha Incorreto(s)';
			require('templates/login_form_template.php');
		}	
	}elseif(isset($_GET['sair'])){//Se o usuário clicar em sair
		$_SESSION['codProfessor'] = null;
		require('templates/login_form_template.php');
	}else{
		require('templates/menu.php');
	}
}
?>
