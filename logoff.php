<?php
session_start(); 
if (!isset($_SESSION["login"]) || !isset($_SESSION["id"]))
{
	header("Location: login.php");		
}
 
session_destroy(); 
header("Location: index.php");
?>