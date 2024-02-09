<?php
    include_once 'functions/authentication.php';
    include_once 'functions/views/get-data.php';

   foreach (get_transaction($_SESSION['id']) as $row) {
        $id = $row['id'];
        $fullname = $row['fullname'];
        $name = explode(' ', $fullname);
        $firstname = $name[0];
        $lastname = $name[1];
        $address = $row['address'];
        $contact = $row['contact'];
    }

    if(get_transaction($_SESSION['id']) == null){
        $id = '';
        $fullname = 'NONE';
        $firstname = 'NONE';
        $lastname = 'NONE';
        $address = 'NONE';
        $contact = 'NONE';
    }
    $sql = "SELECT l.kilo, p.price
            FROM laundry AS l
            JOIN transactions AS t ON l.transaction_id = t.id
            JOIN prices AS p ON l.type = p.id
            WHERE t.user_id = :user_id AND t.status = 'pending'";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $_SESSION['id']);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $total_price = 0;
    foreach ($results as $row) {
        $total_price += $row['price'] * $row['kilo'];
    }
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Transaction - Laundry Management System with QRCode</title>
    <link rel="shortcut icon" href="assets/img/washing-clothes.gif" type="image/gif">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0 toggled" style="background: var(--bs-primary-text-emphasis);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15"><img class="rounded-circle" src="assets/img/washing-clothes.gif" width="60" height="60"></div>
                    <div class="sidebar-brand-text mx-3"><span>Laundry<br>Mangement<br>System</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php
                        include_once 'functions/views/navbar.php';
                    ?>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">My Account</span><i class="far fa-user"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item <?php if($_SESSION['level'] == '1'){echo 'd-none';}?>" href="logs.php"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="functions/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Transaction</h3>
                    </div>
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <button class="btn btn-primary btn-sm mb-1 <?php if ($fullname != 'NONE') {echo 'd-none';}?>" type="button" data-bs-target="#transaction" data-bs-toggle="modal"><i class="fas fa-truck-loading fa-sm text-white-50"></i>&nbsp;New Transaction</button>
                    </div>
                    <div class="row <?php if ($fullname == 'NONE') {echo 'd-none';}?>">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span class="total">₱<?= number_format($total_price, 2)?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-3 <?php if ($fullname == 'NONE') {echo 'd-none';}?>">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col">
                                    <p class="text-primary m-0 fw-bold">Transaction Information</p>
                                </div>
                                <div class="col text-end">
                                    <button class="btn btn-danger mx-2 mb-1" type="button" data-bs-target="#confirm" data-bs-toggle="modal">Cancel</button>
                                    <button class="btn btn-primary mb-1" type="button" data-bs-target="#proceed" data-bs-toggle="modal">Proceed</button></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                            <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="first_name"><strong>First Name:</strong></label>
                                            <label class="form-label" id="first_name"><?php echo $firstname ?></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="last_name"><strong>Last Name:</strong></label>
                                            <label class="form-label" id="last_name"><?php echo $lastname ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="address"><strong>Address:</strong></label>
                                    <label class="form-label" id="address"><?php echo $address ?></label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="contact"><strong>Contact:</strong></label>
                                    <label class="form-label" id="contact"><?php echo $contact ?></label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                                <button class="btn btn-primary btn-sm mb-1 <?php if ($fullname == 'NONE') {echo 'd-none';}?>" type="button" data-bs-target="#add" data-bs-toggle="modal"><i class="fas fa-truck-loading fa-sm text-white-50"></i>&nbsp;Add Item</button> 
                            </div>
                                <div class="card shadow <?php if ($fullname == 'NONE') {echo 'd-none';}?>">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 fw-bold">Items</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                            <table class="table table-striped my-0" id="dataTable">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Unit</th>
                                                        <th>Qty</th>
                                                        <th class="text-center">Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php include_once 'functions/views/products.php' ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr></tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col">
                            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                                <button class="btn btn-primary btn-sm mb-1 <?php if ($fullname == 'NONE') {echo 'd-none';}?>" type="button" data-bs-target="#laundry-add" data-bs-toggle="modal"><i class="fas fa-truck-loading fa-sm text-white-50"></i>&nbsp;Add Laundry</button> 
                            </div>
                            <div class="card shadow <?php if ($fullname == 'NONE') {echo 'd-none';}?>">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Laundry</p>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                        <table class="table table-striped my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Unit</th>
                                                    <th>Laundry</th>
                                                    <th>Total</th>
                                                    <th class="text-center">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php include_once 'functions/views/laundry.php' ?>
                                            </tbody>
                                            <tfoot>
                                                <tr></tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © ZDSPGC&nbsp;2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="add">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Item</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/add-product.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Item</strong></label><select class="form-select" name="item">
                                <optgroup label="Select Item">
                                    <?php items_list() ?>
                                </optgroup>
                            </select></div>
                        <div class="mb-3"><label class="form-label"><strong>Quantity</strong></label><input class="form-control" type="number"  name="qty" pattern="\d+" placeholder="Qty" min="1" value="1"></div>
                   
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="submit">Add</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="laundry-add">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Laundry</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/add-laundry.php" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" ><strong name="type_text">Unit</strong></label>
                                <input class="form-control" type="number" id="kg" name="kilo" min="1" pattern="\d+"></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label"><strong>Type</strong></label><select id="type" class="form-select" name="type">
                                        <optgroup label="SELECT">
                                            <option value="">SELECT UNIT</option>
                                        <?php price_list() ?>
                                        </optgroup>
                                    </select></div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="submit">Add</button></div>
                </form>
            </div>
        </div>
    </div>
    
  
    <div class="modal fade" role="dialog" tabindex="-1" id="remove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove Item</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove this item?</p>
                </div>
                <form action="functions/remove-product.php" method="post">
                    <input type="hidden" name="data_id">
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">No</button><button class="btn btn-danger" type="submit">Yes</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="laundry-remove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove Laundry</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove this Laundry?</p>
                </div>
                <form action="functions/remove-laundry.php" method="post">
                    <input type="hidden" name="data_id">
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-danger" type="submit">Remove</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="laundry-remove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove Laundry</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove this Laundry?</p>
                </div>
                <form action="functions/remove-laundry.php" method="post">
                    <input type="hidden" name="data_id">
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-danger" type="submit">Remove</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="laundry-remove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove Laundry</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to remove this Laundry?</p>
                </div>
                <form action="functions/remove-laundry.php" method="post">
                    <input type="hidden" name="data_id">
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-danger" type="submit">Remove</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="confirm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cancel Transaction</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel this transaction?</p>
                </div>
                <form action="functions/cancel-transaction.php" method="post">
                    <input type="hidden" name="data_id" value="<?php echo $id; ?>">
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">No</button><button class="btn btn-danger" type="submit">Yes</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="proceed">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Proceed Transaction</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/proceed-transaction.php" method="post">
                        <p>Are you sure you want to proceed this transaction?</p>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="kilo">
                        <input type="hidden" name="type">
                    <div class="mb-3"><label class="form-label" for="amount"><strong>Amount</strong></label><input class="form-control" type="number" placeholder="Amount" name="amount" value="<?=$total_price?>" min="<?=$total_price?>" required></div>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">No</button><button class="btn btn-primary" type="submit">Yes</button></div>
                </form>
            </div>
        </div>
    </div>

    <?php
        include_once 'functions/modals/transaction-modal.php';
    ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const type = urlParams.get('type');
        const message = urlParams.get('message');
        if (type == 'success') {
            swal("Success!", message, "success");
        } else if (type == 'error') {
            swal("Error!", message, "error");
        }
        $('a[data-bs-target="#remove"]').on('click', function() {
                var id = $(this).data('id');
                console.log(id); 
                $('input[name="data_id"]').val(id);
            });
        $('a[data-bs-target="#laundry-remove"]').on('click', function() {
                var id = $(this).data('id');
                console.log(id); 
                $('input[name="data_id"]').val(id);
            });
        $('a[data-bs-target="#confirm"]').on('click', function() {
            var id = $(this).data('id');
            console.log(id); 
            $('input[name="data_id"]').val(id);
        });
        $('button[data-bs-target="#proceed"]').on('click', function() {
            var id = $(this).data('id');
            var kilo = $('input[name="kilo"]').val();
            var type = $('select[name="type"]').val();
            console.log(kilo, type);
            $('input[name="id"]').val(id);
            $('input[name="kilo"]').val(kilo);
            $('input[name="type"]').val(type);
        });

        $('select[name="type"]').on('change', function() {
            var unit = $(this).find('option:selected').data('unit');
            $('input[name="kilo"]').val(1);
            $('strong[name="type_text"]').text(unit);
        });
    </script>
</body>

</html>