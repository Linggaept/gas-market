<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['pimpinan'])) {
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pimpinan Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../admin/assets/images/favicon.png">

    <!-- App css -->
    <link href="../plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../admin/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="../admin/assets/css/style.css" rel="stylesheet" type="text/css" />

    <script src="../admin/assets/js/modernizr.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <?php include "left-sidebar.php"; ?>
        <!-- Left Sidebar End -->
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <!-- Top Bar Start -->
                <?php include "topbar.php"; ?>
                <!-- Top Bar End -->
                <!-- ==================
                PAGE CONTENT START
                ================== -->
                <div class="page-content-wrapper">
                    <div class="container-fluid">
                        <?php include "config.php"; ?></div>
                    <!-- container -->
                </div>
                <!-- Page content Wrapper -->
            </div>
            <!-- content -->
            <footer class="footer">© 2025 Toko Sandal Minimarket</span>
            </footer>
        </div>
        <!-- End Right content here -->
    </div>

    <!-- jQuery  -->
    <script src="../admin/assets/js/jquery.min.js"></script>
    <script src="../admin/assets/js/bootstrap.bundle.min.js"></script>
    <script src="../admin/assets/js/modernizr.min.js"></script>
    <script src="../admin/assets/js/jquery.slimscroll.js"></script>
    <script src="../admin/assets/js/waves.js"></script>
    <script src="../admin/assets/js/jquery.nicescroll.js"></script>
    <script src="../admin/assets/js/jquery.scrollTo.min.js"></script>

    <!-- Peity chart JS -->
    <script src="../plugins/peity-chart/jquery.peity.min.js"></script>
    <!--C3 Chart-->
    <script src="../plugins/d3/d3.min.js"></script>
    <script src="../plugins/c3/c3.min.js"></script>
    <!-- KNOB JS -->
    <script src="../plugins/jquery-knob/excanvas.js"></script>
    <script src="../plugins/jquery-knob/jquery.knob.js"></script>
    <!-- Page specific js -->
    <script src="../admin/assets/pages/dashboard.js"></script>
    <!-- App js -->
    <script src="../admin/assets/js/app.js"></script>
    <!-- Datatable js -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>