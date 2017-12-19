<?php 
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id=$_GET['id'];
mysql_query("delete from categorie where id = '$id'");
$r = mysql_query("delete from cadeau where id_categorie= '$id'");
if($r){
header('Location:categories.php');}

?>