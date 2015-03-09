<head>
<meta charset="utf-8">
</head>
<?php session_start();?>
<?php require_once('connexion.inc.php'); ?>
<?php
	if ($mysqli->connect_errno) 
	{
		echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno
		. ") " . $mysqli->connect_error;
	}
	else
	{
	 //Récupération des informations sur le membre
	 $idcompte= $_SESSION["id"];
	 $projet= intval($_POST["projetid"]);

	//Envoie vers la BDD
	$insert=$mysqli->query('INSERT INTO participant (part_projet, part_participant) VALUES ('.$projet.','. $idcompte.')');	
	if(!$insert){echo '<script language="JavaScript">alert("Erreur, impossible de rejoindre le projet.");location.href="javascript:history.back()";</script>';}
	else{echo '<script language="JavaScript">alert("Projet rejoint. Bienvenue!");location.href="projetdetail.php?pid='.$projet.'";</script>';}
	} 
?>
