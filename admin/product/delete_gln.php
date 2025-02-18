<?php
require_once("../include/function.php");

// Check session
if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

// Check if GLN ID is provided
if(!isset($_POST['gln_id']) || empty($_POST['gln_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'GLN ID is required']);
    exit;
}

$gln_id = intval($_POST['gln_id']);

try {
    // First get the certificate paths to delete files
    $query = "SELECT certificate_pdf, certificate_img FROM gln_certificates WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $gln_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $certificate = mysqli_fetch_assoc($result);

    if($certificate) {
        // Delete physical files
        if(!empty($certificate['certificate_pdf'])) {
            $pdf_path = "../../" . $certificate['certificate_pdf'];
            if(file_exists($pdf_path)) {
                unlink($pdf_path);
            }
        }
        if(!empty($certificate['certificate_img'])) {
            $img_path = "../../" . $certificate['certificate_img'];
            if(file_exists($img_path)) {
                unlink($img_path);
            }
        }

        // Delete database record
        $delete_query = "DELETE FROM gln_certificates WHERE id = ?";
        $stmt = mysqli_prepare($conn, $delete_query);
        mysqli_stmt_bind_param($stmt, "i", $gln_id);
        
        if(mysqli_stmt_execute($stmt)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'GLN certificate deleted successfully']);
        } else {
            throw new Exception("Failed to delete GLN certificate from database");
        }
    } else {
        throw new Exception("GLN certificate not found");
    }
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?> 