<?php
session_start();
require 'connection.php';
$conn = Connect();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'components/meta-data.php' ?>
    <link rel="stylesheet" href="admin-login-form.php">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
        }

        body {
            overflow: hidden;
        }

        .login-signup-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fbc257 !important;
        }

        .container {
            display: flex;
            position: relative;
            max-width: 850px;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            perspective: 2700px;
            margin: 20px;
            /* Added margin */
        }

        .form {
            flex: 1;
            padding: 40px 30px !important;
        }

        .signup-form {
            flex: 1;
            background: #fbc257;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 20px;
        }

        .signup-form img {
            max-width: 100%;
            height: auto;
        }

        .form-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .login-form,
        .signup-form {
            width: calc(100% / 2 - 25px);
        }

        .form .form-content .title {
            position: relative;
            font-size: 24px;
            font-weight: 500;
            color: #341413;
        }

        .form .form-content .title::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 35px;
            background-color: #341413;
        }

        .form .form-content .signup-form .title::before {
            width: 20px;
        }

        .form .form-content .input-boxes {
            margin-top: 50px;
        }

        .form .form-content .input-box {
            display: flex;
            align-items: center;
            height: 50px;
            width: 100%;
            margin: 10px 0;
            position: relative;
        }

        .form-content .input-box input {
            height: 100%;
            width: 100%;
            outline: none;
            border: none;
            padding: 0 30px;
            font-size: 16px;
            font-weight: 500;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .form-content .input-box input:focus,
        .form-content .input-box input:valid {
            border-color: #341413;
        }

        .form-content .input-box i {
            position: absolute;
            color: #341413;
            font-size: 16px;
        }

        .form .form-content .input-boxes .button {
            color: #fff;
            margin-top: 40px;
        }

        .form .form-content .text {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .form .form-content .text a {
            text-decoration: none;
        }

        .form .form-content .text a:hover {
            text-decoration: underline;
        }

        .form .form-content .input-boxes .button input {
            color: #fff;
            background: #341413 !important;
            border-radius: 6px;
            padding: 0;
            cursor: pointer;
            transition: all 0.4 ease;
            border-bottom: none;
        }

        .form .form-content .input-boxes .button input:hover {
            background: #fbc257 !important;
            color: #341413;
        }

        .form .form-content label {
            color: #fbc257;
            cursor: pointer;
        }

        .form .form-content label:hover {
            text-decoration: underline;
        }

        .form .form-content .sign-up-text,
        .form .form-content .login-text {
            margin-top: 25px;
        }

        .alert {
            padding: 0.75rem 1.25rem !important;
        }
    </style>
</head>

<body>
    <?php
    require 'components/nav.php'
    ?>

    <section class="login-signup-section">
        <div class="container" data-aos="zoom-in-up">
            <div class="form">
                <div class="form-content">
                    <div class="login-form">
                        <div class="title">
                            Employee Login
                        </div>
                        <form action="process-employee-login.php" method="post">
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
                            </div>
                        </form>
                    </div>

                    <!-- Sign Up -->
                    <div class="signup-form">
                        <div class="front">
                            <img src="imgs/front-customer-login.png" alt="">
                        </div>
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