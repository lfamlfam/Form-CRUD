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
	<li class="active"><a href="crud_usuario.php">CRUD Usu&aacute;rio</a></li>
  </ul>
  <br><br>
  <form class="form-inline" role="form" method="post">
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
	  <div class="form-group">
		<label for="nome">Nome:</label>
		<input type="text" class="form-control" id="nome" value='<?php echo $dados_usuario['nomeUsuario']; ?>' name='nome'>
	  </div>
	  <div class="form-group">
		<label for="login">Login:</label>
		<input type="text" class="form-control" id="login" value='<?php echo $dados_usuario['loginUsuario']; ?>' name='login'>
	  </div>
	  <div class="form-group">
		<label for="perfil">Perfil:</label>
		<select class="form-control" id="nome" name='perfil'>
			<option value=""> Escolha </option>
			<option value="A" <?php if(isset($dados_usuario['tipoPerfil'])) echo $dados_usuario['tipoPerfil'] == 'A' ? 'selected' : '' ; ?>> Administrador </option>
			<option value="U" <?php if(isset($dados_usuario['tipoPerfil'])) echo $dados_usuario['tipoPerfil'] == 'U' ? 'selected' : '' ; ?>> Usu&aacute;rio </option>
		</select>
	  </div>
	  <div class="form-group">
		<label for="ativo">Ativo:</label>
			<input type="checkbox" name='ativo' <?php if(isset($dados_usuario['usuarioAtivo'])) echo empty($dados_usuario['usuarioAtivo']) ? '' : 'checked' ; else echo 'checked'; ?>>
	  </div>
	</div>
  </div>
  <br>
  <div class="row">
	<div class="col-md-12">
	  <div class="form-group">
		<label for="pwd">Senha:</label>
		<input type="password" class="form-control" id="pwd" name='senha'>
	  </div>
	  <div class="form-group">
		<label for="pwd_conf">Confirme a Senha:</label>
		<input type="password" class="form-control" id="pwd_conf" name='senha_conf'>
	  </div>
	  <?php
		if(!isset($_POST['idUsuario'])){
			echo '
			<button type="submit" class="btn btn-default" name="gravar_usuario">Gravar Usu&aacute;rio</button>';
		}else{
			echo '
			<input type="hidden" name="idUsuario" value="'.$_POST['idUsuario'].'">
			<button type="submit" class="btn btn-default" name="salvar_usuario">Salvar Usu&aacute;rio</button>';
		}
	  ?>
    </div>
  </div>
  <div class="row">
	</div class="col-md-12">
		<br><br>
		<a href="crud_usuario.php" class="btn btn-default">Voltar</a>
	</div>
  </div>	
  </form>
</div>

  </body>
</html>

