<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

include_once('funcoes/funcoes_db.php');

if(!$_POST['entrar']){	//Exite a tela de login
	require('templates/login_form_template.php');
}else{	//Caso o usuário tenha preenchido o login e 
	//clicado em "entrar" verifique suas credenciais

	$q = db_consulta($db_resource, 'SELECT idUsuario 
					FROM Usuario 
					WHERE loginUsuario = "'.$_POST['login'].'" 
					AND senhaUsuario = "'.$_POST['senha'].'"');
	db_erro($db_resource);
	$r = db_le_resultado($q);
	db_erro($db_resource);

	if(!empty($r['idUsuario'])){
		print_r($r);
	}else{
		$msg_erro = 'Login e/ou Senha Incorreto(s)';
		require('templates/login_form_template.php');
	}	
}
?>
