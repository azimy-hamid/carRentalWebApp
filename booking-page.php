<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer-login-form.php");
    exit;
}

require 'connection.php';
$conn = Connect();


if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];

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
        $car_name = $car['car_name'];
        $car_price_per_day = $car['car_price_per_day'];
        $year_of_registration = $car['year_of_registration'];
        $price_per_km = $car['price_per_km'];
        $mileage = $car['mileage'];
        $car_color = $car['car_color'];
        $number_of_seats = $car['number_of_seats'];
        $number_of_doors = $car['number_of_doors'];
        $engine_type = $car['engine_type'];
        $tank_capacity = $car['tank_capacity'];
        $horse_power = $car['horse_power'];
        $transmission_type = $car['transmission_type'];
        $fuel_type = $car['fuel_type'];
        $body_type = $car['body_type'];
        $number_plate = $car['number_plate'];
        $car_img = $car['car_img'];
        $rented = $car['rented'];

        $car_stmt->close();
    } else {
        echo "Car not found.";
    }
} else {
    echo "Car ID is missing.";
}


$customer_id = $_SESSION['customer_id'];
$customer_table_name = 'customers'; 


$customer_sql = "SELECT customer_id, customer_name, customer_email FROM $customer_table_name WHERE customer_id = ?";
$customer_stmt = $conn->prepare($customer_sql);

if (!$customer_stmt) {
    die("Prepare failed: " . $conn->error);
}

$customer_stmt->bind_param("i", $customer_id);
$customer_stmt->execute();

if ($customer_stmt->error) {
    die("Execute failed: " . $customer_stmt->error);
}

$customer_result = $customer_stmt->get_result();

