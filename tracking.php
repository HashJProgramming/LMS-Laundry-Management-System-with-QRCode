<?php
include_once 'functions/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $queue_number = "Invalid Tracking Number!";
    $status = 0;
}

$get_tracking_url = getHostByName(getHostName()) . dirname($_SERVER['PHP_SELF']) . '/tracking.php?id=' . $id;

$sql = 'SELECT l.date0, l.date1, l.date2, l.date3, l.date4, l.status, l.id AS laundry_id, l.kilo, p.price, p.name, t.id, t.customer_id, t.total, l.created_at, c.fullname, ROW_NUMBER() OVER (ORDER BY status DESC, kilo ASC) AS queue_number 
    FROM laundry AS l
    JOIN prices AS p ON l.type = p.id
    JOIN transactions AS t ON l.transaction_id = t.id
    JOIN customers AS c ON t.customer_id = c.id
    WHERE l.transaction_id = :id';

$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$result = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Laundry Management System Tracking</title>
    <link rel="shortcut icon" href="assets/img/washing-clothes.gif" type="image/gif">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <script src="assets/js/qrious.min.js"></script>
</head>

<body style="background-color: #4e73df;">
    <section class="" style="background-color: var(--bs-blue);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card text-black card-stepper" style="border-radius:16px;">
                        <div class="card-body p-5">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <div>
                                            <a class="text-decoration-none" href="invoice.php?id=<?= $id ?>&type=invoice">
                                                <h2 class="mb-2"><i class="fas fa-print"></i> Invoice&nbsp;<span class="text-primary font-weight-bold">#<?php echo $id; ?></span></h2>
                                                <div class="card">
                                                    <div class="container">
                                                      <canvas class="mt-1 text-center" id="qr-code"></canvas>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-end">
                                        <p class="mb-0">LMS - Laundry Management System (QRCode)</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            foreach ($result as $row) {

                                $status = $row['status'];
                                $date0 = $row['created_at'] ?? $row['created_at'] = '';
                                $date1 = $row['date0'] ?? $row['date0'] = '';
                                $date2 = $row['date1'] ?? $row['date1'] = '';
                                $date3 = $row['date2'] ?? $row['date2'] = '';
                                $date4 = $row['date3'] ?? $row['date3'] = '';
                                $queue_number = $row['queue_number'];
                                if ($status == 0) {
                                    $status = 5;
                                } else if ($status == 1) {
                                    $status = 30;
                                } else if ($status == 2) {
                                    $status = 50;
                                } else if ($status == 3) {
                                    $status = 80;
                                } else if ($status == 4) {
                                    $status = 100;
                                    $queue_number = "Done!";
                                } else {
                                    $status = 0;
                                }
                            ?>
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <div>
                                        <h2 class="mb-2">Queue <span class="text-primary font-weight-bold">#<?php echo $queue_number; ?></span></h2>
                                        <h5 class="mb-0 ms-5 font-monospace">Type - <span class="text-primary font-weight-bold"><?php echo $row['name']; ?></span></h5>
                                        <h5 class="mb-0 ms-5 font-monospace">Load - <span class="text-primary font-weight-bold"><?php echo $row['kilo']; ?>kg</span></h5>
                                    </div>
                                </div>
                                <div class="progress d-flex justify-content-between d-flex justify-content-between mx-0 mt-0 mb-5">
                                    <div class="progress-bar bg-success progress-bar-animated" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $status ?>%;"></div>
                                </div>
                                <div class="row row-cols-6 row-cols-md-6 row-cols-xl-6 d-xl-flex justify-content-around gutter-y">
                                    <div class="col">
                                        <div class="d-lg-flex align-items-center"><i class="fas fa-clipboard-list fa-2x me-lg-4 mb-3 <?php if ($status >= 20) {
                                                                                                                                            echo 'text-success';
                                                                                                                                        } ?>" data-bs-toggle="tooltip" data-bss-tooltip="" title="Pending | <?=$date0??=''?>"></i>
                                            <div class="d-none d-lg-block">
                                                <p class="fw-bold mb-0">Pending</p>
                                                <p class="fw-bold mb-0"><?=$date0??=''?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-lg-flex align-items-center"><i class="fas fa-tshirt fa-2x me-lg-4 mb-3 <?php if ($status >= 20) {
                                                                                                                                    echo 'text-success';
                                                                                                                                } ?>" data-bs-toggle="tooltip" data-bss-tooltip="" title="Washing | <?=$date1??=''?>"></i>
                                            <div class="d-none d-lg-block">
                                                <p class="fw-bold mb-0">Washing</p>
                                                <p class="fw-bold mb-0"><?=$date1??=''?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-lg-flex align-items-center"><i class="fas fa-box-open fa-2x me-lg-4 mb-3 <?php if ($status >= 50) {
                                                                                                                                    echo 'text-success';
                                                                                                                                } ?>" data-bs-toggle="tooltip" data-bss-tooltip="" title="Folding | <?=$date2??=''?>"></i>
                                            <div class="d-none d-lg-block">
                                                <p class="fw-bold mb-0">Folding</p>
                                                <p class="fw-bold mb-0"><?=$date2??=''?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-lg-flex align-items-center"><i class="fas fa-box fa-2x me-lg-4 mb-3 <?php if ($status >= 80) {
                                                                                                                                echo 'text-success';
                                                                                                                            } ?>" data-bs-toggle="tooltip" data-bss-tooltip="" title="Ready for Pickup | <?=$date3??=''?>"></i>
                                            <div class="d-none d-lg-block">
                                                <p class="fw-bold mb-1" style="font-size: 15px;">Ready for Pickup</p>
                                                <p class="fw-bold mb-0"><?=$date3??=''?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-lg-flex align-items-center"><i class="fas fa-check fa-2x me-lg-4 mb-3 <?php if ($status >= 100) {
                                                                                                                                echo 'text-success';
                                                                                                                            } ?>" data-bs-toggle="tooltip" data-bss-tooltip="" title="Order Claimed | <?=$date4??=''?>"></i>
                                            <div class="d-none d-lg-block">
                                                <p class="fw-bold mb-1">Order Claimed</p>
                                                <p class="fw-bold mb-0"><?=$date4??=''?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <script>
        $(document) .ready(function() {
            (function() {

                var qr = new QRious({
                        element: document.getElementById('qr-code'),
                        size: 150,
                        value: '<?php echo $get_tracking_url; ?>'
                    });
                
                })();
        } );
    </script>
</body>

</html>