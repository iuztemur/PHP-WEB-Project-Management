<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Liste des documents</title>
	<link rel="stylesheet" href="style.css">
    </head>
	<body>
	<?php include('header.inc.php'); ?>
	<?php include('nav.inc.php'); ?>
	<?php include('lateralpart.inc.php'); ?>
	<?php require_once('connexion.inc.php'); ?>
	<div id="contenu">
	<?php
	//Vérification si la personne fait partie de la liste des participants du projet
	$projetid=$_GET['pid']; //Récupération de l'ID projet
	$partid=$_SESSION['id'];
	$res=$mysqli->query("SELECT * FROM participant WHERE part_projet =$projetid AND part_participant =$partid");
	if($res->num_rows != 0)
	{
	echo '<h1>Liste des documents</h1>
		<div>';
		if ($mysqli->connect_errno) 
		{
			echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno. ") " . $mysqli->connect_error;
		}
		//Si suppression nécessaire
		else if(isset($_GET['DelID']))
		{
			echo '<h2>Suppression effectuée!</h2>';
			$id=$_GET['DelID'];
			
			//suppression du fichier
			$res2=$mysqli->query("SELECT res_url FROM ressources WHERE res_id =$id");
			$tuple2=$res2->fetch_assoc();
			$url=$tuple2['res_url'];
				unlink($url);
			//Suppression dans la BDD
			$mysqli->query("DELETE FROM ressources WHERE res_id =$id");
			echo '<script language="JavaScript">location.href="projetdocuments.php?pid='.$projetid.'";</script>';
		} 
		else
		{
			// Id du projet à selectionner
			$res2=$mysqli->query("SELECT * FROM ressources INNER JOIN comptes ON res_last_editeur = cmp_id WHERE res_projet = $projetid");
			if($res2->num_rows == 0)
			{
				echo '<h2>'."Aucun resultat".'</h2>';
			}
			else
			{
				echo '<div id="detail">';

				//Affichage de la liste des documents
				echo '<table class="table" ><caption>Liste des documents</caption><tr><th>Nom</th><th>Description</th><th>Information d\'édition</th><th>-----</th></tr></table>';
				while($tuple2=$res2->fetch_assoc())
				{
					echo '<table class="table"><tr><td>'.htmlentities($tuple2['res_nom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</td><td>'.htmlentities($tuple2['res_desc'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</td><td>'."Edité le: ".htmlentities($tuple2['res_date_last_edition'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'<br>'."Par: ".htmlentities($tuple2['cmp_prenom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8')." ".htmlentities($tuple2['cmp_nom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</td><td><a href = "'.$_SERVER['PHP_SELF'].'?DelID='.$tuple2['res_id'].'&pid='.$projetid.'"><img src="images/delete.gif" width="25" height="25" alt="Del"></a><br><a href = "'.htmlentities($tuple2['res_url'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'"><img src="images/download.gif" width="25" height="25" alt="Sav"></a></td></tr></table>';
				}
				echo '<br>'.'</div>';
			}
		// Affichage du bouton d'ajout d'un document au projet
		echo '<a class="buttons" href="ajoutdocument.php?pid='.$projetid.'">Ajouter un document</a>';
		}
	}
	else
	{
	echo '<h1>Accès refusé!</h1>
			<div class="detail"><h2><br>Accès non autorisé!<br> Privilèges insufisants pour consulter cette page. Seul les membres du projet portant l\'ID '.$projetid.' peuvent accéder à la liste des documents du projet.</h2></div>';
	}?>
		</div>
    	</div>
	<?php include('footer.inc.php'); ?>
	</body>    
