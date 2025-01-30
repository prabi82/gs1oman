


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$rows_website['website_name']; ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  	<link rel="icon" type="icon" href="<?=$rows_website['favicon'];?>">
  	<link rel="stylesheet" type="text/css" href="css/style.css">

  	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  	
  	<style>
  	    .en-ar
        {
            float:right;
            margin-top:-4%;
        }
        
        .en-ar button, .en-ar button:hover
        {
            background:#002c6c;border:#002c6c;;
        }
  	</style>

</head>
<body>

		
	<div class="header">
		<div class="container">
		    
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="logo d-flex justify-content-center">
						<a href="#">
							<img src="<?=$rows_website['logo']; ?>" title="<?=$rows_website['website_name']; ?>" class="GS1 Oman">
						</a>
					</div>
				</div>
			</div>
			
			<div class="row">
			    <div class="en-ar">
		            <div class="col-md-12">
		            <div class="dropdown d-flex justify-content-end">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                        English
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="arabic.php">Arabic</a></li>
                      </ul>
                    </div>
		        </div>
		        </div>
		    </div>    
			
		</div>
	</div>


