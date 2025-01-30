<?php 
include("admin/include/function.php");

// Function to calculate discount amount
function calculateDiscount($amount, $registration_fee, $annual_fee) {
    $discount_percentage = (($registration_fee / 100) + ($annual_fee / 100)) / 2; // Average discount percentage
    $discounted_amount = $amount * $discount_percentage; // Calculate discount amount
    return $discounted_amount;
} 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $promo_code = $_POST['promo_code'];
    $promo_code = mysqli_real_escape_string($conn, $promo_code);
    $param1 = $_POST['param1'];
    $param2 = $_POST['param2'];

    // Fetch the promo code details including the expiry date
    $sql = "SELECT promoregistration_fee, promoannual_fee, expiry_date FROM promo_codes WHERE BINARY promo_code = '$promo_code'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Check if the promo code has expired
        $current_date = date('Y-m-d');
        if ($current_date > $row['expiry_date']) {
            echo json_encode(['success' => false, 'message' => 'Promo code has expired.']);
			
        } else {
            $reg_perscentage_discount = $row['promoregistration_fee'];
            $annual_perscentage_discount = $row['promoannual_fee'];
            
            // Ensure numeric values and handle empty/invalid inputs
            $param1 = is_numeric($param1) ? floatval($param1) : 0;
            $param2 = is_numeric($param2) ? floatval($param2) : 0;
            
            // Calculate registration fee discount
            $discount1 = $param1 * ($reg_perscentage_discount / 100);
            $after_dis_amt = $param1 - $discount1;
            $after_dis_amt_rounded = number_format($after_dis_amt, 2);
            
            // Calculate annual fee discount
            $discount2 = $param2 * ($annual_perscentage_discount / 100);
            $after_dis_annual_amt = $param2 - $discount2;
            $total_amount_discount = $discount1 + $discount2;
            $after_dis_annual = $param2 - $discount2;
            $after_dis_annual_rounded = number_format($after_dis_annual, 2);
            
            // Calculate final amount with original VAT logic
            $final_amount = $param1 + $param2 - $total_amount_discount;
            $final_amount_rounded = number_format($final_amount, 2);
            $grand = $final_amount + ($final_amount * 0.05);
            $granddiscount5 = $grand - ($grand * 0.05);
            
            // Round off the values to 2 decimal places
            $total_amount_discount_rounded = number_format($total_amount_discount, 2);
            $granddiscount5_rounded = number_format($granddiscount5, 2);
            
            echo json_encode([
                'success' => true,
                'message' => 'Promo code applied! ' . $reg_perscentage_discount . '% Registration and ' . $annual_perscentage_discount . '% Annual',
                'amount' => $final_amount_rounded,
                'discountamount' => $total_amount_discount_rounded,
                'discount1' => number_format($discount1, 2),
                'discount2' => number_format($discount2, 2),
                'reg_perscentage_discount' => $reg_perscentage_discount,
                'annual_perscentage_discount' => $annual_perscentage_discount,
                'after_dis_amt' => $after_dis_amt_rounded,
                'after_dis_annual' => $after_dis_annual_rounded,
                'additional_message' => 'If you add or remove a new product, please reapply the promo code to get the discount.'
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid or expired promo code.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
