<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');$etiquette="";
if( (isset($_POST["etiquette"]))AND ($_POST["etiquette"] != ""))
 {
	$etiquette=addslashes($_POST["etiquette"]);
	$etat =mysql_query("INSERT INTO `etiquette` (`id` ,`nom`)VALUES ( NULL , '$etiquette');");
	//echo "INSERT INTO `images` (`id` ,`nom`)VALUES ( NULL , '$categorie');";
	if ($etat==true){
		header("Location:etiquette.php?msg=1");
	}
	else{
		header("Location:etiquette.php?msg=2");
		}
}
else{
		header("Location:etiquette.php?msg=3");
	}

?>