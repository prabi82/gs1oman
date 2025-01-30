<?php
include("admin/include/config.php");

// Set headers
header('Content-Type: text/html; charset=utf-8');

// Get the product ID from POST data
$product_id = isset($_POST['product_id']) ? mysqli_real_escape_string($conn, $_POST['product_id']) : '';

if (empty($product_id)) {
    http_response_code(400);
    exit('Product ID is required');
}

// Get product details from database
$query = "SELECT * FROM product_tbl WHERE id = '$product_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    error_log("Database error: " . mysqli_error($conn));
    http_response_code(500);
    exit('Database error occurred');
}

$product = mysqli_fetch_assoc($result);

if (!$product) {
    http_response_code(404);
    exit('Product not found');
}

// Generate the HTML response
$html = '<div class="row mt-4">
    <div class="col-md-12">
        <h4>Select Your Products/Service</h4>
        <table class="table table-bordered">
            <tr>
                <th>Select</th>
                <th>Product/Service</th>
                <th>Price (OMR)</th>
            </tr>
            <tr>
                <td><input type="checkbox" name="gtin" id="gtins_annual_fee" value="'.$product['gtins_annual_fee'].'" onchange="add()"></td>
                <td>Do you require GTIN?</td>
                <td>'.$product['gtins_annual_fee'].'</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="gln" id="gln_price" value="'.$product['gln_annual_fee'].'" onchange="add()"></td>
                <td>Do you require GLN?</td>
                <td>'.$product['gln_annual_fee'].'</td>
            </tr>';

if ($product['sscc_annual_fee'] > 0) {
    $html .= '<tr>
        <td><input type="checkbox" name="sscc" id="sscc_price" value="'.$product['sscc_annual_fee'].'" onchange="add()"></td>
        <td>Do you require SSCC?</td>
        <td>'.$product['sscc_annual_fee'].'</td>
    </tr>';
}

$html .= '</table>
    </div>
</div>
<input type="hidden" name="product_name" value="'.$product['product_name'].'">
<input type="hidden" id="registration_fee" value="'.$product['registration_fee'].'">
<input type="hidden" id="annual_subscription_fee" value="0">
<input type="hidden" id="total_price" value="'.$product['registration_fee'].'">';

// Send the response
echo $html; 