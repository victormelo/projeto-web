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
	include_once "UsuarioDAO.php";
	$partidaDAO = new PartidaDAO();
	$usuarioDAO = new UsuarioDAO();

	$partidas = $partidaDAO->getAllAtivas();

	echo "<partidas>";
   	if(isset($partidas)) {
	   	foreach($partidas as $partida)
		{
			echo "<partida idPartida='".$partida->id."' 
			nomeUsuario='".$usuarioDAO->getById($partida->id_jogador1)->login."'
			descricao='".$partida->descricao."'
			dataCriacao='".$partida->dataCriacao ." ". $partida->horaCriacao ."'/>";
			
		}
   		
   	}
	echo "</partidas>";
	
?>