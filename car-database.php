<?php
session_start();

if (!isset($_SESSION['employee_id'])) {
    header("Location: admin-login-form.php");
    exit;
}

require 'connection.php';
$conn = Connect();

$query = "SELECT * FROM cars";
$car_db = $conn->query($query);
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
        <h3 class="text-warning text-uppercase text-center mb-4" style="color: #fbc257!important; background: #341413; padding: 10px; border-radius:10px;">Remove a car</h3>

        <form action="process-remove-car.php" method="post"> 
            <div class="table-responsive table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Select</th> 
                            <th>Car Name</th>
                            <th>Year of Registration</th>
                            <th>Per Day</th>
                            <th>Per Km</th>
                            <th>Mileage</th>
                            <th>Car Color</th>
                            <th>Number of Seats</th>
                            <th>Number of Doors</th>
                            <th>Engine Type</th>
                            <th>Tank Capacity</th>
                            <th>Horsepower</th>
                            <th>Transmission Type</th>
                            <th>Fuel Type</th>
                            <th>Body Type</th>
                            <th>Number Plate</th>
                            <th>Car Image</th>
                            <th>Rent Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $car_db->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td><input type="checkbox" name="selected_cars[]" value="' . $row['car_id'] . '"></td>'; 
                            echo '<td>' . $row['car_name'] . '</td>';
                            echo '<td>' . $row['year_of_registration'] . '</td>';
                            echo '<td>' . $row['car_price_per_day'] . '</td>';
                            echo '<td>' . $row['price_per_km'] . '</td>';
                            echo '<td>' . $row['mileage'] . '</td>';
                            echo '<td>' . $row['car_color'] . '</td>';
                            echo '<td>' . $row['number_of_seats'] . '</td>';
                            echo '<td>' . $row['number_of_doors'] . '</td>';
                            echo '<td>' . $row['engine_type'] . '</td>';
                            echo '<td>' . $row['tank_capacity'] . '</td>';
                            echo '<td>' . $row['horse_power'] . '</td>';
                            echo '<td>' . $row['transmission_type'] . '</td>';
                            echo '<td>' . $row['fuel_type'] . '</td>';
                            echo '<td>' . $row['body_type'] . '</td>';
                            echo '<td>' . $row['number_plate'] . '</td>';
                            echo '<td>' . $row['car_img'] . '</td>';
                            echo '<td>' . $row['rented'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-danger mt-4" name="remove_selected">Remove Selected</button> 
        </form>
    </div>

    <?php require 'components/scripts-links.php'; ?>
</body>

</html>