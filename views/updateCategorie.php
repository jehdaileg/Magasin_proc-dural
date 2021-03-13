<?php

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$erreurs = array();
$succes = array();

$idCategorie = isset($_POST['idCategorie']) ? $_POST['idCategorie'] : 0;
$nomCategorie = isset($_POST['nomCategorie']) ? secure_datas($_POST['nomCategorie']) : "";

$requeteUpdateCategorie = "UPDATE categories SET nomCategorie=? WHERE idCategorie=?";
$params=array($nomCategorie, $idCategorie );
$resultatUpdateCat = $pdo->prepare($requeteUpdateCategorie);
$resultatUpdateCat->execute($params);

header('Location:categories.php');

/* A GERER LES MESSAGES FLASH POUR LE U DU CRUD */





?>