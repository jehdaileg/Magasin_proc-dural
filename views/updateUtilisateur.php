<?php
require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$idUser = isset($_POST['idUser'])? $_POST['idUser'] : 0;
$login = isset($_POST['login'])? secure_datas($_POST['login']) : "";
$email = isset($_POST['email'])? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : "";
$photoUtilisateur = isset($_FILES['photo']['name'])? $_FILES['photo']['name'] : "";
$actif = isset($_POST['actif'])? $_POST['actif'] : 0;
$idRole = isset($_POST['idRole'])? $_POST['idRole'] : 0;

$img_tmp = $_FILES['photo']['tmp_name'];

move_uploaded_file($img_tmp, "../images/utilisateurs/".$photoUtilisateur);

if(!empty($photoUtilisateur))
{
	$requeteUpdateUser = "UPDATE utilisateurs SET login=?, email=?, photoUtilisateur=?, actif=?, idRole=? WHERE idUser=?";

	$params = array($login, $email, $photoUtilisateur, $actif, $idRole, $idUser);

} else 
{
	$requeteUpdateUser = "UPDATE utilisateurs SET login=?, email=?, actif=?, idRole=? WHERE idUser=?";

	$params = array($login, $email, $actif, $idRole, $idUser);


}

    $resultatUpdateUser = $pdo->prepare($requeteUpdateUser);
    $resultatUpdateUser->execute($params);

    header('Location:utilisateurs.php');


?>