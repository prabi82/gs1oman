<nav class="navbar navbar-expand-lg custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Harry" aria-controls="Harry" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="Harry">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php if(isset($_GET['page']) && $_GET['page']=="DAS") echo "active-page"; ?>" href="<?= $user_url ?>index.php?page=DAS">
                    <i class="icon-devices_other nav-icon"></i>
                    Dashboard
                </a>
            </li>

            <?php
            $query = mysqli_query($conn, "SELECT * FROM `company_tbl` WHERE user_email='".$_SESSION['user_email']."'") or die(mysqli_error($conn));
            $fetch = mysqli_fetch_array($query);
            ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if(isset($_GET['page']) && $_GET['page']=="REV") echo "active-page"; ?>" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-border_all nav-icon"></i>
                    Company Profile
                </a>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li>
                        <a class="dropdown-item" href="<?= $user_url ?>registration/edit.php?view_id=<?=$fetch['id']?>&&page=REV">User Profile</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php if(isset($_GET['page']) && $_GET['page']=="Pack") echo "active-page"; ?>" href="#" id="productsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-border_all nav-icon"></i>
                    Manage Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                    <li>
                        <a class="dropdown-item" href="<?=$user_url?>package/show.php?page=Pack">Product</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>