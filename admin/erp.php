<?php 
ob_start();
session_start();
if(!isset($_SESSION['email'])){header("Location:index.php?err=2");}
include('conn.php');

$query_user = mysql_query("SELECT * FROM membre");
$user = mysql_num_rows($query_user);
$query_cmd = mysql_query("SELECT * FROM commande");
$cmd = mysql_num_rows($query_cmd);
$query_cado = mysql_query("SELECT * FROM cadeau");
$cado = mysql_num_rows($query_cado);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Pannier Cadeaux: ERP</title>
	<meta name="description" content="ERP panier cadeau">
	<meta name="author" content="Bantou telecom">
	<meta name="keyword" content="cadeaux">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>

<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"><span>Administrateur</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> <?php echo $_SESSION['prenom'].' '.$_SESSION['nom']?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Parametre de compte</span>
								</li>
								<li><a href="pages/user_voir.php?id=<?php echo $_SESSION['id'];?>"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="deconnexion.php"><i class="halflings-icon off"></i> Deconnexion</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="erp.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
                        <li><a href="pages/categories.php"><i class="icon-sitemap"></i><span class="hidden-tablet"> Gestion Categorie</span></a></li>
                        <li><a href="pages/destinataire.php"><i class="icon-user-md"></i><span class="hidden-tablet"> Gestion destinataire</span></a></li>
                        <li><a href="pages/occassion.php"><i class="icon-bullhorn"></i><span class="hidden-tablet"> Gestion Occassion</span></a></li>
                        <li><a href="pages/etiquette.php"><i class="icon-certificate"></i><span class="hidden-tablet"> Gestion Etiquette</span></a></li>	
                        <li><a href="pages/cadeau.php"><i class="icon-gift"></i><span class="hidden-tablet"> Gestion cadeau</span></a></li>
                        <li><a href="pages/etat.php"><i class="icon-list"></i><span class="hidden-tablet"> Gestion Etat commande</span></a></li>
                               <li><a class="dropmenu" href="#"><i class="icon-truck"></i><span class="hidden-tablet"> Gestion des livraison</span></a><ul>
								<li><a class="submenu" href="pages/attente_livraison.php"><i class="icon-truck"></i><span class="hidden-tablet"> En Attente de livraison</span></a></li>
								<li><a class="submenu" href="pages/encours_livraison.php"><i class="icon-truck"></i><span class="hidden-tablet"> Livraison en cours</span></a></li>
                                <li><a class="submenu" href="pages/cmd_livree.php"><i class="icon-truck"></i><span class="hidden-tablet"> Livree</span></a></li>
							</ul></li>
                            
                            
                            
                       <!-- <li><a class="dropmenu" href="#"><i class="icon-tasks"></i><span class="hidden-tablet"> Gestion des commandes</span></a><ul>
								<li><a class="submenu" href="submenu.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Toutes commandes</span></a></li>
								<li><a class="submenu" href="submenu2.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> commande payee</span></a></li>
								<li><a class="submenu" href="submenu3.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Commande sauvegarde</span></a></li>
							</ul></li>-->
                        <li><a href="pages/user.php"><i class="icon-user"></i><span class="hidden-tablet"> Gestion des administrateurs</span></a></li>
					
					</ul>
                 
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Dashboard</a></li>
			</ul>

			
			
            <div class="row-fluid">	

				<a class="quick-button metro yellow span4">
					<i class="icon-group"></i>
					<p>Membres</p>
					<span class="badge"><h3><?php echo $user;?></h3></span>
				</a>
				
				<a class="quick-button metro blue span4">
					<i class="icon-shopping-cart"></i>
					<p>Commandes</p>
					<span class="badge"><h3><?php echo $cmd;?></h3></span>
				</a>
				<a class="quick-button metro green span4">
					<i class="icon-barcode"></i>
					<p>Produits</p>
                    <span class="badge"><h3><?php echo $cado;?></h3></span>
				</a>
				
				
				
				<div class="clearfix"></div>
								
			</div>
			
			<!--/row-->
			
       

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->

	<!--<div class="clearfix">sds</div>-->
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2014 <a href="http://www.bantoutelecom.com" alt="Bootstrap_Metro_Dashboard">Bantou telecom</a></span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
