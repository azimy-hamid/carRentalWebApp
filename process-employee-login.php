<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $conn = Connect();

    $stmt = $conn->prepare("SELECT employee_id, email, password FROM employees WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['employee_id'] = $row['employee_id'];
            $_SESSION['email'] = $row['email'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid email or password.";
            header("Location: admin-login-form.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: admin-login-form.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
