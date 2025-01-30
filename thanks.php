

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="shortcut icon" href="http://localhost/rudy/images/Upload/logo/logo-wide1.png">
<!------ Include the above in your HEAD tag ---------->
    <title>Barcode</title>

    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap');
html,body {
    font-family: 'Raleway', sans-serif;  
}
.thankyou-page ._header {
    background: #fff;
    padding: 27px 30px;
    text-align: center;
    background: #fff url(https://codexcourier.com/images/main_page.jpg) center/cover no-repeat;
}
.thankyou-page ._header .logo {
    max-width: 200px;
    margin: 0 auto 50px;
}

#timer{
 color: #ddd2d2;   
}
.thankyou-page ._header .logo img {
    width: 100%;
}
.thankyou-page ._header h1 {
    font-size: 65px;
    font-weight: 800;
    color: #000;
    margin: 0;
    margin-bottom: 29px;
    margin-top: -30px;
}
.thankyou-page ._body {
    margin: -50px 0 30px;
}
.thankyou-page ._body ._box {
    margin: auto;
    max-width: 80%;
    padding: 50px;
    text-align: center;
    background: #002c6c;
    border-radius: 3px;
    box-shadow: 0 0 35px rgba(10, 10, 10,0.12);
    -moz-box-shadow: 0 0 35px rgba(10, 10, 10,0.12);
    -webkit-box-shadow: 0 0 35px rgba(10, 10, 10,0.12);
}
.thankyou-page ._body ._box h2 {
    font-size: 32px;
    font-weight: 600;
    color: #fff;
}
.thankyou-page ._footer {
    text-align: center;
    padding: 10px 30px;
}

.thankyou-page ._footer .btn {
    background: #002c6c;
    color: white;
    border: 0;
    font-size: 14px;
    font-weight: 600;
    border-radius: 0;
    letter-spacing: 0.8px;
    padding: 20px 33px;
    text-transform: uppercase;
}
    </style>
</head>
<body>

<div class="thankyou-page">
    <div class="_header">
        <div class="logo">
            <img src="images/logo.png" alt="">
        </div>
        <h1>Thank You!</h1>
    </div>
    <div class="_body">
        <div class="_box">
            <h2>
               Your submission has been received.
            </h2>
            <p>
                <span id="timer">This page will redirect in 10 seconds.</span>

            </p>
            <div>
<span id="timer"></span></div>
        </div>
    </div>
    <div class="_footer">
        <p>Having trouble? <a href="index.php">Contact us</a> </p>
        <a class="btn" href="index.php">Back to homepage</a>
    </div>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    var count = 10;
    var timer = document.getElementById("timer");
    
    function countDown() {
        if (count > 0) {
            timer.innerHTML = "This page will redirect in " + count + " seconds.";
            count--;
            setTimeout(countDown, 1000);
        } else {
            window.location.href = "index.php";
        }
    }
    
    countDown();
});
</script>







</body></html>