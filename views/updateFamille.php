<?php

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$idFamille = isset($_POST['idFamille']) ? $_POST['idFamille'] : 0;


$nomFamille = isset($_POST['nomFamille']) ? secure_datas($_POST['nomFamille']) : "";

$idCategorie = isset($_POST['idCategorie']) ? $_POST['idCategorie'] : 1;

$requeteUpdateFamille = "UPDATE familles SET nomFamille=?, idCategorie=? WHERE idFamille=?";

$params = array($nomFamille, $idCategorie, $idFamille);

$resultatUpdateFamille = $pdo->prepare($requeteUpdateFamille);
 
$resultatUpdateFamille->execute($params);




?>