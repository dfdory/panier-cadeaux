<?php
ob_start();
session_start();
include('../admin/conn.php');
if(!isset ($_SESSION["email"])&& $_SESSION["email"] == "")
{
header("Location:../log/ins_login.php");
}
include_once("../panier/fonctions-panier.php");
$page = $_SERVER['REQUEST_URI'] ;

$query_categorie = mysql_query('select * from categorie');
?>
<!DOCTYPE html>
  <head>
    <title>Panier cadeau </title>
    <meta name="description" content="" />
    <meta name="author" content="templatemo">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
      
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/templatemo_misc.css">
    <link type="text/css" rel="stylesheet" href="../css/easy-responsive-tabs.css" />
    <link href="../css/css.css" rel="stylesheet"> 
      
     <script src="../js/jquery-1.10.2.min.js"></script> 
     <script src="../js/jquery.lightbox.js"></script>
     <script src="../js/templatemo_custom.js"></script>
     <script src="../js/easyResponsiveTabs.js" type="text/javascript"></script> 
    
    <link href="../css/style.css" rel="stylesheet" media="all">  
    <script src="../js/jscript.js"></script>          
<style type="text/css">
         #spinner-1 input {width: 100px}
      </style>
      <!-- Javascript -->
      <script>
         $(function() {
            $( "#spinner-1" ).spinner();
         });
      </script>
     <script>
    function showhide()
    {
        var div = document.getElementById("newpost");
    if (div.style.display !== "none") 
    {
      div.style.display = "none";
    }
    else 
    {
      div.style.display = "block";
    }
    }
  </script>
  <script>
    $(function() {
    $(".carousel").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev",
        auto: 800,
      speed: 1000,
       visible: 7,
    });
  });
  </script>
  <style type="text/css">
  
.col-md-2 {
       padding-right: 15px;
       padding-left: 0px;
    }
 .col-md-3 {
       padding-right: 15px;
       padding-left: 0px;
    }
  .col-md-4 {
       padding-right: 15px;
       padding-left: 0px;
    }
  .col-md-6 {
       padding-right: 15px;
       padding-left: 0px;
    }
 .col-md-5 {
       padding-right: 15px;
       padding-left: 0px;
    }

 </style>
  </head>
  <body>
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
    
    
     </ul></div>
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
    <form class="navbar-form" method="get" action="" >
        <div class="">
          <div class="input-group">
            
            <input type="text" id="id_query" name ="query" class="form-control" style="border-radius:0px 0px 0px 0px;height:30px;background-color:#fff;font-size:80%;width:100%" placeholder="Search gifts ">
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
                    <span class="text-error pull-left" style="font-size:80%"><?php echo compterArticles(); ?> Articles<span></div><div class="col-md-6">
<span class="pull-right" style="font-size:80%"><?php echo number_format(MontantGlobal(),0,'',' ');?>FCFA</span></div>
<div class="col-md-12 divider">

