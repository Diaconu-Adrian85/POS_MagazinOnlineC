<?php
session_start(); //Această funcție inițiază o sesiune PHP sau reia o sesiune existentă. Este necesară pentru a permite utilizarea variabilelor de sesiune, cum ar fi $_SESSION
error_reporting(0); //Această instrucțiune dezactivează afișarea erorilor și a avertismentelor. Este utilă pentru a asigura că erorile PHP nu sunt afișate în mod explicit pe pagina vizualizată de utilizator.
include('includes/config.php'); //Această linie include fișierul config.php în codul curent. Presupunem că acest fișier conține configurări și conexiunea la baza de date.
if(isset($_GET['action']) && $_GET['action']=="add"){ //Această construcție verifică dacă există o variabilă GET cu numele "action" și valoarea "add". Dacă această condiție este adevărată, se execută blocul de cod care urmează.
	$id=intval($_GET['id']);  //Această funcție PHP converteste valoarea variabilei GET cu numele "id" într-un număr întreg. Este utilizată pentru a se asigura că valoarea este numerică și nu poate fi injectată cu cod rău intenționat.
	if(isset($_SESSION['cart'][$id])){ //Această funcție PHP converteste valoarea variabilei GET cu numele "id" într-un număr întreg. Este utilizată pentru a se asigura că valoarea este numerică și nu poate fi injectată cu cod rău intenționat.
		$_SESSION['cart'][$id]['quantity']++;  //Această condiție verifică dacă există deja un produs cu ID-ul specificat în coșul de cumpărături al sesiunii. Dacă produsul există, se incrementează cantitatea acestuia
	}else{   ///Dacă produsul nu există în coșul de cumpărături al sesiunii, se execută codul din acest bloc.
		$sql_p="SELECT * FROM produse WHERE id={$id}";  //Această interogare SQL selectează informațiile despre produsul cu ID-ul specificat dintr-o tabelă numită "produse".
		$query_p=mysqli_query($con,$sql_p);  // Această funcție execută interogarea SQL pe conexiunea la baza de date specificată în variabila $con. Rezultatul interogării este stocat în variabila $query_p.
		if(mysqli_num_rows($query_p)!=0){  //Această condiție verifică dacă interogarea returnează cel puțin un rând de rezultate. Dacă da, înseamnă că produsul cu ID-ul specificat există în baza de date.
			$row_p=mysqli_fetch_array($query_p); //Această funcție preia un rând de rezultate din interogarea dată și îl stochează în variabila $row_p sub forma unui array asociativ. Aceasta permite accesul la informațiile despre produs, cum ar fi prețul ($row_p['productPrice']).
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']); //Acesta este un pas în care se adaugă produsul în coșul de cumpărături al
			// sesiunii. Se creează o intrare în array-ul $_SESSION['cart'] cu ID-ul produsului ca cheie și un array asociativ care conține informații despre cantitatea (setată la 1) și prețul produsului.
		
		}else{
			$message="ID produs invalid!";
		}
	}
		echo "<script>alert('Produs adaugat in cos')</script>";//Această linie afișează un mesaj de tip alertă în browser-ul utilizatorului, informându-l că produsul a fost adăugat în coșul de cumpărături.
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>"; //Această linie redirecționează utilizatorul către pagina "my-cart.php" 
}// după adăugarea produsului în coșul de cumpărături. Este realizată prin intermediul JavaScript prin setarea document.location la URL-ul dorit


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="Magazin online de produse cosmetice cu o gamă variată de produse de calitate superioară. Livrare rapidă și servicii excelente pentru clienți.">
		<meta name="author" content="Diaconu Adrian">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all"> <!--  roboții motoarelor de căutare au permisiunea de a accesa, indexa și afișa conținutul paginii respective în rezultatele căutării -->

	    <title>MagazinOnlineProduseCosmetice</title>

	    <!-- Bootstrap Core CSS -->
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
		


	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
	
		
		

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

	
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- ICONIȚĂ IMAGINE SITE -->
		<link rel="shortcut icon" href="assets/images/favicon1.png">

	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>

<!-- ============================================== PARTEA CENTRALA PAGINA - SFARSIT ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
	<div class="container">
		<div class="furniture-container homepage-container">
		<div class="row">
		
			<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
				<!-- ================================== MENIUL DE NAVIGARE DIN PARTEA DE SUS ================================== -->
	<?php include('includes/side-menu.php');?>
<!-- ================================== PARTEA DE SUS NAVIGARE ================================== -->
			</div><!-- /.sidemenu-holder -->	
			
			<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
				<!-- ========================================== SECTIUNE EROU ========================================= -->
			
