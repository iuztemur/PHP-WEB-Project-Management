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
	 //Récupération des informations sur le projet
	 $title= $mysqli->real_escape_string($_POST["title"]);
	 $desc= $mysqli->real_escape_string($_POST["desc"]);
	 $debutdate= $mysqli->real_escape_string($_POST["debutdate"]);
	 $chef= intval($_POST["chef"]);

	//Envoie vers la BDD
	 $insert=$mysqli->query('INSERT INTO projets (pro_title, pro_desc, pro_debut_date, pro_chef) VALUES ("'.$title.'","'. $desc.'","'. $debutdate.'",'. $chef.')');
	if($insert)
	{
		//Récupération de l'ID projet
		$projet=$mysqli->query('SELECT pro_id FROM projets WHERE pro_title ="'.$title.'"');
		$tuple=$projet->fetch_assoc();
		$idprojet=$tuple['pro_id'];

		//Ajout du chef de projet à la liste des participant
		 $insert2=$mysqli->query('INSERT INTO participant (part_projet, part_participant) VALUES ('.$idprojet.','.$chef.')');
	}
	
	if(!$insert || !$insert2){echo '<script language="JavaScript">alert("Erreur d\'insertion!");location.href="javascript:history.back()";</script>';}
	else{echo '<script language="JavaScript">alert("Projet a été ajouté!");location.href="listeprojet.php?p=1";</script>';}
	} 
?>
