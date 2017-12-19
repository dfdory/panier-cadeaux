<?php 
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id=$_GET['id'];
mysql_query("delete from etat_cmd where id = '$id'");
$r = mysql_query("update`commande` set `id_etat`= '$id'");
if($r){
header('Location:etat.php');}

?>