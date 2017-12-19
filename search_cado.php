<?php
ob_start();
session_start();
include('admin/conn.php');
//include_once("panier/fonctions-panier.php");
include_once("panier/fonctions-panier.php");

$dd='';
$rech_ob=addslashes($_REQUEST['rech_ob']);
$objet = str_replace('+',' ',trim($rech_ob));
$array_objet = explode(' ',$objet);
$bre_mot=count($array_objet);
$nbre_mot2= $bre_mot - ($bre_mot-2);

$bre_mot1=count($array_objet);
$nbre_mot3= $bre_mot1 - ($bre_mot1-2);
//$mot=$objet;
$mot = "%".$objet."%";

$cpt=0;
$cpt1=0;
$cpt_debut=0;
$query_occasion = mysql_query('select * from occasion');
$query_destinataire = mysql_query('select * from destinataire');
$query_categorie = mysql_query('select * from categorie');
$sess=0;
$table_verif="table_verif".$sess;
$sess++;
mysql_query("CREATE ALGORITHM = UNDEFINED VIEW `$table_verif` AS (SELECT id,id_cadeau from `search_compare`);");


//  DEBUT DE LA RECHERCHE AVEC LE MOT (OU LA CHAINE ) EN ENTIER
$cpt_result=mysql_query("SELECT *
FROM `cadeau` WHERE `nom` LIKE '$mot'");
if(mysql_num_rows($cpt_result)!=0){
		while($ann7 = mysql_fetch_array($cpt_result))
		{
			$id_cadeau=$ann7['id'];
			$num3= mysql_query("select id_cadeau from $table_verif where id_cadeau = $id_cadeau");
			$num_code=mysql_num_rows($num3);
				if($num_code==0)
					{
						mysql_query("INSERT INTO $table_verif (id,id_cadeau)VALUES (NULL,'$id_cadeau');");
						//$cpt_debut=$cpt_debut+1;
					}
		}
	}


// RECHERCHE DE LA GAUCHE VERS LA DROITE EN ENLEVANT LE DERNIER MOT	
if($cpt_debut==0){
	
	while($bre_mot>$nbre_mot2){
		for($i=0;$i<$bre_mot-1;$i++){
			$dd .=$array_objet[$i].' ';
		}
	$cpt_result=mysql_query("SELECT *
FROM `cadeau` WHERE `nom` LIKE '$mot'");
if(mysql_num_rows($cpt_result)!=0){
		while($ann7 = mysql_fetch_array($cpt_result))
		{
			$id_cadeau=$ann7['id'];
			$num3= mysql_query("select id_cadeau from $table_verif where id_cadeau = $id_cadeau");
			$num_code=mysql_num_rows($num3);
				if($num_code==0)
					{
						mysql_query("INSERT INTO $table_verif (id,id_cadeau)VALUES (NULL,'$id_cadeau');");
						//$cpt_debut=$cpt_debut+1;
					}
		}
	}
		$mot="%".trim($dd)."%";
		$dd='';
		$bre_mot=$bre_mot-1;
	}//FIN WHILE($bre_mot>$nbre_mot2)
	
	// RECHERCHE DE LA GAUCHE VERS LA DROITE EN ENLEVANT LE PREMIER MOT;
	
	if($cpt==0 && $cpt_debut==0)
	{
			$a=1;
			//debut while
			while($bre_mot1>$nbre_mot3)
			{
				for($i=$a;$i<count($array_objet);$i++){
				$dd .=$array_objet[$i].' ';
				}
			$a++;
			
			$mot="%".trim($dd)."%";
			$cpt_result=mysql_query("SELECT * FROM `cadeau` WHERE `nom` LIKE '$mot'");
if(mysql_num_rows($cpt_result)!=0){
		while($ann7 = mysql_fetch_array($cpt_result))
		{
			$id_cadeau=$ann7['id'];
			$num3= mysql_query("select id_cadeau from $table_verif where id_cadeau = $id_cadeau");
			$num_code=mysql_num_rows($num3);
				if($num_code==0)
					{
						mysql_query("INSERT INTO $table_verif (id,id_cadeau)VALUES (NULL,'$id_cadeau');");
						//$cpt_debut=$cpt_debut+1;
					}
		}
	}
		$dd='';
	$bre_mot1=$bre_mot1-1;		}//fin DU WHILE ($bre_mot1>$nbre_mot3)
	}//fin du if ($cpt==0 && $cpt_debut==0)
	
	
	// RECHERCHE MOT A MOT

	if($cpt1==0 && $cpt==0 && $cpt_debut==0){
		foreach($array_objet as $mot1){
		$mot = "%".trim($mot1)."%";
		$cpt_result=mysql_query("SELECT *
FROM `cadeau` WHERE `nom` LIKE '$mot'");
if(mysql_num_rows($cpt_result)!=0){
		while($ann7 = mysql_fetch_array($cpt_result))
		{
			$id_cadeau=$ann7['id'];
			$num3= mysql_query("select id_cadeau from $table_verif where id_cadeau = $id_cadeau");
			$num_code=mysql_num_rows($num3);
				if($num_code==0)
					{
						mysql_query("INSERT INTO $table_verif (id,id_cadeau)VALUES (NULL,'$id_cadeau');");
						//$cpt_debut=$cpt_debut+1;
					}
		}
	}
		}// FIN foreach($array_objet as $mot1)
	 } //FIN if($cpt1==0 && $cpt==0 && $cpt_debut==0){
}//FIN DU GRAND IF($CPT_DEBUT==0)

// comptage du nombre de lignes de la base
$result=mysql_query("select * from $table_verif");
$num_row=mysql_num_rows($result);
echo 'nombre resultat='.$num_row;
?>


<?php  
			     mysql_query("DROP VIEW `$table_verif`");
				 mysql_query("TRUNCATE TABLE  `search_compare`");?>