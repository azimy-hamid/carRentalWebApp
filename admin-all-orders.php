<?php
session_start();


if (!isset($_SESSION['employee_id'])) {
    header("Location: admin-login-form.php");
    exit;
}

require 'connection.php';
$conn = Connect();


$orders_table_name = 'all_orders'; 


$orders_sql = "SELECT * FROM $orders_table_name";
$orders_stmt = $conn->prepare($orders_sql);

if (!$orders_stmt) {
    die("Prepare failed: " . $conn->error);
}

$orders_stmt->execute();

if ($orders_stmt->error) {
    die("Execute failed: " . $orders_stmt->error);
}

$orders_result = $orders_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'components/meta-data.php' ?>
    <style>
        body {
            background: #fff9e6;
        }

        .table-container {
            border-radius: 10px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            --bs-table-accent-bg: none;
        }

        .table-striped tbody tr:nth-of-type(even) {
            --bs-table-accent-bg: #fceabb;
        }

        .table-striped thead {
            background-color: #341413 !important;
            color: #fceabb !important;
        }

        .table-striped th,
        .table-striped td {
            padding: 12px 15px !important;
        }

        .table-striped tbody tr {
            border-bottom: 1px solid #341413 !important;
        }

        .table-striped tbody tr:last-of-type {
            border-bottom: 2px solid #341413 !important;
        }

        .table-striped tbody tr.active-row {
            font-weight: bold !important;
            color: #341413 !important;
        }

        .btn-outline-success {
            color: #341413 !important;
            border-color: #341413 !important;
        }

        .btn-outline-success:hover {
            background-color: #341413 !important;
            color: #ffffff !important;
        }
    </style>
</head>

<body>
    <?php require 'components/nav.php' ?>

    <div class="container" style="margin-top: 3rem;">
        <h3 class="text-warning text-uppercase text-center mb-3" style="color: #fbc257!important; background: #341413; padding: 10px; border-radius:10px;">All Orders</h3>

        <div class="row">
        </div>
        <div class="table-responsive table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Car ID</th>
                        <th>Pickup On</th>
                        <th>Return On</th>
                        <th>Ordered On</th>
                        <th>Status</th>
                        <th>Returned On</th>
                        <th>Price</th>
                        <th>View Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($order = $orders_result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td class="align-middle">' . $order['order_id'] . '</td>';
                        echo '<td class="align-middle">' . $order['car_id'] . '</td>';
                        echo '<td class="align-middle">' . $order['pickup_date'] . '</td>';
                        echo '<td class="align-middle">' . $order['return_date'] . '</td>';
                        echo '<td class="align-middle">' . $order['order_date'] . '</td>';
                        echo '<td class="align-middle">' . ($order['is_returned'] == 1 ? 'Returned' : 'Not Returned') . '</td>';
                        echo '<td class="align-middle">' . $order['brought_back_date'] . '</td>';
                        echo '<td class="align-middle">' . $order['price'] . '</td>';
                        echo '<td class="align-middle"><a href="invoice.php?order_id=' . $order['order_id'] . '&car_id=' . $order['car_id'] . '" class="btn btn-outline-success">View Invoice</a></td>';
                        echo '</tr>';
                    }                    ?>
                </tbody>
            </table>
        </div>

        <div class="alert alert-warning text-center" role="alert" style="color: #341413 !important; background: #fceabb; padding: 8px; border-radius:8px;">
            The price doesn't include tax and late fee - Refer to your invoice
        </div>

    </div>

    <?php require 'components/scripts-links.php' ?>
</body>

</html>