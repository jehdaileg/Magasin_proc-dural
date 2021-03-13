<?php
require_once("../database/connexion_db.php");

$idFamille = isset($_GET['idFamille']) ? $_GET['idFamille']: 0;

$requeteCountProduits = "SELECT count(*) countPROD FROM produits WHERE idFamille=$idFamille";
$resultatCountProduits = $pdo->query($requeteCountProduits);
$tabCountProd = $resultatCountProduits->fetch();

$nbre_produits = $tabCountProd['countPROD'];

if($nbre_produits == 0)
{
	$requeteDeleteFamille = "DELETE FROM familles WHERE idFamille=?";
	$params = array($idFamille);
	$resultatDeleteFamille = $pdo->prepare($requeteDeleteFamille);
	$resultatDeleteFamille->execute($params);

} 
else 
{
	$warning = "Suppression Impossible car cette famille contient des enregistrements";

	header("Location:alertesSpeciales.php?warning=$warning");
}



?>