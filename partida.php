<?php
	@session_start();
	if (!isset($_SESSION["login"]) || !isset($_SESSION["id"]) || !isset($_GET["id_partida"]))
	{
		header("Location: index.php");		
	}
	
	@session_write_close();
	include_once "PartidaDAO.php";
	include_once "UsuarioDAO.php";
	$partidaDAO = new PartidaDAO();
	$usuarioDAO = new UsuarioDAO();

	$partida = $partidaDAO->getByIdAtiva($_GET["id_partida"]);
	if(!$partida) {
		header("Location: lobby.php");
	}
	$usuario1 = $usuarioDAO->getById($partida->id_jogador1);
	if(isset($_POST['id_jogador2'])) {
		$usuario2 = $usuarioDAO->getById($_POST['id_jogador2']);
		$partida->id_jogador2 = $usuario2->id;
		$partidaDAO->update($partida);
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
<body onload="atualizarJogadoresDaPartida(<?php echo $partida->id ?>)" >
	<div id="main">
		<div id="header">
			Partida #<?php echo $_GET['id_partida']; ?> 
			
		</div>

		<div id="content">
			<div class="navegacao">
				<div class="acoes">
					<span class="logado">Logado como: <?php echo $_SESSION['login']?></span>
					<a href="logout.php"><input type="button" value="Logoff" class="btn"></a>
					<?php echo $_SESSION['id'] == $partida->id_jogador1 ? 
					"<a href='fecharPartida.php?id_partida=".$partida->id."'><input type='button' value='Fechar Partida' class='btn'></a>" : "";?>

				</div>
			</div>
			
			<div class="jogadores">
				<?php $u1 = false; $u2 = false; ?>
				<?php if ($_SESSION['id'] == $partida->id_jogador1) $u1 = true; ?>
				<?php if($_SESSION['id'] == $partida->id_jogador2) $u2 = true; ?>				 
				<div class="container-jogador">
					<span class="nome-jogador jogador">Jogador 1:</span>
					<span class="nome-jogador"><?php echo $usuario1->login ?></span>
					
					
					<input type="checkbox" id="pronto1" value="<?php echo $partida->id_jogador1?>" <?php if(!$u1) echo "disabled";?> /> Pronto<br>
				</div>
				<div class="container-jogador">
					<span class="nome-jogador jogador">Jogador 2:</span>
					<span class="nome-jogador" id="jogador2">Sem usuário</span>

					<input type="checkbox" id="pronto2" value="<?php echo $partida->id_jogador2?>"<?php if(!$u2) echo "disabled";?> > Pronto<br>
				</div>
				
				<input type="button" id="start" value="Começar Jogo" class="btn btn-start" disabled>
				
			</div>
			
			<div class="detalhesPartida">
				<ul>
					<p class="titulo-descricao">Detalhes da Partida</p>
					<li>
						Número: <?php echo $partida->id ?> 
					</li>
					<li>
						Criador: <?php echo $usuario1->login ?>
					</li>
					<li>
						Descrição: <?php echo $partida->descricao ?>
					</li>
				</ul>
			</div>	
		</div>

		<div id="footer">
			UFRPE - UAST - Projeto de Sistemas Web - Professor: Glauber Pires - Aluno: Victor Melo
		</div>

		
	</div>
</body>
</html>