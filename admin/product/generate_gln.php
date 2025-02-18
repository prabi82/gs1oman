<?php
include("../include/function.php");

if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location:../login.php');
    exit;
}

if(!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Invalid request";
    header('location: common.php');
    exit;
}

$order_id = intval($_GET['id']);

// Get order details
$order_query = mysqli_query($conn, "SELECT o.*, c.name as company_name, c.address, c.pobox, c.zipcode, c.city, c.country 
                                   FROM order_tbl o 
                                   JOIN company_tbl c ON o.company_id = c.id 
                                   WHERE o.id = '$order_id'");

if(!$order_query || mysqli_num_rows($order_query) == 0) {
    $_SESSION['error'] = "Order not found";
    header('location: common.php');
    exit;
}

$order = mysqli_fetch_assoc($order_query);

// Check if GLN is part of package
if(empty($order['gln_price'])) {
    $_SESSION['error'] = "GLN is not included in this package";
    header('location: common.php');
    exit;
}

try {
    // Check if GD library is installed
    if (!extension_loaded('gd')) {
        throw new Exception("PHP GD library is not installed");
    }

    // Required files
    $font = "Lato-Bold.ttf";
    $font1 = "Lato-Regular.ttf";
    $template = "glncertificate.jpg";

    if (!file_exists($font) || !file_exists($font1) || !file_exists($template)) {
        throw new Exception("Required font or template files are missing");
    }

    // Create GLN certificate
    $image = imagecreatefromjpeg($template);
    if (!$image) {
        throw new Exception("Failed to create image from template");
    }

    // Set colors
    $color = imagecolorallocate($image, 242, 98, 52);
    
    // Format dates
    $issue_date = date("d-m-Y", strtotime($order['order_date']));
    $expiry_date = "31-12-2024"; // Or calculate based on your business logic

    // Add text to certificate
    imagettftext($image, 14, 0, 305, 240, $color, $font1, $order['company_name']);
    imagettftext($image, 13, 0, 525, 319, $color, $font, $order['prefix_num']);
    imagettftext($image, 10, 0, 377, 370, $color, $font, $issue_date);
    imagettftext($image, 10, 0, 688, 370, $color, $font, $expiry_date);
    imagettftext($image, 14, 0, 635, 400, $color, $font, $order['gln_number']);
    
    if(!empty($order['longitude']) && !empty($order['latitude'])) {
        imagettftext($image, 12, 0, 365, 432, $color, $font, $order['longitude']);
        imagettftext($image, 12, 0, 707, 432, $color, $font, $order['latitude']);
    }

    // Create directories if they don't exist
    $cert_dir = "../../certificate/glncertificate";
    if (!file_exists($cert_dir)) {
        mkdir($cert_dir, 0777, true);
    }

    // Generate filenames
    $timestamp = time();
    $image_path = "$cert_dir/gln_{$timestamp}.jpg";
    $pdf_path = "$cert_dir/gln_{$timestamp}.pdf";

    // Save image
    if (!imagejpeg($image, $image_path)) {
        throw new Exception("Failed to save GLN certificate image");
    }
    imagedestroy($image);

    // Create PDF
    require('fpdf.php');
    $pdf = new FPDF('L', 'mm', array(150, 220));
    $pdf->AddPage();
    $pdf->Image($image_path, 0, 0, 210, 150);
    $pdf->Output($pdf_path, "F");

    // Update database with new certificate paths
    $image_path_db = substr($image_path, 6);
    $pdf_path_db = substr($pdf_path, 6);

    $update_sql = "UPDATE order_tbl SET 
                   certificate_glnimg = '$image_path_db',
                   certificate_glnpdf = '$pdf_path_db'
                   WHERE id = '$order_id'";

    if(!mysqli_query($conn, $update_sql)) {
        throw new Exception("Failed to update database with certificate paths");
    }

    $_SESSION['message'] = "GLN Certificate generated successfully";
    header('location: common.php');

} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header('location: common.php');
} 