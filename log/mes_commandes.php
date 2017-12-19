<?php
$email = $_SESSION["email"];
$code_act=$_SESSION['code_act'];
$id=$_SESSION['id'];
$commande = mysql_query("SELECT *
FROM commande
WHERE id_membre =$id
ORDER BY id DESC");



?>

<div class="panel panel-warning" style="border-radius:0;border-color:#2d2925">
                      <div class="panel-heading" style=" background: #2d2925;border-color: #2d2925;border-radius:0;color:#fff">
                        <h3 class="panel-title" style="font-size:16px;text-transform:uppercase">Mes commandes</h3>
                      </div>
                      <div class="panel-body">
                      <div class="text-left">
                      	<table class="table">
                        	<tr>
                            	<th></th>
                                <th>ref commande</th>
                                <th>Date paiement</th>
                                <th>Montant Total</th>
                                
                                <th>Statut</th>
                                <th>Etat</th>
                                <th>Action</th>
                            </tr>
                            <?php 
							$i =1;
							while ($row_commande = mysql_fetch_array($commande)){?>
                        	<tr>
                            	<td><?php echo $i++ ;?> </td>
                                <td><?php echo $row_commande['ref_cmd']; ?></td>
                                <td><?php echo $row_commande['date_cmd']; ?></td>
                                <td><?php echo $row_commande['montant_th']; ?></td>
                                <td><?php if ($row_commande['statut']==1){echo 'Paiement effectue';} ?></td>
                                <td><?php if($row_commande['id_etat']==""){echo 'Commande en attente de livraison'; }
								else{$id_etat = $row_commande['id_etat'];
								$querry_etat = mysql_query("select * from etat_cmd where id=$id_etat");
								$row_etat = mysql_fetch_array($querry_etat);
								echo $row_etat['nom'];}?></td>
                                <td><span><a href="" class="animated fadeInDown pull-right text-warning" data-toggle="modal" data-target="#<?php echo $row_commande['id']; ?>">Voir detail</a></span></td>
                            </tr>
                            <div class="modal fade" id="<?php echo $row_commande['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">
     <div>
        <a style="background-color:transparent;color:#000405 ;width:35px;margin-left:100px;font-size:20px" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></a>
       
      </div>
              <div>
              	<div class="panel panel-primary panel-panier" style="border-radius:0;border-color: #d14233;">
                      <div class="panel-heading" style=" background: #d14233;border-color: #d14233;border-radius:0">
                        <h3 class="panel-title" style="font-size:15px;color:#fff">Reference commande : <?php echo $row_commande['ref_cmd']; ?></h3>
                      </div>
                      
					  <?php
							if(isset($_GET['msg'])&& $_GET['msg']==1)
							{
								echo '<div class="alert-warning"><h5>Insertion incorrect</h5></div>';
							}
					  ?>
                      <div class="panel-body">
                       
                       <span>
                       	 <?php 
							$ref =$row_commande['ref_cmd'];
							$id_cmd =$row_commande['id'];
							$list_article = mysql_query("select * from cado_cmd where id_cmd=$id_cmd and ref_cmd='$ref'");
							//echo ("select * from cado_cmd where id_cmd=$id_cmd and ref_cmd='$ref'");
							while($row_list_article = mysql_fetch_array($list_article)){
								$id_cadeau =$row_list_article['id_cadeau'];
								$cado = mysql_query("select * from cadeau where id= $id_cadeau");
								$row_cado = mysql_fetch_array($cado);
								?>
                                <ul>
                                	<li>Nom : <?php echo $row_cado['nom'];?></>
                                    <li>Qte : <?php echo $row_list_article['qte'];?></li>
                                    <li>P.U : <?php echo $row_cado['prix'];?> FCFA</li>
                                    <li>Total <?php echo ($row_cado['prix']* $row_list_article['qte']);?> FCFA</li>
                                </ul>
                                <?php
								}
						?>
                       </span>
                      </div>
                    </div>
                </div>
      
    </div>
  </div>
</div>
                            <?php } ?>
                        </table>
                  
                      </div> 
                         
                      </div>
                    </div>

<script type="text/javascript" src="../dist/validator.js"></script>