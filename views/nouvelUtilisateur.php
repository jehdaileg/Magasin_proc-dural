<?php

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$requeteAllRole = "SELECT * FROM roles";
$resultatAllRole = $pdo->query($requeteAllRole);

$login            =  isset($_POST['login'])? secure_datas($_POST['login']) : "";
$email            =  isset($_POST['email'])? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : "";
$photoUtilisateur =  isset($_FILES['photo']['name'])? $_FILES['photo']['name'] : "";
$actif            =  isset($_POST['Actif'])? $_POST['Actif'] : 0;
$password         =  isset($_POST['password'])? md5($_POST['password']) : "";
$idRole           =  isset($_POST['idRole'])? $_POST['idRole'] : 0;

$img_tmp          =  $_FILES['photo']['tmp_name'];



move_uploaded_file($img_tmp, "../images/utilisateurs/".$photoUtilisateur); 

$requeteInsertUtilisateur = "INSERT INTO utilisateurs(login,email,password,photoUtilisateur,actif,idRole) VALUES (?,?,?,?,?,?)";

$params = array($login,$email,$password,$photoUtilisateur,$actif,$idRole);

$resultatInsertUtilisateur = $pdo->prepare($requeteInsertUtilisateur);

$resultatInsertUtilisateur->execute($params);

//header('Location:utilisateurs.php');



?>

<!DOCTYPE html>
<html>
<head>
	<title>Nouvel Utilisateur</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">

</head>
<body>
	<?php include("../pageBlanche.php") ; ?>

	<div class="section_recherche">
		<div class="panel panel-success">
			<div class="panel panel-heading">Insertion d'un nouvel Utilisateur</div>
			<div class="panel panel-body">
				
				<form action="" method="post" class="form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="login">Entrer le login:</label>
						<input type="text" name="login" class="form-control" placeholder="Tapez login ici...">
						
					</div>
					<div class="form-group">
						<label for="email">Entrer l'email:</label>
						<input type="email" name="email" placeholder="Tapez  email ici..." class="form-control">
						
					</div>
					<div class="form-group">
						<input type="file" name="photo" class="form-control">
						
					</div>
					<label>Etat:</label>

					<select name="Actif" class="form-control">
						<option value=0 selected>Etat Desactivé</option>
						<option value=1>Etat Actif</option>
						
					</select>

					<div class="form-group">
						<label for="password">Entrer le mot de passe par défaut:</label>
						<input type="password" name="password" placeholder="Tapez mot de passe ici..." class="form-control">
						
					</div>

                    <label>Rôle:</label>
					<select name="idRole" class="form-control">
						<?php while($rol = $resultatAllRole->fetch()) {    ?>
							<option value="<?= $rol['idRole']; ?>"><?= $rol['nomRole']; ?></option>

						<?php  } ?>
					</select> <br>
						
						<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Enregistrer</button>
					
				</form>
			</div>
		</div>
		
	</div>

</body>
</html>