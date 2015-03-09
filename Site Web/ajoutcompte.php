<!DOCTYPE html>
<?php session_start();?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ajouter un compte</title>
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
	echo '<h1>Ajouter un compte</h1>
			<div class="detail">
					<form method="post" action="BDDcompteadd.php" enctype="multipart/form-data">
					
					<p><label class="usertext" for="nom">Nom: </label></p>
					<p><input type="text" id="nom" name="nom" size=30 maxlength=3 required></p>
					<p><label class="usertext" for="prenom"> Prénom: </label></p>
					<p><input type="text" id="prenom" name="prenom" size=30 required></p>
					<p><label class="usertext" for="mail"> E-mail: </label></p>
					<p><input type="email" id="mail" name="mail" size=30></p>
					<br>
					<p><label class="usertext" for="domaine"> Domaine d\'activité: </label></p>
					<p><input type="text" id="domaine" name="domaine" size=30></p>
					<p><label class="usertext" for="type"> Type de compte: </label></p>';
					$res=$mysqli->query("SELECT * FROM profils");
					echo '<p>'.'<select id="type" name="type">';
					while($tuple=$res->fetch_assoc())
					{
						$type=$tuple['pfl_id'];
						echo '<option value="'.$type.'">'.htmlentities($tuple['pfl_nom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8').'</option>';
					}
						echo '</select>'.'</p>
					<br>
					<p><label class="usertext" for="login">Login: </label></p>
					<p><input type="text" id="login" name="login" size=30 required></p>
					<br>
					<p><label class="usertext" for="password">Password: </label></p>
					<p><input type="text" id="password" name="password" size=30 required></p>
					<br>
					
					<p><input type="submit" value="Valider">
					<input type="reset" value="Effacer"></p>
					<br><br><br>
					</form>
			</div>';
	}
	else
	{
	echo '<h1>Accès refusé!</h1>
			<div class="detail"><h2><br>Accès non autorisé!<br> Privilèges insufisants pour consulter cette page. Seul les gestionnairs peuvent accéder à la page d\'ajout de comptes.</h2></div>';
	}
		 ?></div>
	<?php include('footer.inc.php'); ?>
	</body>    
