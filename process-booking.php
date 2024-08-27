<?php
session_start();

require 'connection.php';  
$conn = Connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerID = $_POST['customerID'];
    $pickupDate = $_POST['pickupDate'];
    $returnDate = $_POST['returnDate'];
    $paymentType = $_POST['paymentType'];
    $kilometers = isset($_POST['kilometers']) ? $_POST['kilometers'] : null;
    $totalPrice = $_POST['price'];
    $paymentMethod = $_POST['paymentMethod'];


    $car_id = isset($_GET['car_id']) ? $_GET['car_id'] : null;

    if (!$car_id) {
        echo "Car ID is missing.";
        exit;
    }

    $car_table_name = 'cars'; 


    $car_sql = "SELECT * FROM $car_table_name WHERE car_id = ?";
    $car_stmt = $conn->prepare($car_sql);


    if (!$car_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $car_stmt->bind_param("i", $car_id);
    $car_stmt->execute();


    if ($car_stmt->error) {
        die("Execute failed: " . $car_stmt->error);
    }

    $car_result = $car_stmt->get_result();

    if ($car_result->num_rows > 0) {
        $car = $car_result->fetch_assoc();
        $car_id = $car['car_id'];  

    } else {
        echo "Car not found.";
        exit;
    }


    $car_stmt->close();


    $sqlOrders = "INSERT INTO orders 
        (car_id, customer_id, pickup_date, return_date, payment_type, kilometers, price, payment_method) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmtOrders = $conn->prepare($sqlOrders);

    if (!$stmtOrders) {
        die("Prepare failed: " . $conn->error);
    }

    $stmtOrders->bind_param("iisssdss", $car_id, $customerID, $pickupDate, $returnDate, $paymentType, $kilometers, $totalPrice, $paymentMethod);


    if ($stmtOrders->execute()) {
        $sqlUpdateCar = "UPDATE cars SET rented = true WHERE car_id = ?";
        $stmtUpdateCar = $conn->prepare($sqlUpdateCar);

        if (!$stmtUpdateCar) {
            die("Prepare failed: " . $conn->error);
        }

        $stmtUpdateCar->bind_param("i", $car_id);

        if ($stmtUpdateCar->execute()) {
            $sqlAllOrders = "INSERT INTO all_orders 
    (order_date, car_id, customer_id, pickup_date, return_date, payment_type, kilometers, price, payment_method) 
    VALUES 
    (CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmtAllOrders = $conn->prepare($sqlAllOrders);

            if (!$stmtAllOrders) {
                die("Prepare failed: " . $conn->error);
            }

            $stmtAllOrders->bind_param("iisssdss", $car_id, $customerID, $pickupDate, $returnDate, $paymentType, $kilometers, $totalPrice, $paymentMethod);

            if ($stmtAllOrders->execute()) {
                $order_id = $conn->insert_id;

                header("Location: invoice.php?car_id=" . $car_id . "&order_id=" . $order_id);
                exit;
            } else {
                echo "Error inserting into 'all_orders' table: " . $stmtAllOrders->error;
            }

            $stmtAllOrders->close();
        } else {
            echo "Error updating 'rented' column: " . $stmtUpdateCar->error;
        }

        $stmtUpdateCar->close();
    } else {
        echo "Error inserting into 'orders' table: " . $stmtOrders->error;
    }

    $stmtOrders->close();

    mysqli_close($conn);
}
