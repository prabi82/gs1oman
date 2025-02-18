<?php
include("../include/function.php");
if($_SESSION['email']=="") {
    header('location:../login.php');
    exit();
}

if(isset($_POST['bulk_delete']) && !empty($_POST['delete_ids'])) {
    $response = array();
    try {
        $ids = $_POST['delete_ids'];
        
        // Start transaction
        mysqli_begin_transaction($conn);
        
        try {
            // Delete from company_contacts_tbl
            $contacts_query = "DELETE FROM company_contacts_tbl WHERE company_id IN (" . implode(',', array_map('intval', $ids)) . ")";
            mysqli_query($conn, $contacts_query);
            
            // Delete from order_tbl
            $orders_query = "DELETE FROM order_tbl WHERE company_id IN (" . implode(',', array_map('intval', $ids)) . ")";
            mysqli_query($conn, $orders_query);
            
            // Finally delete from company_tbl
            $company_query = "DELETE FROM company_tbl WHERE id IN (" . implode(',', array_map('intval', $ids)) . ")";
            mysqli_query($conn, $company_query);
            
            // Commit transaction
            mysqli_commit($conn);
            
            $response['success'] = true;
            $response['message'] = 'Records deleted successfully';
            
        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($conn);
            throw $e;
        }
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = 'Error deleting records: ' . $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
} else {
    $_SESSION['message'] = "No records selected for deletion";
    header("Location: show.php?page=REV");
    exit();
}
?> 