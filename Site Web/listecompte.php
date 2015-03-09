<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gestion des comptes</title>
	<link rel="stylesheet" href="style.css">
    </head>
	<body>
	<?php include('header.inc.php'); ?>
	<?php include('nav.inc.php'); ?>
	<?php include('lateralpart.inc.php'); ?>
	<?php require_once('connexion.inc.php'); ?>
	<div id="contenu">
	<?php
	if(isset($_SESSION['type']) && $_SESSION['type']=='2')
	{
		echo '<h1>Gestion des comptes</h1>
		<div>';
		if ($mysqli->connect_errno) 
		{
			echo "<h3>Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno
			. ") " . $mysqli->connect_error."</h3>";
		}
		//Si suppression nécessaire
		else if(isset($_GET['DelID']))
		{
			echo '<h2>Suppression effectuée!</h2>';
			$id=$_GET['DelID'];
			$mysqli->query("DELETE FROM comptes WHERE cmp_id =$id");
			echo '<script language="JavaScript">location.href="javascript:history.back()";</script>';
		}  
		else
		{
			// Variables pour le controle des pages
			$nb_elements = mysqli_num_rows($mysqli->query("SELECT cmp_id FROM comptes"));
			$nb_max_elements=22;
			$nb_pages = ceil($nb_elements/$nb_max_elements); //Calcul nombre de page ceil<->arrondi
			$page=$_GET['p']; //Récupération de la page actuelle			
			$current_element = 0; //Nb d'élement présents sur la pages en cours
			$premier_element = ($page-1)*$nb_max_elements;// Premier élément à afficher

			$res=$mysqli->query("SELECT * FROM comptes INNER JOIN profils ON cmp_type = pfl_id WHERE cmp_id > $premier_element");
			if($res->num_rows == 0)
			{
				echo '<h3>'."Aucun resultat".'</h3>';
			}
			else
			{
				if($page > $nb_pages || $page < 1)
				{
					echo '<h3>'."OUPS ! Cette page n'existe pas".'</h3>';
				}
				else
				{
					echo '<table class="table"><tr><th>Individu</th><th>Type de compte</th><th>E-mail</th><th>-----</th></tr></table>';
					while($tuple=$res->fetch_assoc())
					{
						if($current_element < $nb_max_elements)
						{
							echo '<table class="table"><tr><td>'.htmlentities($tuple['cmp_prenom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').' '.htmlentities($tuple['cmp_nom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</td><td>'.htmlentities($tuple['pfl_nom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</td><td>'.htmlentities($tuple['cmp_mail'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</td><td><a href = "'.$_SERVER['PHP_SELF'].'?DelID='.$tuple['cmp_id'].'"><img src="images/delete.gif" width="25" height="25" alt="Del"></a></td></tr></table>';
							$current_element++;
						}
						else
						{break;}
					}
				 	//Affichage des boutons de navigation entre pages
					if($page < $nb_pages){echo '<a id="next" href="listecompte.php?p='.($page+1).'">Page Suivante</a>';}
					if($page > 1){echo '<a id="previous" href="listecompte.php?p='.($page-1).'">Page Précédente</a>';}
				}
			}
			echo '<br>
			<a class="buttons" href="ajoutcompte.php">Ajouter un Compte</a>';
		}
	}
	else
	{
	echo '<h1>Accès refusé!</h1>
			<div class="detail"><h3>Accès non autorisé!<br> Privilèges insufisants pour consulter cette page. Seul les gestionnaires peuvent accéder à la page de consultation des comptes.</h3>';
	}?>
    </div>
    </div>
	<?php include('footer.inc.php'); ?>
	</body>    
