<?php 

session_start();
$_SESSION = array();
session_destroy();
header("Location: connexion.php"); // permet à l'utilisateur de retourner dans la page connexion quand il se déco
?>