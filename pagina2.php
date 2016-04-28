<?php
/*
Exemplo página 2
*/

ini_set ('odbc.defaultlrl', 9000000);//muda configuração do PHP para trabalhar com imagens no DB

session_start();

if(!$_SESSION['codProfessor']){
	header('Location: index.php');
}else{
	require('functions/funcoes_db.php');
}

$msg_erro = '';
$msg_sucesso = '';

if(isset($_FILES['ArquivoUploaded'])){
	if(	substr($_FILES['ArquivoUploaded']['type'], 0, 5) == 'image' &&
		$_FILES['ArquivoUploaded']['error'] == 0 &&
		($_FILES['ArquivoUploaded']['size'] > 0 && $_FILES['ArquivoUploaded']['size'] < 9000000)){
		//print_r($_FILES);
		$msg_sucesso = 'Arquivo recebido com sucesso';
		
		$file = fopen($_FILES['ArquivoUploaded']['tmp_name'],'rb');
		$fileParaDB = fread($file, filesize($_FILES['ArquivoUploaded']['tmp_name']));
		fclose($file);
		
		$stmt = db_prepare($db_resource,'INSERT INTO Imagem 
										(tituloImagem, bitmapImagem) 
										VALUES 
										(?,?)');			 
		if(db_execute($stmt, array(	'Teste',
						$fileParaDB))){
									
			$msg_sucesso .= '<br>Imagem armazenada no DB';					
		}else{
			$msg_erro .= 'Erro ao salvar a Imagem no DB.';
		}		
	}else{
		if($_FILES['ArquivoUploaded']['size'] > 9000000){
			$base = log($_FILES['ArquivoUploaded']['size']) / log(1024);
			$sufixo = array("", "K", "M", "G", "T");
			$tam_em_mb = round(pow(1024, $base - floor($base)),2).$sufixo[floor($base)];
			$msg_erro = 'Tamanho m&aacute;ximo de imagem 9 Mb. Tamanho da imagem enviada: '.$tam_em_mb;
		}else{
			$msg_erro = 'S&oacute; s&atilde;o aceitos arquivos de imagem. Tamanho da imagem: '.$_FILES['ArquivoUploaded']['size'];
		}
	}
}

$q = db_consulta($db_resource,'SELECT * FROM Imagem');
while($r = db_le_resultado($q)){
	$produtos[$r['codImagem']] = $r;
}

include('templates/pagina2_template.php');
?>
