<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$destinataire="";
if( (isset($_POST["destinataire"]))AND ($_POST["destinataire"] != ""))
 {
	$destinataire=addslashes($_POST["destinataire"]);
	$etat =mysql_query("INSERT INTO `destinataire` (`id` ,`nom`)VALUES ( NULL , '$destinataire');");
	//echo "INSERT INTO `images` (`id` ,`nom`)VALUES ( NULL , '$categorie');";
	if ($etat==true){
		header("Location:destinataire.php?msg=1");
	}
	else{
		header("Location:destinataire.php?msg=2");
		}
}
else{
		header("Location:destinataire.php?msg=3");
	}

?>