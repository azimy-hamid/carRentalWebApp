<?php
session_start();

if (!isset($_SESSION['employee_id'])) {
    header("Location: admin-login-form.php");
    exit;
}

require 'connection.php';
$conn = Connect();

if (isset($_POST['remove_selected'])) {
    if (isset($_POST['selected_cars']) && is_array($_POST['selected_cars'])) {
        foreach ($_POST['selected_cars'] as $car_id) {
            $car_id = $conn->real_escape_string($car_id);
            $query = "DELETE FROM cars WHERE car_id = '$car_id'";
            $conn->query($query);
        }
    }
    header("Location: car-database.php");
    exit;
}
?>
