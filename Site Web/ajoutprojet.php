<!DOCTYPE html>
<?php session_start();?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ajouter un projet</title>
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
		echo '<h1>Ajouter un projet</h1>
			<div class="detail">
					<form method="post" action="BDDprojetadd.php" enctype="multipart/form-data">
					
					<p><label class="usertext" for="title">Titre: </label></p>
					<p><input type="text" id="title" name="title" size=80 required></p>
					<br>
					<p><label class="usertext" for="desc"> Description: </label></p>
					<p><textarea id="desc" name="desc"></textarea></p>
					<br>
					<p><label class="usertext" for="debutdate"> Date de début (AAAA-MM-JJ): </label></p>
					<p><input type="date" id="debutdate" name="debutdate" required></p>
					<br>
					
					<p><label class="usertext" for="chef"> Chef: </label></p>';
					$res=$mysqli->query("SELECT * FROM comptes WHERE cmp_type = 1");
					echo '<p>'.'<select name="chef" id="chef">';
					while($tuple=$res->fetch_assoc())
					{
						$chef=$tuple['cmp_id'];
						echo '<option value="'.$chef.'">'.htmlentities($tuple['cmp_prenom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'   '.htmlentities($tuple['cmp_nom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</option>';
					}
						echo '</select>'.'</p>';
					echo '<br>
					<p><input type="submit" value="Valider">
					<input type="reset" value="Effacer"></p>
					<br>
					</form>
			</div>';
	}
	else
	{
	echo '<h1>Accès refusé!</h1>
	      <div class="detail"><h2><br>Accès non autorisé!<br> Privilèges insufisants pour consulter cette page. Seul les chercheurs peuvent accéder à la page d\'ajout de projets.</h2></div>';
	}
		?></div>
	<?php include('footer.inc.php'); ?>
	</body>    
