<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $_SESSION['signup_error'] = "Please fill in all required fields.";
        header("Location: admin-signup-form.php");
        exit();
    }

    $conn = Connect();

    $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashedPassword); 

    if ($stmt->execute()) {
        $_SESSION['employee_id'] = $stmt->insert_id;
        $_SESSION['email'] = $email;
        header("Location: admin-logged-in.php");
        exit();
    } else {
        $_SESSION['signup_error'] = "Error: Registration failed.";
        header("Location: admin-signup-form.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
