

	<?php
	include('includes/config.php');

	if (isset($_POST['username'])) {
		$username = $_POST['username'];

		// Verificăm dacă numele de utilizator există deja în baza de date
		$checkNameQuery = mysqli_query($con, "SELECT name FROM utilizatori WHERE name = '$username'");
		$countName = mysqli_num_rows($checkNameQuery);

		if ($countName > 0) {
			echo "<span style='color: red;'>Numele de utilizator este deja folosit.</span>";
			echo "<script>$('#submit').prop('disabled',true).addClass('disabled-button');</script>";
		} else {
			echo "<span style='color: green;'>Numele de utilizator este disponibil.</span>";
			echo "<script>$('#submit').prop('disabled',false).removeClass('disabled-button');</script>";
		}
	}
	?>

