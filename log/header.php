<nav class="navbar navbar-static-top navbar-inverse" role="navigation">
		<div id="header-title">
            <a class="brand" href=""></a>
        </div>
    
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand visible-xs" href="">  <span></span></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-mind-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars fa-inverse"></i>
            </button>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse yin-col-12">
           <div class="container">
               <ul class="nav navbar-nav  ">
               </ul>
               <ul class="nav navbar-nav pull-right">
		 <li  class="" style=" border-right: none"><i class="fa fa-phone" style="padding-top:15px;font-size:16px"></i></li>
    <li  class="" style=" border-right: none"><a  href="#" style="color:#fff">Assistance: <strong style="color:#fff">(+237) 0000 00 00</strong></a></li>
    <li  class="" style="text-align:right"><a  href="#" style="color:#fff;margin:0px;padding-left:0;padding-right:0;text-align:right;margin:0 0px 0 0">Nous contacter</a></li>
    <li style="height:20px; border-right: 1px solid #eeeeee;margin:15px 10px 0 10px;"></li>
		<li  class=""><?php if(!isset ($_SESSION['email']) ){?><a  href="log/ins_login.php" class="" style="color:#fff;margin:0 0px 0 0;padding-left:0px;padding-right:0px;">Creer un profil </a><?php } else {?><a  style="color:#fff" href="log/compte.php" class="">Compte</a><?php } ?></span></li>
	 <li style="height:20px; border-right: 1px solid #eeeeee;margin:15px 10px 0 10px;"></li>
		<li  class="" style="color:#fff"><?php if(!isset ($_SESSION['email']) ){?><a  href="log/ins_login.php" class="" style="color:#fff;margin:0 0px 0 0;padding-left:0px;padding-right:0px;">Se connecter</a><?php } else {?><a  style="color:#fff" href="deconnexion.php" class="">Deconnexion</a><?php } ?></span></li>
		
		
	   </ul>
       		</div>
        </div><!-- navbar-collapse -->
		<div class="container">
	  		<div class="collapse navbar-collapse ">
              <ul class="nav navbar-nav" style="width:100%">
		<li  class="step-booking" ><span class="badge"> 1 </span ><span class="badge-ios">Trouvez le cadeau ideal</span></a></li>
		<li class="step-booking" ><span class="badge">2</span><span class="badge-ios">Commandez en ligne</span></a></li>
		<li class="step-booking"><span class="badge">3</span><span class="badge-ios">Payez en ligne</span></li>
		<li id="" class="step-booking"><span class="badge">4</span><span class="badge-ios">Faites livrer votre cadeau</span> </a></li>
	    </ul>
              <div class="col-md-12">
	              <div class="col-md-4">
     <a href="index.php" class="brand"><img alt="Your Logo Here"  src="images/logo-5.jpg" height="60" width="90"></a>
  </div>
                 <div class="col-md-8 pull-right">
                   <div class="col-md-6 col-md-offset-0" style="margin-top:10px">
      <form class="navbar-form" method="post" action="search_cado.php">
        <div class="">
          <div class="input-group">
            
            <input type="text" id="id_query" name ="rech_ob" class="form-control" style="border-radius:0px 0px 0px 0px;height:30px;background-color:#fff;font-size:80%;width:100%" placeholder="Search gifts" required="required">
       <div class="input-group-btn">
             <button type="submit" class="btn btn-primary" style="width:60px;height:30px;border-radius:0px; border:none;"><span class="fa fa-search" style=""></span> </button>
            </div>
          

          </div>
        </div>
      </form>
  </div>
  <div class="col-md-6 cart">
    <ul class="nav navbar-nav navbar-right ">
