<?php
ob_start();
session_start();
include('../admin/conn.php');
//include_once("panier/fonctions-panier.php");
include_once("fonctions-panier.php");
$id ='';
if(isset($_POST['mode_paiement']) && $_POST['mode_paiement']!=''){$id =$_POST['mode_paiement'];}

$query_ref_cmd =mysql_query("select * from commande ");
$num=mysql_num_rows($query_ref_cmd)+1;

$description=$_POST['description'];
$total = $_POST['total'];
$noOfItems = $_POST['noOfItems'];
//echo $description.'/'.$total.'/'.$noOfItems;

$referenceNumber='CMD_'.date("Ymd").'_'.$num;
$date=date("Y-m-d H:i:s");
$date1=date("d/m/Y H:i:s");
 $countryCurrencyCode=237;
 $customerFirstName=$_SESSION['prenom'];
 $customerLastname=$_SESSION['nom'];
 $customerEmail=$_SESSION['email'];
 $customerPhoneNumber=$_SESSION['tel'];
 
 if($id==1){
	header("Location:uba_paiement.php?description=$description&total=$total&noOfItems=$noOfItems&referenceNumber=$referenceNumber&date=$date1&countryCurrencyCode=$countryCurrencyCode&customerFirstName=$customerFirstName&customerLastname=$customerLastname&customerEmail=$customerEmail&customerPhoneNumber=$customerPhoneNumber&jjjj=$date&sys_paie=$id");}
?>