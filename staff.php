<?php
    include_once 'functions/authentication.php';
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Staff - Laundry Management System with QRCode</title>
    <link rel="shortcut icon" href="assets/img/washing-clothes.gif" type="image/gif">
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
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Staff Management</h3><button class="btn btn-primary btn-sm" type="button" data-bs-target="#add" data-bs-toggle="modal"><i class="fas fa-user-check fa-sm text-white-50"></i>&nbsp;Create Staff</button>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Lists of Staff</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-striped my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Staff</th>
                                            <th>Date Created</th>
                                            <th class="text-center">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include_once 'functions/views/staff.php';
                                        ?>
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
                    <h4 class="modal-title">Create Staff</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/add-staff.php" method="post">
                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Username</strong></label><input class="form-control" type="text" placeholder="Username" name="username" required=""></div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Password</strong></label><input class="form-control" type="password" name="password" placeholder="Password" required=""></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Re-type Password</strong></label><input class="form-control" type="password" name="re-password" placeholder="Re-type Password" required=""></div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="submit">Save</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="update">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Staff</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/update-staff.php" method="post">
                        <input type="hidden" name="data_id">
                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Username</strong></label><input class="form-control" type="text" placeholder="Username" name="username" required="" readonly></div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Password</strong></label><input class="form-control" type="password" name="password" placeholder="Password" required=""></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Re-type Password</strong></label><input class="form-control" type="password" name="newpassword" placeholder="Re-type Password" required=""></div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer"><button class="btn btn-primary" type="submit">Save</button></div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="remove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Remove Cusotmer</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="functions/remove-staff.php" method="post">
                        <input type="hidden" name="data_id">
                    <p>Are you sure you want to remove this customer?</p>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">No</button><button class="btn btn-danger" type="submit">Yes</button></div>
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

        $(document).ready(function () {
            const urlParams = new URLSearchParams(window.location.search);
            const type = urlParams.get('type');
            const message = urlParams.get('message');
            if (type == 'success') {
                swal("Success!", message, "success");
            } else if (type == 'error') {
                swal("Error!", message, "error");
            }

            $('a[data-bs-target="#update"]').on('click', function() {
                var id = $(this).data('id');
                var username = $(this).data('username');
                console.log(id, username);
                $('input[name="data_id"]').val(id);
                $('input[name="username"]').val(username);

            });
            $('a[data-bs-target="#remove"]').on('click', function() {
                var id = $(this).data('id');
                console.log(id); // Add this line
                $('input[name="data_id"]').val(id);
            });
        })
    </script>
</body>

</html>