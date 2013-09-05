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
    <body onload="game.init()">    
        <canvas id="canvas" width="740" height="644"> 
            Erro. Instale o Chrome/Firefox
        </canvas>
        <canvas id="canvasHUD" width="200" height="644"> 
            Erro. Instale o Chrome/Firefox
        </canvas>      
        <button onclick="girarDado()">Dado</button>
    </body>
</html>
