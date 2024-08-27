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
    <style>
        body {
            background: #fbc257 !important;
        }

        .container {
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            background: #fff9e6;
        }


        .form-control {
            border: none;
            border-bottom: 2px solid #ced4da;

            border-radius: 0;

            padding: 10px;
            transition: border-color 0.3s ease-in-out;
            background: none;

        }


        .form-control:hover {
            border-color: #341413;
            background: none;

        }


        .form-control:focus {
            border-color: #341413 !important;

            box-shadow: none;
            background: none;

        }


        .form-select {
            border: none;
            border-bottom: 2px solid #ced4da;

            border-radius: 0;

            padding: 10px;

            transition: border-color 0.3s ease-in-out;
            background: none;
            color: #777;

        }


        .form-select:hover {
            border-color: #341413;

        }


        .form-select:focus {
            border-color: #341413 !important;
            box-shadow: none;
        }

        .form-select-icon {
            background: #555;
        }

        .form-check-input{
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <?php require 'components/nav.php'; ?>

    <div class="container" style="margin-top: 3rem; margin-bottom: 2rem;" data-aos="zoom-in-up"> 
        <h3 class="text-warning text-center mb-4" style="color: #fbc257!important; background: #341413; padding: 10px; border-radius:10px;">Add a New Car</h3>
        <form action="process-car-insert.php" method="post">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" id="carName" name="car_name" placeholder="Car Name" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="yearRegistration" name="year_of_registration" placeholder="Registration Year" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="number" step="any" class="form-control" id="carPrice" name="car_price_per_day" placeholder="Car Price Per Day" required>
                </div>

                <div class="col">
                    <input type="number" step="any" class="form-control" id="price_per_km" name="price_per_km" placeholder="Price per Km" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">

                    <input type="number" step="any" class="form-control" id="mileage" name="mileage" placeholder="Mileage" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="carColor" name="car_color" placeholder="Car Color" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="number" class="form-control" id="numSeats" name="number_of_seats" placeholder="Number of Seats" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" id="numDoors" name="number_of_doors" placeholder="Number of Doors" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" id="engineType" name="engine_type" placeholder="Engine Type" required>
                </div>
                <div class="col">
                    <input type="number" step="any" class="form-control" id="tankCapacity" name="tank_capacity" placeholder="Tank Capacity" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" id="horsepower" name="horse_power" placeholder="Horsepower" required>
                </div>
                <div class="col">
                    <select class="form-select" id="transmissionType" name="transmission_type" required>
                        <option value="" disabled selected>Choose Transmission Type</option>
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                        <option value="Semi-Automatic">Semi-Automatic</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <select class="form-select" id="fuelType" name="fuel_type" required>
                        <option value="" disabled selected>Choose Fuel Type</option>
                        <option value="Gasoline">Gasoline</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Electric">Electric</option>
                        <option value="Hybrid">Hybrid</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" id="bodyType" name="body_type" required>
                        <option value="" disabled selected>Choose Body Type</option>
                        <option value="Sedan">Sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="Pickup Truck">Pickup Truck</option>
                        <option value="Coupe">Coupe</option>
                        <option value="Hatchback">Hatchback</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" id="numberPlate" name="number_plate" placeholder="Number Plate" required>
                </div>

                <div class="col" style="height: 2rem;">
                    <input type="file" class="form-control" id="car_img_input" accept="image/*">
                    <p id="image_path" style="display: none;" class="form-text text-muted"></p>
                    <input type="hidden" id="car_img" name="car_img" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div class="form-check">
                        <label for="rented" class="form-label">Check if Rented</label>
                        <input class="form-check-input" type="checkbox" id="rented" name="rented" value="1" disabled>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-warning w-100">Add Car</button>
        </form>
    </div>

    <script>
        const carImgInput = document.getElementById('car_img_input');
        const imagePath = document.getElementById('image_path');
        const carImgField = document.getElementById('car_img');

        carImgInput.addEventListener('change', (e) => {
            const file = carImgInput.files[0];
            if (file) {

                carImgField.value = 'imgs/cars/' + file.name;

                imagePath.textContent = carImgField.value;
                imagePath.style.display = 'block';
            } else {
                imagePath.style.display = 'none';
                carImgField.value = '';
            }
        });
    </script>



    <?php require 'components/scripts-links.php'; ?>
</body>

</html>