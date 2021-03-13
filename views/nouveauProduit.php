<?php

require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");



$requeteAllCategories = "SELECT * FROM categories";
$resultatAllCategories = $pdo->query($requeteAllCategories);

$requeteAllFamilles = "SELECT * FROM familles";
$resultatAllFamilles = $pdo->query($requeteAllFamilles);


$nomProduit  = isset($_POST['nomProduit'])  ? secure_datas($_POST['nomProduit'])  : "";
$prixProduit = isset($_POST['prixProduit']) ? secure_datas($_POST['prixProduit']) : "";
$idCategorie = isset($_POST['idCategorie']) ? $_POST['idCategorie'] : 0;
$idFamille   = isset($_POST['idFamille'])   ? $_POST['idFamille'] : 0;

$nomPhoto    = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : "";

$img_tmp = $_FILES['photo']['tmp_name'];

move_uploaded_file($img_tmp, "../images/produits/".$nomPhoto);

$requeteInsertProduits = "INSERT INTO produits (nomProduit,prixProduit,photoProduit,idCategorie,idFamille) VALUES (?,?,?,?,?)";

$params = array($nomProduit, $prixProduit, $nomPhoto, $idCategorie, $idFamille);

$resultatInsertProduit = $pdo->prepare($requeteInsertProduits);

$resultatInsertProduit->execute($params);



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<title>Nouveau produit</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>
	<?php include("../pageBlanche.php") ; ?>


	<div class="section_recherche" id="inserer">
		<div class="panel panel-primary">
			<div class="panel-heading">Insertion d'un nouveau Produit</div>
			<div class="panel-body">
				<form class="form" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">

						<label for="nomProduit">Nom du produit:</label>
						<input type="text" name="nomProduit" placeholder="Entrer le nom du produit ici..." class="form-control">
					</div>
					<div class="form-group">
						<label for="prixProduit">Prix du produit en $:</label>
						<input type="text" name="prixProduit" placeholder="Entrer le prix du produit ici..." class="form-control">
						
					</div>

					<div class="form-group">
					<label for="photo">Photo:</label>
					<input type="file" name="photo"/>
			    	</div>

					<select name="idCategorie" class="form-control">
						<?php while($cat = $resultatAllCategories->fetch()) {   ?>
							<option value="<?= $cat['idCategorie'];  ?>"> <?= $cat['nomCategorie']; ?>
								
							</option>
						<?php  } ?>
						
					</select><br>

					<select name="idFamille" class="form-control">
						<?php while($fam = $resultatAllFamilles->fetch()) {   ?>

							<option value="<?= $fam['idFamille']; ?>"><?= $fam['nomFamille']; ?></option>

					    <?php  } ?>
						
					</select> <br>


					
					<button type="submit" class="btn btn-primary">Enregistrer</button>

				</form>
				
			</div>
		</div>
		
	</div>


</body>
</html>