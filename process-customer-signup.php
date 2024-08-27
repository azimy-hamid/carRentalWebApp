<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_username = $_POST["customer_username"];
    $customer_name = $_POST["customer_name"];
    $customer_phone = $_POST["customer_phone"];
    $customer_email = $_POST["customer_email"];
    $customer_address = $_POST["customer_address"];
    $customer_password = $_POST["customer_password"];


    $hashedPassword = password_hash($customer_password, PASSWORD_DEFAULT);


    if (empty($customer_username) || empty($customer_name) || empty($customer_phone) || empty($customer_email) || empty($customer_address) || empty($customer_password)) {
        $_SESSION['signup_error'] = "Please fill in all required fields.";
        header("Location: customer-login-form.php");
        exit();
    }

    $conn = Connect();

    $stmt = $conn->prepare("INSERT INTO customers (customer_username, customer_name, customer_phone, customer_email, customer_address, customer_password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $customer_username, $customer_name, $customer_phone, $customer_email, $customer_address, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['customer_id'] = $stmt->insert_id;
        $_SESSION['customer_email'] = $customer_email;
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['signup_error'] = "Error: Registration failed.";
        header("Location: customer-login-form.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
