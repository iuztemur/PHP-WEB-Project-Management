<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Détail du projet</title>
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
		echo '<h1>Détail du projet</h1>
		<div>';
		if ($mysqli->connect_errno) 
		{
			echo "<h3>Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno
			. ") " . $mysqli->connect_error."</h3>";
		}
		else
		{
			// Id du projet à selectionner
			$projetid=$_GET['pid']; //Récupération de l'ID projet
			$res=$mysqli->query("SELECT * FROM projets WHERE pro_id = $projetid");
			if(!$res)
			{
				echo '<h3>'."Aucun resultat".'</h3>';
			}
			else
			{
				if($res){$tuple=$res->fetch_assoc();}
				$id_pro_chef=$tuple['pro_chef'];
				$res2=$mysqli->query("SELECT * FROM comptes WHERE cmp_id =$id_pro_chef");
				if($res2){$tuple2=$res2->fetch_assoc();}
				$res3=$mysqli->query("SELECT * FROM participant INNER JOIN comptes ON part_participant = cmp_id WHERE part_projet =$projetid");
				if($tuple)
				{
					echo '<div id="detail">'.'<h2>'.htmlentities($tuple['pro_title'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</h2>'.'<p>'."Description: ".'<br>'.nl2br(htmlentities($tuple['pro_desc'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8')).'</p>'.'<p>'."Date de début: ".htmlentities($tuple['pro_debut_date'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</p>'.'<p>'."Chef de projet: ".htmlentities($tuple2['cmp_prenom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8')." ".htmlentities($tuple2['cmp_nom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</p>'.'</br>';
				}

				//Affichage de la liste de participants
				echo '<table class="table" ><caption>Liste des participants</caption><tr><th>Chercheur</th><th>Domaine d\'activité</th><th>E-mail</th></tr></table>';
				while($tuple3=$res3->fetch_assoc())
				{
					echo '<table class="table"><tr><td>'.htmlentities($tuple3['cmp_prenom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8')." ".htmlentities($tuple3['cmp_nom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</td><td>'.htmlentities($tuple3['cmp_domaine'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</td><td>'.htmlentities($tuple3['cmp_mail'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</td></tr></table>';
				}
				echo '<br>'.'</div>';				
			}
		//Affichage de l'option pour rejoindre un projet et consulter les documents
		$partid=$_SESSION['id'];
		$res4=$mysqli->query("SELECT * FROM participant WHERE part_projet =$projetid AND part_participant =$partid");
		if($res4->num_rows != 0)
		{
			echo'<a class="buttons" href="projetdocuments.php?pid='.($projetid).'">Consulter les documents</a>';
		}
		else
		{
			echo '<form method="post" action="Joinprojet.php" enctype="multipart/form-data">
			<input type="hidden" name="projetid" value="'.$_GET['pid'].'">
			<input class = "buttons" type="submit" value="Rejoindre le projet">';
		}
		}
	}
	else
	{
	echo '<h1>Accès refusé!</h1>
			<div class="detail"><h3>Accès non autorisé!<br> Privilèges insufisants pour consulter cette page. Seul les chercheurs peuvent accéder au détail d\'un projet.</h3></div>';
	}
	?>
		</div>
    	</div>
	<?php include('footer.inc.php'); ?>
	</body>    
