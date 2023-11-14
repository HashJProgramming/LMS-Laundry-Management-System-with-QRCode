<?php
include_once 'functions/connection.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $sql = 'SELECT id, status, queue_number 
            FROM ( SELECT id, status, ROW_NUMBER() 
            OVER (ORDER BY status DESC, kilo ASC) AS queue_number 
            FROM Transactions ) AS subquery WHERE id = :id AND status <= 4';

    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch();

    $status = $result['status'];
    $queue_number = $result['queue_number'];
    if($status == 0){
        $status = 10;
    }else if($status == 1){
        $status = 30;
    }else if($status == 2){
        $status = 50;
    }else if($status == 3){
        $status = 80;
    }else if($status == 4){
        $status = 100;
        $queue_number = "Done!";
    }else{
        $status = 0;
    }
} else {
    $queue_number = "Invalid Tracking Number!";
    $status = 0;
}



?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Laundry Management System Tracking</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <section class="vh-100" style="background-color: var(--bs-blue);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card text-black card-stepper" style="border-radius:16px;">
                        <div class="card-body p-5">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <div>
                                            <h2 class="mb-0">Queue&nbsp;<span class="text-primary font-weight-bold">#<?php echo $queue_number; ?></span></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <p class="mb-0">LMS - Laundry Management System (QRCode)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 d-xl-flex justify-content-center gutter-y">
                                <div class="col"><img src="assets/img/washing-clothes.gif" width="100%"></div>
                            </div>
                            <div class="progress d-flex justify-content-between d-flex justify-content-between mx-0 mt-0 mb-5">
                                <div class="progress-bar bg-success progress-bar-animated" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $status?>%;"></div>
                            </div>
                            <div class="row row-cols-6 row-cols-md-6 row-cols-xl-6 d-xl-flex justify-content-around gutter-y">
                                <div class="col">
                                    <div class="d-lg-flex align-items-center"><i class="fas fa-clipboard-list fa-2x me-lg-4 mb-3 <?php if ($status >= 10){echo 'text-primary';}?>"></i>
                                        <div class="d-none d-lg-block">
                                            <p class="fw-bold mb-0">Pending</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-lg-flex align-items-center"><i class="fas fa-tshirt fa-2x me-lg-4 mb-3 <?php if ($status >= 30){echo 'text-primary';}?>"></i>
                                        <div class="d-none d-lg-block">
                                            <p class="fw-bold mb-0">Washing</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-lg-flex align-items-center"><i class="fas fa-box-open fa-2x me-lg-4 mb-3 <?php if ($status >= 50){echo 'text-primary';}?>"></i>
                                        <div class="d-none d-lg-block">
                                            <p class="fw-bold mb-0">Folding</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-lg-flex align-items-center"><i class="fas fa-box fa-2x me-lg-4 mb-3 <?php if ($status >= 80){echo 'text-primary';}?>"></i>
                                        <div class="d-none d-lg-block">
                                            <p class="fw-bold mb-1">Ready for</p>
                                            <p class="fw-bold mb-0">Pickup</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-lg-flex align-items-center"><i class="fas fa-check fa-2x me-lg-4 mb-3 <?php if ($status >= 100){echo 'text-success';}?>"></i>
                                        <div class="d-none d-lg-block">
                                            <p class="fw-bold mb-1">Order</p>
                                            <p class="fw-bold mb-0">Claim</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
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