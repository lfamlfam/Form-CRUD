<?php
/*
Funções de banco de dados
*/
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

define('DB_HOST','koo2dzw5dy.database.windows.net');
define('DB_NOME','');
define('DB_USUARIO','TSI');
define('DB_SENHA','');
define('DB_DSN','Driver={SQL Server};Server='.DB_HOST.';Port=1433;Database='.DB_NOME.';');
 
$db_resource = odbc_connect(DB_DSN,DB_USUARIO,DB_SENHA);

function db_prepare($db_resource, $consulta_sql){
	return odbc_prepare($db_resource, $consulta_sql);
}

function db_execute($stmt_resource, $array_parametros){
	return odbc_execute($stmt_resource, $array_parametros);
}

function db_consulta($db_resource, $consulta_sql){
	return odbc_exec($db_resource, $consulta_sql);
}

function db_le_resultado($q_resource){
	return odbc_fetch_array($q_resource);
}

function db_commit($db_resource){
	return odbc_commit($db_resource);
}

function db_erro($db_resource){
	$erro = odbc_errormsg($db_resource);
	if(!empty($erro)){
		echo 'ERRO: '.$erro;
	}
}

function close_db(){
	odbc_close_all();
}
?>
