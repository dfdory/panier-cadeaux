<?php
ob_start();
session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id="";
$nom_etat="";
$code="";
if( ((isset($_POST["code"]))AND ($_POST["code"] != ""))||((isset($_POST["etat"]))AND ($_POST["etat"] != "")))
 {
	$nom_etat=addslashes($_POST["etat"]);
	$code=addslashes($_POST["code"]);
	$id=$_POST['id'];
	$etat =mysql_query("UPDATE `etat_cmd` SET `nom` = '$nom_etat',`code_etat` = '$code' WHERE `etat_cmd`.`id` =$id;");
	

	//echo "INSERT INTO `images` (`id` ,`nom`)VALUES ( NULL , '$categorie');";
	if ($etat==true){
		header("Location:etat.php?msg=4");
	}
	else{
		header("Location:etat_edit.php?msg=5&id=$id");
		}
}
else{
		header("Location:etat_edit.php?msg=3&id=$id");
	}

?>