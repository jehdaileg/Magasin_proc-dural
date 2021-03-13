<?php

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$idFamille = isset($_GET['idFamille'])? $_GET['idFamille'] : 0;

$requeteAllFamille = "SELECT * FROM familles WHERE idFamille=$idFamille";
$resultatAllFamille = $pdo->query($requeteAllFamille);

$famille = $resultatAllFamille->fetch();
$nomFamille = $famille['nomFamille'];
$idCategorie = $famille['idCategorie'];


$requeteAllCategorie = "SELECT * FROM categories";
$resultatAllCategorie = $pdo->query($requeteAllCategorie);




?>

<!DOCTYPE html>
<html>
<head>
	<title>Edition d'une famille</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>

	<?php include("../pageBlanche.php") ; ?>



	<div class="section_recherche">
		<div class="panel panel-primary">
			<div class="panel panel-heading">Modification d'une Famille:</div>
			<div class="panel panel-body">
				
				<form action="updateFamille.php" method="post" class="form">
					<div class="form-group">
						<label for="idFamille">Id de la Famille : <?= $idFamille; ?></label>
						<input type="hidden" name="idFamille" class="form-control" value="<?= $idFamille;?>">
					</div>

					<div class="form-group">
						<input type="text" name="nomFamille" class="form-control" value="<?= $nomFamille; ?>">
					</div>

					<select name="idCategorie" class="form-control">
						<?php while($cat = $resultatAllCategorie->fetch()) {  ?>

							<option value="<?= $cat['idCategorie']; ?>" <?php if($idCategorie==$cat['idCategorie']) echo "selected";  ?> ><?= $cat['nomCategorie']; ?> </option>

					    <?php } ?>
						
					</select> <br>
					<button type="submit" class="btn btn-primary"> Valider Modifications</button>

					
				</form>
			</div>
		</div>
		
	</div>



</body>
</html>