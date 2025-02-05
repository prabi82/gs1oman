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
<div class="row fee_table mt-3">
    <div class="col-md-4">
        <label class="fw-bold">Registration Fee</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">OMR</span>
            <input type="text" id="registration_fee" name="registration_fee" class="form-control mb-0" value="'.$product['registration_fee'].'" readonly>
        </div>
        <span class="fw-bold text-danger">Valid till 31st Dec '.date("Y").'</span>
    </div>
    <div class="col-md-4">
        <label class="fw-bold">Annual Subscription Fee</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">OMR</span>
            <input type="hidden" name="annual_subscription_fee" id="annual_subscription_fee" value="0">
            <input type="text" class="form-control mb-0" name="annual_total_price" id="annual_total_price" value="0" readonly>
        </div>
        <span class="fw-bold text-danger">Next renewal Jan '.date('Y', strtotime('+1 year')).'</span>
    </div>
    <div class="col-md-4">
        <label class="fw-bold">Total Fee</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">OMR</span>
            <input name="total_price" id="total_price" type="text" class="form-control mb-0" value="'.$product['registration_fee'].'" readonly>
        </div>
    </div>
</div>';

// Send the response
echo $html; 