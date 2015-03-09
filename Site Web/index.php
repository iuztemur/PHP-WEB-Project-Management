<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Accueil</title>
	<link rel="stylesheet" href="style.css">
    </head>
	<body>
	<?php include('header.inc.php'); ?>
	<?php include('nav.inc.php'); ?>
	<?php include('lateralpart.inc.php');?>
    	<div id="contenu">
		<h1>Bienvenue</h1>
		<div>
		<br><h2>Bienvenue cher visiteur sur la plateforme Esiglab. Le but de cette plateforme est de permettre aux chercheurs du laboratoire IRSEEM, laboratoire de l'Esigelec, d'échanger des données sur des projets spécifiques et de contrôler l'avancement de ces derniers.</h2>
		</div>
		<h1>Projets récents</h1>
		<div>
		<?php require_once('connexion.inc.php'); ?>
		<?php
		if ($mysqli->connect_errno) 
		{
			echo "<h3>Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno
			. ") " . $mysqli->connect_error."</h3>";
		}
		else
		{
			// Variables pour le controle des pages
			$nb_elements = mysqli_num_rows($mysqli->query("SELECT pro_id FROM projets"));
			$nb_max_elements= 5;
			$current_element = 0; //Nb d'élement présents sur la pages en cours
			$premier_element = ($nb_elements-5); // Premier élément à afficher

			$res=$mysqli->query("SELECT * FROM projets WHERE pro_id > $premier_element");
			if($res->num_rows == 0)
			{
				echo '<h3>'."Aucun resultat".'</h3>';
			}
			else
			{
				while($tuple=$res->fetch_assoc())
				{
					if($current_element < $nb_max_elements)
					{
						echo '<div>'.'<h2>'.htmlentities($tuple['pro_title'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</h2>'.
						'<p>'.substr(htmlentities($tuple['pro_desc'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8'),0,120)."...".'</p>'.
						'<a href="projetdetail.php?pid='.$tuple['pro_id'].'">Plus info</a>'.'</div>';
						$current_element++;
					}
					else
					{break;}
				}
			}
		}?>
		</div>
    	</div>
	<?php include('footer.inc.php'); ?>
	</body>
