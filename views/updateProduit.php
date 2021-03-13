<?php

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$idProduit  = isset($_POST['idProduit']) ? $_POST['idProduit'] : 0;
$nomProduit = isset($_POST['nomProduit']) ? $_POST['nomProduit'] : "";
$prixProduit = isset($_POST['prixProduit']) ? $_POST['prixProduit']: "";
$nomPhoto = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : "";
$idCategorie = isset($_POST['idCategorie']) ? $_POST['idCategorie'] : 1;
$idFamille = isset($_POST['idFamille']) ? $_POST['idFamille'] : 1;

$img_tmp = $_FILES['photo']['tmp_name'];

move_uploaded_file($img_tmp, "../images/produits/".$nomPhoto);

if(!empty($nomPhoto))
{
	 $requeteUpdateProduits = "UPDATE produits SET nomProduit=?, prixProduit=?, photoProduit=?, idCategorie=?, idFamille=? WHERE idProduit=?";
	 $params = array($nomProduit, $prixProduit, $nomPhoto, $idCategorie, $idFamille, $idProduit);
} else 
{
	 $requeteUpdateProduits = "UPDATE produits SET nomProduit=?, prixProduit=?, idCategorie=?, idFamille=? WHERE idProduit=?";
	 $params = array($nomProduit, $prixProduit, $idCategorie, $idFamille, $idProduit);
}

$resultatUpdateProduit = $pdo->prepare($requeteUpdateProduits);
$resultatUpdateProduit->execute($params);



?>