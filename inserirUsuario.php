<?php
include_once "UsuarioVO.php";
include_once "UsuarioDAO.php";

$erro = false;

if(isset($_POST['login']) && isset($_POST['senha1']) && isset($_POST['senha2'])) {
	if($_POST['senha1'] == $_POST['senha2']) 
	{
		$usuario = new UsuarioVO();
		$usuario->login = $_POST['login'];
		$usuario->senha = $_POST['senha1'];
		$usuarioDao = new UsuarioDAO();
		$id = $usuarioDao->insert($usuario);
		if($id != NULL)
		{
			@session_start();
			$_SESSION['id'] = $id;
			$_SESSION['login'] = $usuario->login;
			@session_write_close();
			header('Location: lobby.php');	
		}  
		else 
			$erro = true;
	} 
	else 
		$erro = true;
	
} else {
	$erro = true;
}
if($erro) 
{
	echo "<html>
	<meta charset='UTF-8'>
				<script>
					alert('Cadastro inválido.');
					window.location='index.php';
				</script>
			</html>";
	
}

?>