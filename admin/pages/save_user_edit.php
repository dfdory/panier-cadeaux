<?php
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
include('../conn.php');
$id="";
$nom="";
$prenom="";
$login="";
$pwd="";
$mail ="";
$id=$_POST['id'];
	if( (isset($_POST["nom"]))AND ($_POST["nom"] != "") AND (isset($_POST["login"]))AND ($_POST["login"] != "")
		AND (isset($_POST["pwd"]))AND ($_POST["pwd"] != "********") AND (isset($_POST["email"]))AND ($_POST["email"] != ""))
	{
		
		$nom = addslashes($_POST['nom']);
		$prenom = addslashes($_POST['prenom']);
		$login = addslashes($_POST['login']);
		$pwd = addslashes(md5($_POST['pwd']));
		$mail = addslashes($_POST['email']);
		$etat =mysql_query("update `admin` set `nom`='$nom',`prenom`= '$prenom',`login`='$login' ,`pwd`='$pwd' ,`email`= '$mail' where `id`=$id");
		if ($etat==true)
		{
			header("Location:user.php?msg=1");
		}
		else
		{
			header("Location:user.php?msg=2");
			
		}
	}
	elseif((isset($_POST["nom"]))AND ($_POST["nom"] != "") AND (isset($_POST["login"]))AND ($_POST["login"] != "") AND (isset($_POST["pwd"]))AND ($_POST["pwd"] == "********") AND (isset($_POST["email"]))AND ($_POST["email"] != ""))
    {
		//$id=$_POST['id'];
		$nom = addslashes($_POST['nom']);
		$prenom = addslashes($_POST['prenom']);
		$login = addslashes($_POST['login']);
		//$pwd = addslashes(md5($_POST['pwd']));
		$mail = addslashes($_POST['email']);
		$etat =mysql_query("update `admin` set `nom`='$nom',`prenom`= '$prenom',`login`='$login' ,`email`= '$mail' where `id`=$id");
		if ($etat==true)
		{
			echo ("update `admin` set `nom`='$nom',`prenom`= '$prenom',`login`='$login' ,`email`= '$mail' where `id`=$id");
			header("Location:user.php?msg=1");
		}
		else
		{
			echo ("update `admin` set `nom`='$nom' ,`prenom`= '$prenom',`login`='$login' , `email`= '$mail' where `id`=$id");
			header("Location:user.php?msg=2");
			
		}
	}
	else{
		header("Location:user_edit.php?msg=3&id='$id'");
	}
?>