<?php
include ("include/function.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit']))
{
$user_email=mysqli_real_escape_string($conn,$_POST['email']);
$sql="SELECT * FROM `company_tbl` WHERE  user_email='".$user_email."'";
$query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$row_user=mysqli_fetch_array($query);

if(mysqli_num_rows($query)>0)
{
$token = md5($user_email).rand(10,9999);
$update = mysqli_query($conn,"UPDATE company_tbl set reset_link_token='" . $token . "'  WHERE user_email='" . $user_email . "'");
$link = "<a href='".$user_url."reset-password.php?key=".$user_email."&&token=".$token."' class=''  target='_blank' style='text-decoration:none;'' >Set New Password</a>";


$email_temp='<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">

  <!-- Sets size and scale of the viewport. -->
  <meta name="viewport" content="width=device-width" initial-scale="1">
  <meta name="x-apple-disable-message-reformatting">
  <title>'.$rows_website['website_name'].'</title>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
  <link rel="stylesheet" href="'.$base_url.'email-temp/em-style.css">
</head>
<body bgcolor="#E8ECF1">

  
  <div style="display: none; max-height: 0px; overflow: hidden;">
   
  </div>

 
  <div style="display: none; max-height: 0px; overflow: hidden;">&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;</div>

  <table bgcolor="#E8ECF1" role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" class="document">
    <tr>
      <td valign="top">

        <!-- Main -->
        <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="500" class="container">
          <tr>
            <td bgcolor="#ffffff">
              <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
                <tr>
                  <td style="padding: 20px;">
                    <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="100%">

                       <tr>
                        <td style="padding-bottom: 15px; font-family: "Source Sans Pro", sans-serif; font-size: 20px; line-height: 30px; color: #1B2733;">
                         <img src="'.$base_url.''.$rows_website['logo'].'" alt="Logo" style="width:100px; height:60px;">
                        </td>
                      </tr>

                      <tr>
                        <td style="padding-bottom: 15px; font-family: "Source Sans Pro", sans-serif; font-size: 26px; line-height: 34px; color: #164da1; font-weight:800;">
                            <span style="color:#000000">We have received your change password request.</span>
                     
                        </td>
                      </tr>

                      <tr>
                        <td style="padding-bottom: 15px; font-family: "Source Sans Pro", sans-serif; font-size: 18px; line-height: 24px; color: #1B2733; font-weight:550; text-decoration: none;">
                       We’ve reserved your space — once your password will be updated by <a href="'.$base_url.'"  target="_blank" style="text-decoration:none;">"'.$rows_website['website_name'].'"</a>. Click on the link & set the new password.

                       

                      

                                     

                                    

                        </td>
                      </tr>
                      <br>
                      <tr>
                        <td align="left">
                          <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="left" class="container">
                            <tr>
                           
                              <td style="border-radius:3px; padding:7px;" bgcolor="#42ba96">
                             
                              '.$link.'
                              </td>
                            </tr>
                          </table>
                        </td>

                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

       
      </td>
    </tr>
  </table>
</body>
</html>';


$mail = new PHPMailer(true);
        
    
     $mail->isSMTP(); 
	    #$mail->SMTPDebug = 2;
	    $mail->Host       = 'host33.theukhost.net';                     
	    $mail->SMTPAuth   = true;                                   
	    $mail->Username   = 'info@gs1oman.com';                    
	    $mail->Password   = '9rsE@+3M[f*&';                             
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
	    $mail->Port       = 465;                                    

	  
	    $mail->setFrom('info@gs1oman.com', 'forgetpassword');
	    $mail->addAddress($user_email);
	    
     
     
     
                 


    $mail->isHTML(true);                                 
    $mail->Subject = 'Barcode:Forget Password';
    $mail->Body    = $email_temp;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if($mail->send()){
$_SESSION['forget']="Check Your Email and Click on the link & set new password";
$forget=$_SESSION['forget'];

}


else {
echo $mail->Errorinfo; 
//echo "<script>alert('Something Wrong.')</script>";

 }






}

else{
$_SESSION['forget1']="Invalid Email Address";
$forget1=$_SESSION['forget1'];
}




}
			

		
?>
<?php
$sq="SELECT * FROM `system_settings` WHERE id = 1";
$q=mysqli_query($conn,$sq);
$r=mysqli_fetch_array($q)
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
		<link rel="shortcut icon" href="<?=$base_url?><?=$r['favicon']?>" />

		<!-- Title -->
		
		<title><?php echo $r['website_name']; ?>-Forgot Password</title>
		
		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />

		<!-- Master CSS -->
		<link rel="stylesheet" href="css/main.css" />

	</head>

	<body class="authentication">

		<!-- Container start -->
		<div class="container">

			<form method="post">
				<div class="row justify-content-md-center">
					<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
						<div class="login-screen">
							<div class="login-box text-center">
							<?php
								$sql="SELECT * FROM `system_settings` WHERE id=1";
								$query=mysqli_query($conn,$sql);
								$adminrow=mysqli_fetch_array($query);
								?>
								
									<img src="../<?php echo $adminrow['logo'];?>" alt="" class="img-fluid"/>
								
								
								<div class="form-group">
	
 <h3 style="text-align:center;font-weight: 700;margin-bottom:25px; margin-top:25px;">Forgot Password</h3>
 
  <?php if(isset($_SESSION['forget1'])){
	echo'<span class="my-2"><h5 class="text-danger">'.$_SESSION['forget1'].'</h5></span>';
                                            }
unset($_SESSION['forget1']); ?>
 
  <?php if(isset($_SESSION['forget'])){
	echo'<span class="my-2"><h5 class="text-success">'.$_SESSION['forget'].'</h5></span>';
                                            }
unset($_SESSION['forget']); ?>
 
 
 
 
<input type="text" class="form-control" placeholder="Email Address" name="email">
								</div>
								
								<div style="text-align:center">

									<input type="submit" name="submit"class="btn btn-primary" value="Submit">
									
								</div>
								
								<div style="text-align:center" class="mt-2">
                                   <a href="<?=$user_url?>"><span class="text-danger h6">Login</span></a>&nbsp; | &nbsp; <a href="<?=$base_url?>" class="text-danger h6"><span>New User</span></a>
									
									
								</div>
							
								<hr>
								
							</div>
						</div>
					</div>
				</div>
			</form>
		

		</div>
		<!-- Container end -->

	</body>

</html>