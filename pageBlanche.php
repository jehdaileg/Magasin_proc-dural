<?php
session_start();

if(isset($_SESSION['user']) && !empty($_SESSION['user']))
{
	$nomPhoto = $_SESSION['user']['photoUtilisateur'];
}


?> 
 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=width-content" initial-scale="1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-free/css/all.min.css">
	
	<link rel="stylesheet" type="text/css" href="fichier.css">
	<title>sidebar</title>
</head>
<body>

	<div class="wrapper">
		<div class="sidebar">
			<a href="views/categories.php" class="titre_lien"><h2>SHOP</h2></a>
			<ul>
				<li><a href="categories.php"><i class="fa fa-home"></i>    Home</a></li>

				  <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {  ?>

				<li><a href="#"><i class="glyphicon glyphicon-user"></i> <?= $_SESSION['user']['login']; ?> (Online)<i class="glyphicon glyphicon-ok connected_user" style="color: green;"></i><i class="glyphicon glyphicon-ok connected_user" style="color: green;"></i>   </a></li>

				<li><a href="seDeconnecter.php"><i class="glyphicon glyphicon-log-out"></i>Se Deconnecter</a></li>

			<?php } ?>
				

				<li><a href="utilisateurs.php"><i class="fa fa-user"></i>    Utilisateurs</a></li>
				<li><a href="categories.php"><i class="fa fa-address-card"></i>    Catégories</a></li>
				<li><a href="statistiques.php"><i class="fa fa-project-diagram"></i>    Statistiques</a></li>
				<li><a href="familles.php"><i class="fa fa-hands"></i>    Familles</a></li>
				
				<li><a href="produits.php"><i class="fa fa-map-pin"></i>    Produits</a></li>
				<li><a href="forum.php"><i class="fa fa-hands"></i>Forum</a></li>
   
           
				
			</ul>

			<div class="social_media">
				<a href="#"><i class="fab fa-facebook-f"></i></a>
				<a href="#"><i class="fab fa-twitter"></i></a>
				<a href="#"><i class="fab fa-instagram"></i></a>
			</div>

		</div>

		<div class="main_content">
			<div class="header"><p>Bienvenue sur notre Shop Management System Réalisé par Jehdai</p>

				<div class="photoUserConnected" style="margin-left: 900px; padding: 0px; margin-bottom: 0px; padding-bottom: 0px;">

					<!--<img src="images/utilisateurs/<?= $nomPhoto ; ?>" width="25px" height="25px"> !-->
			
					
				</div>

			 </div>    
                

			<div class="info">
				<!-- Ajout du container principal pour notre forme générale !-->
             <!--
				<div class="container-fluid">

					<div class="panel panel-success ">
						<div class="panel-heading">Rechercher...</div>
						<div class="panel-body">
							
						</div>
					</div>


					<div class="panel panel-success ">
						<div class="panel-heading"></div>
						<div class="panel-body">
							
						</div>
					</div>

					
				</div>

				!-->


				<!-- Fin de l'ajout de la forme générale pour notre application !-->


			</div>
		</div>



	</div>



</body>
</html>