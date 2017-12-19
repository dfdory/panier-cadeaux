<?php 
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
	include('../conn.php');
	$id = $_GET['id'];
	function deleteJoin($id)
	{
		mysql_query("delete from cado_occasion where id_cadeau = '$id'");
		mysql_query("delete from cado_destinataire where id_cadeau = '$id'");
		mysql_query("delete from cado_etiquette where id_cadeau = '$id'");
		
	}	
	
	function deleteImage($id)
	{
		$r = mysql_query("select * from images where id_cadeau = '$id'");
		while ($row = mysql_fetch_array($r,1)) {
			$name =$row['lien'];
			$id = $row['id'];
			$r2 = mysql_query("delete from images where id ='$id'");
			if($r2 == 1){
				 unlink('../../img/cadeau/'.$name);
				 unlink('../../img/cadeau/thumbnail/'.$name);
			}
		}
	}
	
	deleteJoin($id);
	deleteImage($id);
	$r = mysql_query("delete from cadeau where id= '$id'");
	if($r)
		header('location: cadeau.php');
	else 
		echo mysql_error();
	
	
	
?>		