<div id="hero" class="homepage-slider3">
	<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
		<div class="full-width-slider">	
			<div class="item" style="background-image: url(assets/images/sliders/slide1.jpeg);">
				<!-- /.container-fluid -->
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->
		
		<div class="full-width-slider">	
			<div class="item" style="background-image: url(assets/images/sliders/slide3.jpeg);">
				<!-- /.container-fluid -->
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->
	    
	    <div class="full-width-slider">
			<div class="item full-width-slider" style="background-image: url(assets/images/sliders/slide2.jpeg);">
			</div><!-- /.item -->
		</div><!-- /.full-width-slider -->

	</div><!-- /.owl-carousel -->
</div>
			
<!-- ========================================= SECTIUNE EROU : END ========================================= -->	
				<!-- ============================================== INFO BOXES ============================================== -->
<div class="info-boxes wow fadeInUp">
	<div class="info-boxes-inner">
		<div class="row">
			<div class="col-md-6 col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						<div class="col-xs-2">
						     <i class="icon fa fa-dollar"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading green">BANII ÎNAPOI</h4>
						</div>
					</div>	
					<h6 class="text">14 ZILE RETUR GRATUIT.</h6>
				</div>
			</div><!-- .col -->

			<div class="hidden-md col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						<div class="col-xs-2">
							<i class="icon fa fa-truck"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading orange">TRANSPORT GRATUIT</h4>
						</div>
					</div>
					<h6 class="text">LA COMENZILE DE PESTE 600 RON</h6>	
				</div>
			</div><!-- .col -->

			<div class="col-md-6 col-sm-4 col-lg-4">
				<div class="info-box">
					<div class="row">
						<div class="col-xs-2">
							<i class="icon fa fa-gift"></i>
						</div>
						<div class="col-xs-10">
							<h4 class="info-box-heading red">PROMOTIE SPECIALA</h4>
						</div>
					</div>
					<h6 class="text">PRODUSE CU DISCOUNT 30%</h6>	
				</div>
			</div><!-- .col -->
		</div><!-- /.row -->
	</div><!-- /.info-boxes-inner -->
	
</div><!-- /.info-boxes -->
<!-- ============================================== INFORMATII CUTII ============================================== -->		
			</div><!-- /.homebanner-holder -->
			
		</div><!-- /.row -->

		<!-- ============================================== PRODUSE IN CAURSEL ============================================== -->
		<div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
			<div class="more-info-tab clearfix">
			   <h3 class="new-product-title pull-left">PRODUSE PROMOVATE</h3>
				<ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
					<li class="active"><a href="#toate" data-toggle="tab">TOATE PRODUSELE</a></li>
					<li><a href="#cosmetice" data-toggle="tab">COSMETICE</a></li>
					<li><a href="#detergenti" data-toggle="tab">DETERGENȚI</a></li>
				</ul><!-- /.nav-tabs -->
			</div>

			<div class="tab-content outer-top-xs">
				<div class="tab-pane in active" id="all">			
					<div class="product-slider">
						<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
<?php
$ret=mysqli_query($con,"select * from produse");
while ($row=mysqli_fetch_array($ret)) 
{
	# code...

?>
						    	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
			</div><!-- /.image -->			

			                        		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					<?php echo $row['productPrice'] . ".00 RON"; ?>			</span>
										     <span class="price-before-discount"><?php echo htmlentities($row['productPriceBeforeDiscount']);?>.00 RON</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
		<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">ADAUGĂ ÎN COȘ</a></div>
				<?php } else {?>
						<div class="action" style="color:red">STOC ZERO</div>
					<?php } ?>
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	<?php } ?>

			</div><!-- /.home-owl-carousel -->
					</div><!-- /.product-slider -->
				</div>




	<div class="tab-pane" id="cosmetice">
					<div class="product-slider">
						<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
		<?php
$ret=mysqli_query($con,"select * from produse where categorie=4");
while ($row=mysqli_fetch_array($ret)) 
{
	# codul pentru afisarea produselor de categorie 4


?>

						    	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
			</div><!-- /.image -->			

			                        		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					<?php echo $row['productPrice'] . ".00 RON"; ?>
										     <span class="price-before-discount"><?php echo htmlentities($row['productPriceBeforeDiscount']);?>.00 RON</span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
				<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">ADAUGĂ ÎN COȘ</a></div>
				<?php } else {?>
						<div class="action" style="color:red">Stoc ZERO</div>
					<?php } ?>
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	<?php } ?>
	
		
								</div><!-- /.home-owl-carousel -->
					</div><!-- /.product-slider -->
				</div>






		<div class="tab-pane" id="detergenti">
					<div class="product-slider">
						<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
		<?php
