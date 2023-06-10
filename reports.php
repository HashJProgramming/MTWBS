<?php
include_once "functions/authentications.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Reports - MTWBS</title>
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
        <div class="card shadow">
        <div class="card-header d-flex flex-wrap justify-content-center align-items-center justify-content-sm-between gap-3"><img src="assets/img/image1.png" width="50">
            <h4 class="fw-bold">Transactions</h4>
            <form id="search-report" method="post">
            <div class="input-group input-group-sm w-auto">
                <input class="form-control form-control-sm" type="text" name="search">
                <button class="btn btn-outline-primary btn-sm" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-search mb-1">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                    </svg></button>
                    <button class="btn btn-primary ms-3" type="button" id="print">Print</button>
                </div></form>
            </div>
            <div class="card-body" id="print-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="reports">
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
                            <?php include_once 'functions/get-reports.php'; ?>
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
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
        const url = window.location.href;

        if (url.indexOf("#success") > -1) {
        swal("Success", "MTWBS - Margos sa Tubig Water Billing System", "success");
        }

        if (url.indexOf("#error") > -1) {
        swal("Error", "MTWBS - Margos sa Tubig Water Billing System", "error");
        }
    </script>
    <script>
        $(document).ready(function() {
            // When the search form is submitted
            $('#search-report').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Send AJAX request to retrieve filtered data
                $.ajax({
                    url: 'functions/get-reports.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) { // Update table with filtered data
                        $('#reports tbody').html(response);
                    }
                });
            }); 
            
        });
    </script>

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