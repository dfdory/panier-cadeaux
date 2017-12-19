<?php
ob_start();
session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id=$_GET['id'];
$etat =3;
$etat =mysql_query("UPDATE `commande` SET `id_etat` = '$etat' WHERE `id` =$id;");
	 
	 if ($etat==true){
		header("Location:encours_livraison.php?msg=4");
	}
	else{
		header("Location:encours_livraison_edit.php?msg=5&id=$id");
		}
?>