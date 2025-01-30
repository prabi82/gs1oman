<?php
if (extension_loaded('gd')) {
    echo "GD is enabled<br>";
    echo "GD Version: " . gd_info()['GD Version'] . "<br>";
    echo "<pre>";
    print_r(gd_info());
    echo "</pre>";
} else {
    echo "GD is NOT enabled";
}
?> 