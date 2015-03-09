<div id="partielaterale">
	    <aside id="infouser">
		<h2>Informations <br> utilisateurs</h2>
			<br>
			<img id='useravatar' src="images/UserAvatar.png" width="110" height="130" alt="Avatar Utilisateur"><br><br><br>
					<div class="usertext">
					<p><?php echo 'Nom: '.htmlentities($_SESSION['nom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8');?></p>
					<p><?php echo 'Prénom: '.htmlentities($_SESSION['prenom'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8');?></p>
					<p><?php echo 'Domaine: '.htmlentities($_SESSION['domaine'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8');?></p>
					<p><?php echo 'Accès: '.htmlentities($_SESSION['typename'], ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8');?></p>
					<br><form method="post" action="logout.php" enctype="multipart/form-data"><p><input type="submit" value="Déconnecter"></form>
				</div>
	    </aside>
	    <aside id="partenaires">
		<h2>Partenaires</h2>
			<p><a href="http://www.esigelec.fr/"><img src="images/LogoEsigelec1.png" width="150" alt="LogoEsigelec"><br>ESIGELEC</a></p>
			<p><a href="http://www.esigelec.fr/Recherche-IRSEEM"><img src="images/LogoIrseem1.png" width="100" alt="LogoIRSEEM"><br>IRSEEM</a></p>
	    </aside>
</div>
