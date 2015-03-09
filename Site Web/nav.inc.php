    <nav id="mainmenu">
	<ul>
	<?php  
		if(isset($_SESSION['type']) && $_SESSION['type']== '2')
		{
			echo   '<li class="navbuttons" ><a href="index.php">Accueil</a></li>
				<li class="navbuttons" ><a href="listechercheur.php?p=1">Liste des chercheurs</a></li>
				<li class="navbuttons" ><a href="listecompte.php?p=1">Gestion de la platforme</a></li>';
		}
		else
		{
			echo   '<li class="navbuttons" ><a href="index.php">Accueil</a></li>
				<li class="navbuttons" ><a href="listeprojet.php?p=1">Liste des projets</a></li>
				<li class="navbuttons" ><a href="listechercheur.php?p=1">Liste des chercheurs</a></li>';
		}?>
	</ul>
    </nav>
