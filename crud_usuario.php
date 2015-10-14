<?php
/*
Exemplo CRUD Usuário
*/
session_start();

if(!$_SESSION['idUsuario']){
	header('Location: index.php');
}else{
	require('functions/funcoes_db.php');	
}

$msg_erro = '';
$msg_sucesso = '';

//incluir/alterar usuários
if(	isset($_POST['novo_usuario']) || 
	isset($_POST['gravar_usuario']) || 
	isset($_POST['editar_usuario']) || 
	isset($_POST['salvar_usuario'])){
		
	if(isset($_POST['salvar_usuario'])){
		$dados_usuario = array(	'loginUsuario' => $_POST['login'],
							'nomeUsuario' => $_POST['nome'],
							'tipoPerfil' => $_POST['perfil'],
							'usuarioAtivo' => $_POST['ativo']);	
	}else{
		$dados_usuario = array(	'loginUsuario' => null,
							'nomeUsuario' => null,
							'tipoPerfil' => null,
							'usuarioAtivo' => null);
	}
	if(isset($_POST['gravar_usuario']) || isset($_POST['salvar_usuario'])){
		if($_POST['senha'] != $_POST['senha_conf']){
			$msg_erro = 'A senha n&atilde;o confere';			
		}
		if(strlen($_POST['senha']) < 6){
			$msg_erro = 'A senha deve conter seis ou mais caracteres';
		}
		if(empty($_POST['nome']) || empty($_POST['login'])){
			$msg_erro = 'Os campos Nome e Login devem ser preenchidos';
		}
		if(!empty($_POST['ativo'])){
			$_POST['ativo'] = (bool) true;
		}else{
			$_POST['ativo'] = (bool) false;
		}
		if(!$msg_erro && isset($_POST['gravar_usuario'])){
			$consulta_preparada = db_prepare($db_resource,'INSERT INTO
															Usuario
															(loginUsuario, 
															senhaUsuario, 
															nomeUsuario, 
															tipoPerfil, 
															usuarioAtivo)
															VALUES
															(?,?,?,?,?)');
			if(db_execute($consulta_preparada,array($_POST['login'],
													$_POST['senha'],
													$_POST['nome'],
													$_POST['perfil'],
													$_POST['ativo']))){
				$msg_sucesso = $_POST['nome'].' gravado com sucesso';
			}else{
				$msg_erro = 'ERRO ao gravar os dados de '.$_POST['nome'];
			}
		}elseif(!$msg_erro && isset($_POST['salvar_usuario'])){
			$consulta_preparada = db_prepare($db_resource,'UPDATE
															Usuario
															SET 
															loginUsuario = ?, 
															senhaUsuario = ?, 
															nomeUsuario = ?, 
															tipoPerfil = ?, 
															usuarioAtivo = ? 
															WHERE
															idUsuario = ?');
			if(db_execute($consulta_preparada,array($_POST['login'],
													$_POST['senha'],
													$_POST['nome'],
													$_POST['perfil'],
													$_POST['ativo'],
													$_POST['idUsuario']))){
				$msg_sucesso = $_POST['nome'].' alterado com sucesso';
			}else{
				$msg_erro = 'ERRO ao salvar os dados de '.$_POST['nome'];
			}
		}
	}
	if(isset($_POST['editar_usuario'])){
		if(isset($_POST['idUsuario'])){
			$consulta_preparada = db_prepare($db_resource, 'SELECT  
										loginUsuario,
										nomeUsuario,
										tipoPerfil,
										usuarioAtivo
										FROM
										Usuario
										WHERE
										idUsuario = ?');
			db_execute($consulta_preparada,array($_POST['idUsuario']));
			$dados_usuario = db_le_resultado($consulta_preparada);
		}
	}
	include('templates/crud_usuario_novo_usuario_template.php');
}elseif(isset($_POST['apagar_usuario'])){//excluir usuários
	if(!is_numeric($_POST['idUsuario'])){
		$msg_erro = 'ERRO: idUsuario inv&aacute;lido';
	}
	$consulta_preparada = db_prepare($db_resource, 'DELETE FROM   
													Usuario 
													WHERE 
													idUsuario = ?');
	if(db_execute($consulta_preparada,array($_POST['idUsuario']))){
		$msg_sucesso = 'Usu&aacute;rio exclu&iacute;do com sucesso';
		db_commit($db_resource);
	}else{
		$msg_erro = 'ERRO: N&atilde;o foi poss&iacute;vel excluir o usu&aacute;rio';
	}
	//exibir usuários
	$query = db_consulta($db_resource,'	SELECT 
									idUsuario, 
									loginUsuario,
									nomeUsuario,
									tipoPerfil,
									usuarioAtivo
									FROM
									Usuario');
	while($usuario = db_le_resultado($query)){
		$usuarios[$usuario['idUsuario']] = $usuario;
	}
	include('templates/crud_usuario_template.php');
}else{
	//exibir usuários
	$query = db_consulta($db_resource,'	SELECT 
									idUsuario, 
									loginUsuario,
									nomeUsuario,
									tipoPerfil,
									usuarioAtivo
									FROM
									Usuario');
	while($usuario = db_le_resultado($query)){
		$usuarios[$usuario['idUsuario']] = $usuario;
	}
	include('templates/crud_usuario_template.php');
}
?>