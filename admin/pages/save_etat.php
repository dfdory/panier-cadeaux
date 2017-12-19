<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$nom_etat="";
$code="";
if( ((isset($_POST["code"]))AND ($_POST["code"] != ""))||((isset($_POST["etat"]))AND ($_POST["etat"] != "")))
 {
	$nom_etat=addslashes($_POST["etat"]);
	$code=addslashes($_POST["code"]);
	$etat =mysql_query("INSERT INTO `etat_cmd` (`id` ,`nom`,`code_etat`)VALUES ( NULL , '$nom_etat','$code');");
	//echo "INSERT INTO `images` (`id` ,`nom`)VALUES ( NULL , '$categorie');";
	if ($etat==true){
		header("Location:etat.php?msg=1");
	}
	else{
		header("Location:etat.php?msg=2");
		}
}
else{
		header("Location:etat.php?msg=3");
	}

?>