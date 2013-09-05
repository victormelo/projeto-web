<?php
include_once("Jogada.php");
include_once("JogadorDAO.php");
include_once("PartidaDAO.php");
class JogadaDAO
{
	var $conexao;
	function Conectar()
	{
		$this->conexao = mysql_connect("localhost", "root", "senhateste");
		if ($this->conexao)
		{
			if (!mysql_select_db("glauberp_jogos",$this->conexao))
				$this->Desconectar();
		}
	}
	function Desconectar()
	{
		mysql_close($this->conexao);
		$this->conexao=0;
	}

	function insert($Jogada)
	{	
		$sqltxt="insert into `Jogada` (id, jogador, partida, jogada, data, hora) values ('".$Jogada->jogador."', '".$Jogada->partida."', '".$Jogada->data."', '".$Jogada->hora."')";
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

	function getById($id)
	{
		$sqltxt="select * from jogador where id=".$id;
		$this->Conectar();
		$res=mysql_query($sqltxt,$this->conexao);
		if ($res && mysql_num_rows($res)>0)
		{
			$Campos=mysql_fetch_array($res);
			$objJogador= new Jogador();
			$objJogador->id=$Campos['id'];
			$objJogador->login=$Campos['login'];
			$objJogador->dataUltimaJogada=$Campos['dataUltimaJogada'];
			$objJogador->horaUltimaJogada=$Campos['horaUltimaJogada'];

			$this->Desconectar();
			return $objJogador;
		}
		else
		{
			$this->Desconectar();
			return NULL;
		}
	}
	
	function getHistorico($partida,$idUltimaJogada)
	{
		$sqltxt="select * from jogada where id_partida=".$partida->id." and id>".$idUltimaJogada." order by id asc";
		$this->Conectar();
		$res=mysql_query($sqltxt,$this->conexao);
		if ($res && mysql_num_rows($res)>0)
		{
			$linhasini=1;
			$linhas=mysql_num_rows($res);
			$Campos=mysql_fetch_array($res) ;
			while ($linhasini <= $linhas)
			{
				$objJogada= new Jogada();
				$objJogada->id=$Campos['id'];
				$JogadorDAO = new JogadorDAO();
				$objJogada->jogador=$JogadorDAO->getById($Campos['id_jogador']);
				$PartidaDAO = new PartidaDAO();
				$objJogada->partida=$PartidaDAO->getById($Campos['id_partida']);
				$objJogada->jogada=$Campos['jogada'];
				$objJogada->data=$Campos['data'];
				$objJogada->hora=$Campos['hora'];
	
				//$this->Desconectar();
				$ListJogadas[$linhasini-1] = $objJogada;
				$linhasini ++ ;
				$Campos=mysql_fetch_array($res) ;
			}
			return $ListJogadas;
		}
		else
		{
			$this->Desconectar();
			return NULL;
		}
	}
}
?>