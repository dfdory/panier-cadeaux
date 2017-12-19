<?php 
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
	
		if(isset($_SERVER['HTTP_REFERER'])){
			include('../conn.php');
			$name =$_GET['name'];
			$id = $_GET['id'];
			$r = mysql_query("delete from images where id ='$id'");
			if($r == 1){
				 unlink('../../img/cadeau/'.$name);
				 unlink('../../img/cadeau/thumbnail/'.$name);
			}
			header('location: '.$_SERVER['HTTP_REFERER']);
		}
	
	
?>