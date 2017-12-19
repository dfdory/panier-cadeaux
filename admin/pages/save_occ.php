<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$occasion="";
if( (isset($_POST["occasion"]))AND ($_POST["occasion"] != ""))
 {
	$occasion=addslashes($_POST["occasion"]);
	$etat =mysql_query("INSERT INTO `occasion` (`id` ,`nom`)VALUES ( NULL , '$occasion');");
	//echo "INSERT INTO `images` (`id` ,`nom`)VALUES ( NULL , '$categorie');";
	if ($etat==true){
		header("Location:occassion.php?msg=1");
	}
	else{
		header("Location:occassion.php?msg=2");
		}
}
else{
		header("Location:occassion.php?msg=3");
	}

?>