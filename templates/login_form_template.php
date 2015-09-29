<!DOCTYPE html>
<html lang="pt_BR">
  <head>
    <meta charset="utf-8">

    <title>Exemplo de Sistema de Login</title>

    <!-- Bootstrap CSS -->
    <link href="templates/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="templates/login.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post">
	<?php
	if(!empty($msg_erro)){	
		echo "
		<div class='alert alert-danger'>
			<strong> $msg_erro </strong>
		</div>
		";
	}
	?>
        <h2 class="form-signin-heading">Exemplo de Sistema de Login</h2><br><br>
        <label for="login" class="sr-only">Login</label>
        <input type="text" id="login" name="login" class="form-control" placeholder="Seu login" required autofocus><br><br>
        <label for="senha" class="sr-only">Senha</label>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required><br><br>
        <button class="btn btn-lg btn-primary btn-block" name="entrar" value=1 type="submit">Entrar</button>
      </form>

    </div>

  </body>
</html>

