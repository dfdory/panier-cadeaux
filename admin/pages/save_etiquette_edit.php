<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id="";
$etiquette="";
if( (isset($_POST["etiquette"]))AND ($_POST["etiquette"] != ""))
 {
	$etiquette=addslashes($_POST["etiquette"]);
	$id=$_POST['id'];
	$etat =mysql_query("update`etiquette`set `nom`= '$etiquette' where `id`=$id ");
	//echo ("update`destinataire`set `nom`= '$destinataire' where `id`=$id ");
	if ($etat==true){
		header("Location:etiquette.php?msg=4");
	}
	else{
		header("Location:etiquette_editphp?msg=5&id=$id");
		}
}
else{
		header("Location:etiquette_edit.php?msg=3&id=$id");
	}

?>