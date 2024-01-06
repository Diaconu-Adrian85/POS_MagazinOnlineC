<?php
define('DB_SERVER','localhost');
define('DB_USER','adrian');
define('DB_PASS' ,'licenta2023');
define('DB_NAME', 'magazinOnline3');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
mysqli_set_charset($con, "utf8");
// Check connection
if (mysqli_connect_errno())
{
 echo "Conectare nereusita la baza de date SQL! " . mysqli_connect_error();
}
?>