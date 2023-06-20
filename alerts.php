<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blank Page - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0" style="background: var(--bs-primary-text-emphasis);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15"><img class="rounded-circle" src="assets/img/washing-clothes.gif" width="60" height="60"></div>
                    <div class="sidebar-brand-text mx-3"><span>Laundry<br>Mangement<br>System</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.html"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-target="#transaction" data-bs-toggle="modal" href="#"><i class="far fa-credit-card"></i><span>New Transaction</span></a><a class="nav-link" href="transaction.html"><i class="far fa-credit-card"></i><span>Transaction</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="customer.html"><i class="fas fa-user"></i><span>Customers</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="staff.html"><i class="fas fa-user"></i><span>Staff</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="expedinture.html"><i class="far fa-share-square" style="font-size: 14px;"></i><span>Expenditure</span></a><a class="nav-link" href="supply.html"><i class="fas fa-shopping-cart" style="font-size: 14px;"></i><span>Supply</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="queue.html"><i class="fas fa-table"></i><span>Queuing</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="sales.html"><i class="fas fa-table"></i><span>Sales</span></a></li>
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
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">notification 🔔</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-user-circle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new CustomerName</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>CustomerName - New Transaction</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>CustomerName Laundry Pending for 3 days</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="alerts.html">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Administrator</span><i class="far fa-user"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="profile.html"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="logs.html"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-primary fw-bold m-0">All Notification 🔔&nbsp;</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row align-items-center no-gutters">
                                <div class="col-xl-1">
                                    <div class="bg-primary icon-circle"><i class="fas fa-user-circle text-white"></i></div>
                                </div>
                                <div class="col me-2">
                                    <h6 class="mb-0"><strong>New Customer [CustomerName]</strong></h6><span class="text-xs">10:30 AM</span>
                                </div>
                                <div class="col-auto"><button class="btn btn-primary" type="button">Option</button></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row align-items-center no-gutters">
                                <div class="col-xl-1">
                                    <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                </div>
                                <div class="col me-2">
                                    <h6 class="mb-0"><strong>New Transaction 1Kg - $250 [CustomerName]</strong></h6><span class="text-xs">10:30 AM</span>
                                </div>
                                <div class="col-auto"><button class="btn btn-primary" type="button">Option</button></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row align-items-center no-gutters">
                                <div class="col-xl-1">
                                    <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                </div>
                                <div class="col me-2">
                                    <h6 class="mb-0"><strong>[CustomerName] Laundry Pending for 3 days.</strong></h6><span class="text-xs">10:30 AM</span>
                                </div>
                                <div class="col-auto"><button class="btn btn-primary" type="button">Option</button></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © ZDSPGC&nbsp;2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>