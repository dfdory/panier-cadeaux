<?php
$email = $_SESSION["email"];
$code_act=$_SESSION['code_act'];
$profil =mysql_query("select civilite,date_naiss from membre where code_act=$code_act");
$row_profil =mysql_fetch_array($profil);
if(isset ($_POST["modification"])){
	$civilite=addslashes($_POST["civilite"]);
	$nom=addslashes($_POST["nom"]);
	$prenom=addslashes($_POST["prenom"]);
	$datenaiss=addslashes($_POST["datenaiss"]);
	$adresse=addslashes($_POST["adresse"]);
	$mail=addslashes($_POST["mail"]);
	$tel=addslashes($_POST["tel"]);
	$login=addslashes($_POST["login"]);
	$password=md5(addslashes($_POST["password"]));
	$testpassword =$_POST["password"];
	
	$etat='';
	if($testpassword=='******'){
		$etat =mysql_query("UPDATE `membre` SET `nom`='$nom', `prenom`='$prenom',`civilite`='$civilite',`date_naiss`='$datenaiss',
							`adresse`='$adresse',`email`='$mail',`tel`='$tel',`login`='$login' WHERE`code_act`='$code_act'");
			}
		
	else{
		$etat =mysql_query("UPDATE `membre` SET `nom`='$nom', `prenom`='$prenom',`civilite`='$civilite',`date_naiss`='$datenaiss',
							`adresse`='$adresse',`email`='$mail',`tel`='$tel',`login`='$login',`pwd`='$password' WHERE`code_act`='$code_act'");
		}
		
		if ($etat==true)
			{
				$_SESSION['email']=$mail;
				
				$_SESSION['login']=$login;
				$_SESSION['nom']=$nom;
				$_SESSION['prenom']=$prenom;
				$_SESSION['adresse']=$adresse;
				$_SESSION['adresse_livraison']=$adresse;
				$_SESSION['nom_livraison']=$nom.''.$prenom;
				$_SESSION['tel_livraison']=$tel;
				$_SESSION['nom_correct']='correct';
				$_SESSION['tel']=$tel;
			}
	}
?>

<div class="panel panel-warning" style="border-radius:0;border-color:#2d2925">
                      <div class="panel-heading" style=" background: #2d2925;border-color: #2d2925;border-radius:0;color:#fff">
                        <h3 class="panel-title" style="font-size:16px;text-transform:uppercase">Identification</h3>
                      </div>
                      <div class="panel-body">
                      <div class="text-left">
                      	<table class="table">
                        	<tr>
                            	<td>CIVILITE </td>
                                <td><?php echo $row_profil['civilite']; ?></td>
                            </tr>
                            <tr>
                            	<td>NOM </td>
                                <td><?php echo  $_SESSION['nom'];?></td>
                            </tr>
                            <tr>
                            	<td>PRENOM </td>
                                <td> <?php echo $_SESSION['prenom'];?></td>
                            </tr>
                            <tr>
                            	<td> DATE NAISSANCE </td>
                                <td> <?php echo $row_profil['date_naiss'];?></td>
                            </tr>
                             <tr>
                            	<td> ADRESSE</td>
                                <td>  <?php echo $_SESSION['adresse'];?></td>
                            </tr>
                              <tr>
                            	<td>  EMAIL</td>
                                <td>  <?php echo $_SESSION['email'];?></td>
                            </tr>
                            <tr>
                            	<td>  NUM TEL</td>
                                <td>  <?php echo $_SESSION['tel'];?></td>
                            </tr>
                             <tr>
                            	<td>  LOGIN</td>
                                <td>  <?php echo $_SESSION['login'];?></td>
                            </tr>
                            <tr>
                            	<td>  MOT DE PASSE</td>
                                <td>  ******</td>
                            </tr>
                        </table>
                  
                      </div> 
                         <span><a href="" class="animated fadeInDown pull-right text-warning" data-toggle="modal" data-target="#adressefact">Modifier</a></span>
                      </div>
                    </div>
<div class="modal fade" id="adressefact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <div class="modal-content">
     <div>
        <a style="background-color:transparent;color:#000405 ;width:35px;margin-left:100px;font-size:20px" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove-circle"></i></a>
       
      </div>
              <div>
              	<div class="panel panel-primary panel-panier" style="border-radius:0;border-color: #d14233;">
                      <div class="panel-heading" style=" background: #d14233;border-color: #d14233;border-radius:0">
                        <h3 class="panel-title" style="font-size:15px;color:#fff">Modification de mon profil</h3>
                      </div>
                      
					  <?php
							if(isset($_GET['msg'])&& $_GET['msg']==1)
							{
								echo '<div class="alert-warning"><h5>Insertion incorrect</h5></div>';
							}
					  ?>
                      <div class="panel-body">
                       
                        <p>&nbsp;</p>
                        <form data-toggle="validator" role="form" id="myForm" action="" method="post">
                          <div class="form-group">
                            <label for="inputCivilite" class="control-label">Civilite*</label>
                           
                            <select style="border-radius: 0px;" class="form-control" name ="civilite" id="inputCivilite" required>
                            	  <option value="<?php echo $row_profil['civilite']; ?>"><?php echo $row_profil['civilite']; ?></option>
                                  <option value="M.">M.</option>
                                  <option value="Mme">Mme</option>
                                  <option value="Mlle">Mlle</option>
                                  
                            </select>
                            <div class="help-block with-errors"></div>
                          </div>
                          <div class="form-group">
                            <label for="inputName" class="control-label">Nom*</label>
                            <input    style="border-radius: 0px;" type="text" class="form-control" id="inputName" name="nom" placeholder="Votre nom" required value="<?php echo  $_SESSION['nom'];?>">
                            <div class="help-block with-errors"></div>
                          </div>
                          <div class="form-group">
                            <label for="inputPrenom" class="control-label">Prenom*</label>
                            <input style="border-radius: 0px;" type="text" class="form-control" id="inputPrenom" name="prenom" placeholder="Votre prenom" required value="<?php echo $_SESSION['prenom'];?>">
                            <div class="help-block with-errors"></div>
                          </div>
                          <div class="form-group">
                            <label for="inputDateNaiss" class="control-label">Date de naissance</label>
                            <input style="border-radius: 0px;" type="text" pattern="\d{4}-\d{2}-\d{2}" class="form-control" id="inputDateNaiss" name="datenaiss" placeholder="YYYY-MM-JJ" value="<?php echo $row_profil['date_naiss'];?>">
                            <span class="help-block with-errors">Date sous le format YYYY-MM-JJ</span>
                           
                          </div>
                           <div class="form-group">
                            <label for="inputAdresse" class="control-label">Adresse*</label>
                            <input style="border-radius: 0px;" type="text" class="form-control" id="inputAdresse" name="adresse" placeholder="Ville - Quartier - Autre infos pouvant etre utiles" required value ="<?php echo $_SESSION['adresse'];?>">
                            <div class="help-block with-errors">Ville, Quartier, autres infos pouvant etre utiles</div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail" class="control-label">Email*</label>
                            <input style="border-radius: 0px;" type="email" class="form-control" id="inputEmail" placeholder="Email" name="mail" data-error="Email incorrect" required value="<?php echo $_SESSION['email'];?>">
                            <div class="help-block with-errors"></div>
                          </div>
                          <div class="form-group">
                            <label for="inputTel" class="control-label">Tel*</label>
                            <input style="border-radius: 0px;" type="text" pattern="[\(][\+]\d{3}[\)][\ ]\d{3}[\-]\d{2}[\-]\d{4}" class="form-control" id="inputTel" name="tel" placeholder="(+237) 000-00-0000" required value ="<?php echo $_SESSION['tel'];?>">
                            <span class="help-block with-errors">telephone sous le format (+237) 000-00-0000</span>
                           
                          </div>
                          <div class="form-group">
                            <label for="inputLogin" class="control-label">Login*</label>
                            <input style="border-radius: 0px;" type="text" pattern="^([_A-z0-9]){3,}$" maxlength="10" class="form-control" id="inputLogin" name="login" placeholder="Votre login" required value ="<?php echo $_SESSION['login'];?>">
                            <div class="help-block with-errors">10 Lettres au maximun</div>
                          </div>
  						 <div class="form-group">
                         	
                            <label for="inputPassword" class="control-label">Mot de passe*</label>
                           
                              <input style="border-radius: 0px;" type="password" data-minlength="6" class="form-control" id="inputPassword" name="password" placeholder="Mot de passe" required value ="******">
                              <span class="help-block">Minimum de 6 caracteres</span>
                           
                              <input style="border-radius: 0px;" type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, &ccedil;a ne correspond pas" placeholder="Confirmer votre mot de passe " required value ="******">
                              <div class="help-block with-errors"></div>
                           
                            
                         </div>
  
  
  
						  <div class="form-group">
                          <input type="hidden" name="code_act" value ="<?php echo $_SESSION['code_act']; ?>">
							<button  type="submit" class="btn btn-primary" style="font-size:12px;width:80px;border-radius:0;" name="modification">Modifier</button>
                            <button  type="reset" class="btn btn-primary" style="font-size:12px;width:80px;border-radius:0;" name="inscription">Annuler</button>
						  </div>
						</form>
                        
                        	
                      </div>
                    </div>
                </div>
      
    </div>
  </div>
</div>
<script type="text/javascript" src="../dist/validator.js"></script>