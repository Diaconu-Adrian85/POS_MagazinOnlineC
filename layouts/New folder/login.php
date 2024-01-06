<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code user Registration
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$contactno=$_POST['contactno'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"insert into utilizatori(name,email,contactno,password) values('$name','$email','$contactno','$password')");
if($query)
{
	echo "<script>alert('You are successfully register');</script>";
}
else{
echo "<script>alert('Not register something went worng');</script>";
}
}
// Code for User login
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM utilizatori WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="my-cart.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Adresa de email ori parola gresite";
exit();
}
}


?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>MagazinOnline Produse Cosmetice | Autentificare | Inregistrare</title>

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

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">
<script type="text/javascript">
function valid()
{
 if(document.register.password.value!= document.register.confirmpassword.value)
{
alert("ATENTIE, Parolele nu se potrivesc !!");
document.register.confirmpassword.focus();
return false;
}
return true;
}
</script>
    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>



	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

	<!-- ============================================== MENIUL DE SUS ============================================== -->
<?php include('includes/top-header.php');?>
<!-- ============================================== MENIUL DE SUS : END ============================================== -->
<?php include('includes/main-header.php');?>
	<!-- =============================================BARA DE NAVIGARE ============================================== -->
<?php include('includes/menu-bar.php');?>
<!-- ============================================== MENIU NAVIGARE - SFARSIT ============================================== -->

</header>

<!-- ============================================== PARTEA CENTRALA PAGINA - SFARSIT ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index.php">ACASA</a></li>
				<li class='active'>Autentificare</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
	<div class="container">
		<div class="sign-in-page inner-bottom-sm">
			<div class="row">
				<!-- Sign-in -->			
<div class="col-md-6 col-sm-6 sign-in">
	<h4 class="">Inregistreaza-te</h4>
	<p class="">Bineti ati venit in contul dumneavoastra</p>
	<form class="register-form outer-top-xs" method="post">
	<span style="color:red;" >
<?php
echo htmlentities($_SESSION['errmsg']);
?>
<?php
echo htmlentities($_SESSION['errmsg']="");
?>
	</span>
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Adresa de email<span>*</span></label>
		    <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
		</div>
	  	<div class="form-group">
		    <label class="info-title" for="exampleInputPassword1">PAROLA<span>*</span></label>
		 <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" >
		</div>
		<div class="radio outer-xs">
		  	<a href="forgot-password.php" class="forgot-password pull-right">Ai uitat parola?</a>
		</div>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="login">Autentificare</button>
	</form>					
</div>
<!-- Sign-in -->

<!-- create a new account -->

<div class="col-md-6 col-sm-6 create-new-account">
	<h4 class="checkout-subtitle">Crează un cont nou</h4>
	<p class="text title-tag-line">Crează un cont de comandă</p>
	<form class="register-form outer-top-xs" role="form" method="post" name="register" onSubmit="return valid();" oninput="resetCustomValidity();">
		<?php
		// Interogare pentru a obține toate mesajele personalizate din tabelul messages_table
		$query = mysqli_query($con, "SELECT field_name, custom_error_message FROM messages_table");
		$customErrorMessages = array();
		while ($row = mysqli_fetch_assoc($query)) {
			$fieldName = $row['field_name'];
			$customErrorMessage = $row['custom_error_message'];
			$customErrorMessages[$fieldName] = $customErrorMessage;
		}
		?>
		<div class="form-group">
			<label class="info-title" for="fullname">Nume întreg<span>*</span></label>
			<input type="text" class="form-control unicase-form-control text-input" id="fullname" name="fullname" required="required" oninvalid="this.setCustomValidity('<?php echo $customErrorMessages["Nume"]; ?>')">
		</div>

		<div class="form-group">
			<label class="info-title" for="exampleInputEmail2">Adresa de email <span>*</span></label>
			<input type="email" class="form-control unicase-form-control text-input" id="email" name="emailid" required="required" oninvalid="this.setCustomValidity('<?php echo $customErrorMessages["Adresa de email"]; ?>')">
			<span id="user-availability-status1" style="font-size:12px;"></span>
		</div>

		<div class="form-group">
			<label class="info-title" for="contactno">Date de contact <span>*</span></label>
			<input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" required="required" oninvalid="this.setCustomValidity('<?php echo $customErrorMessages["Contact"]; ?>')">
		</div>

		<div class="form-group">
			<label class="info-title" for="password">Parola contului <span>*</span></label>
			<input type="password" class="form-control unicase-form-control text-input" id="password" name="password" required="required" oninvalid="this.setCustomValidity('<?php echo $customErrorMessages["Parola"]; ?>')">
		</div>

		<div class="form-group">
			<label class="info-title" for="confirmpassword">Confirmă parola <span>*</span></label>
			<input type="password" class="form-control unicase-form-control text-input" id="confirmpassword" name="confirmpassword" required oninvalid="this.setCustomValidity('<?php echo $customErrorMessages["Parola2"]; ?>')">
		</div>

	  	<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button" id="submit">Înregistrare nouă</button>
	</form>

<script>
function resetCustomValidity() {
	var fields = document.querySelectorAll('.register-form .form-control');
	fields.forEach(function(field) {
		field.addEventListener('input', function() {
			this.setCustomValidity('');
		});
	});
}
</script>

	
	
	
	<span class="checkout-subtitle outer-top-xs">Intregistreaza-te si vei putea face:  </span>
	<div class="checkbox">
	  	<label class="checkbox">
		  	Direct catre verificare comanda.
		</label>
		<label class="checkbox">
		Urmareste comanda cu usurinta.
		</label>
		<label class="checkbox">
 Pastreaza o evidenta a comenzilor tale.
		</label>
	</div>
</div>	
<!-- create a new account -->			</div><!-- /.row -->
		</div>
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