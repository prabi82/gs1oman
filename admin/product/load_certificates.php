<?php
require_once("../include/function.php");

if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    die("Unauthorized access");
}

$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if($order_id <= 0) {
    echo "<tr><td colspan='3' class='text-center'>Invalid order ID</td></tr>";
    exit;
}

// Fetch generated certificates for this order
$cert_sql = "SELECT * FROM gln_certificates WHERE order_id = '$order_id' ORDER BY created_at DESC";
$cert_query = mysqli_query($conn, $cert_sql);

// Check for query errors
if($cert_query === false) {
    echo "<tr><td colspan='3' class='text-center text-danger'>";
    echo "Error fetching certificates: " . mysqli_error($conn) . "<br>";
    echo "<small class='text-muted'>Query: " . htmlspecialchars($cert_sql) . "</small>";
    echo "</td></tr>";
} else {
    if(mysqli_num_rows($cert_query) > 0) {
        while($cert = mysqli_fetch_assoc($cert_query)) {
            echo "<tr>";
            echo "<td>".htmlspecialchars($cert['gln_number'])."</td>";
            echo "<td>".htmlspecialchars($cert['location_name'])."</td>";
            echo "<td>";
            echo '<span class="badge badge-success"><a href="'.$base_url.$cert['certificate_pdf'].'" download style="color: white;">Download PDF</a></span> ';
            echo '<span class="badge badge-info"><a href="'.$base_url.$cert['certificate_img'].'" download style="color: white;">Download Image</a></span>';
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3' class='text-center'>No certificates generated yet</td></tr>";
    }
} 