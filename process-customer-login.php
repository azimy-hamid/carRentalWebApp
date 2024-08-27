<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conn = Connect(); 

    if ($conn === false) {
        die("Database connection error: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare("SELECT customer_id, customer_email, customer_password FROM customers WHERE customer_email = ?");

    if ($stmt === false) {
        die("Error in prepare: " . $conn->error);
    }

    $stmt->bind_param("s", $email);

    if ($stmt === false) {
        die("Error in bind_param: " . $stmt->error);
    }

    $stmt->execute();

    if ($stmt === false) {
        die("Error in execute: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['customer_password'];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['customer_email'] = $row['customer_email'];
            header("Location: index.php"); 
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid email or password.";
            header("Location: customer-login-form.php"); 
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: customer-login-form.php"); 
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
