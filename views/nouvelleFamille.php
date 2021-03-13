<?php

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$requeteAllCategorie = "SELECT * FROM categories";
$resultatAllCategories = $pdo->query($requeteAllCategorie);


$nomFamille = isset($_POST['nomFamille']) ? secure_datas($_POST['nomFamille']) : "";
$idCategorie =isset($_POST['idCategorie']) ? $_POST['idCategorie'] : 0;

$requeteInsertFamille = "INSERT INTO familles (nomFamille, idCategorie) VALUES (?,?)";
$params = array($nomFamille, $idCategorie);
$resultatInsertFamille = $pdo->prepare($requeteInsertFamille);
$resultatInsertFamille->execute($params);



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<title>Nouvelle Famille</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>
	<?php include("../pageBlanche.php") ; ?>


	<div class="section_recherche" id="inserer">
		<div class="panel panel-primary">
			<div class="panel-heading">Insertion d'une nouvelle famille</div>
			<div class="panel-body">
				<form class="form" action="" method="post">
					<div class="form-group">

						<label for="nomCategorie">Nom de famille</label>
						<input type="text" name="nomFamille" placeholder="Entrer le nom de la famille ici..." class="form-control">
					</div>

					<select name="idCategorie" class="form-control">

						<?php while($cate = $resultatAllCategories->fetch()) {  ?>

							<option value="<?= $cate['idCategorie'] ?>"><?= $cate['nomCategorie']; ?>
								
							</option>

						<?php }?>

						
					</select> <br>
					<button type="submit" class="btn btn-primary">Enregistrer</button>

				</form>
				
			</div>
		</div>
		
	</div>


</body>
</html>