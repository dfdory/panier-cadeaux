<?php 
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id=$_GET['id'];
mysql_query("delete from occasion where id = '$id'");
$r = mysql_query("delete from cado_occasion where id_occasion= '$id'");
if($r)
{
 header('Location:occassion.php');
}

?>