if ($customer_result->num_rows > 0) {
    $customer_info = $customer_result->fetch_assoc();
    $customer_id = $customer_info['customer_id'];
    $customer_name = $customer_info['customer_name'];
    $customer_email = $customer_info['customer_email'];

    $customer_stmt->close();
} else {
    echo "Customer not found.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'components/meta-data.php' ?>
</head>

<body>
    <?php
    require 'components/nav.php'
    ?>

    <div class="container section-padding" style="margin-top: 6rem;">
        <h2 class="text-center text-warning" style="margin-bottom: 2.5rem;">Booking Information</h2>
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center text-secondary" style="margin-bottom: 2rem;">Car Info.</h2>

                <?php
                if (isset($car_name)) {
                    echo '<p><strong>Car Name - </strong> ' . $car_name . '</p>';
                    echo '<p><strong>Price Per Day - </strong> Rs. ' . $car_price_per_day . '</p>';
                    echo '<p><strong>Price Per Kilometer - </strong> Rs. ' . $car['price_per_km'] . '</p>';
                    echo '<p><strong>Year of Registration - </strong> ' . $car['year_of_registration'] . '</p>';
                    echo '<p><strong>Mileage - </strong> ' . $car['mileage'] . ' km</p>';
                    echo '<p><strong>Car Color - </strong> ' . $car['car_color'] . '</p>';
                    echo '<p><strong>Number of Seats - </strong> ' . $car['number_of_seats'] . '</p>';
                    echo '<p><strong>Number of Doors - </strong> ' . $car['number_of_doors'] . '</p>';
                    echo '<p><strong>Engine Type - </strong> ' . $car['engine_type'] . '</p>';
                    echo '<p><strong>Tank Capacity - </strong> ' . $car['tank_capacity'] . '</p>';
                    echo '<p><strong>Horsepower - </strong> ' . $car['horse_power'] . '</p>';
                    echo '<p><strong>Transmission Type - </strong> ' . $car['transmission_type'] . '</p>';
                    echo '<p><strong>Fuel Type - </strong> ' . $car['fuel_type'] . '</p>';
                    echo '<p><strong>Body Type - </strong> ' . $car['body_type'] . '</p>';
                    echo '<p><strong>Number Plate - </strong> ' . $car['number_plate'] . '</p>';

                }
                ?>
            </div>

            <div class="col-md-6" style="margin-bottom: 2rem;">
                <h2 class="text-center text-secondary" style="margin-bottom: 2rem;">Order Here</h2>
                <form action="process-booking.php?car_id=<?php echo $car_id; ?>" method="post">

                    <div class="mb-3 row">
                        <div class="col-3">
                            <label for="customerID" class="form-label">Customer ID</label>
                            <input type="text" class="form-control" name="customerID" value="<?php echo $customer_id; ?>" readonly>
                        </div>
                        <div class="col-9">
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="customerName" value="<?php echo $customer_name; ?>" readonly>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="customerEmail" class="form-label">Customer Email</label>
                        <input type="email" class="form-control" name="customerEmail" value="<?php echo $customer_email; ?>" readonly>
                    </div>
                    <hr class="my-4">


                    <div class="mb-3">
                        <label for="pickupDate" class="form-label">Pickup Date</label>
                        <input type="date" class="form-control" name="pickupDate" required>
                    </div>


                    <div class="mb-3">
                        <label for="returnDate" class="form-label">Return Date</label>
                        <input type="date" class="form-control" name="returnDate" required>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Payment Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentType" id="paymentPerDay" value="per_day" checked>
                            <label class="form-check-label" for="paymentPerDay">
                                Pay Per Day
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentType" id="paymentPerKm" value="per_km">
                            <label class="form-check-label" for="paymentPerKm">
                                Pay Per Kilometer
                            </label>
                        </div>
                    </div>


                    <div class="mb-3" id="kmInput" style="display: none;">
                        <label for="kilometers" class="form-label">Number of Kilometers</label>
                        <input type="number" class="form-control" name="kilometers" id="kilometers">
                    </div>


                    <div class="mb-3" id="priceInfo">
                        <label for="price" class="form-label">Total Price</label>
                        <input type="text" class="form-control" name="price" id="price" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Payment Method</label>
                        <select class="form-select" name="paymentMethod" required>
                            <option value="cash">Cash On Delivery</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Confirm Booking</button>
                </form>
            </div>


            <script>
                const paymentPerDayRadio = document.getElementById("paymentPerDay");
                const paymentPerKmRadio = document.getElementById("paymentPerKm");
                const kmInput = document.getElementById("kmInput");

                paymentPerDayRadio.addEventListener("change", function() {
                    kmInput.style.display = "none";
                });

                paymentPerKmRadio.addEventListener("change", function() {
                    kmInput.style.display = "block";
                });
            </script>

            <script>
                function calculatePrice() {
                    var price = 0;
                    var paymentType = document.querySelector('input[name="paymentType"]:checked').value;
                    var priceInput = document.getElementById('price');

                    if (paymentType === 'per_day') {
                        var pickupDate = new Date(document.querySelector('input[name="pickupDate"]').value);
                        var returnDate = new Date(document.querySelector('input[name="returnDate"]').value);

                        if (pickupDate.toDateString() === returnDate.toDateString()) {
                            var pricePerDay = <?php echo $car_price_per_day; ?>;
                            price = pricePerDay;
                        } else {
                            var daysDifference = (returnDate - pickupDate) / (1000 * 60 * 60 * 24);
                            var pricePerDay = <?php echo $car_price_per_day; ?>;
                            price = daysDifference * pricePerDay;
                        }
                    } else if (paymentType === 'per_km') {
                        var kilometers = parseFloat(document.querySelector('input[name="kilometers"]').value);
                        var pricePerKm = <?php echo $car['price_per_km']; ?>;
                        price = kilometers * pricePerKm;
                    }

                    priceInput.value = price.toFixed(2);
                }

                document.querySelector('input[name="paymentType"]').addEventListener('change', function() {
                    var kmInput = document.getElementById('kilometers');
                    var priceInput = document.getElementById('price');

                    if (this.value === 'per_km') {
                        kmInput.disabled = false;
                    } else {
                        kmInput.disabled = true;
                        calculatePrice();
                    }
                    priceInput.value = "";
                });

                document.querySelector('input[name="pickupDate"]').addEventListener('change', calculatePrice);
                document.querySelector('input[name="returnDate"]').addEventListener('change', calculatePrice);
                document.querySelector('input[name="kilometers"]').addEventListener('input', calculatePrice);
            </script>
</body>

</html>