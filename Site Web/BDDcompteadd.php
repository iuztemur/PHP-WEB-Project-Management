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
	 $nom= $mysqli->real_escape_string($_POST["nom"]);
	 $prenom= $mysqli->real_escape_string($_POST["prenom"]);
	 $mail= $mysqli->real_escape_string($_POST["mail"]);
	 $login= $mysqli->real_escape_string($_POST["login"]);
	 $password= $mysqli->real_escape_string($_POST["password"]);
	 $domaine= $mysqli->real_escape_string($_POST["domaine"]);
	 $type= intval($_POST["type"]);

	//Envoie vers la BDD
	$insert=$mysqli->query("INSERT INTO comptes (cmp_nom, cmp_prenom, cmp_mail, cmp_domaine, cmp_login, cmp_password, cmp_type) VALUES ('$nom','$prenom','$mail','$domaine','$login','$password',$type)");
	
	if(!$insert){echo '<script language="JavaScript">alert("Erreur d\'insertion!");location.href="javascript:history.back()";</script>';}
	else{echo '<script language="JavaScript">alert("Compte a été ajouté!");location.href="listecompte.php?p=1";</script>';}
	} 
?>
