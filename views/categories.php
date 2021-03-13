<?php


require_once("../database/connexion_db.php");


/**

Variables pour la pagination

**/
$size =isset($_GET['size'])? $_GET['size'] : 6;
$page =isset($_GET['page'])? $_GET['page'] : 1;
$offset = ($page-1) * $size;

/**
Traite recherche catégorie
**/
//$nom_categorie = isset($_GET['nom_categorie'])?: "";


if(isset($_GET['nom_categorie']))
{
	$nom_categorie = $_GET['nom_categorie'];

	$requeteAllCategories = "SELECT * FROM categories WHERE nomCategorie like '%$nom_categorie%' limit $size offset $offset";

	$requeteCountCategories = "SELECT count(*) countCAT FROM categories WHERE nomCategorie like '%$nom_categorie%'";
}
else 
{
	$requeteAllCategories = "SELECT * FROM categories limit $size offset $offset";

	$requeteCountCategories = "SELECT count(*) countCAT FROM categories";
}

    $resultatCategories = $pdo->query($requeteAllCategories);

    $resultatCountCat = $pdo->query($requeteCountCategories);
    $tabCounter = $resultatCountCat->fetch();
    $nbre_categories = $tabCounter['countCAT'];

    $reste = $nbre_categories%$size;

    if($reste==0){
    	$nbre_Pages = $nbre_categories/$size;
    }
    else 
    {
    	$nbre_Pages = floor($nbre_categories/$size) +1 ;
    }


?>

<!DOCTYPE html>
<html>
<head>
	<title>catégories</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>

	
	<?php include("../pageBlanche.php") ; ?>

    <div class="section_recherche">
    	
    	<div class="panel panel-warning ">
    		<div class="panel-heading">Recherche des catégories</div>
    		<div class="panel-body">
    			<form action="" method="get" class="form-inline">
    				
    				<div class="form-group">
    					
    					<input type="text" name="nom_categorie" class="form-control" placeholder="Tapez la catégorie à chercher" id="nom_categorie">
    				</div> &nbsp; &nbsp;
    				<button class="btn btn-success" type="submit" name="btn_Search"><span class="glyphicon glyphicon-search"></span> Rechercher...</button> &nbsp; &nbsp;
            
             <?php if(isset($_SESSION['user']) && ($_SESSION['user']['idRole']==2) || $_SESSION['user']['idRole']==3) { ?>

    				<a href="nouvelleCategorie.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>  Ajouter une catégorie</a>

                    <?php   } ?>
    			</form>
    			

    		</div>
    	</div>

    </div>

    <div class="section_datas">
    	<div class="panel panel-success">
    		<div class="panel-heading">Liste des Catégories   (<?php if($nbre_categories==1) {echo $nbre_categories. " valeur";} else {echo $nbre_categories. " valeurs"; } ?>) </div>
    		<div class="panel-body">

    			<table class="table table-striped table-bordered">
    				<thead>
    				<tr>
    					<th>Id Catégorie</th>
    					<th>Nom</th>

                        <?php if(isset($_SESSION['user']) && ($_SESSION['user']['idRole']==2) || $_SESSION['user']['idRole']==3) { ?>

    					<th>Actions</th>

                        <?php   } ?>

    				</tr>
    				</thead>
    				<tbody>
    					<?php while($cat = $resultatCategories->fetch()) {  ?>
    					<tr>
    						<td><?= $cat['idCategorie'];  ?></td>
    						<td><?= $cat['nomCategorie'];  ?></td>

                            <?php if(isset($_SESSION['user']) && ($_SESSION['user']['idRole']==2 || $_SESSION['user']['idRole']==3)) {  ?>
    						<td>
    							<a href="editerCategorie.php?idCategorie=<?= $cat['idCategorie']; ?>"><span class="fa fa-edit" class="span_edite"></span> Editer</a> &nbsp; &nbsp;

    							<a href="supprimerCategorie.php?idCategorie=<?= $cat['idCategorie']; ?>" onclick="return confirm('Voulez-vous vraiment Supprimer cette catégorie?');"><span class="fa fa-trash" class="span_supprime"></span> Supprimer</a>
    						</td> 
                            <?php } ?>

    					</tr>
    					<?php } ?>
    				</tbody>
    			</table>

    			<div>

    			<ul class="pagination">

    				<?php for($i=1; $i<=$nbre_Pages; $i++) {   ?>
    					<li class="<?php if($i==$page) echo 'active'; ?>"><a href="categories.php?page=<?= $i; ?>"><?= $i; ?></a></li>
    			    <?php } ?>

    			</ul>

			</div>
    			

    		</div>
    	</div>
    </div>
   
	
</body>
</html>