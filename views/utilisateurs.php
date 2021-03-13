<?php
require_once("../database/connexion_db.php");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$size = isset($_GET['size']) ? $_GET['size'] : 6;
$offset = ($page-1) * $size;

$requeteAllRoles = "SELECT * from roles";
$resultatAllRoles = $pdo->query($requeteAllRoles); 

$login = isset($_GET['login']) ? $_GET['login'] : "";
$idRole = isset($_GET['idRole']) ? $_GET['idRole'] : 0;

if($idRole==0)
{
    $requeteAllUtilisateurs   = "SELECT idUser,login,email, photoUtilisateur, actif, nomRole from roles as r, utilisateurs as u WHERE r.idRole=u.idRole and (login like '%$login%') order by idUser LIMIT $size offset $offset";


    $requeteCountUtilisateurs = "SELECT count(*) countUSER from utilisateurs WHERE login like '%$login%'";


}else 
{
    $requeteAllUtilisateurs   = "SELECT idUser, login, email, photoUtilisateur, actif, nomRole from roles as r, utilisateurs as u WHERE r.idRole=u.idRole and (login like '%$login%') and r.idRole=$idRole order by idUser LIMIT $size offset $offset";
    $requeteCountUtilisateurs = "SELECT count(*) countUSER from utilisateurs WHERE idRole=$idRole";

}

$resultatAllUtilisateurs   = $pdo->query($requeteAllUtilisateurs);
$resultatCountUtilisateurs = $pdo->query($requeteCountUtilisateurs);

$tabCount = $resultatCountUtilisateurs->fetch();
$nbre_Users = $tabCount['countUSER'];

$reste = $nbre_Users%$size;

if ($reste==0)
{
    $nbre_Pages = $nbre_Users/$size;

} else 
{
    $nbre_Pages = floor($nbre_Users/$size) + 1;

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Utilisateurs</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fichier.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
</head>
<body>

	
	<?php include("../pageBlanche.php") ; ?>

    <div class="section_recherche">
    	
    	<div class="panel panel-warning ">
    		<div class="panel-heading">Recherche des Utilisateurs</div>
    		<div class="panel-body">
                <form action="" method="get" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="login" id="login" class="form-control" placeholder="Tapez le login à chercher">
                    </div> &nbsp;
                    &nbsp;
                    Roles:

                    <select name="idRole" class="form-control" onchange="this.form.submit()">
                        <option value=0 selected>Tous les roles</option>
                        <?php while($rol = $resultatAllRoles->fetch()) {    ?>

                            <option value="<?= $rol['idRole']; ?>"><?= $rol['nomRole']; ?></option>

                        <?php  } ?>
                        
                    </select> &nbsp; &nbsp;


                    <button class="btn btn-success" type="submit" name="btn_Search"><span class="glyphicon glyphicon-search"></span>  Rechercher...</button> &nbsp; &nbsp;

                   <?php if(isset($_SESSION['user']) &&($_SESSION['user']['idRole']==2 || $_SESSION['user']['idRole']==3)) {  ?>

                    <a href="nouvelUtilisateur.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter Utilisateur</a>

                      <?php  } ?>
                      
                </form>
                
            </div>
    	</div>

    </div>

    <div class="section_datas">
    	<div class="panel panel-success">
    		<div class="panel-heading">Liste des Utilisateurs  (<?php if($nbre_Users<=1) { echo $nbre_Users. "  valeur"; } else { echo $nbre_Users. " valeurs"; } ?>) </div>
    		<div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Login</th>
                            <th>Email</th>
                           
                            <th>Photo</th>
                            <th>Actif</th>
                            
                             <th>Roles</th>

                             <?php if(isset($_SESSION['user']) &&($_SESSION['user']['idRole']==2)) {  ?>

                             <th>Actions</th>

                             <?php  } ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while($utilisateurs = $resultatAllUtilisateurs->fetch()) {  ?>
                            
                        <tr class=" <?php echo $utilisateurs['actif']==1? 'success': 'danger';  ?> ">
                            <td><?= $utilisateurs ['idUser'];            ?></td>
                            <td><?= $utilisateurs ['login'];             ?></td>
                            <td><?= $utilisateurs['email'];             ?></td>
                           
                            <td><img src="../images/utilisateurs/<?= $utilisateurs['photoUtilisateur'];  ?>" width="50px" height="50px"> </td>

                            <td><?= $utilisateurs['actif'];             ?> </td>
                             <td><?= $utilisateurs['nomRole'];             ?></td>

                          <?php if(isset($_SESSION['user']) &&($_SESSION['user']['idRole']==2)) {  ?>
                             <td>

                                <a href="editerUtilisateur.php?idUser=<?= $utilisateurs['idUser'];?>"><span class="glyphicon glyphicon-edit"></span>  Editer</a>

                                <a href="supprimerUtilisateur.php?idUser=<?= $utilisateurs['idUser']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur?'); "><span class="glyphicon glyphicon-trash"></span>  Supprimer</a> &nbsp;

                                

                                <a href="activerOuDesactiverUser.php?idUser=<?= $utilisateurs['idUser']; ?>&etat=<?= $utilisateurs['actif']; ?>">
                                    <?php

                                    if($utilisateurs['actif']==1)
                                    {
                                        echo '<span class="glyphicon glyphicon-remove"></span>';
                                    } else {
                                        echo '<span class="glyphicon glyphicon-ok" ></span>';
                                    }

                                     ?>

                                </a>
                                
                                 
                             </td>
                             <?php  } ?>

                        </tr>
                    <?php } ?>
                    </tbody>
                    
                </table>
                <div class="section_pagination">
                    <ul class="pagination">
                        <?php  for($i=1; $i<=$nbre_Pages; $i++) {  ?>

                            <li class="<?php if($i==$page) echo "active" ;?>"  ><a href="utilisateurs.php?page=<?= $i; ?>"><?= $i; ?></a></li>

                        <?php  } ?>
                    </ul>
                    
                </div>
                
            </div>
    	</div>
    </div>
   
	
</body>
</html>