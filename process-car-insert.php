<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_name = filter_var($_POST["car_name"], FILTER_UNSAFE_RAW);
    $year_of_registration = filter_var($_POST["year_of_registration"], FILTER_UNSAFE_RAW);
    $car_price_per_day = filter_var($_POST["car_price_per_day"], FILTER_VALIDATE_FLOAT);
    $price_per_km = filter_var($_POST["price_per_km"], FILTER_VALIDATE_FLOAT);
    $mileage = filter_var($_POST["mileage"], FILTER_VALIDATE_FLOAT);
    $car_color = filter_var($_POST["car_color"], FILTER_UNSAFE_RAW);
    $number_of_seats = filter_var($_POST["number_of_seats"], FILTER_VALIDATE_INT);
    $number_of_doors = filter_var($_POST["number_of_doors"], FILTER_VALIDATE_INT);
    $engine_type = filter_var($_POST["engine_type"], FILTER_UNSAFE_RAW);
    $tank_capacity = filter_var($_POST["tank_capacity"], FILTER_VALIDATE_FLOAT);
    $horse_power = filter_var($_POST["horse_power"], FILTER_UNSAFE_RAW);
    $transmission_type = filter_var($_POST["transmission_type"], FILTER_UNSAFE_RAW);
    $fuel_type = filter_var($_POST["fuel_type"], FILTER_UNSAFE_RAW);
    $body_type = filter_var($_POST["body_type"], FILTER_UNSAFE_RAW);
    $number_plate = filter_var($_POST["number_plate"], FILTER_UNSAFE_RAW);
    $car_img = filter_var($_POST["car_img"], FILTER_UNSAFE_RAW);
    $rented = isset($_POST["rented"]) ? 1 : 0;

    $conn = new PDO('mysql:host=localhost;dbname=my_car_rental', 'root', 'root');

    $sql = "INSERT INTO cars (car_name, year_of_registration, car_price_per_day, price_per_km, mileage, car_color, number_of_seats, number_of_doors, engine_type, tank_capacity, horse_power, transmission_type, fuel_type, body_type, number_plate, car_img, rented) 
            VALUES (:car_name, :year_of_registration, :car_price_per_day, :price_per_km, :mileage, :car_color, :number_of_seats, :number_of_doors, :engine_type, :tank_capacity, :horse_power, :transmission_type, :fuel_type, :body_type, :number_plate, :car_img, :rented)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bindParam(':car_name', $car_name);
        $stmt->bindParam(':year_of_registration', $year_of_registration);
        $stmt->bindParam(':car_price_per_day', $car_price_per_day);
        $stmt->bindParam(':price_per_km', $price_per_km);
        $stmt->bindParam(':mileage', $mileage);
        $stmt->bindParam(':car_color', $car_color);
        $stmt->bindParam(':number_of_seats', $number_of_seats);
        $stmt->bindParam(':number_of_doors', $number_of_doors);
        $stmt->bindParam(':engine_type', $engine_type);
        $stmt->bindParam(':tank_capacity', $tank_capacity);
        $stmt->bindParam(':horse_power', $horse_power);
        $stmt->bindParam(':transmission_type', $transmission_type);
        $stmt->bindParam(':fuel_type', $fuel_type);
        $stmt->bindParam(':body_type', $body_type);
        $stmt->bindParam(':number_plate', $number_plate);
        $stmt->bindParam(':car_img', $car_img);
        $stmt->bindParam(':rented', $rented);

        if ($stmt->execute()) {
            header("Location: admin-logged-in.php");
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Error: " . $conn->errorInfo()[2];
    }

    $conn = null;
}
?>
