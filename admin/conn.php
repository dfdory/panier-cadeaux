<?php

$user ='root';
$password='root';
$db='panier_cadeau';
$host='localhost';
$port ='8889';


$conn = @mysql_connect("$host:$port",$user,$password);

if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('panier_cadeau', $conn) or die ('Mysql Error : No Database selected . Please contact DBA for more informations ---------- Inext Server Error ---------');

?>
