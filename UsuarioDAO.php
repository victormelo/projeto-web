<?php
include_once("UsuarioVO.php");
class UsuarioDAO
{
	var $conexao;
	function Conectar()
	{
		$this->conexao = mysql_connect("localhost", "root", "root");
		if ($this->conexao)
		{
			if (!mysql_select_db("projetoweb",$this->conexao))
				$this->Desconectar();
		}
	}
	function Desconectar()
	{
		mysql_close($this->conexao);
		$this->conexao=0;
	}
	function getById($id)
	{
		$sqltxt="select * from Usuario where id=".$id;
		$this->Conectar();
		$res=mysql_query($sqltxt,$this->conexao);
		if ($res && mysql_num_rows($res)>0)
		{
			$Campos=mysql_fetch_array($res);
			$Usuario= new UsuarioVO();
			$Usuario->id=$Campos['id'];
			$Usuario->login=$Campos['login'];
			$Usuario->senha=$Campos['senha'];
			$this->Desconectar();
			return $Usuario;
		}
		else
		{
			$this->Desconectar();
			return NULL;
		}
	}
	function getByLoginSenha($login, $senha)
	{
		$login = mysql_real_escape_string($login);
		$senha = mysql_real_escape_string($senha);
		$sqltxt="select * from Usuario where login='".$login."' AND senha='".$senha."'";
		$this->Conectar();
		
		$res=mysql_query($sqltxt,$this->conexao);
		if ($res && mysql_num_rows($res)>0)
		{
			$Campos=mysql_fetch_array($res);
			$Usuario= new UsuarioVO();
			$Usuario->id=$Campos['id'];
			$Usuario->login=$Campos['login'];
			$Usuario->senha=$Campos['senha'];
			$this->Desconectar();
			return $Usuario;
		}
		else
		{
			$this->Desconectar();
			return NULL;
		}
	}
	
	function insert($Usuario)
	{
		$sqltxt="insert into `Usuario` (login, senha) values ('".$Usuario->login."', '".$Usuario->senha."')";
		$this->Conectar();
		if (mysql_query($sqltxt,$this->conexao))
		{
			$id = mysql_insert_id();
			$this->Desconectar();
			return $id;
		}
		else
		{
			$msg=mysql_error($this->conexao);
			$this->Desconectar();
			return NULL;
		}
	}
	
}
?>