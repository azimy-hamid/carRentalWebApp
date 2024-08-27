<?php
session_start();
require 'connection.php';
$conn = Connect();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="customer-login-form.css">
    <?php require 'components/meta-data.php' ?>
</head>

<body>
    <?php
    require 'components/nav.php'
    ?>

    <section class="login-signup-section">
        <div class="container" data-aos="zoom-in-up">
            <input type="checkbox" id="flip" hidden>
            <div class="cover">
                <div class="front">
                    <img src="imgs/front-customer-login.png" alt="">
                </div>

                <div class="back">
                    <img class="back-img" src="imgs/back-customer-login.png" alt="">
                </div>

            </div>

            <div class="form">
                <div class="form-content">
                    <div class="login-form">
                        <div class="title">
                            Login
                        </div>
                        <form action="process-customer-login.php" method="post">
                            <div class="input-boxes">
                                <div class="input-box">
                                    <i class="fas fa-envelope"></i>
                                    <input type="text" name="email" placeholder="Enter you email" required>
                                </div>

                                <div class="input-box">
                                    <i class="fas fa-key"></i>
                                    <input type="password" name="password" placeholder="Enter you password" required>
                                </div>

                                <div class="button input-box">
                                    <input type="submit" value="Submit" required>
                                </div>


                                <div class="alert alert-warning mt-3" role="alert" id="loginError" style="display: <?php echo isset($_SESSION['login_error']) ? 'block' : 'none'; ?>">
                                    <?php echo isset($_SESSION['login_error']) ? $_SESSION['login_error'] : ''; ?>
                                </div>


                                <div class="text sign-up-text">Don't have an account? <label for="flip">Sign Up Now!</label></div>
                            </div>
                        </form>
                    </div>


                    <div class="signup-form">
                        <div class="title">
                            Sign Up
                        </div>
                        <form action="process-customer-signup.php" method="post">
                            <div class="input-boxes">
                                <div class="input-box">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="customer_username" placeholder="Username" required>
                                </div>

                                <div class="input-box">
                                    <i class="fas fa-user-plus"></i>
                                    <input type="text" name="customer_name" placeholder="Name" required>
                                </div>

                                <div class="input-box">
                                    <i class="fas fa-phone"></i>
                                    <input type="tel" name="customer_phone" placeholder="Phone Number" required>
                                </div>

                                <div class="input-box">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="customer_email" placeholder="Email" required>
                                </div>

                                <div class="input-box">
                                    <i class="fas fa-address-card"></i>
                                    <input type="text" name="customer_address" placeholder="Enter your address" required>
                                </div>

                                <div class="input-box">
                                    <i class="fas fa-key"></i>
                                    <input type="password" name="customer_password" placeholder="Enter you password" required>
                                </div>

                                <div class="button input-box">
                                    <input type="submit" value="Register" required>
                                </div>
                                <div class="text login-text">Already have an account? <label for="flip">Login!</label></div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php
    require 'components/scripts-links.php'
    ?>

</body>

</html>