<?php
    @session_start();
    if (!isset($_SESSION["login"]) || !isset($_SESSION["id"]) || !isset($_GET["id_partida"]))
    {
        // header("Location: index.php");      
    }
    
    @session_write_close();
    include_once "PartidaDAO.php";
    include_once "UsuarioDAO.php";
    $partidaDAO = new PartidaDAO();
    $usuarioDAO = new UsuarioDAO();

    $partida = $partidaDAO->getByDataId($_GET["id_partida"]);
    if(!$partida) {
        // header("Location: lobby.php");
    }
    $jogador1 = $usuarioDAO->getById($partida->id_jogador1);
    $jogador2 = $usuarioDAO->getById($partida->id_jogador2);

    if( !($jogador1->id == $_SESSION['id'] || $jogador2->id == $_SESSION['id']) ) {
        // header("Location: lobby.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <link href='./css/style.css' rel='stylesheet' type='text/css'>
        <title>Monopoly</title>
        <script src="./js/script.js"></script>
        <script src="./js/game.js"></script>
        <script src="./js/tabuleiro.js"></script>
    </head>
    <body onload="game.init(); game.updateHUD();">    
        <input type="hidden" id="id_jogador1" value='<?php echo $jogador1->id ?>'>
        <input type="hidden" id="id_jogador2" value='<?php echo $jogador2->id ?>'>
        <input type="hidden" id="id_partida" value='<?php echo $partida->id ?>'>

        <div id="main-jogo">
            <canvas id="canvas" width="740" height="644"> 
                Erro. Instale o Chrome/Firefox
            </canvas>
            <canvas id="canvasHUD" width="200" height="644"> 
                Erro. Instale o Chrome/Firefox
            </canvas>      
            <button onclick="girarDado()">Dado</button>
        </div>
    </body>
</html>
