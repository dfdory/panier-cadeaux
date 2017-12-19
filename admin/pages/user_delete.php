<?php 
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id=$_GET['id'];

mysql_query("update message set id_admin =NULL where id_admin= '$id'");
mysql_query("update commande set id_admin =NULL where id_admin= '$id'");
$r = mysql_query("delete from admin where id = '$id'");
if($r){
header('Location:user.php');}

?>