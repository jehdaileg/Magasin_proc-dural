<?php
session_start();

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");


if(isset($_SESSION['erreurLogin']))
{
	$erreurLogin = $_SESSION['erreurLogin'];

}else
{
	$erreurLogin = "";

}
session_destroy();


?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=width-content" initial-scale="1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>

	<?php include("../pageBlanche.php") ; ?>

	


	<div class="section_recherche" id="inserer">
		<div class="panel panel-success">
			<div class="panel-heading">Se Connecter</div>
			<div class="panel-body">
				<form class="form" action="SeConnecter.php" method="post">

					<?php if(!empty($erreurLogin)){   ?>
					<div class="alert alert-danger">

						<p><?= $erreurLogin; ?></p>
						
					</div>
				    <?php } ?>

					<div class="form-group">

						<label for="nomCategorie">Login:</label>
						<input type="text" name="login" placeholder="Tapez votre Login ici..." class="form-control">
					</div>

					<div class="form-group">
						<label>Mot de passe:</label>
						<input type="password" name="password" placeholder="Tapez votre mot de passe ici..." class="form-control">
						
					</div>
					<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-log-in"></span> Connexion</button> &nbsp; &nbsp;

					<a href="motdepasseOublie.php"> Mot de passe oublié ?</a> &nbsp; &nbsp;

					<a href="nouvelUtilisateur.php">  Créer un Compte</a>

				</form>
				
			</div>
		</div>
		
	</div>



</body>
</html>