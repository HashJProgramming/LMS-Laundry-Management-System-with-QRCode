<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

$id = $_GET['id'];
$kilo = $_GET['kilo'];
$type = $_GET['type'];
$type_price = $_GET['type_price'];
$products = $_GET['products'];
$total = $_GET['total'];
$get_tracking_url = $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/tracking.php?id=' . $id;

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Laundry</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="assets/css/Pricing-Centered-badges.css">
    <script src="assets/js/qrious.min.js"></script>
</head>

<body>
    <div class="container py-4 py-xl-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 d-xl-flex justify-content-center gutter-y">
            <div class="col">
                <div class="card border-primary border-2">
                    <div class="card-body text-center p-4">
                        <span class="badge rounded-pill bg-primary position-absolute top-0 start-50 translate-middle text-uppercase">Reciept</span>
                        <h6 class="text-uppercase text-muted card-subtitle">Total</h6>
                        <h4 class="display-4 fw-bold card-title">₱<?php echo $total; ?></h4>
                        <canvas id="qr-code"></canvas>
                    </div>
                    <div class="card-footer p-4">
                        <div id="receipt">
                            
                            <ul class="list-unstyled">
                                <li class="d-flex mb-2"><span class="bs-icon-xs bs-icon-rounded bs-icon-primary-light bs-icon me-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check2-circle">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"></path>
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"></path>
                                        </svg></span><span><strong>Kg/Kilo : <?php echo $kilo; ?></strong></span></li>
                                <li class="d-flex mb-2"><span class="bs-icon-xs bs-icon-rounded bs-icon-primary-light bs-icon me-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check2-circle">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"></path>
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"></path>
                                        </svg></span><span><strong>Type : <?php echo $type; ?> -&nbsp;₱<?php echo $type_price; ?></strong></span></li>
                                <li class="d-flex mb-2"><span class="bs-icon-xs bs-icon-rounded bs-icon-primary-light bs-icon me-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check2-circle">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"></path>
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"></path>
                                        </svg></span><span><strong>Products</strong>&nbsp;: <strong>₱<?php echo $products; ?></strong></span></li>
                                <li class="d-flex mb-2"><span class="bs-icon-xs bs-icon-rounded bs-icon-primary-light bs-icon me-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                                        </svg></span><span><strong>Total :&nbsp;₱<?php echo $total; ?></strong></span></li>
                            </ul>
                        </div>
                        <a class="btn btn-primary d-block w-100" role="button" onclick="printReceipt()">Print</a>
                        <a class="btn btn-primary d-block w-100" role="button" href="transaction.php" style="margin-top: 10px;">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    <script>
        $(document) .ready(function() {
            (function() {
            var qr = new QRious({
                        element: document.getElementById('qr-code'),
                        size: 200,
                        value: '<?php echo $get_tracking_url; ?>'
                    });
                })();
        } );



    function printReceipt() {
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head>');
        printWindow.document.write('<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="card border-primary border-2 mt-1">');
        printWindow.document.write('<div class="card-body text-center p-4">');
        printWindow.document.write('<span class="badge rounded-pill bg-primary position-absolute top-0 start-50 translate-middle text-uppercase">Reciept</span>');
        printWindow.document.write(' <h6 class="text-uppercase text-muted card-subtitle">Total</h6>');
        printWindow.document.write(' <h4 class="display-4 fw-bold card-title">₱<?php echo $total; ?></h4>');
        printWindow.document.write('<img id="qr-code-img" src="" />');
        printWindow.document.write('</div>');
        printWindow.document.write('<div class="card-footer p-4">');
        printWindow.document.write('');
        printWindow.document.write(document.getElementById('receipt').innerHTML);
        printWindow.document.write('</div>');
        printWindow.document.write('</body></html>');

        var qrValue = '<?php echo $get_tracking_url; ?>';
        var qrCodeImg = printWindow.document.getElementById('qr-code-img');

        var qr = new QRious({
            value: qrValue,
            size: 200
        });

        qrCodeImg.src = qr.toDataURL();

        setInterval(function() {
            printWindow.close();
        }, 10);
        printWindow.document.close();
        printWindow.print();
    }
    </script>
</body>

</html>