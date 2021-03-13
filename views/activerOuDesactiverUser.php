<?php
require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$idUser = isset($_GET['idUser']) ? $_GET['idUser']: 0;
$etat  = isset($_GET['etat']) ? $_GET['etat']: 0;

if($etat==1)
{
	$nouvelEtat = 0;
	$requeteActiverOuDesactiverUser = "UPDATE utilisateurs SET actif=? WHERE idUser=?";
	$params = array($nouvelEtat, $idUser);

} else 
{
	$nouvelEtat = 1;
	$requeteActiverOuDesactiverUser = "UPDATE utilisateurs SET actif=? WHERE idUser=?";
	$params = array($nouvelEtat, $idUser);

}

   $resultatActivDesactivUser = $pdo->prepare($requeteActiverOuDesactiverUser);
   $resultatActivDesactivUser->execute($params);

   header('Location:utilisateurs.php');

   ?>

   