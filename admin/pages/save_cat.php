<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');$categorie="";
if( (isset($_POST["categorie"]))AND ($_POST["categorie"] != ""))
 {
	$categorie=addslashes($_POST["categorie"]);
	$etat =mysql_query("INSERT INTO `categorie` (`id` ,`nom`)VALUES ( NULL , '$categorie');");
	//echo "INSERT INTO `images` (`id` ,`nom`)VALUES ( NULL , '$categorie');";
	if ($etat==true){
		header("Location:categories.php?msg=1");
	}
	else{
		header("Location:categories.php?msg=2");
		}
}
else{
		header("Location:categories.php?msg=3");
	}

?>