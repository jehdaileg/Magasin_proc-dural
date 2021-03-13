<?php
require_once("../database/connexion_db.php");

$size = isset($_GET['size'])? $_GET['size'] : 6;
$page = isset($_GET['page'])? $_GET['page'] : 1;
$offset = ($page-1) * $size;

$requeteAllFamilles = "SELECT * FROM familles";
$resultatAllFamilles = $pdo->query($requeteAllFamilles);


$nomProduit = isset($_GET['nomProduit'])? $_GET['nomProduit']: "";
$idFamille = isset($_GET['idFamille'])? $_GET['idFamille']: 0;

if($idFamille==0)
{
	$requeteAllProduits = " SELECT idProduit, nomProduit, prixProduit, photoProduit, nomFamille from familles as f, produits as p WHERE f.idFamille = p.idFamille and (nomProduit like '%$nomProduit%') order by idProduit LIMIT $size offset $offset";

	$requeteCountProduits = " SELECT count(*) countPROD from produits WHERE nomProduit like '%$nomProduit%'";

} else 
{
	$requeteAllProduits = "SELECT idProduit, nomProduit, prixProduit, photoProduit, nomFamille from familles as f, produits as p WHERE f.idFamille = p.idFamille and (nomProduit like '%$nomProduit%') and f.idFamille=$idFamille order by idProduit LIMIT $size offset $offset";

	$requeteCountProduits = "SELECT count(*) countPROD from produits WHERE nomProduit like '%$nomProduit%' and idFamille = $idFamille";

}

$resultatAllProduits = $pdo->query($requeteAllProduits);
$resultatCountProduits = $pdo->query($requeteCountProduits);
$tabCount = $resultatCountProduits->fetch();
$nbre_Produits = $tabCount['countPROD'];

$reste = $nbre_Produits%$size;

if($reste==0)
{
	$nbre_Pages = $nbre_Produits/$size;

} else {
	$nbre_Pages = floor($nbre_Produits/$size) + 1;

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Produits</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>

	
	<?php include("../pageBlanche.php") ; ?>

	<div class="section_recherche">
		<div class="panel panel-warning">
			<div class="panel-heading">Recherche des Produits...</div>
			<div class="panel-body">
				<form class="form-inline" method="get" action="">
					<div class="form-group">
						<input type="text" name="nomProduit" id="nomProduit" placeholder="Tapez le nom du produit à chercher..." class="form-control">
					</div> &nbsp; &nbsp;

					Famille:
					<select name="idFamille" class="form-control">
						<option value=0>Toutes les familles</option>
						<?php while($fam = $resultatAllFamilles->fetch()) {  ?>

							<option value="<?= $fam['idFamille']; ?>"> <?= $fam['nomFamille']; ?> </option>
							
						<?php } ?>
					</select> &nbsp; &nbsp;
					<button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i>  Rechercher</button> &nbsp; &nbsp;

					<?php if(isset($_SESSION['user']) &&($_SESSION['user']['idRole']==2 || $_SESSION['user']['idRole']==3)) {  ?>

					<a href="nouveauProduit.php" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>  Ajouter un produit</a>

					<?php } ?>

					
				</form>
			</div>
		</div>
	</div>

	<div class="section_datas">
		<div class="panel panel-success">
			<div class="panel-heading">Liste des produits  (<?php if($nbre_Produits<=1) { echo $nbre_Produits. " valeur"; } else { echo $nbre_Produits. " valeurs"; }  ?>)</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Id</th><th>Nom</th><th>Prix</th><th>Photo</th><th>Nom Famille</th>

							<?php if(isset($_SESSION['user']) &&($_SESSION['user']['idRole']==2 || $_SESSION['user']['idRole']==3)) {  ?>
							<th>Actions</th>
							 <?php  }  ?>
							 
						</tr>
					</thead>

					<tbody>
						<?php while($prod = $resultatAllProduits->fetch()) {  ?>
							<tr>
								<td><?= $prod['idProduit'];  ?></td>
								<td><?= $prod['nomProduit'];  ?></td>
								<td><?= $prod['prixProduit'];  ?> $</td>
								<td><img src="../images/produits/<?= $prod['photoProduit']; ?>" width="50px" height="50px"></td>
								<td><?= $prod['nomFamille'];  ?></td>

								<?php if(isset($_SESSION['user']) &&($_SESSION['user']['idRole']==2 || $_SESSION['user']['idRole']==3)) {  ?>
								<td>
									<a href="editerProduit.php?idProduit=<?= $prod['idProduit']; ?>"><span class="glyphicon glyphicon-edit" class="span_edite"></span> Editer</a> &nbsp; &nbsp;

									<a href="supprimerProduit.php?idProduit=<?= $prod['idProduit']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce produit?');"><span class="glyphicon glyphicon-trash" class="span_supprime"></span>  Supprimer</a>
								</td>

								 <?php  }  ?>

							</tr>

					    <?php  }  ?>
						
					</tbody>
				</table>
				<div>
					<ul class="pagination">

						<?php for($i=1; $i<=$nbre_Pages; $i++) {  ?>

						<li class="<?php if($i==$page) echo "active"; ?>" ><a href="produits.php?page=<?= $i; ?>"><?= $i; ?></a></li>

					    <?php }?>
					</ul>
				
			</div>
			</div>
		</div>
	</div>

</body>
</html>