<?php
require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");


$idUser = isset($_GET['idUser'])? $_GET['idUser'] : 0;

$requeteDeleteUser = "DELETE FROM utilisateurs WHERE idUser=?";
$params = array($idUser);
$resultatDeleteUser = $pdo->prepare($requeteDeleteUser);
$resultatDeleteUser->execute($params);
header('Location:utilisateurs.php');


?>