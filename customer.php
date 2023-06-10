<?php
include_once "functions/authentications.php";
include_once "functions/customer-profile.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Customer Profile - MTWBS</title>
    <meta name="description" content="Margos sa Tubig Water Billing System (Web-Base) - MTWBS">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Lato.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/pikaday.min.css">
    <link rel="stylesheet" href="assets/css/Pricing-Free-Paid-badges.css">
    <link rel="stylesheet" href="assets/css/Pricing-Free-Paid-icons.css">
    <link rel="stylesheet" href="assets/css/Profile-with-data-and-skills.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
        <div class="container"><a class="navbar-brand logo" href="#">MTWBS</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="administration.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="functions/user-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page lanidng-page">
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center d-flex flex-column align-items-center"><img class="rounded-circle" src="assets/img/avatar7.png" alt="Admin" width="150">
                                    <div class="mt-3">
                                        <h4><?php echo $_GET['fullname']; ?></h4>
                                        <p class="text-secondary mb-1">Customer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters-sm">
                            <div class="col">
                                <div class="card border-primary mb-4">
                                    <div class="card-body text-center p-4">
                                        <h4 class="fw-bold card-subtitle">BILLS</h4>
                                        <h4 class="display-5 fw-bold card-title"><?php get_total_bill($_GET['id'])?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <?php get_customer_details($_GET['id']);?>
                        </div>
                        <div class="row gutters-sm">
                            <div class="col">
                                <div class="card border-primary mb-4">
                                    <div class="card-body text-center p-4">
                                        <h4 class="fw-bold card-subtitle">Previous</h4>
                                        <h4 class="display-5 fw-bold card-title"><?php get_previous($_GET['id']); ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card border-primary mb-4">
                                    <div class="card-body text-center p-4">
                                        <h4 class="fw-bold card-subtitle">Current</h4>
                                        <h4 class="display-5 fw-bold card-title"><?php get_current($_GET['id']); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header d-flex flex-wrap justify-content-center align-items-center justify-content-sm-between gap-3"><img src="assets/img/image1.png" width="50">
                <h4 class="fw-bold">Transactions</h4>
                <div class="input-group input-group-sm w-auto"><button class="btn btn-primary" type="button" id="print">Print</button></div>
            </div>
            <div class="card-body" id="print-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Consumption</th>
                                <th>Water Bill</th>
                                <th>Previous</th>
                                <th>Current</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include_once 'functions/customer-transaction-list.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="page-footer">
        <div class="container">
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/pikaday.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script>

        function printTable() {
            var data = $("#print-content").html();
            var win = window.open("about:blank");
            win.document.write('<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"><title>MTWBS - Margos sa Tubig Water Billing System (Web-Base)</title><meta name="description" content="Margos sa Tubig Water Billing System (Web-Base) - MTWBS"><link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"><link rel="stylesheet" href="assets/css/Lato.css"><link rel="stylesheet" href="assets/fonts/ionicons.min.css"><link rel="stylesheet" href="assets/css/pikaday.min.css"><link rel="stylesheet" href="assets/css/Pricing-Free-Paid-badges.css"><link rel="stylesheet" href="assets/css/Pricing-Free-Paid-icons.css"><link rel="stylesheet" href="assets/css/Profile-with-data-and-skills.css"></head><body>' +
            data + '</body></html>');
            win.print();
        }
        // Attach the print event to the print button
        $("#print").on("click", printTable);
    </script>
</body>

</html>