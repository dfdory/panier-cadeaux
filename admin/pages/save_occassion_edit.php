<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id="";
$occasion="";
if( (isset($_POST["occasion"]))AND ($_POST["occasion"] != ""))
 {
	$occasion=addslashes($_POST["occasion"]);
	$id=$_POST['id'];
	$etat =mysql_query("update`occasion`set `nom`= '$occasion' where `id`=$id ");
	//echo ("update`destinataire`set `nom`= '$destinataire' where `id`=$id ");
	if ($etat==true){
		header("Location:occassion.php?msg=4");
	}
	else{
		header("Location:occasion_editphp?msg=5&id=$id");
		}
}
else{
		header("Location:occasion_edit.php?msg=3&id=$id");
	}

?>