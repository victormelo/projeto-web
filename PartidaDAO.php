<?php
include_once("PartidaVO.php");
include_once("constant-status.php");
class PartidaDAO
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
	function getAll()
	{
		$sqltxt="select * from Partida";
		$this->Conectar();
		$res=mysql_query($sqltxt,$this->conexao);
		if ($res && mysql_num_rows($res)>0)
		{
			$lista = array();
			$i = 0;
			while($Campos=mysql_fetch_array($res))
			{
				$Partida= new PartidaVO();
				$Partida->id=$Campos['id'];
				$Partida->id_jogador1=$Campos['id_jogador1'];
				$Partida->id_jogador2=$Campos['id_jogador2'];
				$Partida->descricao=$Campos['descricao'];
				$Partida->dataCriacao=$Campos['dataCriacao'];
				$Partida->horaCriacao=$Campos['horaCriacao'];	
				$lista[$i] = $Partida;
				$i++;
			}
			
			$this->Desconectar();
			return $lista;
		}
		else
		{
			$this->Desconectar();
			return NULL;
		}
	}
	function getAllAtivasCondicao($condicao)
	{
		$dataAtual=date("Y-m-d", time());
		$dataAtual=explode("-", $dataAtual);
		
		$horaAtual=date("H:i:s", time());
		$horaAtual=explode(":", $horaAtual);
		
		$dataAntiga = date("Y-m-d",  mktime($horaAtual[0], $horaAtual[1]-30, $horaAtual[2], $dataAtual[1], $dataAtual[2], $dataAtual[0]));
		$horaAntiga = date("H:i:s",  mktime($horaAtual[0], $horaAtual[1]-30, $horaAtual[2], $dataAtual[1], $dataAtual[2], $dataAtual[0]));
		
		$sqltxt="select * from Partida where ".$condicao." AND (dataCriacao='".$dataAntiga."' and horaCriacao>='".$horaAntiga."') or dataCriacao>'".$dataAntiga."'";
		$this->Conectar();
		$res=mysql_query($sqltxt,$this->conexao);
		if ($res && mysql_num_rows($res)>0)
		{
			$lista = array();
			$i = 0;
			while($Campos=mysql_fetch_array($res))
			{
				$Partida= new PartidaVO();
				$Partida->id=$Campos['id'];
				$Partida->id_jogador1=$Campos['id_jogador1'];
				$Partida->id_jogador2=$Campos['id_jogador2'];
				$Partida->descricao=$Campos['descricao'];
				$Partida->dataCriacao=$Campos['dataCriacao'];
				$Partida->horaCriacao=$Campos['horaCriacao'];	
				$lista[$i] = $Partida;
				$i++;
			}
			
			$this->Desconectar();
			return $lista;
		}
		else
		{
			$this->Desconectar();
			return NULL;
		}
	}
	function getAllAtivas()
	{
		$dataAtual=date("Y-m-d", time());
		$dataAtual=explode("-", $dataAtual);
		
		$horaAtual=date("H:i:s", time());
		$horaAtual=explode(":", $horaAtual);
		
		$dataAntiga = date("Y-m-d",  mktime($horaAtual[0], $horaAtual[1]-30, $horaAtual[2], $dataAtual[1], $dataAtual[2], $dataAtual[0]));
		$horaAntiga = date("H:i:s",  mktime($horaAtual[0], $horaAtual[1]-30, $horaAtual[2], $dataAtual[1], $dataAtual[2], $dataAtual[0]));
		
		$sqltxt="select * from Partida where status=".ESPERA." AND (dataCriacao='".$dataAntiga."' and horaCriacao>='".$horaAntiga."') or dataCriacao>'".$dataAntiga."'";
		
		$this->Conectar();
		$res=mysql_query($sqltxt,$this->conexao);
		if ($res && mysql_num_rows($res)>0)
		{
			$lista = array();
			$i = 0;
			while($Campos=mysql_fetch_array($res))
			{
				$Partida= new PartidaVO();
				$Partida->id=$Campos['id'];
				$Partida->id_jogador1=$Campos['id_jogador1'];
				$Partida->id_jogador2=$Campos['id_jogador2'];
				$Partida->descricao=$Campos['descricao'];
				$Partida->dataCriacao=$Campos['dataCriacao'];
				$Partida->horaCriacao=$Campos['horaCriacao'];	
				$lista[$i] = $Partida;
				$i++;
			}
			
			$this->Desconectar();
			return $lista;
		}
		else
		{
			$this->Desconectar();
			return NULL;
		}
	}
	function getByIdAtiva($id)
	{
		$dataAtual=date("Y-m-d", time());
		$dataAtual=explode("-", $dataAtual);
		
		$horaAtual=date("H:i:s", time());
		$horaAtual=explode(":", $horaAtual);
		
		$dataAntiga = date("Y-m-d",  mktime($horaAtual[0], $horaAtual[1]-30, $horaAtual[2], $dataAtual[1], $dataAtual[2], $dataAtual[0]));
		$horaAntiga = date("H:i:s",  mktime($horaAtual[0], $horaAtual[1]-30, $horaAtual[2], $dataAtual[1], $dataAtual[2], $dataAtual[0]));
		$sqltxt="select * from Partida where id=".$id." AND (status = ".ESPERA." OR status = ".CHEIA.") AND (dataCriacao='".$dataAntiga."' and horaCriacao>='".$horaAntiga."') or dataCriacao>'".$dataAntiga."'";
		$this->Conectar();
		$res=mysql_query($sqltxt,$this->conexao);
		if ($res && mysql_num_rows($res)>0)
		{
			$Campos=mysql_fetch_array($res);
			$Partida= new PartidaVO();
			$Partida->id=$Campos['id'];
			$Partida->id_jogador1=$Campos['id_jogador1'];
			$Partida->id_jogador2=$Campos['id_jogador2'];
			$Partida->jogador1_pronto=$Campos['jogador1_pronto'];
			$Partida->jogador2_pronto=$Campos['jogador2_pronto'];
			$Partida->descricao=$Campos['descricao'];
			$Partida->dataCriacao=$Campos['dataCriacao'];
			$Partida->horaCriacao=$Campos['horaCriacao'];
			$Partida->status=$Campos['status'];

			$this->Desconectar();
			return $Partida;
		}
		else
		{
			$this->Desconectar();
			return NULL;
		}
	}
	

	function insert($Partida)
	{	
		$sqltxt="insert into `Partida` (id_jogador1, descricao, dataCriacao, horaCriacao) values ('".$Partida->id_jogador1."', '".$Partida->descricao."', '".$Partida->dataCriacao."', '".$Partida->horaCriacao."')";
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

	function update($Partida)
	{
		$sqltxt = "UPDATE Partida SET id_jogador1='".$Partida->id_jogador1."',  id_jogador2 = '".$Partida->id_jogador2."'  ,  status = '".$Partida->status."', jogador1_pronto = '".$Partida->jogador1_pronto."', jogador2_pronto = '".$Partida->jogador2_pronto."' WHERE id='".$Partida->id."'";
		$this->Conectar();
		if ($alterado = mysql_query($sqltxt,$this->conexao))
		{
			$this->Desconectar();
			return $alterado;
		}
		else
		{
			$msg=mysql_error($this->conexao);
			$this->Desconectar();
			return NULL;
		}	
	}
	function updateJogador2_pronto($Partida)
	{
		$sqltxt = "UPDATE Partida SET jogador2_pronto = '".$Partida->jogador2_pronto."' WHERE id='".$Partida->id."'";
		$this->Conectar();
		if ($alterado = mysql_query($sqltxt,$this->conexao))
		{
			$this->Desconectar();
			return $alterado;
		}
		else
		{
			$msg=mysql_error($this->conexao);
			$this->Desconectar();
			return NULL;
		}	
	}

	function updateJogador1_pronto($Partida)
	{
		$sqltxt = "UPDATE Partida SET jogador1_pronto = '".$Partida->jogador1_pronto."' WHERE id='".$Partida->id."'";
		$this->Conectar();
		if ($alterado = mysql_query($sqltxt,$this->conexao))
		{
			$this->Desconectar();
			return $alterado;
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