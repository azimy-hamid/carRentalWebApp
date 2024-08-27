<?php
require 'connection.php';
$conn = Connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['employee_id']) && is_array($_POST['employee_id'])) {
        $employeeIds = $_POST['employee_id'];

        if (!empty($employeeIds)) {
            $employeeIds = array_map('intval', $employeeIds);
            $employeeIds = implode(',', $employeeIds);

            $sql = "DELETE FROM employees WHERE employee_id IN ($employeeIds)";

            if ($conn->query($sql) === TRUE) {
                header("Location: remove-employee.php");
                exit;
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            $warningMessage = "Please select employees to remove.";
        }
    } else {
        $warningMessage = "No employees selected for removal.";
    }
}

