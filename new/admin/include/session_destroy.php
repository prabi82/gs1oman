<?php
include "function.php";

session_start();
unset($_SESSION['email']);
unset($_SESSION['roles']);

echo "<script>window.location='".$admin_url."'</script>";



?>