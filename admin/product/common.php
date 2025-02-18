<?php
include("../include/function.php");
if($_SESSION['email']=="")
{
   header('location:../login.php');
}
error_reporting(0);

$_SESSION['filter_status']=$_GET['stype'];
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
  <meta name="author" content="ParkerThemes">
  <link rel="shortcut icon" href="<?=$base_url?><?=$rows_website['favicon']?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  <title><?php title(); ?></title>
  <?php include("../include/table_css.php"); ?>

  <style>
    /* ... your same CSS styles ... */
  </style>
</head>
<body>
<?php include("../include/top_header.php"); ?>
<div class="screen-overlay"></div>
<?php  include("../include/quick_link.php"); ?>
<?php include ("../include/quick_setting.php"); ?>

<div class="container-fluid">
  <?php include("../include/menu_navbar.php"); ?>
  <div class="main-container">
    <div class="page-header">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Customwer Product</a></li>
      </ol>
      <ul class="app-actions">
        <li><a href="#"><?php echo date("d/m/Y"); ?></a></li>
        <li><a href="#">Back</a></li>
      </ul>
    </div>

    <div class="col-md-12" style="height:40px;">
      <?php
        if(isset($_SESSION['message'])) {
          echo "
          <div id='alert' class='col-md-12 alert alert-success alert-dismissible fade show' role='alert' style='background:#51a362;'>
            <p style='color:#e9f1eb; text-align:center; !important;'>".$_SESSION['message']."</p>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
          </div>";
        }
        unset($_SESSION['message']);
      ?>
    </div>

    <div class="content-wrapper">
      <!-- Filter Buttons -->
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
          <form method="GET" enctype="multipart/form-data" action="" name="upload_excel">
            <div class="card m-0">
              <div class="card-body">
                <div class="row gutters">
                  <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="form-group">
                      <a href="common.php?page=PROT" class="btn btn-dark">All</a>
                      <a href="common.php?stype=1&search=Filter&page=PROT" class="btn btn-success">Approved</a>
                      <a href="common.php?stype=0&search=Filter&page=PROT" class="btn btn-warning">Pending</a>
                      <a href="common.php?stype=2&search=Filter&page=PROT" class="btn btn-info">Rejected</a>
                      <a href="common.php?stype=3&search=Filter&page=PROT" class="btn btn-primary">Disable</a>
                      <a href="common.php?stype=Expired&search=Filter&page=PROT" class="btn btn-danger">Expired</a>
                    </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4" style="display: flex; flex-direction: row-reverse;">
                    <div class="form-group">
                      <a href="exportData.php" class="btn btn-success">Download Excel</a>
                      <a href="exportPdf.php" class="btn btn-danger" download>Download Pdf</a>
                    </div>
                  </div>
                </div><!-- row gutters -->
              </div><!-- card-body -->
            </div><!-- card -->
          </form>
        </div>
      </div><!-- end row for filters -->

      <!-- Table Start -->
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="table-container">
            <form method="post" id="delete_form">
              <div class="text-right mb-3">
                <button type="button" id="delete_selected" class="btn btn-danger">
                  <i class="fa fa-trash"></i> Delete Selected
                </button>
              </div>

              <div class="row t-header">
                <div class="col-md-2">
                  <div class="t-header">Manage Product</div>
                </div>
              </div>

              <div class="table-responsive">
                <table id="basicExample" class="table custom-table">
                  <thead>
                  <tr>
                    <th style="width: 30px; text-align: center;">
                      <input type="checkbox" id="select_all" class="select-all-checkbox">
                    </th>
                    <th>Sno</th>
                    <th>Company Name</th>
                    <th>GCP</th>
                    <th>Capacity</th>
                    <th>Date of Purchase</th>
                    <th>Expiry Date</th>
                    <th>Package Details</th>
                    <th>Prefix Number</th>
                    <th>GLN Number</th>
                    <th>Payment Receipt</th>
                    <th>Renew Status</th>
                    <th>Certificate</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  // ----------------------
                  // MAIN SEARCH LOGIC
                  // ----------------------
                  
                  // Default query to show all records
                  $query = "SELECT o.*, c.name as company_name 
                           FROM order_tbl o 
                           LEFT JOIN company_tbl c ON o.company_id = c.id";
                  
                  // Add WHERE clause if filtering is applied
                  if(isset($_GET['search']) && isset($_GET['stype'])) {
                    $stype = $_GET['stype'];
                    
                    if($stype != '' && $stype != 'Expired' && $stype != 'Verified') {
                      $query .= " WHERE o.status = '$stype'";
                    }
                    elseif($stype == 'Verified') {
                      $query .= " WHERE o.renew_status = '1'";
                    }
                    elseif($stype == 'Expired') {
                      $query .= " WHERE o.renew_status = '0'";
                    }
                  }
                  
                  // Add ordering
                  $query .= " ORDER BY o.id DESC";
                  
                  // Execute query
                  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                  
                  // Display records
                  if(mysqli_num_rows($result) > 0) {
                    $n = 1;
                    while($fetch = mysqli_fetch_array($result)) {
                      $query1 = mysqli_query($conn, "SELECT * FROM product_tbl") or die(mysqli_error($conn));
                      $fetch1 = mysqli_fetch_array($query1);

                      $status = $fetch['status'];
                      $renew_status = $fetch['renew_status'];
                      $bid = $fetch['id'];
                      $year = date("Y", strtotime($fetch['order_date']));
                      $month = date("M", strtotime($fetch['order_date']));
                      $date = date("d", strtotime($fetch['order_date']));

                      $user_mail = $fetch['company_name'];

                      // Expiry logic
                      $date1 = $fetch['order_date'];
                      $date2 = $fetch['expiry_date'];
                      $date3 = date('Y-m-d');

                      $purchased_date = strtotime($date1);
                      $exp_date = strtotime($date2);
                      $today_date = strtotime($date3);
                      $diff = $exp_date - $today_date;
                      $num = round($diff / 86400);
                  ?>
                    <tr>
                      <td style="text-align: center;">
                        <input type="checkbox" name="delete_checkbox[]" class="delete_checkbox" value="<?php echo $fetch['id']; ?>">
                      </td>
                      <td><?php echo $n; $n++;?></td>
                      <td><?=$user_mail?></td>
                      <td>
                        <?php 
                          if($fetch['product_id'] == $fetch1['id']){
                            echo $fetch1['product_name'];
                          } else {
                            echo "----";
                          }
                        ?>
                      </td>
                      <td>
                        <?php 
                          if($fetch['product_id'] == $fetch1['id']){
                            echo $fetch1['gtins_name'];
                          } else {
                            echo "----";
                          }
                        ?>
                      </td>
                      <td><?=$date?>/<?=$month?>/<?=$year?></td>
                      <td><?=$fetch['expiry_date']?></td>
                      <td>
                        <?php
                          if(!empty($fetch['gtins_annual_fee'])){
                             echo "GTIN: ".$fetch['gtins_annual_fee']." ";
                          }
                          if(!empty($fetch['gln_price'])){
                             echo "GLN: ".$fetch['gln_price']." ";
                          }
                          if(!empty($fetch['sscc_price'])){
                             echo "SSCC: ".$fetch['sscc_price'];
                          }
                          if(empty($fetch['gtins_annual_fee']) && empty($fetch['gln_price']) && empty($fetch['sscc_price'])){
                             echo 'No Product Selected';
                          }
                        ?>
                      </td>
                      <td><?php echo $fetch['prefix_num'] ? $fetch['prefix_num'] : "----"; ?></td>
                      <td><?php echo $fetch['gln_number'] ? $fetch['gln_number'] : "----"; ?></td>
                      <td>
                        <?php
                          if($fetch['payment_receipt'] != ''){
                            echo '<a href="'.$base_url.$fetch['payment_receipt'].'" target="_blank" class="text-dark">'.$fetch['payment_receipt'].'</a>';
                          } else {
                            echo '---';
                          }
                        ?>
                      </td>

                      <!-- Renew Status -->
                      <td>
                        <?php
                          // if expiry_date >= today
                          if($date2 >= $date3){
                            if($num > 0){
                              // still active
                              if(($renew_status==1) && ($renew_date=='0000-00-00')){
                                echo "<span class='badge badge-success'>Active</span>";
                              } else {
                                echo "<span class='badge badge-success'>Active</span>";
                              }
                            } elseif($num == 0){
                              echo "<span class='badge badge-success'>Active</span>";
                            } elseif($num < 0){
                              // Past expiry
                              if(($renew_status==1) && ($renew_date=='0000-00-00')){
                                echo "<span class='badge badge-success'>Active</span>";
                              }
                            }
                          }
                          elseif(($renew_status==0) && ($renew_date!='0000-00-00')){
                            echo "<span class='badge badge-light'>Expired</span>";
                          }
                          else {
                            // if the diff < 0
                            if($num < 0){
                              echo "<span class='badge badge-danger'>Expired</span>";
                            }
                          }
                        ?>
                      </td>

                      <!-- Certificate -->
                      <td>
                        <?php
                          if($status==1) { // If approved
                            // Show main certificate if available
                            if(!empty($fetch['certificate_pdf'])) {
                              echo '<span class="badge badge-success"><a href="'.$base_url.$fetch['certificate_pdf'].'" download>Download</a></span>';
                            }
                            
                            // Check if GLN is in package details
                            if(!empty($fetch['gln_price']) && $fetch['gln_price'] > 0) {
                              // Show Generate GLN button that links to the GLN generation page
                              echo ' <span class="badge badge-primary"><a href="generate_multiple_gln.php?id='.$fetch['id'].'&page=PROT" style="color:white;">Generate GLN</a></span>';
                            }
                          } else {
                            echo "<span class='text-danger'>Certificate is not available</span>";
                          }
                        ?>
                      </td>

                      <!-- Status -->
                      <td>
                        <?php
                          if($status==0){
                            echo "<span class='badge badge-warning'>Pending</span>";
                          }
                          elseif($status==1){
                            echo "<span class='badge badge-success'>Approved</span>";
                          }
                          elseif($status==2){
                            echo "<span class='badge badge-danger'>Rejected</span>";
                          }
                          elseif($status==3){
                            echo "<span class='badge badge-light'>Disabled</span>";
                          }
                        ?>
                      </td>

                      <!-- Action -->
                      <td>
                        <a href="edit.php?view_id=<?=$fetch['company_id']?>&id=<?=$fetch['id']?>&page=PROT">
                          <i class='fa fa-edit' style='font-size:13px; color:#ea490b;'></i>
                        </a>
                        <a href="view.php?view_id=<?=$fetch['company_id']?>&page=PROT">
                          <i class='fa fa-eye' style='font-size:13px; color:#008dbd;'></i>
                        </a>
                        <a href="show?image_id=<?php echo $bid; ?>&page=REV">
                          <i class='fa fa-trash' style='font-size:13px; color:#ff0000;'></i>
                        </a>
                      </td>
                    </tr>

                    <!-- Renew logic / modal is here -->
                    <tr>
                      <?php
                        if(isset($_POST['renew'])) {
                          // ...
                          // [Renew product code here—unchanged]
                        }
                      ?>
                      <!-- Modal markup here—unchanged -->
                    </tr>
                  <?php
                    } // end while
                  } else {
                    echo '<tr><td colspan="15" class="text-center">No Records Found</td></tr>';
                  }
                  ?>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            </form>
          </div><!-- table-container -->
        </div>
      </div><!-- Row end -->
    </div><!-- content-wrapper end -->
  </div><!-- main-container end -->
  
  <?php
  // Deletion logic
  if(!empty($_GET['image_id']))
  {
    $id=$_GET['image_id'];
    $sql_f="SELECT c.* , o.*, cc.* FROM company_tbl c, order_tbl o, company_contacts_tbl cc 
            WHERE c.id=o.company_id AND c.id=cc.company_id";
    $query_f=mysqli_query($conn,$sql_f);
    while($wo=mysqli_fetch_array($query_f)) {
      // ...
    }
    $s="DELETE c.* , o.*,cc.* FROM company_tbl c,order_tbl o, company_contacts_tbl cc
        WHERE c.id=o.company_id AND c.id=cc.company_id";
    $q=mysqli_query($conn,$s);
    $query=mysqli_query($conn,$s) or die(mysqli_error($conn));
    if($query) {
      echo "<script>window.location='show.php?page=REV'</script>";
      $_SESSION['message']="Record Deleted Successfully";
    }
  }
  ?>

  <?php include("../include/footer.php"); ?>
