<?php
require_once("../include/function.php");

// Add debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug function
function debug_log($message) {
    error_log(date('Y-m-d H:i:s') . " - " . $message . "\n", 3, "gln_debug.log");
}

debug_log("Script started");
debug_log("Session email: " . (isset($_SESSION['email']) ? $_SESSION['email'] : 'not set'));
debug_log("GET parameters: " . print_r($_GET, true));

function generate_gln_certificate($order, $gln_data) {
    global $conn, $base_url;
    
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
        $registration_date = date("d-m-Y");
        $expiry_date = date("d-m-Y", strtotime('+1 year'));

        // Add text to certificate
        // Combine company name with location if provided
        $company_text = $order['company_name'];
        if(!empty($gln_data['location_name'])) {
            $company_text .= " - " . $gln_data['location_name'];
        }
        imagettftext($image, 14, 0, 305, 240, $color, $font1, $company_text);
        imagettftext($image, 13, 0, 525, 319, $color, $font, $order['prefix_num']);
        imagettftext($image, 10, 0, 377, 370, $color, $font, $registration_date);
        imagettftext($image, 10, 0, 688, 370, $color, $font, $expiry_date);
        imagettftext($image, 14, 0, 635, 400, $color, $font, $gln_data['gln_number']);
        
        // Add coordinates if provided
        if(!empty($gln_data['longitude']) && !empty($gln_data['latitude'])) {
            imagettftext($image, 12, 0, 365, 432, $color, $font, $gln_data['longitude']);
            imagettftext($image, 12, 0, 707, 432, $color, $font, $gln_data['latitude']);
        }

        // Create directories if they don't exist
        $cert_dir = "../../certificate/glncertificate";
        if (!file_exists($cert_dir)) {
            mkdir($cert_dir, 0777, true);
        }

        // Generate filenames
        $timestamp = time();
        $image_path = "$cert_dir/gln_{$order['id']}_{$timestamp}.jpg";
        $pdf_path = "$cert_dir/gln_{$order['id']}_{$timestamp}.pdf";

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

        $update_sql = "INSERT INTO gln_certificates (
            order_id,
            gln_number,
            location_name,
            longitude,
            latitude,
            registration_date,
            expiry_date,
            certificate_img,
            certificate_pdf
        ) VALUES (
            '{$order['id']}',
            '".mysqli_real_escape_string($conn, $gln_data['gln_number'])."',
            '".mysqli_real_escape_string($conn, $gln_data['location_name'])."',
            '".mysqli_real_escape_string($conn, $gln_data['longitude'])."',
            '".mysqli_real_escape_string($conn, $gln_data['latitude'])."',
            '".date('Y-m-d')."',
            '".date('Y-m-d', strtotime('+1 year'))."',
            '$image_path_db',
            '$pdf_path_db'
        )";

        if(!mysqli_query($conn, $update_sql)) {
            throw new Exception("Failed to update database with certificate paths");
        }

        return array('success' => true);

    } catch (Exception $e) {
        return array('success' => false, 'message' => $e->getMessage());
    }
}

// Session check
if(!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    debug_log("Redirecting to login - No session email");
    header('location:../login.php');
    exit;
}

// Store the page parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'PROT';
debug_log("Page parameter: " . $page);

if(!isset($_GET['id']) || empty($_GET['id'])) {
    debug_log("Redirecting to common.php - No ID parameter");
    $_SESSION['error'] = "Invalid request";
    header('location: common.php?page=' . $page);
    exit;
}

$order_id = intval($_GET['id']);
debug_log("Order ID: " . $order_id);

// Check if gln_certificates table exists
$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'gln_certificates'");
debug_log("Table check result: " . ($table_check ? "Query successful" : "Query failed: " . mysqli_error($conn)));
debug_log("Number of rows: " . mysqli_num_rows($table_check));

if(mysqli_num_rows($table_check) == 0) {
    debug_log("Table doesn't exist, attempting to create");
    $create_table_sql = file_get_contents('gln_certificates.sql');
    if(!mysqli_query($conn, $create_table_sql)) {
        debug_log("Failed to create table: " . mysqli_error($conn));
        $_SESSION['error'] = "Failed to create certificates table: " . mysqli_error($conn);
        header('location: common.php?page=' . $page);
        exit;
    }
    debug_log("Table created successfully");
}

