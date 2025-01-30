<?php
include("../include/function.php");
if($_SESSION['email']=="") {
    header('location:../login.php');
    exit();
}

if(isset($_POST['bulk_delete']) && !empty($_POST['delete_ids'])) {
    $success = true;
    $deleted = 0;
    
    // Start transaction
    mysqli_begin_transaction($conn);
    
    try {
        foreach($_POST['delete_ids'] as $id) {
            $id = intval($id); // Sanitize the ID
            
            // Delete from company_contacts_tbl first
            $delete_contacts = mysqli_query($conn, "DELETE FROM company_contacts_tbl WHERE company_id='$id'");
            
            if($delete_contacts) {
                // Then delete from company_tbl
                $delete_company = mysqli_query($conn, "DELETE FROM company_tbl WHERE id='$id'");
                
                if($delete_company) {
                    $deleted++;
                } else {
                    throw new Exception("Error deleting company record");
                }
            } else {
                throw new Exception("Error deleting contact records");
            }
        }
        
        // If we get here, all deletions were successful
        mysqli_commit($conn);
        $_SESSION['message'] = "Successfully deleted " . $deleted . " record(s)";
        
    } catch (Exception $e) {
        // An error occurred, rollback changes
        mysqli_rollback($conn);
        $_SESSION['message'] = "Error: " . $e->getMessage();
    }
}

// Redirect back
header("Location: show.php?page=REV");
exit();
?> 