<?php 
ob_start();
Session_start();
if(!isset($_SESSION['email'])){header("Location:../index.php?err=2");}
	include('../conn.php');
	$id = $_GET['id'];
	function deleteJoin($id)
	{
		mysql_query("delete from cado_occasion where id_cadeau = '$id'");
		mysql_query("delete from cado_destinataire where id_cadeau = '$id'");
		mysql_query("delete from cado_etiquette where id_cadeau = '$id'");
		
	}	
	
	
	if($_POST)
	{
		deleteJoin($id);
		$nom = addslashes($_POST['nom']);
		$categorie = addslashes($_POST['categorie']);
		$detail = addslashes($_POST['detail']);
		$prix =addslashes( $_POST['prix']);
		$destinataire = $_POST['destinataire'];
		$etiquette =$_POST['etiquette'];
		$occasion = $_POST['occasion'];
		
		$r = mysql_query("update cadeau set nom ='$nom', id_categorie = '$categorie' , detail ='$detail', prix ='$prix' where id = '$id' ");
		//echo ("update cadeau set nom ='$nom', id_categorie = '$categorie' , detail ='$detail', prix ='$prix' where id = '$id' ");
		if($r)
		{
			if(isset($destinataire)&& $destinataire!=""){
				foreach ($destinataire as $dest) {
					mysql_query("insert into cado_destinataire values ('','$dest','$id')");
					//echo ("insert into cado_destinataire values ('','$dest','$id')");
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
			header('location: cadeau_voir.php?id='.$id);
		}
		echo mysql_error();
	}
	
	else 
	{
	
	
	
	$cadeau = mysql_query("select cadeau.nom as nom, cadeau.prix as prix, cadeau.detail as detail, categorie.nom as categorie, categorie.id as id_categorie from cadeau, categorie  where categorie.id = cadeau.id_categorie and cadeau.id='$id'");
	
	$categorie = mysql_query("select * from categorie order by nom");
	$etiquette = mysql_query("select * from cado_etiquette, etiquette where etiquette.id = cado_etiquette.id_etiquette and id_cadeau='$id'");
	$autre_etiquette = mysql_query("select * from  etiquette where  id not in (select etiquette.id from cado_etiquette, etiquette where etiquette.id = cado_etiquette.id_etiquette and id_cadeau='$id')");  
	
	$destinataire = mysql_query("select * from cado_destinataire , destinataire where destinataire.id = cado_destinataire.id_destinataire and id_cadeau='$id'");
	$autre_destinataire = mysql_query("select * from   destinataire where id not in (select destinataire.id from cado_destinataire , destinataire where destinataire.id = cado_destinataire.id_destinataire and id_cadeau='$id') ");
	
	$occasion = mysql_query("select * from cado_occasion, occasion where occasion.id = cado_occasion.id_occasion and id_cadeau='$id'");
	$autre_occasion = mysql_query("select * from occasion where id not in (select occasion.id from cado_occasion, occasion where occasion.id = cado_occasion.id_occasion and id_cadeau='$id') ");
	
	$images = mysql_query("select * from  images where id_cadeau='$id'");
	
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
                        <li  class="active"><a href="cadeau.php"><i class="icon-gift"></i><span class="hidden-tablet"> Gestion cadeau</span></a></li>
                        <li><a href="commandes.php"><i class="icon-tasks"></i><span class="hidden-tablet"> Gestion Etat commande</span></a></li>
                        <li><a href="livraison.php"><i class="icon-truck"></i><span class="hidden-tablet"> Gestion Livraison</span></a></li>
                        <li><a href="user"><i class="icon-user"></i><span class="hidden-tablet"> Gestion des administrateurs</span></a></li>
					
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
                    	
						<?php $row_cadeau = mysql_fetch_array($cadeau,1);?>
						<form class="form-horizontal" action="" method="post">
						  <fieldset>
                          <div class="control-group">
								<label class="control-label" for="nom">Nom du produit</label>
								<div class="controls">
								  <input type="text" name="nom" id="nom" value="<?php echo $row_cadeau['nom'] ?>">
								   
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="categorie">Categorie</label>
								<div class="controls">
								  <select name="categorie" id="categorie" required="required">
                                   <option value="<?php echo $row_cadeau['id_categorie']?>" > <?php echo $row_cadeau['categorie']?></option>
								  <?php while ($row = mysql_fetch_array($categorie,1)) :?>
									
									<option value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
								<?php endwhile ; ?>
								  </select>
								</div>
							  </div>
                                        
							<div class="control-group hidden-phone">
							  <label class="control-label" for="detail">Detail</label>
							  <div class="controls">
								<textarea class="cleditor" name="detail" id="detail" rows="3"><?php echo $row_cadeau['detail']?></textarea>
							  </div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="prix">Prix</label>
								<div class="controls">
								  <div class="input-prepend input-append">
									<span class="add-on">F</span><input name="prix" id="prix" value="<?php echo $row_cadeau['prix']?>" size="16" type="text"><span class="add-on">.00</span>
								  </div>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="selectError1">Destinataire</label>
								<div class="controls">
								  <select name="destinataire[]" id="destinataire" multiple data-rel="chosen">
								 
									<?php while ($row = mysql_fetch_array($destinataire,1)) :?>
										<option selected  value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
									<?php endwhile ; ?>
									
									<?php while ($row = mysql_fetch_array($autre_destinataire,1)) :?>
										<option    value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
									<?php endwhile ; ?>
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="occasion">Occasion</label>
								<div class="controls">
								  <select name="occasion[]" id="occasion" multiple data-rel="chosen">
									 
									<?php while ($row = mysql_fetch_array($occasion,1)) :?>
										<option selected  value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
									<?php endwhile ; ?>
									
									<?php while ($row = mysql_fetch_array($autre_occasion,1)) :?>
										<option    value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
									<?php endwhile ; ?>
								  </select>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="etiquette">Etiquette</label>
								<div class="controls">
								  <select name="etiquette[]"id="etiquette" multiple data-rel="chosen">
									 
									<?php while ($row = mysql_fetch_array($etiquette,1)) :  ?>
										<option selected value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
									<?php endwhile ; ?>
									
								
									 
									<?php while ($row = mysql_fetch_array($autre_etiquette,1)) :?>
										<option value="<?php echo $row['id']?>" > <?php echo $row['nom']?></option>
									<?php endwhile ; ?>
								  </select>
								  
								</div>
							  </div>
							   <div class="control-group">
								   <div class="controls">
								   <h3> Images </h3>
								   <?php while ($row = mysql_fetch_array($images,1)) :?>
									<a href="../../img/cadeau/<?php echo $row['lien']?>">	<img src="../../img/cadeau/thumbnail/<?php echo $row['lien']?>" > 	  </a>
									<a class="btn btn-danger" href="deleteImage.php?name=<?php echo $row['lien']?>&id=<?php echo $row['id']?>">
										<i class="halflings-icon white trash"></i> 
									</a>
									<?php endwhile ; ?>
									<a href="uploader/index.php?id=<?php echo $id ?>" > Ajouter des Images </a>
									</div>	
									
									
								</div>	
									 
							<!--<div class="control-group">
							  <label class="control-label" for="typeahead">Auto complete </label>
							  <div class="controls">
								<input type="text" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
								<p class="help-block">Start typing to activate auto complete!</p>
							  </div>
							</div>
                            <div class="control-group">
							  <label class="control-label" for="date01">Date input</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" value="02/16/12">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="fileInput">File input</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="fileInput" type="file">
							  </div>
							</div>          
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Textarea WYSIWYG</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3"></textarea>
							  </div>
							</div>
                            <div class="form-group">
                            <label class=" control-label">Full name</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="firstName" placeholder="First name" />
                            </div>
                            <div class="controls">
                                <input type="text" class="form-control" name="lastName" placeholder="Last name" />
                            </div>
                        </div>-->
                            
							

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Modifier</button>
							  <button type="reset" class="btn">Annuler</button>
							</div>
						  </fieldset>
						</form> 
                         
						
					</div>
				</div><!--/span-->

			</div><!--/row-->
			
			</div>
            
             
			
       

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
<?php } ?>