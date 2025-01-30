<?php
include "function.php";

session_start();
unset($_SESSION['user_email']);


echo "<script>window.location='".$user_url."'</script>";



?>