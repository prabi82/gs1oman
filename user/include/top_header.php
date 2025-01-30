<header class="header">
			<div class="logo-wrapper">
				<a href="<?=$user_url ?>index.php" class="logo">
				<?php
					$sql="SELECT * FROM `system_settings` WHERE id=1";
					$query=mysqli_query($conn,$sql);
					$webs=mysqli_fetch_array($query);
					?>
					<img src="<?= $base_url ?><?php echo $webs['logo'];?>" alt=""/>
				</a>
				
			</div>
			<div class="header-items">
				
				<!-- Header actions start -->
					<ul class="header-actions">
					<?php
					$email1=$_SESSION['user_email'];
					$sql="SELECT * FROM `company_tbl` WHERE user_email='$email1'";
					$query=mysqli_query($conn,$sql);
					$row=mysqli_fetch_array($query);
					$name1=$row['user_email'];
					
					?>
					
					<li class="dropdown">
						<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
							
							<span class="avatar">
							<span class="status busy"></span><?=ucfirst($name1[0])?></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
							<div class="header-profile-actions">
								<a href="<?=$user_url?>include/session_destroy.php"><i class="icon-log-out1"></i> Sign Out</a>
							</div>
						</div>
					</li>
					
				</ul>					
				<!-- Header actions end -->
			</div>
		</header>