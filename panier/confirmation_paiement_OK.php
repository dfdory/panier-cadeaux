<?php
ob_start();
session_start();
include('../admin/conn.php');
//include_once("panier/fonctions-panier.php");
include_once("fonctions-panier.php");
if(!isset ($_SESSION["email"])&& $_SESSION["email"] == "")
{
header("Location:../log/ins_login.php");
}
$page = $_SERVER['REQUEST_URI'] ;
$id_membre=$_SESSION['id'];
$url=$_POST['url'];
$ref_cmd=$_POST['ref_cmd'];
$adresse_facture=addslashes($_SESSION['adresse']);
$adresse_livraison=addslashes($_SESSION['adresse_livraison']);
$nom_receptioniste=addslashes($_SESSION['nom_livraison']);
$tel_receptioniste=addslashes($_SESSION['tel_livraison']);
$nom_correct=addslashes($_SESSION['nom_correct']);
$montant_th = MontantGlobal();
$montant_livraison=0;
$date_cmd=$_POST['date_cmd'];
$date_save='0000-00-00 00:00:00';
$date_dt_livraison='0000-00-00 00:00:00';
$date_fin_livraison='0000-00-00 00:00:00';
$id_sys=$_POST['sys_paie'];
$date_paie=$_POST['date_cmd'];
$montant_total = MontantGlobal();
$montant_recu = MontantGlobal();
$montant_restant = $montant_total-$montant_recu;
$num_transaction=$_POST['id_transaction'];
$statut=1;
$etat=1;
$j=0;
$inser_cmd= mysql_query(" INSERT INTO `commande` (`id` ,`id_etat` ,`id_membre` ,`id_admin` ,`statut` ,`ref_cmd` ,`adresse_facture` ,`adresse_livraison` ,`nom_receptioniste` ,`tel_receptioniste` ,`nom_correct` ,`montant_th` ,`montant_livraison` ,`date_cmd` ,`date_save` ,`date_dt_livraison` ,`date_fin_livraison`
)VALUES (
NULL , '$etat', '$id_membre', NULL, '$statut', '$ref_cmd', '$adresse_facture', '$adresse_livraison', '$nom_receptioniste', '$tel_receptioniste', '$nom_correct', '$montant_th', '$montant_livraison', '$date_cmd', '$date_save', '$date_dt_livraison', '$date_fin_livraison'
)");

	if($inser_cmd){
		$id_cmd =  mysql_insert_id();
		echo $id_cmd;
		if(creationPanier())
				{
					if(compterArticles()> 0) 
					{
						for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++ )
						{
							
				$id_cado=$_SESSION['panier']['idProduit'][$i];
				$qte_cado=$_SESSION['panier']['qteProduit'][$i];
				$inser_cmd_cado =mysql_query(" INSERT INTO `cado_cmd` (`id` ,`id_cmd` ,`id_cadeau` , `qte`,`ref_cmd`)VALUES (
NULL , '$id_cmd', '$id_cado','$qte_cado','$ref_cmd')");
							$j++;
					}
					}
				}
		
			if($j > 0){
		$inser_paie=mysql_query(" INSERT INTO `paiement` (`id` ,`id_cmd` ,`id_sys` ,`date_paiement`,`montant_total` ,`montant_recu`,`montant_restant` ,`num_transaction`,`ref_cmd`)VALUES (NULL , '$id_cmd', '$id_sys','$date_paie','$montant_total','$montant_recu','$montant_restant','$num_transaction','$ref_cmd')");
		supprimePanier();
		header('Location:../index.php');
		}
	}
?>