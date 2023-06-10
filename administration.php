<?php
include_once "functions/authentications.php";
include_once "functions/get-count.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - MTWBS</title>
    <meta name="description" content="Margos sa Tubig Water Billing System (Web-Base) - MTWBS">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Lato.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/pikaday.min.css">
    <link rel="stylesheet" href="assets/css/Pricing-Free-Paid-badges.css">
    <link rel="stylesheet" href="assets/css/Pricing-Free-Paid-icons.css">
    <link rel="stylesheet" href="assets/css/Profile-with-data-and-skills.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
        <div class="container"><a class="navbar-brand logo" href="#">MTWBS</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="functions/user-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page lanidng-page">
        <div class="container py-4 py-xl-5">
            <div class="row gy-4 row-cols-md-2 row-cols-xl-4 d-xl-flex">
                <div class="col">
                    <div class="card border-primary mb-4">
                        <div class="card-body text-center p-4">
                            <h4 class="fw-bold card-subtitle">Customers</h4>
                            <h4 class="display-5 fw-bold card-title"><?php get_customers_count(); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-primary mb-4">
                        <div class="card-body text-center p-4">
                            <h4 class="fw-bold card-subtitle">Income</h4>
                            <h4 class="display-5 fw-bold card-title">$<?php get_sales(); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-primary mb-4">
                        <div class="card-body text-center p-4">
                            <h4 class="fw-bold card-subtitle">Pending</h4>
                            <h4 class="display-5 fw-bold card-title"><?php get_pending_count(); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-primary mb-4">
                        <div class="card-body text-center p-4">
                            <h4 class="fw-bold card-subtitle">Proceed</h4>
                            <h4 class="display-5 fw-bold card-title"><?php get_proceed_count(); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="portfolio-block call-to-action border-bottom">
            <div class="container">
                <div class="d-flex justify-content-center align-items-center content">
                    <h3>Options</h3><button class="btn btn-outline-primary btn-lg ms-3" type="button" data-bs-target="#read" data-bs-toggle="modal">Reading</button><button class="btn btn-outline-primary btn-lg ms-3" type="button" data-bs-target="#add-customer" data-bs-toggle="modal">Add Customer</button><button class="btn btn-outline-primary btn-lg ms-3" type="button" data-bs-target="#customers" data-bs-toggle="modal">View Customers</button><a class="btn btn-outline-primary btn-lg ms-3" role="button" href="reports.php">Reports</a>
                </div>
            </div>
        </section>
    </main>
    <div class="card shadow">
        <div class="card-header d-flex flex-wrap justify-content-center align-items-center justify-content-sm-between gap-3"><img src="assets/img/image1.png" width="50">
            <h4 class="fw-bold">Transactions</h4>
            <form id="search-pending" method="post">
            <div class="input-group input-group-sm w-auto">
                <input class="form-control form-control-sm" type="text" name="search">
                <button class="btn btn-outline-primary btn-sm" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-search mb-1">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                    </svg></button></div></form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="pending">
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Consumption</th>
                            <th>Water Bill</th>
                            <th>Previous</th>
                            <th>Current</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once 'functions/get-pending.php';
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="page-footer">
        <div class="container">
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>

    <div class="modal fade" role="dialog" tabindex="-1" id="add-customer">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Customer</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/create-customer.php" method="post">
                        <div class="text-center"><img class="mb-3" src="assets/img/image1.png" width="80"></div>
                        <div class="mb-3"><label class="form-label" for="name">Fullname</label><input class="form-control item" type="text" name="fullname" required="" pattern="^(?!\s).*$" placeholder="Juan Dela Cruz"></div>
                        <div class="mb-3"><label class="form-label" for="name">Address</label><input class="form-control item" type="text" name="address" required="" pattern="^(?!\s).*$" placeholder="Address: 123 Main Street, Barangay San Francisco"></div>
                        <div class="mb-3"><label class="form-label" for="name">Phone</label><input class="form-control item" type="text" name="phone" required="" pattern="[0-9]+" minlength="11" maxlength="11" placeholder="09123456789"></div>
                        <div class="mb-3"><label class="form-label" for="name">Birthdate</label><input class="form-control item" name="birthdate" type="date" required=""></div>
                        <div class="mb-3"><button class="btn btn-primary btn-lg d-block w-100" type="submit">Save</button></div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="update-customer">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Customer</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/update-customer.php" method="post"><input class="form-control" type="hidden" name="data_id">
                        <div class="text-center"><img class="mb-3" src="assets/img/image1.png" width="80"></div>
                        <div class="mb-3"><label class="form-label" for="name">Fullname</label><input class="form-control item" type="text" name="fullname" required="" pattern="^(?!\s).*$"></div>
                        <div class="mb-3"><label class="form-label" for="name">Address</label><input class="form-control item" type="text" name="address" required="" pattern="^(?!\s).*$"></div>
                        <div class="mb-3"><label class="form-label" for="name">Phone</label><input class="form-control item" type="text" name="phone" required="" pattern="[0-9]+" minlength="11" maxlength="11"></div>
                        <div class="mb-3"><label class="form-label" for="name">Birthdate</label><input class="form-control item" name="birthdate" type="date" required=""></div>
                        <div class="mb-3"><label class="form-label" for="name">Status</label><select class="form-select" name="status" required="">
                                <optgroup label="Select Status">
                                    <option value="Active" selected="">Active</option>
                                    <option value="Disconnected">Disconnected</option>
                                </optgroup>
                            </select></div>
                        <div class="mb-3"><button class="btn btn-primary btn-lg d-block w-100" type="submit">Save</button></div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="customers">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Customers</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow">
                        <div class="card-header d-flex flex-wrap justify-content-center align-items-center justify-content-sm-between gap-3"><img src="assets/img/image1.png" width="50">
                        <form id="search-form" method="post">
                            <div class="input-group input-group-sm w-auto">
                                <input class="form-control form-control-sm" type="text" name="search"><button class="btn btn-outline-primary btn-sm" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-search mb-1">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                    </svg></button></div></form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="customers">
                                    <thead>
                                        <tr>
                                            <th>Fullname</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Birthdate</th>
                                            <th>Age</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="remove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <form action="functions/remove-customer.php" method="post">
                <div class="modal-body"><input type="hidden" name="data_id">
                    <p>Are you sure you want to remove this data?</p>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-danger" type="submit">Remove</button></div>
            </div></form>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="remove-transaction">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <form action="functions/remove-transaction.php" method="post">
                <div class="modal-body"><input type="hidden" name="data_id">
                    <p>Are you sure you want to remove this data?</p>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-danger" type="submit">Remove</button></div>
            </div></form>
        </div>
    </div>

    <div class="modal fade" role="dialog" tabindex="-1" id="proceed">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Proceed</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <form action="functions/proceed-transaction.php" method="post">
                <div class="modal-body"><input type="hidden" name="data_id">
                    <p>Are you sure you want to proceed this data?</p>
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="submit">Save</button></div>
            </div>
            </form>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="read">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Water Reading</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/create-transaction.php" method="post">
                        <div class="text-center"><img class="mb-3" src="assets/img/image1.png" width="80"></div>
                        <div class="mb-3"><label class="form-label" for="name">Customer:</label></div><select class="form-select" readonly="" name="data_id">
                            <optgroup label="Select Customer">
                                <?php
                                    include_once 'functions/get-customer-fullname.php';
                                ?>
                            </optgroup>
                        </select>
                        <div class="mb-3"><label class="form-label" for="name">Water Reading</label><input class="form-control form-control-lg item" type="number" name="reading" required="" pattern="[0-9]+" minlength="11" maxlength="11"></div>
                        <div class="mb-3"><button class="btn btn-primary btn-lg d-block w-100" type="submit">Save</button></div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    
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
            $('#search-form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Send AJAX request to retrieve filtered data
                $.ajax({
                    url: 'functions/view-customers.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) { // Update table with filtered data
                        $('#customers tbody').html(response);
                    }
                });
            }); 

            $('#search-pending').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Send AJAX request to retrieve filtered data
                $.ajax({
                    url: 'functions/get-pending.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) { // Update table with filtered data
                        $('#pending tbody').html(response);
                    }
                });
            });

            $.ajax({
                    url: 'functions/view-customers.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) { // Update table with filtered data
                        $('#customers tbody').html(response);
                    }
                });
            
        });
    </script>

    <script>
        $(document).on('click', 'a[data-bs-target="#update-customer"]', function() {
            var id = $(this).data('id');
            var fullname = $(this).data('fullname');
            var birthdate = $(this).data('birthdate');
            var address = $(this).data('address');
            var phone = $(this).data('phone');

            console.log(id, fullname, birthdate, phone);

            $('input[name="data_id"]').val(id);
            $('input[name="fullname"]').val(fullname);
            $('input[name="birthdate"]').val(birthdate);
            $('input[name="address"]').val(address);
            $('input[name="phone"]').val(phone);
        });


        $(document).on('click', 'a[data-bs-target="#remove"]', function() {
            var id = $(this).data('id');
            console.log(id);

            $('input[name="data_id"]').val(id);
        });

        $(document).on('click', 'a[data-bs-target="#proceed"]', function() {
            var id = $(this).data('id');
            console.log(id);

            $('input[name="data_id"]').val(id);
        });

        $(document).on('click', 'a[data-bs-target="#remove-transaction"]', function() {
            var id = $(this).data('id');
            console.log(id);

            $('input[name="data_id"]').val(id);
        });

    </script>
</body>

</html>