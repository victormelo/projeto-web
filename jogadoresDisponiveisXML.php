<?php
	@session_start();
	if (!isset($_SESSION["login"]) || !isset($_SESSION["id"]))
	{
		header("index.php");		
	}
	
	@session_write_close();
	header("Content-Type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>\n";
	include_once "PartidaDAO.php";
	include_once "constant-status.php";

	include_once "UsuarioDAO.php";
	$partidaDAO = new PartidaDAO();
	$usuarioDAO = new UsuarioDAO();
	$partida = $partidaDAO->getByDataId($_GET['id_partida']);

	$jogador = 0;
	if($_SESSION['id'] == $partida->id_jogador1) {
		$partida->jogador1_pronto = $_GET['jogador1_pronto'];
		$partidaDAO->updateJogador1_pronto($partida);
		$jogador = 1;
	} else if($_SESSION['id'] == $partida->id_jogador2) {
		$partida->jogador2_pronto = $_GET['jogador2_pronto'];
		$partidaDAO->updateJogador2_pronto($partida);
		$jogador = 2;
	}

	$usuario = $usuarioDAO->getById($partida->id_jogador2);

	echo "<partidas>";

	@session_start();
   	
   	if (isset($_SESSION["login"]) && isset($_SESSION["id"]) && isset($_GET['id_partida']) ) {
		if($partida->status != CANCELADA && $partida->status != ANDAMENTO) {
			if($partida && $usuario) {
				echo "<partida loginUsuario='".$usuario->login."' jogador1_pronto='".$partida->jogador1_pronto."' jogador2_pronto='".$partida->jogador2_pronto."' jogador='".$jogador."' status='".$partida->status."'/>";
				$partida->status = CHEIA;
				$partidaDAO->update($partida);
			} else {
				$partida->status = ESPERA;
				$partidaDAO->update($partida);
			}
		} else {
			echo "<partida id='".$partida->id."' status='".$partida->status."'/>";
		}
	}

	@session_write_close();

	echo "</partidas>";

?>