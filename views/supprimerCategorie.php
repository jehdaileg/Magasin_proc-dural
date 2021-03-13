<?php

require_once("../database/connexion_db.php"); 

$idCategorie = isset($_GET['idCategorie']) ? $_GET['idCategorie'] : 0;

$requeteCountFamilles = "SELECT count(*) countF from familles WHERE idCategorie=$idCategorie";
$requeteCountProduits = "SELECT count(*) CountP from produits WHERE idCategorie=$idCategorie";

$resultatCountFamilles =$pdo->query($requeteCountFamilles);
$tabCountFam = $resultatCountFamilles->fetch();
$nbre_fam = $tabCountFam['countF'];

$resultatCountProduits = $pdo->query($requeteCountProduits);
$tabCountProd =$resultatCountProduits->fetch();
$nbre_prod = $tabCountProd['countP'];

if($nbre_fam==0 && $nbre_prod==0)
{
	$requeteDeleteCategorie = "DELETE from categories WHERE idCategorie=?";
	$params = array($idCategorie);
	$resultatDeleteCategorie = $pdo->prepare($requeteDeleteCategorie);
	$resultatDeleteCategorie->execute($params);

	header('Location:categories.php');


} else 
{
	$msg ="Impossible de supprimer la Catégorie car elle possède des enregistrements!";
	header("Location:alertesSpeciales.php?message=$msg");
}



?>