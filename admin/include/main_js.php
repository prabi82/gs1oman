<!-- jQuery -->
<script src="<?= $admin_url ?>js/jquery.min.js"></script>

<!-- Bootstrap Bundle (includes Popper) -->
<script src="<?= $admin_url ?>js/bootstrap.bundle.min.js"></script>

<!-- Moment.js - Required for daterangepicker -->
<script src="<?= $admin_url ?>js/moment.js"></script>

<!-- Vendor JS Files -->
<!-- Daterange -->
<link rel="stylesheet" href="<?= $admin_url ?>vendor/daterange/daterange.css">
<script src="<?= $admin_url ?>vendor/daterange/daterange.js"></script>
<script>
// Initialize daterangepicker after DOM is ready
$(document).ready(function() {
    // Basic initialization for all daterange inputs
    $('.daterange').each(function() {
        $(this).daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoApply: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });

    // Special initialization for reportrange
    var start = moment().subtract(29, 'days');
    var end = moment();
    
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        opens: 'left',
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    
    cb(start, end);
});
</script>

<!-- Slimscroll JS -->
<script src="<?= $admin_url ?>vendor/slimscroll/slimscroll.min.js"></script>
<script>
// Initialize slimScroll after DOM is ready
$(document).ready(function() {
    if($.fn.slimScroll) {
        // Initialize your scrollbars here
        $('.customScroll').slimScroll({
            height: "180px",
            color: '#e5e8f2',
            alwaysVisible: false,
            size: "4px",
            distance: '1px',
            railVisible: false,
            railColor: "#0066bf"
        });
    }
});
</script>
<script src="<?= $admin_url ?>vendor/slimscroll/custom-scrollbar.js"></script>

<!-- Chartist JS -->
<script src="<?= $admin_url ?>vendor/chartist/js/chartist.min.js"></script>
<script src="<?= $admin_url ?>vendor/chartist/js/chartist-tooltip.js"></script>
<script src="<?= $admin_url ?>vendor/chartist/js/custom/threshold/threshold.js"></script>
<script src="<?= $admin_url ?>vendor/chartist/js/custom/bar/bar-chart-orders.js"></script>

<!-- jVector Maps -->
<script src="<?= $admin_url ?>vendor/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?= $admin_url ?>vendor/jvectormap/world-mill-en.js"></script>
<script src="<?= $admin_url ?>vendor/jvectormap/gdp-data.js"></script>
<script src="<?= $admin_url ?>vendor/jvectormap/custom/world-map-markers2.js"></script>

<!-- Rating JS -->
<script src="<?= $admin_url ?>vendor/rating/raty.js"></script>	
<script src="<?= $admin_url ?>vendor/rating/raty-custom.js"></script>

<!-- Main Js Required -->
<script src="<?= $admin_url ?>js/main.js"></script>

<!-- Ck Editor JS File Include  -->
<?php include "ckeditor_js.php" ; ?>
		