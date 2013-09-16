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
	echo "<jogadores>";

	@session_start();
   	
   	if (isset($_SESSION["login"]) && isset($_SESSION["id"]) && isset($_GET['id_partida']) ) {
		echo "<jogador dinheiro_jogador1='".$partida->dinheiro_jogador1."' dinheiro_jogador2='".$partida->dinheiro_jogador2."'/>";
		
	}

	@session_write_close();

	echo "</jogadores>";

?>