</div><!-- container-fluid end -->

<!-- JS includes -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script>
// DataTables + Bulk Delete
$(document).ready(function() {
    var table = $('#basicExample').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pagingType: "full_numbers",
        dom: '<"top"fl>rt<"bottom"ip><"clear">',
        language: {
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            search: "Search:",
            paginate: {
                first: "First",
                last: "Last", 
                next: "Next",
                previous: "Previous"
            }
        },
        columnDefs: [
            { targets: 0, orderable: false, searchable: false }
        ],
        order: [[1, 'asc']]
    });

    // Select all
    $('#select_all').on('click', function(e) {
        e.stopPropagation();
        var rows = table.rows({ page: 'current' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });
    // Individual checkboxes
    $('#basicExample tbody').on('change', 'input[type="checkbox"]', function(e) {
        e.stopPropagation();
        if (!this.checked) {
            var el = $('#select_all').get(0);
            if (el && el.checked && ('indeterminate' in el)) {
                el.indeterminate = true;
            }
        }
    });
    // Reset select-all on page change
    table.on('page.dt', function() {
        $('#select_all').prop('checked', false);
    });
    // Bulk delete
    $('#delete_selected').on('click', function(e) {
        e.preventDefault();
        var checkedBoxes = $('.delete_checkbox:checked');
        
        if (checkedBoxes.length === 0) {
            alert('Please select at least one record to delete.');
            return;
        }
        
        if (confirm('Are you sure you want to delete the selected records?')) {
            var selectedIds = [];
            checkedBoxes.each(function() {
                selectedIds.push($(this).val());
            });
            
            $.ajax({
                url: 'bulk_delete.php',
                type: 'POST',
                data: {
                    delete_ids: selectedIds,
                    bulk_delete: true
                },
                success: function(response) {
                    try {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert(result.message);
                            location.reload();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    } catch(e) {
                        console.error('Error parsing response:', e);
                        alert('Error processing the request');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('An error occurred while processing your request');
                }
            });
        }
    });
});
</script>

<!-- Terms Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="min-width:200px; max-width:500px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Terms & Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
      </div>
      <form>
        <div class="modal-body">
          <p>Contrary to popular belief, Lorem Ipsum is not simply random text ...</p>
          <!-- Add your own T&C text here -->
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
