<?php
	@session_start();
	if (isset($_SESSION["login"]) && isset($_SESSION["id"]))
	{
		header("Location: lobby.php");		
	}
	@session_write_close();

?>
<!doctype html>	
<html lang="ptbr">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<meta charset="UTF-8">
	<title>Monopoly Online</title>
</head>
<body>
	<div id="main">
		<div id="header">
			Monopoly Online
		</div>
		<div id="imagemJogo">
			<img src="img/logoMonopoly.jpg" alt="">
			
		</div>
		<div id="content">
			<div class="form">
				<fieldset>
					<legend>Cadastro</legend>
					<form action="inserirUsuario.php" method="POST">
						<label for="campoUser">Usuário</label> 
						<input id="campoUser" name="login" id="loginCadastro" type="text" required placeholder="Insira o nome do usuário">
						<br/>
						<label for="campoSenha">Senha</label> 
						<input id="campoSenha" name="senha1" id="senha1Cadastro" type="password" required placeholder="Insira a senha">
						<br/>
						<label for="campoSenha2">Repita a Senha</label> 
						<input id="campoSenha2" name="senha2" id="senha2Cadastro" type="password" required placeholder="Insira novamente a senha">
						<br/>
						<input type="submit" class="btn" value="Cadastrar">
					</form>
				</fieldset>
			</div>
			<div class="form">
				<fieldset>
					<legend>Login</legend>
					<form action="loginUsuario.php" method="POST">
					<label for="campoUser">Usuário</label> 
					<input class="campoUser" name="login" id="loginEntrar" type="text" required placeholder="Insira o nome do usuário">
					<br>
					<label for="campoSenha">Senha</label> 
					<input class="campoSenha" name="senha" id="senhaEntrar" type="password" required placeholder="Insira a senha">
					<br>
					<?php
						if(isset($_GET['erro']) && $_GET['erro'] )
							echo"<span class='spanErro'>Ocorreu um erro no login!</span>
								</br>"
					?>
					<input type="submit" class="btn" value="Logar">
					</form>
				</fieldset>
			</div>
		</div>

		<div id="footer">
			UFRPE - UAST - Projeto de Sistemas Web - Professor: Glauber Pires - Aluno: Victor Melo
		</div>

		
	</div>
</body>
</html>
<?php

?>