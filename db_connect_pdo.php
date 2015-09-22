<?php
/*
Exemplo de conexão com PDO
*/

$objDb = new PDO(	'driver:host=IP_ou_nome_do_servidor;dbname=nome_do_db;charset=utf8',
			'usuario','senha', 
			array(	PDO::ATTR_EMULATE_PREPARES => false,                                                                                           
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


$objConsulta = $objDb->query('SELECT nome, login_id FROM tb_usuario');
$qtdLinhas = $objConsulta->rowCount(); // quantidade de resultados
$objResultado = $objConsulta->fetchAll(PDO::FETCH_ASSOC);

var_dump($objResultado);

unset($objDb);
?>
