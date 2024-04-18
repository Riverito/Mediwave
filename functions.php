<?php
include 'includes/functions.inc.php';
if (isset($_POST["submit"])) {
    LogoutUser();
}
function get_header() {
    include('header.php'); 
}

function get_footer() {
    include('footer.php'); 
}
?>



