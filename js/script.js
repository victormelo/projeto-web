function criarPartida() {

	var divCriarPartida = document.getElementById("divCriarPartida");
	var btnCriarPartida = document.getElementById("btnCriarPartida");
	if(divCriarPartida.hidden == true) {
		divCriarPartida.hidden = false;
		btnCriarPartida.value="- Criar Partida";

	} else {
		divCriarPartida.hidden = true;
		btnCriarPartida.value="+ Criar Partida";

	}
}

function salvarJogada(jogada) {
	console.log(jogada);
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		alert("Your browser does not support XMLHTTP!");
		return;
	}

	// Carrega a função de execução do AJAX
	xmlhttp.onreadystatechange = function() 
	{

		if(xmlhttp.readyState == 4)
		{ 
			// Quando estiver completado o Carregamento
			var resultados = xmlhttp.responseXML;
			var partida = resultados.getElementsByTagName("partida");
			var html='';
			var tabelaPartidas = document.getElementById("tabelaPartidas");

			for(var i=0; i<partida.length; i++)
			{
	    		

				html += "<tr>";
				html += "<td>" + partida[i].getAttribute("idPartida") + "</td>";
				html += "<td>" + partida[i].getAttribute("nomeUsuario") + "</td>";
				html += "<td>" + partida[i].getAttribute("descricao") + "</td>";
				html += "<td>" + partida[i].getAttribute("dataCriacao") + "</td>";
				html += "<td><a href='partida.php?id_partida="+partida[i].getAttribute("idPartida")+"'><input type='button' value='Entrar' class='btn'></a></td>";
				html += "</tr>";
				
			}
			tabelaPartidas.innerHTML = html;

		}
	};
	// Envia via método GET as informações
	xmlhttp.open("GET","historicoPartidaXML.php",true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1") 
	xmlhttp.send(null);

}

function atualizarPartidasDisponiveis() {
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		alert("Your browser does not support XMLHTTP!");
		return;
	}

	// Carrega a função de execução do AJAX
	xmlhttp.onreadystatechange = function() 
	{

		if(xmlhttp.readyState == 4)
		{ 
			// Quando estiver completado o Carregamento
			var resultados = xmlhttp.responseXML;
			var partida = resultados.getElementsByTagName("partida");
			var html='';
			var tabelaPartidas = document.getElementById("tabelaPartidas");
			var jogador = document.getElementById("jogador").value;
			for(var i=0; i<partida.length; i++)
			{
	    		

				html += "<tr>";
				html += "<td>" + partida[i].getAttribute("idPartida") + "</td>";
				html += "<td>" + partida[i].getAttribute("nomeUsuario") + "</td>";
				html += "<td>" + partida[i].getAttribute("descricao") + "</td>";
				html += "<td>" + partida[i].getAttribute("dataCriacao") + "</td>";
				html += "<td><form method='POST' action='partida.php?id_partida="+partida[i].getAttribute('idPartida')+"'>";
				html += "<input type='hidden' name='id_jogador2' value='"+jogador+"'/>";
				html += "<input type='submit' class='btn' value='Entrar'/>";
				html += "</form>";
				html += "</td>";
				html += "</tr>";
			}
			tabelaPartidas.innerHTML = html;
			setTimeout(function() { atualizarPartidasDisponiveis() }, 5000);

		}
	};
	// Envia via método GET as informações
	xmlhttp.open("GET","historicoPartidaXML.php",true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1") 
	xmlhttp.send(null);

	return xmlhttp;

}

function atualizarPartida(id_partida) {
	var xmlhttp;
	var check1 = document.getElementById("pronto1");
	var check2 = document.getElementById("pronto2");
	var start = document.getElementById("start");

	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		alert("Your browser does not support XMLHTTP!");
		return;
	}

	// Carrega a função de execução do AJAX
	xmlhttp.onreadystatechange = function() 
	{

		if(xmlhttp.readyState == 4)
		{ 
			// Quando estiver completado o Carregamento
			var resultados = xmlhttp.responseXML;
			var html='';
			var spanJogador2 = document.getElementById("jogador2");
			partida=resultados.getElementsByTagName("partida");

				
			if(partida[0]) {
				//status 2 = cancelada
				if(partida[0].getAttribute("status") === '2') {
					alert("Partida cancelada");
					window.location.href="lobby.php";
				} else if(partida[0].getAttribute("status") === '1') {
					window.location.href="jogo.php?id_partida="+partida[0].getAttribute('id');
				}
				html += partida[0].getAttribute("loginUsuario");
				
				if(partida[0].getAttribute('jogador') === '2') {
					if(partida[0].getAttribute("jogador1_pronto") === '1') {
						check1.checked = true;
					} else {

						check1.checked = false;
					}
				} 
				else if(partida[0].getAttribute('jogador') === '1') {
					if(partida[0].getAttribute("jogador2_pronto") === '1') {
						check2.checked = true;
					} else {
						check2.checked = false;
					}
				}

			} else {
				html="Sem usuário";

			}


			spanJogador2.innerHTML = html;
			if(start) {
				if(check1.checked && check2.checked) {
					start.disabled = false;
				} else {
					start.disabled = true;
				}
				
			}


			setTimeout(function() { atualizarPartida(id_partida)}, 1000);

		}
	};
	// Envia via método GET as informações
	var pronto1 = check1.checked ? 1 : 0;
	var pronto2 = check2.checked ? 1 : 0;

	xmlhttp.open("GET","jogadoresDisponiveisXML.php?id_partida="+id_partida+"&jogador1_pronto="+pronto1+"&jogador2_pronto="+pronto2,true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1") 
	xmlhttp.send(null);
}