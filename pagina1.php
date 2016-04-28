<?php
/*
Exemplo página 1
*/
session_start();

if(!$_SESSION['codProfessor']){
	header('Location: index.php');
}
include('templates/pagina1_template.php');
?>
