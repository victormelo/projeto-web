<?php
	@session_start();
	if (!isset($_SESSION["login"]) || !isset($_SESSION["id"]))
	{
		// header("Location: index.php");		
	}
	
	@session_write_close();

	include_once "PartidaDAO.php";
	include_once "constant-status.php";

	$partidaDAO = new PartidaDAO();
	if(isset($_GET['id_partida'])) {
		$partida = $partidaDAO->getByIdAtiva($_GET['id_partida']);
		if($partida)
		{
			if($_SESSION["id"] != $partida->id_jogador1) {
				// header("Location: lobby.php");
			} else {
				$partida->status = ANDAMENTO;
				$partidaDAO->update($partida);

				header("Location: jogo.php?id_partida=".$partida->id);
			}
			
		}
		
	}
?>
