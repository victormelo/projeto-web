<?php
include_once("UsuarioDAO.php");

if(isset($_POST['login']) && isset($_POST['senha']))
{
	$usuarioDao = new UsuarioDAO();
	$Campo = $usuarioDao->getByLoginSenha($_POST['login'], $_POST['senha']);

	if(isset($Campo)) 
	{
		$id = $Campo->id;
		$login  = $Campo->login;
		@session_start();
		$_SESSION['id'] = $id;
		$_SESSION['login'] = $login;
		@session_write_close();
		header("Location: lobby.php");
	}
	else
	{
		header("Location: index.php");
		die();
	}	
} else 
{
	header("Location: index.php");
	die();
}
	
?>