</div>
      <div class="col-md-12" style="border:1px solid #eeeeee;padding:10px 10px 0 10px"> <p><a href="panier/commande.php" class="btn btn-primary" style="border-radius:0px;font-size:90%;width:100px">Panier</a> <a href="panier/paiement.php" class="btn btn-primary pull-right" style="border-radius:0px;;font-size:90%;width:100px">Caisse</a></p></div>
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
    	  
   <div id="menu-container" class="main_menu">
		 <div class="page-header">
			 <i class="label label-warning" style="font-size:14px;background:  #f4a62a;border-radius:0;padding:2px 10px 2px 10px"> Mon compte</i>
		 </div>
    </div>
    <div class="container">
     	 <div class="col-md-3 templatemo_leftgap" style="padding-left:15px">
            <div class="panel panel-primary panel-panier" style="border-radius:0;border-color: #d14233;">
                              <div class="panel-heading" style=" background: #d14233;border-color: #d14233;border-radius:0">
                                <h3 class="panel-title" style="font-size:15px;color:#fff">Infos profil</h3>
                              </div>
                              
                              <?php
                                    if(isset($_GET['msg'])&& $_GET['msg']==1)
                                    {
                                        echo '<div class="alert-warning"><h5>Insertion incorrect</h5></div>';
                                    }
                              ?>
                              <div class="panel-body">
                               <ul>
                                <li><a href="?page=1">Infos profil</a></li>
                                <li><a href="?page=2">Mes commandes</a></li>
                                <!--<li><a href="?page=3">Suivi Livraison</a></li>-->
                               </ul>
                                    
                              </div>
                            </div>
         </div>


        <!--  wang -->       
		
          <div class="col-md-9 col-sm-12" > 
              	
                	<?php 
						if (isset($_GET['page']) && $_GET['page']==1){include('profil.php');}
						elseif(isset($_GET['page']) && $_GET['page']==2){include('mes_commandes.php');}
						//elseif(isset($_GET['page']) && $_GET['page']==3){include('suivi_livraison.php');}
						else{
					?>
                                <div class="panel panel-warning" style="border-radius:0;border-color:#2d2925">
                                  <div class="panel-heading" style=" background: #2d2925;border-color: #2d2925;border-radius:0;color:#fff">
                                    <h3 class="panel-title" style="font-size:16px;text-transform:uppercase">Mon panier</h3>
                                  </div>
                                  <div class="panel-body">
                                    <table class="table table-hover">
                            <thead>
                                <tr class="active">
                                    <th>Image</th>
                                    <th>Articles</th>
                                    <th>Prix </th>
                                    <th>Qte</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (creationPanier())
                                {
                                   $nbArticles=count($_SESSION['panier']['libelleProduit']);
                                   if ($nbArticles <= 0)
                                   {
                                        echo "<tr><td>Votre panier est vide </ td></tr>";
                                   }
                                   else
                                   { 
                                        for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++ )
                                        {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                          <div class="col-xs-6 col-md-3">
                                                                <a href="#" class="thumbnail">
                                                                  <img src="../img/cadeau/thumbnail/<?php echo $_SESSION['panier']['imgProduit'][$i]; ?>" alt="">
                                                                </a>
                                                          </div>
                                                        </div> 
                                                    </td>
                                                    <td style="font-size:10px;text-transform:uppercase"><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></td>
                                                    <td><?php echo $_SESSION['panier']['prixProduit'][$i]; ?> </td>
                                                    <td><div class="input-group number-spinner">
                            <span class="input-group-btn data-dwn">
                                <button class="btn btn-default btn-info" style="" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                            </span>
                            <input type="text" class="form-control text-center" value="<?php echo $_SESSION['panier']['qteProduit'][$i]; ?>" min="0" disabled>
                            <span class="input-group-btn data-up">
                                <button class="btn btn-default btn-info" style="" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                            </span>
                        </div></td>
                                                    <td><input style="border-radius:0px; color:#08374A;background:#DADEE0;border:none;height:35px;text-align:center" type= "text" id="total" value ="<?php echo ($_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i]);?>" disabled></p>
                        <input type ="hidden" value ="<?php echo $_SESSION['panier']['prixProduit'][$i]; ?> " id="prix"></td></td>
                                                    <td class="text-error"><a href="ajout_panier.php" >supp</a></td>
                                                </tr>
                                            <?php 
                                        }
                                   }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                    <th colspan="6" class="text-right ">Total: <?php echo number_format(MontantGlobal(),0,'',' ');?> FCFA</th>
                                </tr>
                                
                                 
                            </tfoot>
                        </table>
                                  </div>
                                </div>
                                <div class="panel panel-success" style="border-radius:0;border-color:#2d2925">
                                  <div class="panel-heading" style=" background: #2d2925;border-color: #2d2925;border-radius:0;color:#fff">
                                    <h3 class="panel-title" style="font-size:16px;text-transform:uppercase">Vos Avantages</h3>
                                  </div>
                                  <div class="panel-body">
                                    <ul>
                                      <li>Livraison la plus rapide</li>
                                        <li>Droit de retractation 14 jours</li>
                                        <li>Protection Acheteurs</li>
                                        <li>Protection des données</li>
                                        <li>Paiement sécurisé par SSL</li>
                                    </ul>
                                  </div>
                                </div>
                    	<?php 
						}
						?>
                        
                      
     <!--  yang -->
     <!-- start Modification de mn adresse de facturation-->

					
<!-- end Modification de mn adresse de facturation-->
          </div>    
   <!--  wang -->
		
		</div>
    <!-- homepage end -->

<!-- homepage start -->
  




     <section >















   <div class="container" style="margin-top:4em">
  <div class="row">
<div class="col-sm-12 col-sm-offset-0 ">

      <div class="col-sm-3">
          <div class="row0">
            <div id="infos_footer">
      <a id="footer_logo" href="#" title="Rapid Cadeau">
                <img class="logo" src="images/logo-5.jpg" alt="Panier Cadeau" >
      </a>
      <p style="color: #fff;">Rapid-cadeau.com<br>3 rue Pierre et Marie Curie<br><span style="line-height: 1.5em;">63200 Riom</span></p>
