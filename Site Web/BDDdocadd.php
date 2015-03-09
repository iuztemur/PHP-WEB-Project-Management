<head>
<meta charset="utf-8">
</head>
<?php session_start();?>
<?php require_once('connexion.inc.php'); ?>
<?php

if ($mysqli->connect_errno) 
{
	echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno. ") " . $mysqli->connect_error;
}
else
{ 
	 //recevoir les informations sur le nouveau document
	 $nom= $mysqli->real_escape_string($_POST["nom"]);
	 $desc= $mysqli->real_escape_string($_POST["desc"]);
	 $projetid= intval($_POST["projet"]);
	 $editor= intval($_POST["editor"]);
	 $date = date("Y-m-d");
	 $target_dir = "files/";
	 $tempname = $_FILES["file"]["tmp_name"];
	 $size = $_FILES["file"]["size"];
	 $target_file = $target_dir . basename("pro_".$projetid."_".$_FILES["file"]["name"]);

	if ($size < 1048576)
	{
		//Upload du fichier dans le dossier
		if (move_uploaded_file($tempname, $target_file)) 
		{
			// Vérifier la présence du fichier
			if (file_exists($target_file)) 
			{
				//L'utilisateur veux juste modifier le fichier
				echo "Le fichier existe déjà vous allez le remplacer!";

				//Lien entre le fichier et ses informations dans la BDD
				$insert=$mysqli->query("UPDATE ressources SET res_date_last_edition ='$date', res_last_editeur = $editor WHERE res_url ='$target_file'");
			}
			else
			{
				//Lien entre le fichier et ses informations dans la BDD
				$insert=$mysqli->query("INSERT INTO ressources (res_nom, res_desc, res_url, res_date_last_edition, res_last_editeur, res_projet) VALUES ('$nom','$desc','$target_file','$date',$editor,$projetid)");
			}

		//Message d'information sur le statut de l'upload
		if(!$insert){echo '<script language="JavaScript">alert("Erreur, echec de l\'insertion dans la base");location.href="javascript:history.back()";</script>';}
		else{echo '<script language="JavaScript">alert("Document a été ajouté!");location.href="projetdocuments.php?pid='.$projetid.'";</script>';}

		}
		else{echo '<script language="JavaScript">alert("Erreur, transfert vers le répertoire impossible!");location.href="javascript:history.back()";</script>';}
	}
	else{echo '<script language="JavaScript">alert("Fichier trop volumineux!")</script>';}
}	
?>
