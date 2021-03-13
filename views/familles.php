<?php
require_once("../database/connexion_db.php");

$requeteAllCategories = "SELECT * FROM categories";
$resultatAllCategories = $pdo->query($requeteAllCategories);

/**
Prévoir les variables pour la pagination 
**/
$size = isset($_GET['size'])? $_GET['size'] : 6;
$page = isset($_GET['page'])? $_GET['page'] : 1;
$offset = ($page-1) * $size;


$nomFamille = isset($_GET['nomFamille'])? $_GET['nomFamille']: "";
$idCategorie = isset($_GET['idCategorie'])? $_GET['idCategorie']: 0;

if($idCategorie==0)
{
	$requeteAllFamilles = "	SELECT idFamille, nomFamille, nomCategorie from categories as c, familles as f 
	WHERE c.idCategorie = f.idCategorie and nomFamille like '%$nomFamille%' order by idFamille LIMIT $size offset $offset ";

	$requeteCountFamilles = "SELECT count(*) countFAM from familles WHERE nomFamille like '%$nomFamille%'";

} else 
{
	$requeteAllFamilles = "SELECT idFamille, nomFamille, nomCategorie from categories as c, familles as f 
	WHERE c.idCategorie = f.idCategorie and (nomFamille like '%$nomFamille%') and c.idCategorie=$idCategorie order by idFamille LIMIT $size offset $offset ";

	$requeteCountFamilles = "SELECT count(*) countFAM from familles WHERE (nomFamille like '%$nomFamille%') and idCategorie=$idCategorie";

}

$resultatAllFamilles = $pdo->query($requeteAllFamilles);
$resultatCountFamilles = $pdo->query($requeteCountFamilles);
$tabCounter = $resultatCountFamilles->fetch();
$nbre_familles = $tabCounter['countFAM'];

$reste = $nbre_familles%$size;

if($reste==0)
{
	$nbre_Pages = $nbre_familles/$size;
} else 
{
	$nbre_Pages = floor($nbre_familles/$size) + 1;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Familles</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>

	
	<?php include("../pageBlanche.php") ; ?>

	<div class="section_recherche">
		<div class="panel panel-warning">
			<div class="panel-heading">Recherche des familles...</div>
			<div class="panel-body">
				<form action="" method="get" class="form-inline">
					<div class="form-group">
						<input type="text" name="nomFamille" id="nomFamille" class="form-control" placeholder="Tapez le nom de la famille à chercher">
					</div> &nbsp; &nbsp;
                    Catégorie:
                    
					<select class="form-control" name="idCategorie" onchange="this.form.submit();">
						<option value=0>Toutes les catégories</option>

						<?php while($cat = $resultatAllCategories->fetch()) {  ?>
							<option value="<?= $cat['idCategorie'];  ?>"><?= $cat['nomCategorie']; ?></option>
						
						<?php }  ?>
					</select>
				   
					 &nbsp;
					<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Rechercher</button> &nbsp; &nbsp;

					<?php if(isset($_SESSION['user']) &&($_SESSION['user']['idRole']==2 || $_SESSION['user']['idRole']==3)) {  ?>

					<a href="nouvelleFamille.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>  Ajouter une famille</a>

					<?php } ?>


				</form>
			</div>
		</div>
	</div>

	<div class="section_datas">
		<div class="panel panel-success">
			<div class="panel-heading">Liste des familles (<?php if($nbre_familles<=1) {echo $nbre_familles. " valeur"; } else { echo $nbre_familles. " valeurs";  }  ?>)</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Id</th><th>Nom Famille</th><th>Nom Catégorie</th>

							<?php if(isset($_SESSION['user']) &&($_SESSION['user']['idRole']==2 || $_SESSION['user']['idRole']==3)) {  ?>
								
							<th>Actions</th>

							<?php }?>
						</tr>
					</thead>
					<tbody>
						<?php  while($fam = $resultatAllFamilles->fetch()) { ?>
						<tr>
							<td><?= $fam['idFamille'];     ?>    </td>
							<td><?= $fam['nomFamille'];    ?>    </td>
							<td><?= $fam['nomCategorie'];  ?>    </td>

								<?php if(isset($_SESSION['user']) &&($_SESSION['user']['idRole']==2 || $_SESSION['user']['idRole']==3)) {  ?>
							<td>
								<a href="editerFamille.php?idFamille=<?= $fam['idFamille']; ?>"><span class="fa fa-edit" class="span_edite"></span> Editer</a> &nbsp; &nbsp;

								<a href="supprimerFamille.php?idFamille=<?= $fam['idFamille']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette famille?');"><span class="fa fa-trash" class="span_supprime"></span>  Supprimer</a>
							</td>
							<?php } ?>
						</tr>
					<?php } ?>
					</tbody>
				</table>

				<div>
					<ul class="pagination">

						<?php for($i=1; $i<=$nbre_Pages; $i++) {  ?>

						<li class="<?php if($i==$page) echo "active"; ?>" ><a href="familles.php?page=<?= $i; ?>"><?= $i; ?></a></li>

					    <?php }?>
					</ul>
				</div>
			</div>
		</div>
	</div>

</body>
</html>