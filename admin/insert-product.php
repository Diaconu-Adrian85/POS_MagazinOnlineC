<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {//
	if (isset($_POST['submit'])) {
		$category = $_POST['category'];
		$subcat = $_POST['subcategory'];
		$productname = $_POST['productName'];
		$productcompany = $_POST['productCompany'];
		$productprice = $_POST['productprice'];
		$productpricebd = $_POST['productpricebd'];
		$productdescription = $_POST['productDescription'];
		$productscharge = $_POST['productShippingcharge'];
		$productavailability = $_POST['productAvailability'];
		$productimage1 = $_FILES["productimage1"]["name"];
		$productimage2 = $_FILES["productimage2"]["name"];
		$productimage3 = $_FILES["productimage3"]["name"];
		// pentru a găsi următorul, ultimul id dupa ultimul produs creat
		$query = mysqli_query($con, "select max(id) as pid from produse");
		$result = mysqli_fetch_array($query);
		$productid = $result['pid'] + 1;
		$dir = "C:/MagaziOnlineCosmetice/img/ImaginiProduse/$productid";
		if (!is_dir($dir)) {
			mkdir($dir);
		}
	//crează imaginea selectată intr-un fișier nou din interiorul directorului /productimage/ + și crează denumirea acestuia în funcție de id-ul alocal
	//automat din baza de date astfel încât să nu existe duplicați
		move_uploaded_file($_FILES["productimage1"]["tmp_name"], $dir . "/" . $_FILES["productimage1"]["name"]);
		move_uploaded_file($_FILES["productimage2"]["tmp_name"], $dir . "/" . $_FILES["productimage2"]["name"]);
		move_uploaded_file($_FILES["productimage3"]["tmp_name"], $dir . "/" . $_FILES["productimage3"]["name"]);
		$sql = mysqli_query($con, "insert into produse(categorie,subcategorie,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productPriceBeforeDiscount) values('$category','$subcat','$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$productimage1','$productimage2','$productimage3','$productpricebd')");
		$_SESSION['msg'] = "Produs adăugat cu succes !!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administrator| Introduceți produsul</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

   <script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcategory").html(data);
	}
	});
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>	


</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Adaugă produs</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Foarte bine!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Ai făcut o grelșeală!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<div class="control-group">
<label class="control-label" for="basicinput">Categorie</label>
<div class="controls">
<select name="category" class="span8 tip" onChange="getSubcat(this.value);"  required>
<option value="">Selectează Categorie</option> 
<?php $query=mysqli_query($con,"select * from categorie");
while($row=mysqli_fetch_array($query))
{?>

<option value="<?php echo $row['id'];?>"><?php echo $row['categoryName'];?></option>
<?php } ?>
</select>
</div>
</div>

									
<div class="control-group">
<label class="control-label" for="basicinput">SUBCATEGORIE</label>
<div class="controls">
<select   name="subcategory"  id="subcategory" class="span8 tip" required>
</select>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Denumire produs</label>
<div class="controls">
<input type="text"    name="productName"  placeholder="Introduceți Denumire produs" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Brand produs</label>
<div class="controls">
<input type="text"    name="productCompany"  placeholder="Introduceți denumire brand" class="span8 tip" required>
</div>
</div>
<div class="control-group">
<label class="control-label" for="basicinput">preț produs înainte de reducere</label>
<div class="controls">
<input type="text"    name="productpricebd"  placeholder="Introduceți preț produs" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">preț produs după discount</label>
<div class="controls">
<input type="text"    name="productprice"  placeholder="Introduceți preț produs" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">descriere produs</label>
<div class="controls">
<textarea  name="productDescription"  placeholder="Introduceți descriere produs" rows="6" class="span8 tip">
</textarea>  
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Taxe de livrare</label>
<div class="controls">
<input type="text"    name="productShippingcharge"  placeholder="Introduceți Taxe de livrare" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Disponibilitate stoc</label>
<div class="controls">
<select   name="productAvailability"  id="productAvailability" class="span8 tip" required>
<option value="">Select</option>
<option value="In Stock">In Stock</option>
<option value="Out of Stock">Out of Stock</option>
</select>
</div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Product Image1</label>
<div class="controls">
<input type="file" name="productimage1" id="productimage1" value="" class="span8 tip" required>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Product Image2</label>
<div class="controls">
<input type="file" name="productimage2"  class="span8 tip" required>
</div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Product Image3</label>
<div class="controls">
<input type="file" name="productimage3"  class="span8 tip">
</div>
</div>

	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Adaugă</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body> ?>