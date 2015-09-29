<?php
/*
Funções de banco de dados
*/
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

define(DB_HOST,'127.0.0.1');
define(DB_NOME,'PI');
define(DB_USUARIO,'root');
define(DB_SENHA,'s13q79l46');
define(DB_DSN,'Driver=MySQL;Server='.DB_HOST.';Database='.DB_NOME.';');
               
$db_resource = odbc_connect(DB_DSN,DB_USUARIO,DB_SENHA);
echo odbc_error($db_resource);
function db_consulta($db_resource, $consulta_sql){
	return odbc_exec($db_resource, $consulta_sql);
}

function db_le_resultado($q_resource){
	return odbc_fetch_array($q_resource);
}

function db_erro($db_resource){
	$num_erro = odbc_error($db_resource);
	if($num_erro){
		echo 'ERRO: '.$num_erro.' - '.odbc_errormsg($db_resource);
	}
}

function close_db(){
	odbc_close_all();
}
?>
