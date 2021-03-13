<?php 
require_once("../database/connexion_db.php");
require_once("../functions/fonctions.php");

$idProduit = isset($_GET['idProduit']) ? $_GET['idProduit'] : 0;
$requeteAllProduit = "SELECT * FROM produits WHERE idProduit=$idProduit";

$resultatAllProduit = $pdo->query($requeteAllProduit);
$produit =$resultatAllProduit->fetch();

$nomProduit  = $produit['nomProduit'];
$prixProduit = $produit['prixProduit'];
$nomPhoto    = $produit['photoProduit'];
$idCategorie = $produit['idCategorie'];
$idFamille   = $produit['idFamille'];


$requeteAllCategories = "SELECT * FROM categories";
$resultatAllCategories = $pdo->query($requeteAllCategories);

$requeteAllFamilles  = "SELECT * FROM familles";
$resultatAllFamilles = $pdo->query($requeteAllFamilles);


?>


<!DOCTYPE html>
<html>
<head>
	<title>Edition d'un produit</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>

	<?php include("../pageBlanche.php") ; ?>



	<div class="section_recherche" id="inserer">
		<div class="panel panel-primary">
			<div class="panel-heading">Edition d'un produit</div>
			<div class="panel-body">
				<form class="form" action="updateProduit.php" method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label for="idProduit">Id du produit: <?= $idProduit; ?>  </label>
						<input type="hidden" name="idProduit" class="form-control" value="<?= $idProduit; ?>" >
						
					</div>
					<div class="form-group">
						<label for="nomProduit">Nom du produit</label>
						<input type="text" name="nomProduit"  class="form-control" value="<?= $nomProduit ; ?>">
					</div>

					<div class="form-group">
						<label for="prixProduit">Prix du Produit:</label>
						<input type="text" name="prixProduit" class="form-control" value="<?= $prixProduit; ?>">
						
					</div>

					<div class="form-group">
						<input type="file" name="photo" class="form-control"/>
					</div>

					<select name="idCategorie" class="form-control">
						<?php while($cat = $resultatAllCategories->fetch()) {   ?>
							<option value="<?= $cat['idCategorie']; ?>" <?php  if($idCategorie==$cat['idCategorie']) echo "selected"; ?>  ><?=$cat['nomCategorie']?></option>
						<?php } ?>
						
					</select> <br>

					<select name="idFamille" class="form-control">

						<?php while($fam = $resultatAllFamilles->fetch()) {   ?>

							<option value="<?= $fam['idFamille']; ?>" <?php if($idFamille==$fam['idFamille']) echo "selected"; ?>  ><?= $fam['nomFamille']; ?></option>

						<?php  }  ?>
						
					</select> <br>


					<button type="submit" class="btn btn-primary">Valider Modification</button>

				</form>
				
			</div>
		</div>
		
	</div>



</body>
</html>