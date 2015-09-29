<?php
/*
Exemplo página 2
*/
session_start();

if(!$_SESSION['idUsuario']){
	header('Location: index.php');
}

include('templates/pagina2_template.php');
?>