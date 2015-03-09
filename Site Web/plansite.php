<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Plan du site</title>
	<link rel="stylesheet" href="style.css">
    </head>
	<body>
	<?php include('header.inc.php'); ?>
	<?php include('nav.inc.php'); ?>
	<?php include('lateralpart.inc.php');?>
    	<div id="contenu">
		<h1>Plan du site</h1>
		<div id="plan">
		Le site constitue une plateforme de travail pour les différents acteurs du laboratoire de l'IRSEEM, laboratoire de l'Esigelec. Certaines fonctionnalités ne sont accessibles qu'à un groupe précis de personne. Le site quand à lui s'organise de la manière suivante:
		<br>
		<ul>
  		<li><a href="index.php">Accueil</a></li>
		<br>
  		<li><a href="listeprojet.php?p=1">Liste des projets</a>
    			<ul>
    			<li>Détail d'un projet</li>
    				<ul>
    				<li>Liste des documents</li>
	    				<ul>
	    				<li>Ajouter un document</li>
					</ul>
    				<li>Rejoindre un projet</li>
				</ul>
    			<li><a href="ajoutprojet.php">Ajouter un projet</a></li>
    			</ul>
  		</li>
		<br>
  		<li><a href="listechercheur.php?p=1">Liste des chercheurs</a></li>
		<br>
  		<li><a href="listecompte.php?p=1">Gestion des comptes</a></li>
			<ul>
			<li><a href="ajoutcompte.php">Ajouter un compte</a></li>
			</ul>
		</ul>
		</div>
    	</div>
	<?php include('footer.inc.php'); ?>
	</body>
