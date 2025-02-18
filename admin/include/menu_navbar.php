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
<a class="nav-link dropdown-toggle <?php echo (isset($_GET['page']) && $_GET['page']=="DAS") ? "active-page" : ""; ?>" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>index.php?page=DAS" id="">
<i class="icon-devices_other nav-icon"></i>
Dashboard
</a>
</li>

<li class="nav-item dropdown" style="display:none;">
<a class="nav-link dropdown-toggle <?php echo (isset($_GET['page']) && $_GET['page']=="MP") ? "active-page" : ""; ?>" href="#" id="formsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-edit1 nav-icon"></i>
Manage Services
</a>
<ul class="dropdown-menu" aria-labelledby="formsDropdown">
<li>
<a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>manage_service/manage_service.php?page=MP">Manage Services</a>
</li>
<li>
<a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>manage_product/manage_brand.php?page=MP">Manage Client</a>
</li>
</ul>
</li>

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle <?php echo (isset($_GET['page']) && $_GET['page']=="PD") ? "active-page" : ""; ?>" 
 id="uiElementsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
<i class="icon-image nav-icon"></i>
Manage Package
</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
<li>
<a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>package/show.php?page=PD">Product</a>
</li>
<li>
<a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>package/promocode.php?page=PD">Promo Code</a>
</li>
</ul>
</li>

<li class="nav-item dropdown" style="display:block;">
<a class="nav-link dropdown-toggle <?php echo (isset($_GET['page']) && $_GET['page']=="REV") ? "active-page" : ""; ?>"  id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-border_all nav-icon"></i>
Manage Registration
</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
<li>
<a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>registration/show.php?page=REV">Manage Registration</a>
<a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>registration/alregistrations.php?page=REV">All Registration</a>
</li>
</ul>
</li>

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle <?php echo (isset($_GET['page']) && $_GET['page']=="PROT") ? "active-page" : ""; ?>"  id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-border_all nav-icon"></i>
Manage User Product
</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
<li>
<a class="dropdown-item">Manage Product</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
    <li><a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>product/common.php?page=PROT">All</a></li>
    <li><a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>product/common.php?stype=1&search=Filter&page=PROT">Approved</a></li>
    <li><a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>product/common.php?stype=0&search=Filter&page=PROT">Pending</a></li>
</ul>
</li>
</ul>
</li>

<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle <?php echo (isset($_GET['page']) && $_GET['page']=="WS") ? "active-page" : ""; ?>" href="#" id="layoutsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-layers2 nav-icon"></i>
Website Settings
</a>
<ul class="dropdown-menu dropdown-menu-left" aria-labelledby="layoutsDropdown">
<li>
<a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>website_setting/website_setting_form.php?page=WS">Website Settings</a>
</li>
</ul>
</li>

<li class="nav-item dropdown" style="display:block;">
<a class="nav-link dropdown-toggle <?php echo (isset($_GET['page']) && $_GET['page']=="finreport") ? "active-page" : ""; ?>"  id="tablesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="icon-border_all nav-icon"></i>
Reports
</a>
<ul class="dropdown-menu" aria-labelledby="tablesDropdown">
<li>
<a class="dropdown-item" href="<?php echo isset($admin_url) ? $admin_url : ''; ?>product/financialreports.php?page=finreport">Financial Reports</a>
</li>
</ul>
</li>
</ul>
</div>
</nav>