<p style="color: #d14233">Tél : <span style="color: #fff;"> +33 4 43 135 027 </span><br>E-Mail : <a href="mailto:contact@rapid-cadeau.com" style="color: #fff;">contact@rapid-cadeau.com</a></p>
<ul>
<li><a title="Qui Sommes-nous ?" href="http://www.rapid-cadeau.com/content/26-a-propos-de-rapid-cadeau">Qui sommes-nous ?</a></li>
<li><a title="Modes de Paiement" href="http://www.rapid-cadeau.com/content/28-modes-de-paiement-rapid-cadeau">Modes de paiement</a></li>
<li><a title="Foire aux Questions" href="http://www.rapid-cadeau.com/content/27-faq">FAQ</a></li>
<li><a href="http://www.rapid-cadeau.com/plan-du-site">Plan du Site</a></li>
<li><a href="http://www.rapid-cadeau.com/content/6-mentions-legales-rapid-cadeau">Mentions Légales</a></li>
<li><a href="http://www.rapid-cadeau.com/content/9-conditions-generales-de-vente-rapid-cadeau">Conditions Générales de Vente</a></li>
<li><a href="http://www.rapid-cadeau.com/content/29-liens-rapid-cadeau">Liens</a></li>
<li><a href="http://www.rapid-cadeau.com/contactez-nous">Contact</a></li>
</ul>
    </div>                
                                        
                                        
                                    
                                
          </div>
      </div>
        <div class="col-sm-3 text-center" >
          
          <div class="rowo">
            <div class="col-sm-2 block_title-pre" style=""><i class="fa fa-lock" style="color:#fff;font-size:14px"></i></div>
      <div class="block_title col-sm-10"><span>Paiement sécurisé</span></div>
        <div class="block_content"><p>Modes de paiements acceptés :&nbsp;<br><span style="line-height: 1.5em;">-</span><strong style="line-height: 1.5em;">&nbsp;</strong><span style="line-height: 1.5em;"><strong>Carte Bancaire</strong></span><strong style="line-height: 1.5em;">&nbsp;</strong><span style="line-height: 1.5em;">via le serveur sécurisé de la banque CIC (protection 3D Secure)<br></span><span style="line-height: 1.5em;">-&nbsp;</span><span style="line-height: 1.5em;"><strong>Paypal</strong></span><span style="line-height: 1.5em;">&nbsp;via leur interface sécurisée.</span></p><p><em></em></p></div>
          </div>
      </div>
   <div class="col-sm-3 text-center">
          
          <div class="row0">
            <div class="col-sm-2 block_title-pre" style=""><i class="fa fa-car" style="color:#fff;font-size:14px"></i></div>
            <div class="block_title col-sm-10"><i></i><span>Livraison rapide</span></div>
        <div class="block_content"><p><span>Toute commande finalisée avant 
15 heures (et dont le règlement a bien été reçu par nos services avant 
15 heures) est expédiée le jour même (du lundi au vendredi).</span></p><p><em></em></p></div>
          </div>
      </div>
        <div class="col-sm-3 text-center">
          <div class="row0">
            <div class="col-sm-2 block_title-pre" style=""><i class="fa fa-comments" style="color:#fff;font-size:14px"></i></div>
            <div class="block_title col-sm-10"><i></i><span>Ils parlent de nous</span></div>
        <div class="block_content"><a href="http://www.rapid-cadeau.com/content/35-page-presse"><em></em></a></div>
      
          </div>


      </div>
    <div class="col-sm-9 text-center" >
          
          <div class="row0">
    <div class="col-sm-2 block_title-pre" style=""><i class="fa fa-meh-o" style="color:#fff;font-size:14px"></i></div>
            <div class="block_title col-sm-10"><i></i><span>Suivez-nous</span></div>
        <div class="block_content">

        
        </div>
          </div>
      </div>
  </div>
 </div></div>
</section> 
<div class="footer-col-12">
    <div class="copyright text-center">
             
    <span  class="t" style=""><a  href="#">&copy;&nbsp;Copyright 2014 Bantou Telecom </span></a></span>
    
     </div>
        </div><!-- navbar-collapse --> 
         <script src="../js/bootstrap.js"></script> 
         <script src="../js/slideshow.js"></script>      
   <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
				
            }
        });

        $('#ab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
        });
		

		$('#cmt').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
        });
    });
</script>
<script>
$( "#spinner" ).spinner();
</script>
<script>  
 
(function ($, window, delay) {
  // http://jsfiddle.net/AndreasPizsa/NzvKC/
  var theTimer = 0;
  var theElement = null;
    var theLastPosition = {x:0,y:0};
  $('[data-toggle]')
    .closest('li')
    .on('mouseenter', function (inEvent) {
    if (theElement) theElement.removeClass('open');
    window.clearTimeout(theTimer);
    theElement = $(this);

    theTimer = window.setTimeout(function () {
      theElement.addClass('open');
    }, delay);
  })
    .on('mousemove', function (inEvent) {
        if(Math.abs(theLastPosition.x - inEvent.ScreenX) > 4 || 
           Math.abs(theLastPosition.y - inEvent.ScreenY) > 4)
        {
            theLastPosition.x = inEvent.ScreenX;
            theLastPosition.y = inEvent.ScreenY;
            return;
        }
        
    if (theElement.hasClass('open')) return;
    window.clearTimeout(theTimer);
    theTimer = window.setTimeout(function () {
      theElement.addClass('open');
    }, delay);
  })
    .on('mouseleave', function (inEvent) {
    window.clearTimeout(theTimer);
    theElement = $(this);
    theTimer = window.setTimeout(function () {
      theElement.removeClass('open');
    }, delay);
  });
})(jQuery, window, 0); 
</script> 
  </body>
</html>
