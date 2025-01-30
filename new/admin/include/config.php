<?php
session_start();
define('DB_SERVER','localhost');
define('DB_USER','gs1omancom_barcode');
define('DB_PASS' ,'O1nOqadXgZ.K'); 
define('DB_NAME', 'gs1omancom_barcode');
$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
mysqli_set_charset($conn, 'utf8');
 
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


?>