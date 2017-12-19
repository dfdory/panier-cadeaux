<meta charset="UTF-8">
<?php
ob_start();
session_start();
include('../admin/conn.php');
include_once("fonctions-panier.php");
$etat='';
$erreur = false;
$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
//echo $action;
if($action =='ajout'){
//récuperation des variables en POST ou GET
	$l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
	$p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
	$q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
	$lien = (isset($_POST['lien'])? $_POST['lien']:  (isset($_GET['lien'])? $_GET['lien']:null )) ;
	$id = (isset($_POST['id'])? $_POST['id']:  (isset($_GET['id'])? $_GET['id']:null )) ;
	$img = (isset($_POST['img'])? $_POST['img']:  (isset($_GET['img'])? $_GET['img']:null )) ;
	//echo $lien; 
	if($erreur==false){
		 ajouterArticle($id,$l,$q,$p,$img);
		 $nbre=compterArticles();
		 echo $nbre ;
		 header("Location:$lien");
	}
}
elseif($action =='vider'){
	$lien = (isset($_POST['lien'])? $_POST['lien']:  (isset($_GET['lien'])? $_GET['lien']:null )) ;
	supprimePanier();
	header("Location:$lien");
}
elseif($action =='suppression'){
	$lien = (isset($_POST['lien'])? $_POST['lien']:  (isset($_GET['lien'])? $_GET['lien']:null )) ;
	$l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
	supprimerArticle($l);
	header("Location:$lien");
}
elseif($action =='modifier'){
	
	$lien = (isset($_POST['lien'])? $_POST['lien']:  (isset($_GET['lien'])? $_GET['lien']:null )) ;
	$l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
	$q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
	$etat = modifierQTeArticle($l,$q);
	//echo $l.'+'.$q;
	if($etat==true){
	echo 'bon';}
	else{echo 'mauvais';}
	//header("Location:$lien");
}
//
?>