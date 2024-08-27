<?php
session_start();


if (!isset($_SESSION['employee_id'])) {
    header("Location: admin-login-form.php");
    exit;
}

require 'connection.php';
$conn = Connect();


$query = "SELECT * FROM employees";
$employee_db = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'components/meta-data.php'; ?>
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
    <?php require 'components/nav.php'; ?>

    <div class="container" style="margin-top: 3rem;">
    <h3 class="text-warning text-uppercase text-center mb-4" style="color: #fbc257!important; background: #341413; padding: 10px; border-radius:10px;">All Employees</h3>

        <div class="table-responsive table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Pass</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $employee_db->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['employee_id'] . '</td>';
                        echo '<td>' . $row['first_name'] . '</td>';
                        echo '<td>' . $row['last_name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['password'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php require 'components/scripts-links.php'; ?>
</body>

</html>