$ret=mysqli_query($con,"select * from produse where categorie=5");
while ($row=mysqli_fetch_array($ret)) 
{
?>

						    	
		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
				<img  src="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt=""></a>
			</div>		

			                        		   
		</div>
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					<?php echo htmlentities($row['productPrice']);?>RONx</span>
										     <span class="price-before-discount"><?php echo htmlentities($row['productPriceBeforeDiscount']);?> RONx</span>
									
			</div>
			
		</div>
				<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">ADAUGĂ ÎN COȘ</a></div>
				<?php } else {?>
						<div class="action" style="color:red">Stoc ZERO</div>
					<?php } ?>
			</div>
      
			</div>
		</div>
	<?php } ?>
	
		
								</div>
					</div>
				</div>
			</div>
		</div>
		    

         <!-- ============================================== TABS ============================================== -->
			<div class="sections prod-slider-small outer-top-small">
				<div class="row">
					<div class="col-md-6">
	                   <section class="section">
	                   	<h3 class="section-title">Deodorante</h3>
	                   	<div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="2">
	   
<?php
$ret=mysqli_query($con,"select * from produse where categorie=4 and subcategorie=4");
while ($row=mysqli_fetch_array($ret)) 
{
?>



		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300"></a>
			</div><!-- /.image -->			                        		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					<?php echo htmlentities($row['productPrice']);?>.00 RON</span>
										     <span class="price-before-discount"><?php echo htmlentities($row['productPriceBeforeDiscount']);?> RON</span>
									
			</div>
			
		</div>
				<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">ADAUGĂ ÎN COȘ</a></div>
				<?php } else {?>
						<div class="action" style="color:red">Stoc ZERO</div>
					<?php } ?>
			</div>
			</div>
		</div>
<?php }?>

	
			                   	</div>
	                   </section>
					</div>
					<div class="col-md-6">
						<section class="section">
							<h3 class="section-title">Fixative</h3>
		                   	<div class="owl-carousel homepage-owl-carousel custom-carousel outer-top-xs owl-theme" data-item="2">
	<?php
$ret=mysqli_query($con,"select * from produse where categorie=4 and subcategorie=6");
while ($row=mysqli_fetch_array($ret)) 
{
?>

		<div class="item item-carousel">
			<div class="products">
				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="300" height="300"></a>
			</div><!-- /.image -->			                        		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					<?php echo htmlentities($row['productPrice']);?>.00 RON</span>
										     <span class="price-before-discount"><?php echo htmlentities($row['productPriceBeforeDiscount']);?>.0 RON</span>
									
			</div>
			
		</div>
				<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">ADAUGĂ ÎN COȘ</a></div>
				<?php } else {?>
						<div class="action" style="color:red">Stoc ZERO</div>
					<?php } ?>
			</div>
			</div>
		</div>
<?php }?>

		
	
				                   	</div>
	                   </section>

					</div>
				</div>
			</div>
		<!-- ============================================== TABS : END ============================================== -->

		

	<section class="section featured-product inner-xs wow fadeInUp">
		<h3 class="section-title">Igiena Orala</h3>
		<div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
			<?php
$ret=mysqli_query($con,"select * from produse where categorie=6");
while ($row=mysqli_fetch_array($ret)) 
{

?>
				<div class="item">
					<div class="products">

												<div class="product">
							<div class="product-micro">
								<div class="row product-micro-row">
									<div class="col col-xs-6">
										<div class="product-image">
											<div class="image">
												<a href="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-lightbox="image-1" data-title="<?php echo htmlentities($row['productName']);?>">
													<img data-echo="img/ImaginiProduse/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" width="170" height="174" alt="">
													<div class="zoom-overlay"></div>
												</a>					
											</div><!-- /.image -->

										</div><!-- /.product-image -->
									</div><!-- /.col -->
									<div class="col col-xs-6">
										<div class="product-info">
											<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
											<div class="rating rateit-small"></div>
											<div class="product-price">	
												<span class="price"><?php echo htmlentities($row['productPrice']);?>.0 RON</span>
												<span class="price-before-discount"><?php echo htmlentities($row['productPriceBeforeDiscount']);?>.0 RON</span>

											</div><!-- /.product-price -->
										<?php if($row['productAvailability']=='In Stock'){?>
					<div class="action"><a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="lnk btn btn-primary">ADAUGĂ ÎN COȘ</a></div>
				<?php } else {?>
						<div class="action" style="color:red">Stoc ZERO</div>
					<?php } ?>
										</div>
									</div><!-- /.col -->
								</div><!-- /.product-micro-row -->
							</div><!-- /.product-micro -->
						</div>


											</div>
				</div><?php } ?>
							</div>
		</section>
<?php include('includes/brands-slider.php');?>
</div>
</div>
<?php include('includes/footer.php');?>
	
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->
	
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->

	

</body>
</html>