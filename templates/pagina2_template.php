<!DOCTYPE html>
<html lang="pt_BR">
  <head>
    <meta charset="utf-8">

    <title>Bem-vindo(a)</title>

    <!-- Bootstrap CSS -->
    <link href="templates/bootstrap.min.css" rel="stylesheet">
	
    <!-- Login CSS -->
    <link href="templates/login.css" rel="stylesheet">

	<!-- Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<!-- Bootstrap JS -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- Awesome Icons -->
	<link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/3.2.1/assets/font-awesome/css/font-awesome.css">
	
  </head>

  <body>

<div class="container">
  <div class="jumbotron">
    <h1>Exemplo com Bootstrap</h1>      
    <p>Sistema Super Simples de Login</p> 
	<a href="index.php?sair=1" class="btn btn-danger btn-lg"><i class="icon-off"></i> Sair</a>
  </div>

  <ul class="nav nav-tabs">
    <li><a href="index.php"><i class="icon-home"></i> In&iacute;cio</a></li>
    <li><a href="pagina1.php">P&aacute;gina 1</a></li>
    <li class="active"><a href="#">Imagem (Upload/DB)</a></li>
	<li><a href="crud_usuario.php">CRUD Usu&aacute;rio</a></li>
  </ul>
  <br><br>
  <div class="row">
    <div class="col-md-12">
		<?php
		if($msg_sucesso){
			echo "<div class='alert alert-success'>
						<strong> $msg_sucesso </strong>
					</div>";
		}
		if($msg_erro){
			echo "<div class='alert alert-danger'>
						<strong> $msg_erro </strong>
					</div>";
		}
		?>
		<h1>Upload do Arquivo</h1>
		<form action="pagina2.php" method="post" enctype="multipart/form-data"><br><br>
			<input type="file" name="ArquivoUploaded" id="ArquivoUploaded"><br><br>
			<input type="submit" value="Enviar Imagem" name="submit">
		</form>
		<br><br>
		<table width='100%'>
			<thead>
				<th>Nome</th><th>Pre&ccedil;o</th><th>Foto</th>
			</thead>
			<tbody>
			<?php
			if(isset($produtos)){
				foreach($produtos as $produto){
					echo 	'<tr><td>'.
							$produto['nomeProduto'].'</td><td>'.
							number_format($produto['precProduto'],2,',','.').'</td><td>'.
							'<img src="data:image/jpeg;base64,'.base64_encode($produto['imagem']).'" /></td></tr>'."\n";
				}
			}
			?>
			</tbody>
		</table>
    </div>
  </div>
</div>

  </body>
</html>

