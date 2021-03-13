<?php

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$erreurs = array();
$succes = array();



$nomCategorie = isset($_POST['nomCategorie'])? secure_datas($_POST['nomCategorie']) : "";


$insertIntoCategorie = "INSERT INTO categories (nomCategorie) VALUES (?)";
$params = array($nomCategorie);
$resultatInsertCat = $pdo->prepare($insertIntoCategorie);
$resultatInsertCat->execute($params);

if(!$resultatInsertCat)
{
	$erreurs['insert'] = "Insertion de la catégorie Echouée, réessayer svp! ";
}
else {
	$succes['insert'] = "Insertion de la catégorie réussie";
	

}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Nouvelle Catégorie</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>

	<?php include("../pageBlanche.php") ; ?>

	<?php if(!empty($succes) && isset($succes)):  ?>

		<div class="alert alert-success section_recherche">
		<p>SUCCESS</p>
		<ul>
			<?php foreach($succes as $suc):   ?>
				<li><?= $suc; ?></li>
			<?php  endforeach;  ?>
		</ul>
	</div>

	<?php  endif;  ?>


	<?php if(!empty($erreurs) && isset($erreurs)):  ?>

		<div class="alert alert-danger section_recherche">
		<p>ERREUR</p>
		<ul>
			<?php foreach($erreurs as $err):   ?>
				<li><?= $err; ?></li>
			<?php  endforeach;  ?>
		</ul>
	</div>
	
	<?php  endif;  ?>

	


	<div class="section_recherche" id="inserer">
		<div class="panel panel-primary">
			<div class="panel-heading">Insertion d'une nouvelle catégorie</div>
			<div class="panel-body">
				<form class="form" action="" method="post">
					<div class="form-group">

						<label for="nomCategorie">Nom de la catégorie</label>
						<input type="text" name="nomCategorie" placeholder="Entrer le nom de la catégorie ici..." class="form-control">
					</div>
					<button type="submit" class="btn btn-primary">Enregistrer</button>

				</form>
				
			</div>
		</div>
		
	</div>



</body>
</html>