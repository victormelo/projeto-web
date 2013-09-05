<?php
	@session_start();
	if (!isset($_SESSION["login"]) || !isset($_SESSION["id"]))
	{
		header("Location: index.php");		
	}
	
	@session_write_close();
?>

<?php
include_once "PartidaDAO.php";
include_once "UsuarioDAO.php";
include_once "constant-status.php";

$partidaDAO = new PartidaDAO();
$usuarioDAO = new UsuarioDAO();

$partidas = $partidaDAO->getAllAtivasCondicao("status = ".ESPERA." or status = ".CHEIA." ");
if(isset($partidas)) {
	foreach($partidas as $partida) {
		if($_SESSION['id'] == $partida->id_jogador1 || $_SESSION['id'] == $partida->id_jogador2) {
			header("Location: partida.php?id_partida=".$partida->id);
		}
	}
	
}

?>
<!doctype html>	
<html lang="ptbr">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/script.js"></script>
	<meta charset="UTF-8">
	<title>Monopoly Online</title>
</head>
<body onload="atualizarPartidasDisponiveis();">
	<div id="main">
		<div id="header">
			<input type="hidden" id="jogador" value=<?php echo "'".$_SESSION['id']."'" ?>>
			Sala de Partidas
		</div>
		<div id="content">
			<div class="navegacao">
				<span class="logado">Logado como: <?php echo $_SESSION['login']?></span>
				<div class="acoes">
					<input type="button" id="btnCriarPartida" value="+ Criar Partida" class="btn" onclick="criarPartida();">
					<a href="logout.php"><input type="button" value="Logoff" class="btn"><a>

				</div>
			</div>
			<div class="formCriarPartida" hidden="true" id="divCriarPartida">
				<h2 class="titulo">Criar Partida</h2>
				<form action="inserirPartida.php" method="POST">
					<label for="descricao">Descrição da Partida</label> 
					<textarea name="descricao" id="descricao" cols="30" rows="5" placeholder="Descrição para a partida"></textarea>
					<br>
					
					<input type="submit" class="btn btnSubmit" value="Criar">
				</form>
			</div>

			<div class="listaJogos">
				<h2 class="titulo">Partidas disponíveis</h2>
				<table class="bordered">
				    <thead>
				    <tr>
				        <th>#</th>
				        <th>Host</th>                
				        <th>Descrição</th>
				        <th>Data de Criação</th>
				        <th>Ação</th>
				    </tr>
				    </thead>
				    <tbody id="tabelaPartidas">
				    </tbody>
				    

				</table>



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