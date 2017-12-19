<?php 
ob_start();
session_start();
include('../admin/conn.php');
$lien =$_POST["lien"];
//echo $lien;
$adresse_livraison=addslashes($_POST["adresse"]);
$_SESSION['adresse']=$adresse_livraison;
$etat = mysql_query("update  `membre` set adresse ='$adresse_livraison'");
 header("Location:$lien");
?>