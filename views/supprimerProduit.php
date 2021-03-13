<?php
require_once("../database/connexion_db.php");

$idProduit = isset($_GET['idProduit']) ? $_GET['idProduit'] : 0;

$requeteDeleteProduit = "DELETE FROM produits WHERE idProduit=?";
$params = array($idProduit);
$resultatDeleteProduit = $pdo->prepare($requeteDeleteProduit);
$resultatDeleteProduit->execute($params);

?>