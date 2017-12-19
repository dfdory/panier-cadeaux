<?php 
ob_start();
session_start();
include('../admin/conn.php');
$lien =$_POST["lien"];
//echo $lien;
$adresse_livraison=addslashes($_POST["adresse"]);
$nom =addslashes($_POST["nom"]).' '.addslashes($_POST["prenom"]);
$tel=addslashes($_POST["tel"]);
$nom_correct=addslashes($_POST["nom_correct"]);
$_SESSION['adresse_livraison']=$adresse_livraison;
$_SESSION['nom_livraison']=$nom;
$_SESSION['tel_livraison']=$tel;
$_SESSION['nom_correct']=$nom_correct;
 header("Location:$lien");
?>