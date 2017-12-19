<?php 
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
	include('../conn.php');
	if($_POST)	{
		
		$nom = addslashes($_POST['nom']);
		$categorie = addslashes($_POST['categorie']);
		$detail = addslashes($_POST['detail']);
		$prix = addslashes($_POST['prix']);
		$destinataire = $_POST['destinataire'];
		$etiquette =$_POST['etiquette'];
		$occasion =$_POST['occasion'];
		
		$r = mysql_query("insert into cadeau (id,id_categorie,nom,detail,prix) values ('','$categorie','$nom','$detail','$prix')");
		if($r)
		{
			$id =  mysql_insert_id();
			if(isset($destinataire)&& $destinataire!=""){
				foreach ($destinataire as $dest) {
					mysql_query("insert into cado_destinataire values ('','$dest','$id')");
					echo mysql_error();
				}
			}
			
			if(isset($etiquette)&& $etiquette!=""){
				foreach ($etiquette as $eti) {
					mysql_query("insert into cado_etiquette values ('','$eti','$id')");
					echo mysql_error();
				}
			}
			
			if(isset($etiquette)&& $etiquette!=""){
				foreach ($occasion as $occas) {
					mysql_query("insert into cado_occasion values ('','$occas','$id')");
					echo mysql_error();
				}
			}
			
			header('location: uploader/index.php?id='.$id);
		}
		echo mysql_error();
		 
	}
	else
	{
		$destinataire = mysql_query("select * from destinataire order by nom");
		$categorie = mysql_query("select * from categorie order by nom");
		$etiquette = mysql_query("select * from etiquette order by nom");
		$occasion = mysql_query("select * from occasion order by nom");
		$cadeaux = mysql_query("select * from cadeau order by nom");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Pannier Cadeaux: Gestion des utilisateurs</title>
	<meta name="description" content="ERP panier cadeau">
	<meta name="author" content="Bantou telecom">
	<meta name="keyword" content="cadeaux">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="../css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="../css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
  <!-- <link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>
    
    <!--<link rel="stylesheet"  href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../style/panier_style.css"/>-->
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
	
	<style type="text/css">
		#form-group .btn-group .form-control-feedback {
			top: 0;
			right: -30px;
		}
		#productForm .inputGroupContainer .form-control-feedback,
		#productForm .selectContainer .form-control-feedback {
			top: 0;
			right: -15px;
		}
		#profileForm .form-control-feedback {
			top: 35px;
			right: 0px;
		}
	</style>	
		
		
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
								<li><a href="user_voir.php?id=<?php echo $_SESSION['id'];?>"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="../deconnexion.php"><i class="halflings-icon off"></i> Deconnexion</a></li>
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
						<li><a href="../erp.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
                        <li><a href="categories.php"><i class="icon-sitemap"></i><span class="hidden-tablet"> Gestion Categorie</span></a></li>
                        <li><a href="destinataire.php"><i class="icon-user-md"></i><span class="hidden-tablet"> Gestion destinataire</span></a></li>
                        <li><a href="occassion.php"><i class="icon-bullhorn"></i><span class="hidden-tablet"> Gestion Occassion</span></a></li>
                        <li><a href="etiquette.php"><i class="icon-certificate"></i><span class="hidden-tablet"> Gestion Etiquette</span></a></li>	
                        <li class="active"><a href="cadeau.php"><i class="icon-gift"></i><span class="hidden-tablet"> Gestion cadeau</span></a></li>
                        <li><a href="commandes.php"><i class="icon-tasks"></i><span class="hidden-tablet"> Gestion Etat commande</span></a></li>
                        <li><a href="livraison.php"><i class="icon-truck"></i><span class="hidden-tablet"> Gestion Livraison</span></a></li>
                        <li><a href="user.php"><i class="icon-user"></i><span class="hidden-tablet"> Gestion des administrateurs</span></a></li>
					
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
				<li><a href="index.php">Gestion des utlisateurs</a></li>
			</ul>

			
				<div class="row-fluid">
				
				
                    <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Gestion des Categories</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                    	
                    
						<form class="form-horizontal" action="" method="post">
						  <fieldset>
                          <div class="control-group">
								<label class="control-label" for="nom">Nom du produit</label>
								<div class="controls">
								  <input type="text" name="nom" id="nom">
								  
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="categorie">Categorie</label>
								<div class="controls">
								  <select name="categorie" id="categorie" required="required">
                                  <option value='' >....</option>
								  <?php while ($row = mysql_fetch_array($categorie,1)) :?>
									<option value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
								<?php endwhile ; ?>
								  </select>
								</div>
							  </div>
                                        
							<div class="control-group hidden-phone">
							  <label class="control-label" for="detail">Detail</label>
							  <div class="controls">
								<textarea class="cleditor" name="detail" id="detail" rows="3"></textarea>
							  </div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="prix">Prix</label>
								<div class="controls">
								  <div class="input-prepend input-append">
									<span class="add-on">F</span><input name="prix" id="prix" size="16" type="text"><span class="add-on">.00</span>
								  </div>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="selectError1">Destinataire</label>
								<div class="controls">
								  <select name="destinataire[]" id="destinataire" multiple data-rel="chosen">
									<option value='' >....</option>
									<?php while ($row = mysql_fetch_array($destinataire,1)) :?>
										<option value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
									<?php endwhile ; ?>
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="occasion">Occasion</label>
								<div class="controls">
								  <select name="occasion[]" id="occasion" multiple data-rel="chosen">
									<option value='' >....</option>
									<?php while ($row = mysql_fetch_array($occasion,1)) :?>
										<option value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
									<?php endwhile ; ?>
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="etiquette">Etiquette</label>
								<div class="controls">
								  <select name="etiquette[]"id="etiquette" multiple data-rel="chosen">
									<option value='' >....</option>
									<?php while ($row = mysql_fetch_array($etiquette,1)) :?>
										<option value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
									<?php endwhile ; ?>
								  </select>
								</div>
							  </div>
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Ajouter</button>
							  <button type="reset" class="btn">Annuler</button>
							</div>
						  </fieldset>
						</form> 
                         
						
					</div>
				</div><!--/span-->

			</div><!--/row-->
			
			</div>
            
            	<div class="row-fluid">
				
				
                    <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon sitemap"></i><span class="break"></span>liste des cadeaux</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Nom</th>
								  
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?php while ($row = mysql_fetch_array($cadeaux,1)): ?>
							<tr>
								<td> <?php echo $row['nom'] ?> </td>
								
								<td class="center">
									<a class="btn btn-success" href="cadeau_voir.php?id=<?php echo $row['id'] ?>" >
										<i class="halflings-icon white zoom-in"></i>                                            
									</a>
									<a class="btn btn-info" href="cadeau_voir.php?id=<?php echo $row['id'] ?>">
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<a class="btn btn-danger" href="cadeau_delete.php?id=<?php echo $row['id'] ?>">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							<?php endwhile ?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
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

		
<!--<script type="text/javascript" src="../jquery/jquery-1.10.2.min.js"></script>-->
		<script src="../js/jquery-1.9.1.min.js"></script>
	<script src="../js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="../js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="../js/jquery.ui.touch-punch.js"></script>
	
		<script src="../js/modernizr.js"></script>
	
		<script src="../js/bootstrap.min.js"></script>
        <!--<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>-->
	
		<script src="../js/jquery.cookie.js"></script>
	
		<script src='../js/fullcalendar.min.js'></script>
	
		<script src='../js/jquery.dataTables.min.js'></script>

		<script src="../js/excanvas.js"></script>
	<script src="../js/jquery.flot.js"></script>
	<script src="../js/jquery.flot.pie.js"></script>
	<script src="../js/jquery.flot.stack.js"></script>
	<script src="../js/jquery.flot.resize.min.js"></script>
	
		<script src="../js/jquery.chosen.min.js"></script>
	
		<script src="../js/jquery.uniform.min.js"></script>

		
		<script src="../js/jquery.cleditor.min.js"></script>
	
		<script src="../js/jquery.noty.js"></script>
	
		<script src="../js/jquery.elfinder.min.js"></script>
	
		<script src="../js/jquery.raty.min.js"></script>
	
		<script src="../js/jquery.iphone.toggle.js"></script>
	
		<script src="../js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="../js/jquery.gritter.min.js"></script>
	
		<script src="../js/jquery.imagesloaded.js"></script>
	
		<script src="../js/jquery.masonry.min.js"></script>
	
		<script src="../js/jquery.knob.modified.js"></script>
	
		<script src="../js/jquery.sparkline.min.js"></script>
	
		<script src="../js/counter.js"></script>
	
		<script src="../js/retina.js"></script>

		<script src="../js/custom.js"></script>
        
	<!-- end: JavaScript-->
	
</body>
</html>
