<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id="";
$destinataire="";
if( (isset($_POST["destinataire"]))AND ($_POST["destinataire"] != ""))
 {
	$destinataire=addslashes($_POST["destinataire"]);
	$id=$_POST['id'];
	$etat =mysql_query("update`destinataire`set `nom`= '$destinataire' where `id`=$id ");
	//echo ("update`destinataire`set `nom`= '$destinataire' where `id`=$id ");
	if ($etat==true){
		header("Location:destinataire.php?msg=4");
	}
	else{
		header("Location:destinataire_editphp?msg=5&id=$id");
		}
}
else{
		header("Location:destinataire_edit.php?msg=3&id=$id");
	}

?>