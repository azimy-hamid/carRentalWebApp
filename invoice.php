<?php
session_start();

require 'connection.php';
$conn = Connect();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];


    $sqlOrder = "SELECT * FROM all_orders WHERE order_id = ?";
    $stmtOrder = $conn->prepare($sqlOrder);

    if (!$stmtOrder) {
        die("Prepare failed: " . $conn->error);
    }

    $stmtOrder->bind_param("i", $order_id);
    $stmtOrder->execute();

    if ($stmtOrder->error) {
        die("Execute failed: " . $stmtOrder->error);
    }

    $order_result = $stmtOrder->get_result();

    if ($order_result->num_rows > 0) {
        $order = $order_result->fetch_assoc();

        $sqlCustomer = "SELECT * FROM customers WHERE customer_id = ?";
        $stmtCustomer = $conn->prepare($sqlCustomer);

        if (!$stmtCustomer) {
            die("Prepare failed: " . $conn->error);
        }

        $stmtCustomer->bind_param("i", $order['customer_id']);
        $stmtCustomer->execute();

        if ($stmtCustomer->error) {
            die("Execute failed: " . $stmtCustomer->error);
        }

        $customer_result = $stmtCustomer->get_result();

        if ($customer_result->num_rows > 0) {
            $customer = $customer_result->fetch_assoc();
        } else {
            echo "Customer not found for customer ID: " . $order['customer_id'];
            exit;
        }


        $sqlCar = "SELECT * FROM cars WHERE car_id = ?";
        $stmtCar = $conn->prepare($sqlCar);

        if (!$stmtCar) {
            die("Prepare failed: " . $conn->error);
        }

        $stmtCar->bind_param("i", $order['car_id']);
        $stmtCar->execute();

        if ($stmtCar->error) {
            die("Execute failed: " . $stmtCar->error);
        }

        $car_result = $stmtCar->get_result();

        if ($car_result->num_rows > 0) {
            $car = $car_result->fetch_assoc();
        } else {
            echo "Car not found for car ID: " . $order['car_id'];
            exit;
        }


        $returnDate = strtotime($order['return_date']);
        $pickupDate = strtotime($order['pickup_date']);
        $currentDate = time(); 
        $isReturned = $order['is_returned'];
        $broughtBackDate = strtotime($order['brought_back_date']);

        if (!$isReturned) {
            $daysLate = max(0, floor(($currentDate - $returnDate) / (60 * 60 * 24)));
        } else {
            $daysLate = max(0, floor(($broughtBackDate - $returnDate) / (60 * 60 * 24)));
        }

        $lateFeePerDay = 1000; 

        $lateFee = $daysLate * $lateFeePerDay;

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <?php require 'components/meta-data.php' ?>
            <style>
                body {
                    background: #fbc257 !important;

                }

                .invoice {
                    background: #fff9e6;
                    padding: 1rem;
                    border-radius: 10px;
                    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                }

                .renting {
                    background-color: #341413 !important;
                    color: #ffffff !important;
                }

                .renting:hover {
                    background-color: #ffc107 !important;
                    color: #341413 !important;
                }
            </style>
        </head>

        <body>
            <?php require 'components/nav.php' ?>

            <section class="container" style="margin-top: 3rem; margin-bottom: 2rem;">
                <div class="alert alert-warning text-center font-weight-bold mt-3" role="alert" style="box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2); border-radius: 10px;">
                    <?php
                    if ($order["is_returned"] != 0) {
                        echo "Car returned. Amount Recieved. Invoice closed!";
                    } else {
                        echo "Invoice pending! Price Increasing!";
                    }
                    ?>
                </div>

                <div class="invoice">
                    <div class="header">
                        <div class="row">
                            <div class="col">
                                <h2 class="font-weight-bold"><span class="text-warning text-uppercase">DriveJoy</span> CAR RENTALS</h2>
                            </div>
                            <div class="col text-right">
                                <h2 class="font-weight-bold text-warning">INVOICE</h2>
                                <p><?php echo date('F j, Y', strtotime($order['order_date'])); ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="font-weight-bold">INVOICE NO: <?php echo $order_id; ?></p>
                            </div>
                            <div class="col text-right mb-5">
                                <span class="font-weight-bold">To: </span><?php echo $customer['customer_address']; ?><br>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">DESCRIPTION</th>
                                    <th scope="col">DAYS/KILOMETERS</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col" class="text-right">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="font-weight-bold">
                                            <?php echo $car['year_of_registration']; ?>
                                            <?php echo $car['car_name']; ?><br />
                                            <?php echo $car['number_plate']; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold text-uppercase">
                                            <?php
                                            $carPricingMethod = $order['payment_type'];
                                            $numberOfKms = $order['kilometers'];
                                            $carPricePerDay = $car['car_price_per_day'];
                                            $carPricePerKm = $car['price_per_km'];
                                            $numberOfDays = ($returnDate - $pickupDate) / (60 * 60 * 24);

                                            if ($carPricingMethod === 'per_day') {
                                                echo $numberOfDays;
                                            } elseif ($carPricingMethod === 'per_km') {
                                                echo $numberOfKms;
                                            } else {
                                                echo "Invalid pricing method";
                                            }
                                            ?>

                                        </p>
                                    </td>

                                    <td>
                                        <p class="font-weight-bold text-uppercase">
                                            <?php echo $order['payment_type']; ?><br />
                                        </p>
                                    </td>
                                    <td>
                                        <p class="font-weight-bold text-uppercase">
                                            <?php

                                            if ($carPricingMethod === 'per_day') {
                                                echo $carPricePerDay;
                                            } elseif ($carPricingMethod === 'per_km') {
                                                echo $carPricePerKm;
                                            } else {
                                                echo "Invalid pricing method";
                                            }
                                            ?>

                                        </p>
                                    </td>
                                    <td class="text-right"><?php echo number_format($order['price'], 2); ?> PKR</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="font-weight-bold">
                                            <?php
                                            echo $daysLate . " Day(s) Late";
                                            ?>
                                        </p>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">
                                        <?php

                                        if ($carPricingMethod === 'per_day') {
                                            if ($daysLate != 0) {
                                                $final_late_fee = $lateFee + ($carPricePerDay * $daysLate);
                                                echo number_format($final_late_fee, 2) . " PKR";
                                            } else {
                                                $final_late_fee = $lateFee;
                                                echo number_format($final_late_fee, 2) . " PKR";
                                            }
                                        } elseif ($carPricingMethod === 'per_km') {

                                            if ($daysLate != 0) {
                                                $final_late_fee = $lateFee;
                                                echo number_format($final_late_fee, 2) . " PKR";
                                            } else {
                                                $final_late_fee = $lateFee;
                                                echo number_format($final_late_fee, 2) . " PKR";
                                            }
                                        } else {
                                            echo "Invalid pricing method";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col">
                                <p></p>
                            </div>
                            <div class="col">
                                <p></p>
                            </div>
                            <div class="col text-right">
                                <p class="font-weight-bold">Sub Total</p>
                                <p class="font-weight-bold">Tax 10%</p>
                            </div>
                            <div class="col text-right">
                                <p>PKR <?php
                                        $subTotal = $order['price'] + $final_late_fee;
                                        echo number_format($subTotal, 2); ?></p>
                                <p>PKR <?php
                                        $tax = $subTotal * 0.10; // Calculate 10% tax
                                        echo number_format($tax, 2);
                                        ?></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <p></p>
                            </div>
                            <div class="col">
                                <p></p>
                            </div>
                            <div class="col">
                                <p></p>
                            </div>
                            <div class="col text-right">
                                <p class="font-weight-bold">GRAND TOTAL:</p>
                            </div>
                            <div class="col text-right">
                                <p class="font-weight-bold">PKR <?php
                                                                $grandTotal = $subTotal + $tax;
                                                                echo number_format($grandTotal, 2);
                                                                ?></p>
                            </div>
                        </div>
                    </div>
                    <hr class="dropdown-devider">
                    <div class="footer">
                        <div class="row">
                            <div class="col">
                                <p class="font-weight-bold">Payment Method</p>
                                <p class="text-uppercase"><?= $order['payment_method'] . " &rarr; " . $order['payment_type'] ?></p>
                            </div>
                            <div class="col text-right">
                                <p class="font-weight-bold">Terms and Conditions</p>
                                <p>Thank you for choosing our service. </br> Payment is due upon delivery. </br>Late payments may be subject to a fee.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col text-right">
                            <a href="index.php" class="btn btn-warning w-100 renting">Continue Renting</a>
                        </div>
                    </div>
                </div>
            </section>

        </body>

        </html>

<?php
    } else {
        echo "Order not found for order ID: $order_id";
        exit;
    }

    $stmtOrder->close();
} else {
    echo "Order ID is missing.";
    exit;
}
?>