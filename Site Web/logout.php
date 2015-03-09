<head>
<meta charset="utf-8">
</head>
<?php 
	session_start();
	session_destroy();
echo '<script language="JavaScript">;alert("Déconnecté.");location.href="index.php";</script>';
?>;
