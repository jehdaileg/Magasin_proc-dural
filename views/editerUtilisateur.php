<?php
require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$idUser = isset($_GET['idUser'])? $_GET['idUser'] : 0;

$requeteAllRole  = "SELECT * FROM roles";
$resultatAllRole = $pdo->query($requeteAllRole);

$requeteAllUtilisateur  = "SELECT * FROM utilisateurs WHERE idUser=$idUser";
$resultatAllUtilisateur = $pdo->query($requeteAllUtilisateur);  

$user = $resultatAllUtilisateur->fetch();

$Login             = $user['login'];
$email             = $user['email'];
$photoUtilisateur  = $user['photoUtilisateur'];
$actif             = $user['actif'];
$role              = $user['idRole'];


?>

<!DOCTYPE html>
<html>
<head>
	<head>
	<title>Editer Utilisateur</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">

</head>
</head>
<body>
	<?php include("../pageBlanche.php") ; ?>

	<div class="section_recherche">
		<div class="panel panel-primary">
			<div class="panel panel-heading">Modification d'un Utilisateur</div>
			<div class="panel panel-body">

				<form action="updateUtilisateur.php" method="post" class="form" enctype="multipart/form-data">
					<div class="form-group">
						<label>ID: <?= $idUser; ?></label>
						<input type="hidden" name="idUser" value="<?= $idUser;?>">
					</div>
					<div class="form-group">
						<label>Login:</label>
						<input type="text" name="login" value="<?= $Login; ?>" class="form-control">
						
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input type="email" name="email" value="<?= $email  ?>" class="form-control">
						
					</div>
					<label>Photo:</label>
					<div class="form-group">
						<input type="file" name="photo" class="form-control">
						
					</div>

					<label>Actif:</label>
					<select name="actif" class="form-control">
						<option value=0 <?php if($actif==0) echo "selected"; ?>>Etat desactivé</option>
						<option value=1 <?php if($actif==1) echo "selected";  ?>>Etat activé</option>

						
					</select><br>
					<label>Rôle:</label>
					<select name="idRole" class="form-control">

						<?php while($rol = $resultatAllRole->fetch()) {   ?>
							<option value="<?= $rol['idRole']; ?>" <?php if($role==$rol['idRole']) echo "selected";  ?> ><?= $rol['nomRole']; ?></option>
						<?php } ?>
						
					</select> <br>

					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span>  Valider Modifications</button> &nbsp; &nbsp;

					<a href="changerMotDePasse.php"> Changer le mot de passe</a>

				</form>
				
			</div>
		</div>
		
	</div>

</body>
</html>