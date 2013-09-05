<?php
include_once "PartidaVO.php";
include_once "PartidaDAO.php";
@session_start();
if (!isset($_SESSION["login"]) || !isset($_SESSION["id"]))
{
	header("Location: index.php");		
}
@session_write_close();

$partida = new PartidaVO();

if(!isset($_POST['descricao'])) 
	$partida->descricao = "Partida de " . $_SESSION["login"];
else
	$partida->descricao = $_POST['descricao'];

$partida->id_jogador1 = $_SESSION['id'];
$partida->dataCriacao = date('Y-m-d');
$partida->horaCriacao = date('H:i:s', time());
$partidaDao = new PartidaDAO();
$id = $partidaDao->insert($partida);
	if($id != NULL)
	{
		header('Location: partida.php?id_partida='.$id);	
	}  
		
?>