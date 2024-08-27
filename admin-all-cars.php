<?php
session_start();


if (!isset($_SESSION['employee_id'])) {
    header("Location: admin-login-form.php");
    exit;
}

require 'connection.php';
$conn = Connect();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'components/meta-data.php'; ?>
</head>

<body>
    <?php require 'components/nav.php'; ?>

    <div class="container section-padding mt-5" >
        <h3 class="text-warning text-uppercase text-center mb-4" style="color: #fbc257!important; background: #341413; padding: 10px; border-radius:10px;">All cars</h3>
        <div class="menu-content row">
            <?php
            $sql = "SELECT * FROM cars"; 
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $car_id = $row["car_id"];
                    $car_name = $row["car_name"];
                    $car_price_per_day = $row["car_price_per_day"];
                    $car_img = $row["car_img"];
                    $year_of_registration = $row["year_of_registration"];
                    $number_plate = $row["number_plate"];
                    $mileage = $row["mileage"];
                    $car_color = $row["car_color"];
                    $fuel_type = $row["fuel_type"];
                    $body_type = $row["body_type"];
                    $number_of_seats = $row["number_of_seats"];
                    $number_of_doors = $row["number_of_doors"];
                    $engine_type = $row["engine_type"];
                    $tank_capacity = $row["tank_capacity"];
                    $horse_power = $row["horse_power"];
                    $transmission_type = $row["transmission_type"];
                    $price_per_km = $row["price_per_km"];
                    $rented = $row["rented"];


                    $badgeClass = $rented ? 'bg-success' : 'bg-warning';
                    $rentedStatus = $rented ? 'Rented' : 'Available';


            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="position-relative">
                                <span class="badge position-absolute top-0 end-0 <?php echo $badgeClass; ?>" style="font-size: 1rem;"><?php echo $rentedStatus; ?></span>
                                <img class="card-img-top" src="<?php echo $car_img; ?>" alt="Car Image" style="width: 100%; height: 270px; object-fit: cover;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title border-bottom pb-2"><strong><?php echo $year_of_registration; ?> <?php echo $car_name; ?></strong></h5>
                                <p class="card-text"><strong>Price Per Day - </strong> Rs. <?php echo $car_price_per_day; ?></p>
                                <p class="card-text"><strong>Price Per Km - </strong> Rs. <?php echo $price_per_km; ?></p>
                                <p class="card-text"><strong>Number Plate - </strong> <?php echo $number_plate; ?></p>
                                <p class="card-text"><strong>Mileage - </strong> <?php echo $mileage; ?> km</p>
                                <p class="card-text"><strong>Car Color - </strong> <?php echo $car_color; ?></p>
                                <p class="card-text"><strong>Fuel Type - </strong> <?php echo $fuel_type; ?></p>
                                <p class="card-text"><strong>Body Type - </strong> <?php echo $body_type; ?></p>
                                <p class="card-text"><strong>Number of Seats - </strong> <?php echo $number_of_seats; ?></p>
                                <p class="card-text"><strong>Number of Doors - </strong> <?php echo $number_of_doors; ?></p>
                                <p class="card-text"><strong>Engine Type - </strong> <?php echo $engine_type; ?></p>
                                <p class="card-text"><strong>Tank Capacity - </strong> <?php echo $tank_capacity; ?></p>
                                <p class="card-text"><strong>Horsepower - </strong> <?php echo $horse_power; ?></p>
                                <p class="card-text"><strong>Transmission Type - </strong> <?php echo $transmission_type; ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col">
                    <h1 class="text-center">No cars available :(</h1>
                </div>
            <?php
            }
            ?>
        </div>
    </div>


    <?php
    require 'components/scripts-links.php'
    ?>


</body>

</html>