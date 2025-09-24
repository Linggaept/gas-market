<?php
if (isset($_GET['pages'])) {
    if ($_GET['pages'] == "laporan") {
        include 'laporan.php';
    } elseif ($_GET['pages'] == "logout") {
        include 'logout.php';
    }
} else {
    include 'laporan.php';
}
?>