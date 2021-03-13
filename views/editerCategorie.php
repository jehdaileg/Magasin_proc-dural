<?php

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$erreurs = array();
$succes = array();


$idCategorie = isset($_GET['idCategorie'])? $_GET['idCategorie'] : 0;

$requeteAllCategories = "SELECT * from  categories WHERE idCategorie=$idCategorie";
$resultatAllCategories = $pdo->query($requeteAllCategories);
$categorie = $resultatAllCategories->fetch();

$nomCatAncien = $categorie['nomCategorie'];


?>

<!DOCTYPE html>
<html>
<head>
	<title>Edition d'une catégorie</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>

	<?php include("../pageBlanche.php") ; ?>



	<div class="section_recherche" id="inserer">
		<div class="panel panel-primary">
			<div class="panel-heading">Edition d'une catégorie</div>
			<div class="panel-body">
				<form class="form" action="updateCategorie.php" method="post">

					<div class="form-group">
						<label for="idCategorie">Id de la Catégorie: <?= $idCategorie; ?>  </label>
						<input type="hidden" name="idCategorie" class="form-control" value="<?= $idCategorie; ?>" >
						
					</div>
					<div class="form-group">
						<label for="nomCategorie">Nom de la catégorie</label>
						<input type="text" name="nomCategorie"  class="form-control" value="<?=$nomCatAncien; ?>">
					</div>
					<button type="submit" class="btn btn-primary">Valider Modification</button>

				</form>
				
			</div>
		</div>
		
	</div>



</body>
</html>