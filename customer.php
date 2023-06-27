<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Customer - Laundry Management System with QRCode</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0" style="background: var(--bs-primary-text-emphasis);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15"><img class="rounded-circle" src="assets/img/washing-clothes.gif" width="60" height="60"></div>
                    <div class="sidebar-brand-text mx-3"><span>Laundry<br>Mangement<br>System</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-target="#transaction" data-bs-toggle="modal" href="#"><i class="far fa-credit-card"></i><span>New Transaction</span></a><a class="nav-link" href="transaction.php"><i class="far fa-credit-card"></i><span>Transaction</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="customer.php"><i class="fas fa-user"></i><span>Customers</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="staff.php"><i class="fas fa-user"></i><span>Staff</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="expedinture.php"><i class="far fa-share-square" style="font-size: 14px;"></i><span>Expenditure</span></a><a class="nav-link" href="supply.php"><i class="fas fa-shopping-cart" style="font-size: 14px;"></i><span>Supply</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="queue.php"><i class="fas fa-table"></i><span>Queuing</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="sales.php"><i class="fas fa-table"></i><span>Sales</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Administrator</span><i class="far fa-user"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="logs.php"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Customer Management</h3><button class="btn btn-primary btn-sm d-none d-sm-inline-block" type="button" data-bs-target="#add" data-bs-toggle="modal"><i class="fas fa-user-check fa-sm text-white-50"></i>&nbsp;Create Customer</button>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Lists of Customers</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-striped my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Fullname</th>
                                            <th>Address</th>
                                            <th>Contact No.</th>
                                            <th>Date Created</th>
                                            <th class="text-center">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#1</td>
                                            <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">Airi Satou</td>
                                            <td>1</td>
                                            <td>150</td>
                                            <td>Process</td>
                                            <td>2008/11/29</td>
                                            <td class="text-center"><a class="mx-1" href="profile-customer.php"><i class="far fa-eye" style="font-size: 20px;"></i></a><a class="mx-1" href="#" data-bs-target="#update" data-bs-toggle="modal"><i class="far fa-edit text-warning" style="font-size: 20px;"></i></a><a class="mx-1" href="#" data-bs-target="#remove" data-bs-toggle="modal"><i class="far fa-trash-alt text-danger" style="font-size: 20px;"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>#2</td>
                                            <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">Airi Satou</td>
                                            <td>1.5</td>
                                            <td>225</td>
                                            <td>Pending</td>
                                            <td>2008/11/28</td>
                                            <td class="text-center"><a class="mx-1" href="profile-customer.php"><i class="far fa-eye" style="font-size: 20px;"></i></a><a class="mx-1" href="#" data-bs-target="#update" data-bs-toggle="modal"><i class="far fa-edit text-warning" style="font-size: 20px;"></i></a><a class="mx-1" href="#" data-bs-target="#remove" data-bs-toggle="modal"><i class="far fa-trash-alt text-danger" style="font-size: 20px;"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>#3</td>
                                            <td><img class="rounded-circle me-2" width="30" height="30" src="assets/img/profile.png">Airi Satou</td>
                                            <td>2</td>
                                            <td>300</td>
                                            <td>Pending</td>
                                            <td>2008/11/29</td>
                                            <td class="text-center"><a class="mx-1" href="profile-customer.php"><i class="far fa-eye" style="font-size: 20px;"></i></a><a class="mx-1" href="#" data-bs-target="#update" data-bs-toggle="modal"><i class="far fa-edit text-warning" style="font-size: 20px;"></i></a><a class="mx-1" href="#" data-bs-target="#remove" data-bs-toggle="modal"><i class="far fa-trash-alt text-danger" style="font-size: 20px;"></i></a></td>
                                        </tr>
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
                    <h4 class="modal-title">Create Customer</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" placeholder="John" name="firstname" required=""></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" placeholder="Doe" name="lastname" required=""></div>
                            </div>
                        </div>
                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Address</strong></label><input class="form-control" type="text" placeholder="Address" name="address" required=""></div>
                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Contact</strong>&nbsp;No.</label><input class="form-control" type="text" placeholder="Contact No." name="contact" required="" minlength="11" maxlength="11"></div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="update">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Customer</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" placeholder="John" name="firstname" required=""></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" placeholder="Doe" name="lastname" required=""></div>
                            </div>
                        </div>
                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Address</strong></label><input class="form-control" type="text" placeholder="Address" name="address" required=""></div>
                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Contact</strong>&nbsp;No.</label><input class="form-control" type="text" placeholder="Contact No." name="contact" minlength="11" maxlength="11"></div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-primary" type="button">Save</button></div>
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
                    <p>Are you sure you want to remove this customer?</p>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button><button class="btn btn-danger" type="button">Remove</button></div>
            </div>
        </div>
    </div>
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
</body>

</html>