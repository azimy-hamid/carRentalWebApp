<footer class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-box">
                    <a class="navbar-brand link-light" href="index.php" style="font-size: 28px;"><span class="text-warning">DriveJoy </span>Car Rentals</a>
                    <p>We are currently exclusively available in Quetta, Pakistan. However, dedecated to provide relliable service all across Pakistan.
                    </p>
                    <h2 class="text-warning">We Accept</h2>
                    <div class="card-area">
                        <h3>&rarr; Cash On Delivery</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-lg-6">
                <div class="single-box">
                    <h2 class="text-warning">Terms & Policy</h2>
                    <p>When utilizing DriveJoy Car Rentals, you acknowledge the terms, including driver requirements, payment policies, and return responsibilities. Please be aware that a 1000 PKR charge will apply for late car returns, beyond the base fee, upon return. Review these conditions before finalizing your reservation; agreement is required. Currently, our online transaction process is in progress. During this period, it's important to note that we only accept cash. Additionally, upon delivery, we will request your Identity Card.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-box">
                    <h2 class="text-warning">Employee <?php echo isset($_SESSION['employee_id']) ? 'Logout' : 'Login'; ?></h2>
                    <p><?php echo isset($_SESSION['employee_id']) ? 'Click to log out from your account.' : 'Login to access employee-related content and features.'; ?></p>

                    <?php if (isset($_SESSION['employee_id'])) : ?>
                        <a class="btn btn-outline-warning mb-3 w-100" href="employee-logout.php">Employee Logout</a>
                    <?php else : ?>
                        <a class="btn btn-outline-warning mb-3 w-100" href="admin-login-form.php">Employee Login</a>
                    <?php endif; ?>
                    <h2 class="text-warning">Follow us on</h2>
                    <p class="socials">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-dribbble"></i>
                        <i class="fab fa-pinterest"></i>
                        <i class="fab fa-twitter"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>