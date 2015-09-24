<?php
$dbhost = "IP ou nome do servidor";
$db = "nome do banco";
$user = "user@servidor";
$password = "Senha";
$dsn = "Driver={SQL Server};Server=$dbhost;Port=1433;Database=$db;";
               
$connect = odbc_connect($dsn,
						$user,
						$password);

$q = odbc_exec($connect,'SELECT * FROM Cliente');
echo "<pre>";
while($r = odbc_fetch_array($q)){
	print_r($r);
}
echo "</pre>";
var_dump($connect);
?>
