<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Liste Projets</title>
	<link rel="stylesheet" href="style.css">
    </head>
	<body>
	<?php include('header.inc.php'); ?>
	<?php include('nav.inc.php'); ?>
	<?php include('lateralpart.inc.php'); ?>
	<?php require_once('connexion.inc.php'); ?>
	<div id="contenu">
	<?php
	if(isset($_SESSION['type']) && $_SESSION['type']=='1')
	{
		echo '<h1>Liste de projets</h1>
		<div>';
		if ($mysqli->connect_errno) 
		{
			echo "<h3>Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno
			. ") " . $mysqli->connect_error."</h3>";
		}
		else
		{
			// Variables pour le controle des pages
			$nb_elements = mysqli_num_rows($mysqli->query("SELECT pro_id FROM projets"));
			$nb_max_elements= 9;
			$nb_pages = ceil($nb_elements/$nb_max_elements); //Calcul nombre de page ceil<->arrondi
			$page=$_GET['p']; //Récupération de la page actuelle			
			$current_element = 0; //Nb d'élement présents sur la pages en cours
			$premier_element = ($page-1)*$nb_max_elements; // Premier élément à afficher

			$res=$mysqli->query("SELECT * FROM projets WHERE pro_id > $premier_element");
			if(!$res)
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
					while($tuple=$res->fetch_assoc())
					{
						if($current_element < $nb_max_elements)
						{
							echo '<div>'.'<h2>'.htmlentities($tuple['pro_title'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</h2>'.'<p>'.substr(htmlentities($tuple['pro_desc'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8'),0,120)."...".'</p>'.'<a href="projetdetail.php?pid='.$tuple['pro_id'].'">Plus info</a>'.'</div>';
							$current_element++;
						}
						else
						{break;}
					}
				 	//Affichage des boutons de navigation entre pages
					if($page < $nb_pages){echo '<a id="next" href="listeprojet.php?p='.($page+1).'">Page Suivante</a>';}
					if($page > 1){echo '<a id="previous" href="listeprojet.php?p='.($page-1).'">Page Précédente</a>';}
				}
			}
		}
// Affichage du bouton d'ajout d'un projet
echo '<a class="buttons" href="ajoutprojet.php">Ajouter un projet</a>';
	}
	else
	{
	echo '<h1>Accès refusé!</h1>
			<div class="detail"><h3>Accès non autorisé!<br> Privilèges insufisants pour consulter cette page. Seul les chercheurs peuvent accéder à la page présentant la liste des projets.</h3>';
	}?>
    	</div>
    	</div>
	<?php include('footer.inc.php'); ?>
	</body>    
