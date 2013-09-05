<?php
define("VAZIO",0);
define("PRETO",1);
define("BRANCO",2);
class Cartas
{
	function getCartas()
	{
		return array(
					array('Sorte', 'Você achou um pacote de dinheiro no chão.', 50),
					array('Sorte', 'Parabéns. Você tirou primeiro lugar no torneio de tênis do seu clube.', 100),
					array('Sorte', 'Seu cachorro foi campeão da apresentação.', 55),
					array('Sorte', 'Você acaba de receber uma parcela do seu 13º salário', 75),
					array('Sorte', 'Houve um assalto a sua loja, mas você estava segurado.', 150),
					array('Sorte', 'Você jogou na Loteria Esportiva com um grupo de amigos. Ganharam!', 35),
					array('Sorte', 'Você trocou seu carro usado com um amigo e ainda saiu lucrando', 50),
					array('Sorte', 'Você saiu de férias e se hospedou na casa de um amigo. Voce economizou o hotel.', 45),
					array('Sorte', 'Um amigo tinha lhe pedido um empréstimo e se esqueceu de devolver. Ele acaba de lembrar', 80),
					array('Sorte', 'Você foi promovido a diretor da sua empresa.', 100),

					array('Azar', 'Você acaba de receber a comunicação do imposto de renda', 50),
					array('Azar', 'Hoje é seu aniversário, é preciso fazer uma festa.', -150),
					array('Azar', 'Seu carro deu defeito no motor, o conserto é um pouco caro.', -200),
					array('Azar', 'Seus parentes do interior vieram passar umas "férias" na sua casa.', -45),
					array('Azar', 'A geada prejudicou a sua safra de café', -70),
					array('Azar', 'Papai, os livros do ano passado não servem mais, preciso de livros novos.', -60),
					array('Azar', 'Renove a tempo a licença do seu automóvel.', -30),
					array('Azar', 'Você estacionou seu carro em lugar proibido e entrou na contra mão', -30),
					array('Azar', 'Você achou interessante assistir à estréia da temporada de balé. Compre os ingressos.', -50),
					array('Azar', 'Um amigo pediu-lhe um empréstimo. Você não pode recusar.', -45),

					);
	}
}
?>