<?php
$mysqli = new mysqli('localhost', 'root', 'root', 'projetoweb');

if (mysqli_connect_errno()) {
    die('Não foi possí­vel conectar-se ao banco de dados: ' . mysqli_connect_error());
    exit();
}

?>