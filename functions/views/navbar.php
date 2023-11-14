<?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($_SESSION['level'] == '0') {
        ?>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'index.php') ? 'active' : ''; ?>" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'transaction.php') ? 'active' : ''; ?>" href="transaction.php"><i class="far fa-credit-card"></i><span>Transaction</span></a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'customer.php') ? 'active' : ''; ?>" href="customer.php"><i class="fas fa-user"></i><span>Customers</span></a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'staff.php') ? 'active' : ''; ?>" href="staff.php"><i class="fas fa-user"></i><span>Staff</span></a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'expedinture.php') ? 'active' : ''; ?>" href="expedinture.php"><i class="far fa-share-square" style="font-size: 14px;"></i><span>Expenditure</span></a><a class="nav-link <?= ($currentPage == 'supply.php') ? 'active' : ''; ?>" href="supply.php"><i class="fas fa-shopping-cart" style="font-size: 14px;"></i><span>Supply</span></a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'queue.php') ? 'active' : ''; ?>" href="queue.php"><i class="fas fa-table"></i><span>Queuing</span></a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'sales.php') ? 'active' : ''; ?>" href="sales.php"><i class="fas fa-table"></i><span>Sales</span></a></li>
        <?php
    } else {
        ?>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'index.php') ? 'active' : ''; ?>" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'transaction.php') ? 'active' : ''; ?>" href="transaction.php"><i class="far fa-credit-card"></i><span>Transaction</span></a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'customer.php') ? 'active' : ''; ?>" href="customer.php"><i class="fas fa-user"></i><span>Customers</span></a></li>
        <li class="nav-item"><a class="nav-link <?= ($currentPage == 'queue.php') ? 'active' : ''; ?>" href="queue.php"><i class="fas fa-table"></i><span>Queuing</span></a></li>
        <?php
    }
?>
