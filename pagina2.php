<?php
/*
Exemplo página 2
*/
session_start();

if(!$_SESSION['idUsuario']){
	header('Location: index.php');
}else{
	require('functions/funcoes_db.php');
}

$msg_erro = '';
$msg_sucesso = '';

if(	substr($_FILES['ArquivoUploaded']['type'], 0, 5) == 'image' &&
	$_FILES['ArquivoUploaded']['error'] == 0 &&
	$_FILES['ArquivoUploaded']['size'] > 0){
		//print_r($_FILES);
		$msg_sucesso = 'Arquivo recebido com sucesso';
		
		$file = fopen($_FILES['ArquivoUploaded']['tmp_name'],'rb');
		$conteudo = fread($file, filesize($_FILES['ArquivoUploaded']['tmp_name']));
		$fileParaDB = base64_encode($conteudo);
		fclose($file);

		if(db_consulta($db_resource,'	INSERT INTO 
										Produto
										(nomeProduto,
										precProduto,
										idCategoria,
										ativoProduto,
										imagem)
										VALUES
										('."'".'Teste Imagem'."'".',
										10.00,
										12,
										'.(true).',
										'."'".$fileParaDB."'".')')){
			$msg_sucesso .= '<br>Imagem armazenada no DB';
			
			$q = db_consulta($db_resource,'SELECT * FROM Produto');
			while($r = db_le_resultado($q)){
				$produtos[$r['idProduto']] = $r;
			}
			
		}else{
			$msg_erro .= 'Erro ao salvar a Imagem no DB';
		}		
}else{
	$msg_erro = 'S&oacute; s&atilde;o aceitos arquivos de imagem';
}

include('templates/pagina2_template.php');
?>