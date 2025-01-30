<nav class="navbar navbar-expand-lg custom-navbar">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Harry" aria-controls="Harry" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon">
<i></i>
<i></i>
<i></i>
</span>
</button>
<div class="collapse navbar-collapse" id="Harry_Admin">
<ul class="navbar-nav">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle <?php if($_GET['page']=="DAS") echo "active-page"; ?>" href="<?= $user_url ?>index.php?page=DAS" id="">
<i class="icon-devices_other nav-icon"></i>
Dashboard
<li class="nav-item dropdown" style="display:none;">
<a class="nav-link dropdown-toggle <?php if($_GET['page']=="MP") echo "active-page"; ?>" href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-edit1 nav-icon"></i>
Manage Services
</a>

</li>


<li class="nav-item dropdown" style="display:block;">
<a class="nav-link dropdown-toggle <?php if($_GET['page']=="REV") echo "active-page"; ?>"  id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-border_all nav-icon"></i>
Manage Registration
</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
<li>
<a class="dropdown-item" href="<?= $user_url ?>registration/show.php?page=REV">Manage Registration</a>
</li>

</ul>
</li>

<li class="nav-item dropdown" style="display:block;">
<a class="nav-link dropdown-toggle <?php if($_GET['page']=="Pack") echo "active-page"; ?>"  id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-border_all nav-icon"></i>
Manage  Products
</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
<li>
<a class="dropdown-item" href="<?=$user_url?>package/show.php?page=Pack">Product</a>
</li>

</ul>
</li>

 

</ul>
</div>
</nav>