<?php
include("include/config.php");

// Initialize variables
$email = '';
$password1 = '';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $password1 = $_POST['password'];
    $captcha = $_POST['g-recaptcha-response'];

    // Temporarily allow local development without captcha
    $captcha = true;

    if ($captcha) {
        $sql = "SELECT * FROM `admin_tbl` WHERE email_id='$email' AND password='$password'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $row_admin = mysqli_fetch_array($query);

        if (mysqli_num_rows($query) > 0) {
            $_SESSION['email'] = $row_admin['email_id'];
            $_SESSION['roles'] = $row_admin['roles'];
            echo "<script> window.location='index.php';</script>";
        } else {
            $_SESSION['error'] = "Check User Email and Password";
        }
    } else {
        $_SESSION['error2'] = "Please Fill The Captcha.";
    }
}
?>

<!doctype html>
<html lang="en">
<?php
$sql = "SELECT * FROM `system_settings`";
$query = mysqli_query($conn, $sql);
$adminrow = mysqli_fetch_array($query);
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap4">
    <meta name="author" content="">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <!-- Title -->
    <title><?php echo $adminrow['website_name']; ?> - Login</title>
    
    <link rel="icon" type="image/x-icon" href="../<?=$adminrow['favicon']?>">
    
    <!-- ************* Common CSS Files ************* -->
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
                            <img src="../<?php echo $adminrow['logo']; ?>" alt="" class="img-fluid" />
                            <div class="form-group"></div>

                            <div class="form-group">
                                <h3 style="text-align:center; font-weight: 700; margin-bottom:25px; margin-top:25px;">Admin Login</h3>
                                
                                <?php
                                if (isset($_SESSION['error'])) {
                                    echo '<span class="my-2"><h5 class="text-danger">'.$_SESSION['error'].'</h5></span>';
                                }
                                unset($_SESSION['error']);
                                ?>
                                
                                <?php
                                if (isset($_SESSION['error2'])) {
                                    echo '<span class="my-2"><h5 class="text-danger">'.$_SESSION['error2'].'</h5></span>';
                                }
                                unset($_SESSION['error2']);
                                ?>
                                
                                <input type="text" class="form-control" placeholder="Email Address" name="email" value="<?=$email?>">
                            </div>
                            
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" value="<?=$password1?>">
                            </div>
                            
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LeD_OQhAAAAALV9zeyjeh822UKGL4MTFIw8d4hu"></div>
                            </div>
                            
                            <div style="text-align:center">
                                <input type="submit" name="submit" class="btn btn-primary" value="Login">
                            </div>
                            
                            <div style="text-align:center" class="mt-2">
                                <a href="<?=$adminrow['website_url']?>"><span class="text-danger h6">New User</span></a>&nbsp;|&nbsp;
                                <a href="<?=$admin_url?>forget-password.php" class="text-danger h6"><span>Forgot Password</span></a>
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
