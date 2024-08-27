<?php
session_start();

require 'connection.php';
$conn = Connect();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $all_orders_table_name = 'all_orders';
    $all_orders_sql = "SELECT * FROM $all_orders_table_name WHERE order_id = ?";
    $all_orders_stmt = $conn->prepare($all_orders_sql);

    if (!$all_orders_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $all_orders_stmt->bind_param("i", $order_id);
    $all_orders_stmt->execute();

    if ($all_orders_stmt->error) {
        die("Execute failed: " . $all_orders_stmt->error);
    }

    $all_orders_result = $all_orders_stmt->get_result();

    if ($all_orders_result->num_rows > 0) {
        $order = $all_orders_result->fetch_assoc();
        $car_id = $order['car_id'];

        $update_all_orders_sql = "UPDATE $all_orders_table_name SET is_returned = true, brought_back_date = CURRENT_DATE() WHERE order_id = ?";
        $update_all_orders_stmt = $conn->prepare($update_all_orders_sql);

        if (!$update_all_orders_stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $update_all_orders_stmt->bind_param("i", $order_id);

        echo "Executing query: $update_all_orders_sql with order_id: $order_id<br>";

        if ($update_all_orders_stmt->execute()) {
            $cars_table_name = 'cars';
            $update_cars_sql = "UPDATE $cars_table_name SET rented = false WHERE car_id = ?";
            $update_cars_stmt = $conn->prepare($update_cars_sql);

            if (!$update_cars_stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $update_cars_stmt->bind_param("i", $car_id);

            echo "Executing query: $update_cars_sql with car_id: $car_id<br>";

            if ($update_cars_stmt->execute()) {
                $orders_table_name = 'orders';
                $delete_orders_sql = "DELETE FROM $orders_table_name WHERE order_id = ?";
                $delete_orders_stmt = $conn->prepare($delete_orders_sql);

                if (!$delete_orders_stmt) {
                    die("Prepare failed: " . $conn->error);
                }

                $delete_orders_stmt->bind_param("i", $order_id);

                echo "Executing query: $delete_orders_sql with order_id: $order_id<br>";

                if ($delete_orders_stmt->execute()) {
                    echo "Successfully updated and deleted records.";
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Error deleting from 'orders' table: " . $delete_orders_stmt->error;
                }

                $delete_orders_stmt->close();
            } else {
                echo "Error updating 'rented' column: " . $update_cars_stmt->error;
            }

            $update_cars_stmt->close();
        } else {
            echo "Error updating 'is_returned' and 'brought_back_date' columns in 'all_orders' table: " . $update_all_orders_stmt->error;
        }

        $update_all_orders_stmt->close();
    } else {
        echo "Order not found.";
    }
} else {
    echo "Order ID is missing.";
}

mysqli_close($conn);
?>
