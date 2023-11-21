<?php
    include_once 'functions/authentication.php';
    include_once 'functions/connection.php';
    $sid = $_SESSION['id'];
    $id = $_GET['id'] ?? $sid;
    $sql = 'SELECT l.id, l.kilo, t.total, l.status, l.created_at, users.username, customers.fullname 
            FROM laundry AS l 
            JOIN transactions AS t ON l.transaction_id = t.id
            JOIN users ON t.user_id = users.id 
            JOIN customers ON t.customer_id = customers.id 
            WHERE user_id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $results = $stmt->fetchAll();

    $sql = 'SELECT username 
        FROM users 
        WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$info = $stmt->fetch();
$username = $info['username'] ?? 'None';
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Laundry Management System with QRCode</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
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
                    <h3 class="text-dark mb-4">Profile</h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="assets/img/profile.png" width="160" height="160">
                                    <div class="mb-3"></div><strong><?php echo $username?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-5"></div>
                </div>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Staff Transaction</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Transactions</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                            <table class="table table-striped my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>User</th>
                                            <th>KG/Kilo</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                                                                    
                                        foreach ($results as $row) {
                                            if($row['status'] == 0){
                                                $status = 'Pending';
                                            }else if($row['status'] == 1){
                                                $status = 'Processing';
                                            }else if($row['status'] == 2){
                                                $status = 'Folding';
                                            }else if($row['status'] == 3){
                                                $status = 'Ready for Pickup';
                                            }else if($row['status'] == 4){
                                                $status = 'Claimed';
                                            }else{
                                                $status = 'Unknown';
                                            }

                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['fullname'] . '</td>';
                                            echo '<td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">' . $row['username'] . '</td>';
                                            echo '<td>' . $row['kilo'] . '</td>';
                                            echo '<td>' . $row['total'] . '</td>';
                                            echo '<td>' . $status. '</td>';
                                            echo '<td>' . $row['created_at'] . '</td>';
                                            echo '</tr>';
                                        }
                                        
                                        ?>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
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

    <?php
        include_once 'functions/modals/transaction-modal.php';
    ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/listTable.js"></script>
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
        
    </script>
</body>

</html>