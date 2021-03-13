<?php
session_start();

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");


$login    = isset($_POST['login'])? secure_datas($_POST['login']) : "";
$password = isset($_POST['password'])? $_POST['password'] : "";

$requeteAllUser  = "SELECT * FROM utilisateurs WHERE login='$login' AND password=md5('$password')";
$resultatAllUser = $pdo->query($requeteAllUser);
          
             if($user = $resultatAllUser->fetch())

             {
             	if($user['actif']==1)
             	{
             		$_SESSION['user'] = $user;

             		header('Location:../index.php');
             	}else
             	{
             		$_SESSION['erreurLogin'] = "<strong>Erreur!!!</strong>Votre compte est désactivé, veuillez contactez l'administrateur pour le réactiver svp!";
             		
             	}

             }else 
             {
             	   $_SESSION['erreurLogin'] = "<strong>Erreur!!!</strong>Login ou mot de passe Incorrect!veuillez Reessayer!";

             }




?>