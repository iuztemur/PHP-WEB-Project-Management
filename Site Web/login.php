<head>
<meta charset="utf-8">
</head>
<?php require_once('connexion.inc.php'); ?>
<?php
if ($mysqli->connect_errno) 
{
	echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno. ") " . $mysqli->connect_error;
}
else
{
	 $nom= $mysqli->real_escape_string($_POST["logname"]);
	 $password= $mysqli->real_escape_string($_POST["logpass"]);
	 $res=$mysqli->query("SELECT * FROM comptes INNER JOIN profils ON cmp_type = pfl_id WHERE cmp_login='$nom' AND cmp_password='$password'");
	 $tuple=$res->fetch_assoc();
	 if(!$tuple)
	 {
		echo '<script language="JavaScript">;alert("Identification invalide.");location.href="index.php";</script>';
		//else{echo 'Identification invalide! Veuillez patienter vous allez être redirigé vers la page d\'accueil.';header ("Refresh: 1;URL=index.php");}
	 }
	 else
	 {
		session_start();
		//Récupération des info utilisateur et stockage
		$_SESSION['id']=$tuple['cmp_id'];
		$_SESSION['nom']=$tuple['cmp_nom'];
		$_SESSION['prenom']=$tuple['cmp_prenom'];
		$_SESSION['domaine']=$tuple['cmp_domaine'];
		$_SESSION['type']=$tuple['cmp_type'];
		$_SESSION['typename']=$tuple['pfl_nom'];
		echo '<script language="JavaScript">alert("Identification validé. Bienvenue!");location.href="javascript:history.back()";</script>';
	 }
}?>
