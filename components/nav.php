<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><span class="text-warning">DriveJoy </span>Car Rentals</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <?php
        if (isset($_SESSION['employee_id'])) {
            // Assuming you have a database connection established
            $employee_id = $_SESSION['employee_id'];
            $sql = "SELECT first_name FROM employees WHERE employee_id = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("i", $employee_id);
            $stmt->execute();

            $stmt->bind_result($employeeName);
            $stmt->fetch();

            $stmt->close();

        ?>

            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active text-warning" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="admin-signup-form.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            New Employee
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="admin-signup-form.php">Add an Employee</a></li>
                            <li><a class="dropdown-item" href="remove-employee.php">Remove employee</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="admin-all-employees.php">All Employee</a></li>
                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="admin-logged-in.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Add New Cars
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="admin-logged-in.php">Add a car</a></li>
                            <li><a class="dropdown-item" href="car-database.php">Remove a car</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="admin-all-cars.php">All Cars</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="admin-all-orders.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Orders
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="admin-all-orders.php">All Orders</a></li>
                            <li><a class="dropdown-item" href="admin-return-car.php">Return an Order</a></li>
                        </ul>
                    </li>

                </ul>
                <form>
                    <span class="me-2 btn btn-light" style="pointer-events: none;">Welcome <?php echo $employeeName; ?></span>
                    <a class="btn btn-outline-warning" href="employee-logout.php">Employee Logout</a>
                </form>
            </div>

        <?php
        } else if (isset($_SESSION['customer_id'])) {

            $customer_id = $_SESSION['customer_id'];
            $sql = "SELECT customer_name FROM customers WHERE customer_id = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("i", $customer_id);
            $stmt->execute();

            $stmt->bind_result($customerName);
            $stmt->fetch();

            $stmt->close();

        ?>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active text-warning" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer-logged-in.php">Current Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="customer-order-history.php">Order History</a>
                    </li>
                </ul>
                <form>
                    <span class="me-2 btn btn-light" style="pointer-events: none;">Welcome <?php echo $customerName; ?></span>
                    <a class="btn btn-warning" href="process-customer-logout.php">Customer Logout</a>
                </form>
            </div>


        <?php
        } else {
        ?>

            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active text-warning" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#card-section">Our Cars</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials-section">Testimonials</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#faq-section">FAQs</a>
                    </li>
                </ul>
                <form>
                    <a class="btn btn-warning" href="customer-login-form.php">Customer Login</a>
                </form>
            </div>
        <?php   }
        ?>



    </div>
</nav>