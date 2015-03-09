<!DOCTYPE html>
<?php session_start();?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ajouter un document</title>
	<link rel="stylesheet" href="style.css">
    </head>
	<body>
	<?php include('header.inc.php'); ?>
	<?php include('nav.inc.php'); ?>
	<?php include('lateralpart.inc.php'); ?>
	<?php require_once('connexion.inc.php'); ?>
	<div id="contenu">
	<?php
		echo '<h1>Ajouter un document</h1>
			<div class="detail">
					<form method="post" action="BDDdocadd.php" enctype="multipart/form-data">
					
					<p><label class="usertext" for="nom">Nom du fichier: </label></p>
					<p><input type="text" id="nom" name="nom" size=80 required></p>
					<br>
					<p><label class="usertext" for="desc"> Description: </label></p>
					<p><input type="text" id="desc" name="desc" size=80 required></p>				
					<br>
					<p><label class="usertext" for="file">Document (max 20Mo):</label></p>
					<p><input type="file" name="file" id="file"/> </p>
					<input type="hidden" name="projet" value="'.$_GET['pid'].'">
					<input type="hidden" name="editor" value="'.$_SESSION['id'].'">
					<br>
					<p><input type="submit" value="Valider">
					<br>
					</form>
			</div>'?>
		</div>
	<?php include('footer.inc.php'); ?>
	</body>    
