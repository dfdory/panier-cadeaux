<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id="";
$categorie="";
if( (isset($_POST["categorie"]))AND ($_POST["categorie"] != ""))
 {
	$categorie=addslashes($_POST["categorie"]);
	$id=$_POST['id'];
	$etat =mysql_query("update`categorie`set `nom`= '$categorie' where `id`=$id ");
	

	//echo "INSERT INTO `images` (`id` ,`nom`)VALUES ( NULL , '$categorie');";
	if ($etat==true){
		header("Location:categories.php?msg=4");
	}
	else{
		header("Location:categorie_editphp?msg=5&id=$id");
		}
}
else{
		header("Location:categorie_edit.php?msg=3&id=$id");
	}

?>