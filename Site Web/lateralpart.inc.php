<?php 
	if(isset($_SESSION["id"]))
	{
		include('lateralpartuser.inc.php');
	}
	else
	{
		include('lateralpartlogin.inc.php');
	}
?>