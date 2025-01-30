<?php
   include("../include/function.php");
   if(empty($_SESSION['email']))
   {
   header('location:../login.php');
   }
   
   if(isset($_POST['submit']))
   {
   $website_url=$_POST['website_url'];
   $website_name=$_POST['website_name'];
   $website_email_id=$_POST['website_email_id'];
   $mobile_number=$_POST['mobile_number'];
   
   $img_name=$_FILES['logo']['name'];
   $img_tmp_name=$_FILES['logo']['tmp_name'];
   $img_path2="../../images/Upload/logo/".$img_name;
   $img_path=substr($img_path2,6);
   if(!empty($img_name))
   {
   move_uploaded_file($img_tmp_name,$img_path2);
   $sql="UPDATE `system_settings` SET `logo`='$img_path' WHERE id= 1";
   $query=mysqli_query($conn,$sql);
   }

   $img_name1=$_FILES['favicon']['name'];
   $img_tmp_name1=$_FILES['favicon']['tmp_name'];
   $img_path12="../../images/Upload/logo/".$img_name1;
   $img_path1=substr($img_path12,6);
   if(!empty($img_name1))
   {
   move_uploaded_file($img_tmp_name1,$img_path12);
   $sql="UPDATE `system_settings` SET `favicon`='$img_path1' WHERE id= 1";
   $query=mysqli_query($conn,$sql);
   }

  
   $sql="UPDATE `system_settings` SET `website_url`='$website_url',`website_name`='$website_name',`website_email_id`='$website_email_id',`mobile_number`='$mobile_number' WHERE `id`= 1";
   $query=mysqli_query($conn,$sql)or die(mysqli_error($conn));
   
   if($query)
   {
   $_SESSION['message']="Website Configuration is Updated ";
   $message=$_SESSION['message'];
   }
   }
   ?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Meta -->
      <meta name="description" content="Responsive Bootstrap4">
      <meta name="author" content="">
      <link rel="shortcut icon" href="<?=$base_url?><?=$rows_website['favicon']?>" />
      <!-- Title -->
      <title><?php title(); ?>- Website Setting</title>
      <!-- *************
         ************ Common Css Files *************
         ************ -->
      <!-- Bootstrap css -->
      <?php include("../include/common_style.php"); ?>
   </head>
   <body>
      <!-- *************
         ************ Header section start *************
         ************* -->
      <!-- Header start -->
      <?php include("../include/top_header.php"); ?>
      <!-- Header end -->
      <!-- Screen overlay start -->
      <div class="screen-overlay"></div>
      <!-- Screen overlay end -->
      <!-- Quicklinks box start -->
      <?php  include("../include/quick_link.php"); ?>
      <!-- Quicklinks box end -->
      <!-- Quick settings start -->
      <?php include ("../include/quick_setting.php"); ?>
      <!-- Quick settings end -->
      <!-- *************
         ************ Header section end *************
         ************* -->
      <div class="container-fluid">
         <!-- Navigation start -->
         <?php include("../include/menu_navbar.php"); ?>
         <!-- Navigation end -->
         <!-- *************
            ************ Main container start *************
            ************* -->
         <div class="main-container">
            <!-- Page header start -->
            <div class="page-header">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item">Website Setting</li>
                  <li class="breadcrumb-item active">Website Setting</li>
               </ol>
               <ul class="app-actions">
                  <li>
                     <a href="#" >
                     <?php echo date("d/m/Y"); ?>
                     </a>
                  </li>
               </ul>
            </div>
            <!-- Page header end -->
            <!-- Content wrapper start -->
            <div class="content-wrapper">
               <div class="row justify-content-center gutters">
                  <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
                     <?php
                        $sql="SELECT * FROM `system_settings` WHERE id=1";
                        $query=mysqli_query($conn,$sql);
                        $row=mysqli_fetch_array($query);
                        ?>
                     <form method="post" enctype="multipart/form-data">
                        <div class="card m-0">
                           <div class="card-header">
                              <div class="card-title">Website Configuration</div>
                              <ul class="text-muted custom">
                                 <li><span style="color:red;">*</span> Set Website Configuration As per your requirement </li>
                                 <?php if(isset($_SESSION['message']))
                                    {
                                    message($message);	
                                    }
                                    unset($_SESSION['message']); ?>
                              </ul>
                           </div>
                           <div class="card-body">
                              <div class="row gutters">
                                 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                       <label for="inputName" class="col-form-label">Website Name</label>
                                       <input type="text" class="form-control" id="inputName"  name="website_name" value="<?php echo $row['website_name']; ?>">
                                    </div>
                                    <div class="form-group">
                                       <label for="inputEmail" class="col-form-label">Website Url</label>
                                       <input type="tesx" class="form-control" id="inputEmail"  name="website_url" value="<?php echo $row['website_url']; ?>">
                                    </div>
                                    <div class="form-group">
                                       <label for="inputMobNumber" class="col-form-label">Website Email</label>
                                       <input type="text" class="form-control" id="inputMobNumber"  name="website_email_id" value="<?php echo $row['website_email_id']; ?>">
                                    </div>
                                   
                                   
                                    <div class="form-group">
                                       <label for="inputSubject" class="col-form-label">Mobile Number</label>
                                       <input type="text" class="form-control" id="inputSubject"  name="mobile_number" value="<?php echo $row['mobile_number']; ?>">
                                    </div>

                                    
                                    <div class="form-group">
                                       <label for="inputSubject" class="col-form-label">Website LOGO</label><br><img src="../../<?php echo $row['logo']; ?>" style="width:110px;">
                                       <input type="file" class="form-control" id="inputSubject"  name="logo">
                                    </div>

                                     <div class="form-group">
                                       <label for="inputSubject" class="col-form-label">Website Favicon </label><br><img src="<?=$base_url?><?php echo $row['favicon']; ?>" style="width:50px;">
                                       <input type="file" class="form-control" id="inputSubject"  name="favicon">
                                    </div>

                                   
                                 </div>
                                 
                              </div>
                              <div class="row gutters">
                                 <div class="col-xl-12">
                                    <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Submit">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- Content wrapper end -->
         </div>
         <!-- *************
            ************ Main container end *************
            ************* -->
         <!-- Footer start -->
         <?php include("../include/footer.php"); ?>
         <!-- Footer end -->
      </div>
      <!-- *************
         ************ Required JavaScript Files *************
         ************* -->
      <!-- Required jQuery first, then Bootstrap Bundle JS -->
      <?php include ("../include/main_js.php"); ?>
   </body>
</html>