<?php if(creationPanier())
				{
					if(compterArticles() <= 0) 
					{
					?>
						<li class="" style="margin-right:20px;"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="width:260px;background-color:#2d2925;margin-bottom:5px;color:#fff;margin-top:0px;text-align:center;border-radius:0px 0px 0px 0px;"><i class="fa fa-shopping-cart" style="font-size:14px"></i>Mon Panier <span style="color:#d14233;padding:10px"><?php echo compterArticles();?>&nbsp; Cadeaux </span></a></li>
					<?php
					}
					else
					{
					?>
  <li class="dropdown" style="margin-right:20px;">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="width:260px;background-color:#2d2925;margin-bottom:5px;color:#fff;margin-top:0px;text-align:center;border-radius:0px 0px 0px 0px;"><i class="fa fa-shopping-cart" style="font-size:14px"></i>Mon Panier <span style="color:#d14233;padding:10px"><?php echo compterArticles();?>&nbsp; Cadeaux </span></a>
        <ul class="dropdown-menu" style="">
<?php if(compterArticles() > 0) 
								{
								?>
								<?php
								}
									if(isset($_SESSION['panier']['libelleProduit']))
									{
										for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++ )
										{
										?>
											<div class="col-md-4 gallery-item-small">
												<img src="img/cadeau/<?php echo $_SESSION['panier']['imgProduit'][$i];?>">
											</div>
											<div class="col-md-6">
												<span style="font-size:90%"><?php echo $_SESSION['panier']['qteProduit'][$i];?> x </span><span style=" padding:2px;font-size:11px;color:#d14233;font-style:bold;text-transform:uppercase;font-weight:900"><?php echo $_SESSION['panier']['libelleProduit'][$i];?></span></br>
												
												<span style="font-size:90% ;text-align:center"><?php echo number_format( $_SESSION['panier']['prixProduit'][$i],0,'',' ');?> FCFA</span>
											</div>
											<div class="col-md-2">
											<a href="panier/ajout_panier.php?action=suppression&amp;lien=<?php echo $page;?>&amp;l=<?php echo $_SESSION['panier']['libelleProduit'][$i];?>"><i class="close" style="color:#000405;font-size:13px;font-style:normal">x</i></a>	
											</div>

										<div class="col-md-12 divider">

									</div>	
										<?php	
										}
									}
									?></br>
									
									<div class="col-md-12">
<strong>Total </strong></br><div class="col-md-6">
										<span class="text-error pull-left" style="font-size:80%">
											<?php echo compterArticles(); ?> Articles 
                                        </span> 
                                      </div>
                                        <div class="col-md-6">
<span class="pull-right" style="font-size:80%"><?php echo number_format(MontantGlobal(),0,'',' ');?>FCFA</span></div>
<div class="col-md-12 divider">

</div>
			<div class="col-md-12" style="border:1px solid #eeeeee;padding:10px 10px 0 10px">	<p><a href="panier/commande.php" class="btn btn-primary" style="border-radius:0px;font-size:90%;width:100px">Panier</a> <a href="panier/paiement.php" class="btn btn-primary pull-right" style="border-radius:0px;;font-size:90%;width:100px">Caisse</a></p></div>
									</div>
									
									<?php
									
								?>

	
        </ul>
      </li>
<?php 
					}
				}
			?>

			<li class="cash"><a id="cash"  style="background-color:#f4a62a;margin-bottom:5px;color:#fff;margin-top:0px;text-align:center;border-radius:0px 0px 0px 0px;padding:8px 15px"  href="panier/paiement.php">Caisse</a></li>

      
    </ul>
		
  </div>

</div>
   
	 
      </div>
        </div><!-- navbar-collapse -->
        <div class="collapse navbar-collapse mael-menu" >
             <ul class="nav navbar-nav">
                <li  class="" style=""><a  href="#" data-toggle="dropdown" class="dropdown-toggle "><span class="fa fa-home " style="font-size:16px"></span></a></li>
		<?php while ($row_categorie = mysql_fetch_array($query_categorie)){?>
		<li  class="" style="color:#fff"><a  href="categorie.php?cat=<?php echo $row_categorie['id'];?>"><?php echo $row_categorie['nom'];?></a></li>
		<?php } ?>
	   </ul>
        </div><!-- navbar-collapse -->
    </div> <!-- container -->
   </nav> <!-- navbar navbar-default -->
    