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
    <li><a href="#">P&aacute;gina 2</a></li>
	<li class="active"><a href="crud_area.php">CRUD &Aacute;rea</a></li>
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
		<form method='post'>
        <table class="table">
			<thead>
			  <tr>
				<th>C&oacute;digo</th>
				<th>&Aacute;rea</th>
				<th>Selecionar</th>
			  </tr>
			</thead>
			<tbody>
			  <?php
			  foreach($areas as $area){
				echo "	<tr>
						<td>{$area['codArea']}</td>
						<td>{$area['descricao']}</td>
						<td class='text-center'><input type='radio' name='codArea' value='{$area['codArea']}'></td>
										    
					</tr>";
			  }		
			  ?>
			  <tr>
				<td colspan='2' class='text-center'><input type="submit" class="btn btn-primary" name='nova_area' value='Nova &Aacute;rea'></td>
				<td colspan='2' class='text-center'><input type="submit" class="btn btn-default" name='editar_area' value='Editar &Aacute;rea Selecionada'></td>
				<td colspan='2' class='text-center'><input type="submit" class="btn btn-danger" name='apagar_area' value='Apagar &Aacute;rea Selecionada'></td>
			  </tr>
			</tbody>
		</table>
		</form>
    </div>
  </div>
</div>

  </body>
</html>

