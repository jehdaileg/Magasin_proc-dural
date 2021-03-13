 <?php

$message_erreur = isset($_GET['message']) ? $_GET['message'] : "";

$warning = isset($_GET['warning']) ? $_GET['warning'] : "";

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

	<div class="panel panel-warning">
		<div class="panel-heading">Erreur !!!</div>
		<div class="panel panel-body">
			<h4><?= $message_erreur;  ?></h4>

			<a href="<?=$_SERVER['HTTP_REFERER'];  ?>">Retour</a>

		</div>
		
	</div>

	<div class="panel panel-warning">
		<div class="panel-heading">Erreur !!!</div>
		<div class="panel panel-body">
			<h4><?= $warning;  ?></h4>

			<a href="<?=$_SERVER['HTTP_REFERER'];  ?>">Retour</a>

		</div>
		
	</div>

</body>
</html>