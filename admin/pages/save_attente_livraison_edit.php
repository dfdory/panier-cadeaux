<?php
ob_start();
session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id="";
$date_fin_livraison1="";
$date_dt_livraison=date("Y-m-d H:i:s");
$etat =2;
$id_admin =$_SESSION['id'];
if( (isset($_POST["date_fin_livraison"]))&& ($_POST["date_fin_livraison"] != ""))
 {
	 
	 $date_fin_livraison1=addslashes($_POST["date_fin_livraison"]);
	  $date_fin=explode('/',$date_fin_livraison1);
	 
	 $date_fin_livraison=$date_fin[2].'-'.$date_fin[0].'-'.$date_fin[1];
	 echo $date_fin_livraison;
	 $id=$_POST['id'];
	 
	 $etat =mysql_query("UPDATE `commande` SET `id_etat` = '$etat',`id_admin` = '$id_admin',`date_dt_livraison` = '$date_dt_livraison',`date_fin_livraison` = '$date_fin_livraison' WHERE `id` =$id;");
	 
	 if ($etat==true){
		header("Location:attente_livraison.php?msg=4");
	}
	else{
		header("Location:attente_livraison_edit.php?msg=5&id=$id");
		}
 }
 else{
		header("Location:attente_livraison_edit.php?msg=3&id=$id");
	}
?>