// Get order details
$order_query = mysqli_query($conn, "SELECT o.*, c.name as company_name, c.address, c.pobox, c.zipcode, c.city, c.country,
                                   p.gtins_name as capacity 
                                   FROM order_tbl o 
                                   JOIN company_tbl c ON o.company_id = c.id
                                   JOIN product_tbl p ON o.product_id = p.id 
                                   WHERE o.id = '$order_id'");

debug_log("Order query result: " . ($order_query ? "Query successful" : "Query failed: " . mysqli_error($conn)));
debug_log("Number of order rows: " . mysqli_num_rows($order_query));

if(!$order_query || mysqli_num_rows($order_query) == 0) {
    debug_log("Redirecting to common.php - Order not found");
    $_SESSION['error'] = "Order not found";
    header('location: common.php?page=' . $page);
    exit;
}

$order = mysqli_fetch_assoc($order_query);
debug_log("Order GLN price: " . (isset($order['gln_price']) ? $order['gln_price'] : 'not set'));

// Check if GLN is part of package
if(empty($order['gln_price'])) {
    debug_log("Redirecting to common.php - GLN not in package");
    $_SESSION['error'] = "GLN is not included in this package";
    header('location: common.php?page=' . $page);
    exit;
}

// Add GLN limit check before form display
$gln_count_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM gln_certificates WHERE order_id = '$order_id'");
$gln_count = mysqli_fetch_assoc($gln_count_query)['count'];
$remaining_gln = intval($order['capacity']) - $gln_count;

if($remaining_gln <= 0) {
    $_SESSION['error'] = "You have reached the maximum GLN generation limit for this package (Capacity: {$order['capacity']})";
    header('location: common.php?page=' . $page);
    exit;
}

debug_log("All checks passed, proceeding to display form");

// Process form submission
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['gln_data'])) {
        $gln_data = $_POST['gln_data'];
        
        // Check if new GLNs would exceed capacity
        if(count($gln_data) > $remaining_gln) {
            $response = array(
                'success' => false,
                'message' => "Cannot generate ".count($gln_data)." GLNs. You only have capacity for ".$remaining_gln." more GLN(s)."
            );
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        $success_count = 0;
        $error_messages = [];

        foreach($gln_data as $gln) {
            try {
                // Validate required fields
                if(empty($gln['gln_number'])) {
                    throw new Exception("GLN number is required");
                }

                // Create GLN certificate
                $result = generate_gln_certificate($order, $gln);
                if($result['success']) {
                    $success_count++;
                } else {
                    $error_messages[] = $result['message'];
                }
            } catch(Exception $e) {
                $error_messages[] = $e->getMessage();
            }
        }

        // Prepare response
        $response = array();
        if($success_count > 0) {
            $response['success'] = true;
            $response['message'] = "$success_count GLN certificate(s) generated successfully";
            $response['certificates'] = array(); // Will store certificate data
            
            // Fetch updated certificates
            $cert_sql = "SELECT * FROM gln_certificates WHERE order_id = '$order_id' ORDER BY created_at DESC";
            $cert_query = mysqli_query($conn, $cert_sql);
            if($cert_query && mysqli_num_rows($cert_query) > 0) {
                while($cert = mysqli_fetch_assoc($cert_query)) {
                    $response['certificates'][] = array(
                        'gln_number' => $cert['gln_number'],
                        'location_name' => $cert['location_name'],
                        'pdf_url' => $base_url.$cert['certificate_pdf'],
                        'img_url' => $base_url.$cert['certificate_img']
                    );
                }
            }
        } else {
            $response['success'] = false;
            $response['message'] = implode("<br>", $error_messages);
        }

        // Always return JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Generate Multiple GLN Certificates</title>
    <?php include("../include/table_css.php"); ?>
    <style>
        .gln-form {
            background: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        .remove-gln {
            color: #dc3545;
            cursor: pointer;
        }
        .add-more-btn {
            margin-bottom: 20px;
        }
        .debug-info {
            background: #f8f9fa;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            font-family: monospace;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <?php 
    // Add debug information if in development
    if(isLocalEnvironment()) {
        echo '<div class="debug-info">';
        echo "Session Info:<br>";
        echo "Session ID: " . session_id() . "<br>";
        echo "Session Email: " . (isset($_SESSION['email']) ? $_SESSION['email'] : 'not set') . "<br>";
        echo "<br>GET Parameters:<br>";
        echo print_r($_GET, true) . "<br>";
        echo "<br>Order Info:<br>";
        echo "Order ID: " . $order_id . "<br>";
        echo "GLN Price: " . (isset($order['gln_price']) ? $order['gln_price'] : 'not set') . "<br>";
        echo '</div>';
    }
    ?>
    <?php include("../include/top_header.php"); ?>
    <div class="screen-overlay"></div>
    <?php include("../include/quick_link.php"); ?>
    <?php include("../include/quick_setting.php"); ?>

    <div class="container-fluid">
        <?php include("../include/menu_navbar.php"); ?>
        <div class="main-container">
            <div class="page-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item"><a href="common.php?page=PROT">Customer Product</a></li>
                    <li class="breadcrumb-item active">Generate Multiple GLN</li>
                </ol>
            </div>

            <div class="content-wrapper">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Generate Multiple GLN Certificates for <?php echo htmlspecialchars($order['company_name']); ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <strong>Note:</strong> Your package capacity is <?php echo $order['capacity']; ?>. You have generated <?php echo $gln_count; ?> GLN(s). 
                                    You can generate <?php echo $remaining_gln; ?> more GLN(s).
                                </div>
                                <form id="gln-form" method="POST">
                                    <div id="gln-container">
                                        <div class="gln-form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>GLN Number *</label>
                                                        <input type="text" class="form-control" name="gln_data[0][gln_number]" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Location Name</label>
                                                        <input type="text" class="form-control" name="gln_data[0][location_name]">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Longitude</label>
                                                        <input type="text" class="form-control" name="gln_data[0][longitude]">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Latitude</label>
                                                        <input type="text" class="form-control" name="gln_data[0][latitude]">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm remove-gln" style="display: none;">Remove</button>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-info" id="add-more">Add Another GLN</button>
                                            <button type="submit" class="btn btn-primary" id="generate-btn">Generate Certificates</button>
                                            <div id="alert-container" class="mt-3"></div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Add table to display generated certificates -->
                                <div class="mt-4">
                                    <h5>Generated GLN Certificates</h5>
                                    <div class="table-responsive">
                                        <table class="table custom-table">
                                            <thead>
                                                <tr>
                                                    <th>GLN Number</th>
                                                    <th>Location Name</th>
                                                    <th>Download</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="certificates-table-body">
                                            <?php
                                            // Fetch generated certificates for this order
                                            $cert_sql = "SELECT * FROM gln_certificates WHERE order_id = '$order_id' ORDER BY created_at DESC";
                                            $cert_query = mysqli_query($conn, $cert_sql);
                                            
                                            if($cert_query && mysqli_num_rows($cert_query) > 0) {
                                                while($cert = mysqli_fetch_assoc($cert_query)) {
                                                    echo "<tr id='gln-row-".$cert['id']."'>";
                                                    echo "<td>".htmlspecialchars($cert['gln_number'])."</td>";
                                                    echo "<td>".htmlspecialchars($cert['location_name'])."</td>";
                                                    echo "<td>";
                                                    echo '<span class="badge badge-success"><a href="'.$base_url.$cert['certificate_pdf'].'" download style="color: white;">Download PDF</a></span> ';
                                                    echo '<span class="badge badge-info"><a href="'.$base_url.$cert['certificate_img'].'" download style="color: white;">Download Image</a></span>';
                                                    echo "</td>";
                                                    echo "<td>";
                                                    echo '<button type="button" class="btn btn-danger btn-sm delete-gln" onclick="deleteGLN('.$cert['id'].')">Delete</button>';
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='4' class='text-center'>No certificates generated yet</td></tr>";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("../include/footer.php"); ?>

    <script>
        $(document).ready(function() {
            var remainingGln = <?php echo $remaining_gln; ?>;
            var glnCount = 1;

            // Function to create new GLN form
            function createGlnForm(index) {
                return `
                    <div class="gln-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>GLN Number *</label>
                                    <input type="text" class="form-control" name="gln_data[${index}][gln_number]" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Location Name</label>
                                    <input type="text" class="form-control" name="gln_data[${index}][location_name]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" class="form-control" name="gln_data[${index}][longitude]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control" name="gln_data[${index}][latitude]">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-gln">Remove</button>
                    </div>
                `;
            }

            // Add more GLN forms
            $('#add-more').click(function() {
                if(glnCount >= remainingGln) {
                    alert("You cannot generate more than " + remainingGln + " GLN(s). This is your package capacity limit.");
                    return;
                }
                glnCount++;
                $('#gln-container').append(createGlnForm(glnCount));
                if($('.gln-form').length > 1) {
                    $('.remove-gln').show();
                }
            });

            // Remove GLN form
            $(document).on('click', '.remove-gln', function() {
                $(this).closest('.gln-form').remove();
                if($('.gln-form').length <= 1) {
                    $('.remove-gln').hide();
                }
            });

            // Handle form submission
            $('#gln-form').on('submit', function(e) {
                e.preventDefault();
                
                // Show loading state
                $('#generate-btn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generating...');
                
                // Clear previous alerts
                $('#alert-container').empty();
                
                $.ajax({
                    url: window.location.href,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if(response.success) {
                            // Show success message
                            $('#alert-container').html('<div class="alert alert-success">' + response.message + '</div>');
                            
                            // Update certificates table
                            if(response.certificates && response.certificates.length > 0) {
                                var tableBody = '';
                                response.certificates.forEach(function(cert) {
                                    tableBody += '<tr>' +
                                        '<td>' + cert.gln_number + '</td>' +
                                        '<td>' + cert.location_name + '</td>' +
                                        '<td>' +
                                        '<span class="badge badge-success"><a href="' + cert.pdf_url + '" download style="color: white;">Download PDF</a></span> ' +
                                        '<span class="badge badge-info"><a href="' + cert.img_url + '" download style="color: white;">Download Image</a></span>' +
                                        '</td></tr>';
                                });
                                $('#certificates-table-body').html(tableBody);
                            }
                            
                            // Reset form
                            $('#gln-form')[0].reset();
                        } else {
                            $('#alert-container').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        $('#alert-container').html('<div class="alert alert-danger">Failed to generate certificates: ' + error + '</div>');
                    },
                    complete: function() {
                        // Reset button state
                        $('#generate-btn').prop('disabled', false).text('Generate Certificates');
                    }
                });
            });

            // Define deleteGLN function in global scope
            window.deleteGLN = function(glnId) {
                if(!confirm('Are you sure you want to delete this GLN certificate?')) {
                    return;
                }

                const $row = $('#gln-row-' + glnId);
                const $button = $row.find('.delete-gln');

                $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');

                $.ajax({
                    url: '<?php echo $admin_url; ?>product/delete_gln.php',
                    method: 'POST',
                    data: { gln_id: glnId },
                    dataType: 'json',
                    success: function(response) {
                        console.log('Delete response:', response);
                        if(response.success) {
                            // Remove the row and show success message
                            $row.fadeOut(400, function() {
                                $(this).remove();
                                if($('#certificates-table-body tr').length === 0) {
                                    $('#certificates-table-body').html('<tr><td colspan="4" class="text-center">No certificates generated yet</td></tr>');
                                }
                            });
                            $('#alert-container').html('<div class="alert alert-success">' + response.message + '</div>');
                            
                            // Update the remaining GLN count
                            remainingGln++;
                            $('.alert-info').html('<strong>Note:</strong> Your package capacity is <?php echo $order['capacity']; ?>. You have generated ' + 
                                (<?php echo $order['capacity']; ?> - remainingGln) + ' GLN(s). You can generate ' + remainingGln + ' more GLN(s).');
                        } else {
                            $('#alert-container').html('<div class="alert alert-danger">' + response.message + '</div>');
                            $button.prop('disabled', false).text('Delete');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        console.error('Response:', xhr.responseText);
                        $('#alert-container').html('<div class="alert alert-danger">Failed to delete GLN certificate: ' + error + '</div>');
                        $button.prop('disabled', false).text('Delete');
                    }
                });
            };
        });
    </script>
</body>
</html> 