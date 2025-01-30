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
<a class="nav-link dropdown-toggle <?php if($_GET['page']=="DAS") echo "active-page"; ?>" href="<?= $admin_url ?>index.php?page=DAS" id="">
<i class="icon-devices_other nav-icon"></i>
Dashboard
<li class="nav-item dropdown" style="display:none;">
<a class="nav-link dropdown-toggle <?php if($_GET['page']=="MP") echo "active-page"; ?>" href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-edit1 nav-icon"></i>
Manage Services
</a>
<ul class="dropdown-menu" aria-labelledby="formsDropdown">

<li>
<a class="dropdown-item" href="<?= $admin_url ?>manage_service/manage_service.php?page=MP">Manage Services</a>
</li>
<li style="display:none">
<a class="dropdown-item" href="<?= $admin_url ?>manage_clinic/manage_location.php?page=MP">Manage Location</a>
</li>-->
<li>
<a class="dropdown-item" href="<?= $admin_url ?>manage_product/manage_brand.php?page=MP">Manage Client</a>
</li>
</ul>
</li>




<!-- Manage Product  Start --->
<li class="nav-item dropdown">
<a  class="nav-link dropdown-toggle <?php if($_GET['page']=="PD") echo "active-page"; ?>" 
 id="uiElementsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
<i class="icon-image nav-icon"></i>
Manage Package
</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
<li>
<a class="dropdown-item" href="<?=$admin_url?>package/show.php?page=PD">Product</a>
</li>

</ul>
</li>
<!-- Manage Product  Wrap --->


<li class="nav-item dropdown" style="display:block;">
<a class="nav-link dropdown-toggle <?php if($_GET['page']=="REV") echo "active-page"; ?>"  id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-border_all nav-icon"></i>
Manage Registration
</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
<li>
<a class="dropdown-item" href="<?= $admin_url ?>registration/show.php?page=REV">Manage Registration</a>
</li>

</ul>
</li>


<li class="nav-item dropdown" style="display:block;">
<a class="nav-link dropdown-toggle <?php if($_GET['page']=="PROT") echo "active-page"; ?>"  id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-border_all nav-icon"></i>
Manage User Product
</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
<li style="display:none">
<a class="dropdown-item" href="<?= $admin_url ?>product/show.php?page=PROT">Manage Product</a>
</li>

<li style="display:none">
<a class="dropdown-item" href="<?= $admin_url ?>product/show.php?page=PROT">Manage Product</a>
</li>

<li>
<a class="dropdown-item">Manage Product</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
    <li><a class="dropdown-item" href="<?= $admin_url ?>product/show.php?page=PROT">All Product</a></li>
    <li><a class="dropdown-item" href="<?= $admin_url ?>product/approved.php?page=PROT">Approved Product</a></li>
    
        <li><a class="dropdown-item" href="<?= $admin_url?>product/pending.php?page=PROT">Pending Product</a></li>
    

</ul>
</li>

</ul>
</li>

 

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle <?php if($_GET['page']=="WS") echo "active-page"; ?>" href="#" id="layoutsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-layers2 nav-icon"></i>
Website Settings
</a>
<ul class="dropdown-menu dropdown-menu-left" aria-labelledby="layoutsDropdown">

<li>
<a class="dropdown-item" href="<?= $admin_url ?>website_setting/website_setting_form.php?page=WS">Website Settings</a>
</li>




</ul>
</li>
</ul>
</div>
</nav>