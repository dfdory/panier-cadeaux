<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$nom="";
$prenom="";
$login="";
$pwd="";
$mail ="";

	
	if( (isset($_POST["nom"]))AND ($_POST["nom"] != "") AND (isset($_POST["login"]))AND ($_POST["login"] != "")
		AND (isset($_POST["pwd"]))AND ($_POST["pwd"] != "") AND (isset($_POST["email"]))AND ($_POST["email"] != ""))
	{
		$nom = addslashes($_POST['nom']);
		$prenom = addslashes($_POST['prenom']);
		$login = addslashes($_POST['login']);
		$pwd = addslashes(md5($_POST['pwd']));
		$mail = addslashes($_POST['email']);
		$etat =mysql_query("INSERT INTO `admin` (`id` ,`nom`,`prenom`,`login`,`pwd`,`email`)VALUES( NULL , '$nom', '$prenom', '$login', '$pwd', '$mail');");
		if ($etat==true){
		header("Location:user.php?msg=1");
	}
	else{
		header("Location:user.php?msg=2");
		}
	}
	else{
		header("Location:user.php?msg=3");
	}
?>