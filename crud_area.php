<?php
/*
Exemplo CRUD Usuário
*/
session_start();

if(!$_SESSION['codProfessor']){
	header('Location: index.php');
}else{
	require('functions/funcoes_db.php');	
}

$msg_erro = '';
$msg_sucesso = '';

//incluir/alterar áreas
if(	isset($_POST['nova_area']) || 
	isset($_POST['gravar_area']) || 
	isset($_POST['editar_area']) || 
	isset($_POST['salvar_area'])){
		
	if(isset($_POST['salvar_area'])){
		$dados_area = array(	'codArea' => $_POST['codArea'],
					'descricao' => $_POST['descricao']);	
	}else{
		$dados_area = array(	'codArea' => null,
					'descricao' => null);
	}
	if(isset($_POST['gravar_area']) || isset($_POST['salvar_area'])){
		if(empty($_POST['descricao'])){
			$msg_erro = '&Aacute; n&atilde;o pode ser vazia';
		}
		if(!$msg_erro && isset($_POST['gravar_area'])){
			$consulta_preparada = db_prepare($db_resource,'INSERT INTO
															Area
															(descricao)
															VALUES
															(?)');
			if(db_execute($consulta_preparada,array($_POST['descricao']))){
				$msg_sucesso = $_POST['descricao'].' gravada com sucesso';
			}else{
				$msg_erro = 'ERRO ao gravar a &aacute;rea '.$_POST['descricao'];
			}
		}elseif(!$msg_erro && isset($_POST['salvar_area'])){
			$consulta_preparada = db_prepare($db_resource,'UPDATE
															Area
															SET 
															descricao = ? 
															WHERE
															codArea = ?');
			if(db_execute($consulta_preparada,array($_POST['descricao'],
													$_POST['codArea']))){
				$msg_sucesso = $_POST['descricao'].' alterada com sucesso';
			}else{
				$msg_erro = 'ERRO ao salvar os dados de '.$_POST['descricao'];
			}
		}
	}
	if(isset($_POST['editar_area'])){
		if(isset($_POST['codArea'])){
			$consulta_preparada = db_prepare($db_resource, 'SELECT  
									codArea,
									descricao
									FROM
									Area
									WHERE
									codArea = ?');						

			db_execute($consulta_preparada,array($_POST['codArea']));
			$dados_area = db_le_resultado($consulta_preparada);
		}
	}
	include('templates/crud_area_nova_area_template.php');
}elseif(isset($_POST['apagar_area'])){//excluir áreas
	if(!is_numeric($_POST['codArea'])){
		$msg_erro = 'ERRO: c&oacute;digo inv&aacute;lido para &aacute;rea';
	}
	$consulta_preparada = db_prepare($db_resource, 'DELETE FROM   
													Area 
													WHERE 
													codArea = ?');
	if(db_execute($consulta_preparada,array($_POST['codArea']))){
		$msg_sucesso = '&Aacute;rea exclu&iacute;da com sucesso';
		db_commit($db_resource);
	}else{
		$msg_erro = 'ERRO: N&atilde;o foi poss&iacute;vel excluir a &aacute;rea';
	}
	//exibir áreas
	$query = db_consulta($db_resource,'	SELECT 
						codArea,
						descricao
						FROM
						Area');
	while($area = db_le_resultado($query)){
		$areas[$area['codArea']] = $area;
	}
	include('templates/crud_area_template.php');
}else{
	//exibir áreas
	$query = db_consulta($db_resource,'	SELECT 
						codArea, 
						descricao
						FROM
						Area');
	while($area = db_le_resultado($query)){
		$areas[$area['codArea']] = $area;
	}
	include('templates/crud_area_template.php');
}
?>
