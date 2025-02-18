<?php
include("../include/function.php");

header('Content-Type: application/json');

if(isset($_POST['bulk_delete']) && isset($_POST['delete_ids'])) {
    $response = array();
    
    try {
        $ids = $_POST['delete_ids'];
        
        if(!is_array($ids) || empty($ids)) {
            throw new Exception('Invalid or empty input');
        }
        
        // Convert ids to integers and sanitize
        $sanitized_ids = array_map(function($id) {
            return intval($id);
        }, $ids);
        
        // Create placeholders for SQL query
        $placeholders = str_repeat('?,', count($sanitized_ids) - 1) . '?';
        
        // Begin transaction
        mysqli_begin_transaction($conn);
        
        // First check if records exist
        $check_sql = "SELECT COUNT(*) as count FROM order_tbl WHERE id IN ($placeholders)";
        $check_stmt = mysqli_prepare($conn, $check_sql);
        
        if(!$check_stmt) {
            throw new Exception('Error preparing check query: ' . mysqli_error($conn));
        }
        
        // Bind parameters for check
        $types = str_repeat('i', count($sanitized_ids));
        mysqli_stmt_bind_param($check_stmt, $types, ...$sanitized_ids);
        mysqli_stmt_execute($check_stmt);
        $result = mysqli_stmt_get_result($check_stmt);
        $row = mysqli_fetch_assoc($result);
        
        if($row['count'] == 0) {
            throw new Exception('No records found to delete');
        }
        
        // Delete records from order_tbl
        $delete_sql = "DELETE FROM order_tbl WHERE id IN ($placeholders)";
        $delete_stmt = mysqli_prepare($conn, $delete_sql);
        
        if(!$delete_stmt) {
            throw new Exception('Error preparing delete query: ' . mysqli_error($conn));
        }
        
        // Bind parameters for delete
        mysqli_stmt_bind_param($delete_stmt, $types, ...$sanitized_ids);
        
        // Execute the delete
        if(!mysqli_stmt_execute($delete_stmt)) {
            throw new Exception('Error executing delete query: ' . mysqli_error($conn));
        }
        
        $affected_rows = mysqli_stmt_affected_rows($delete_stmt);
        
        if($affected_rows > 0) {
            mysqli_commit($conn);
            echo json_encode([
                'success' => true,
                'message' => $affected_rows . ' record(s) deleted successfully'
            ]);
        } else {
            throw new Exception('No records were deleted');
        }
        
    } catch(Exception $e) {
        mysqli_rollback($conn);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    
    exit;
}

echo json_encode([
    'success' => false,
    'message' => 'Invalid request parameters'
]); 