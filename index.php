<?php
session_start();
require 'connection.php';
$conn = Connect();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'components/meta-data.php' ?>
    <link rel="stylesheet" href="style.css">
    <style>
        h1,
        h2,
        h3,
        h4,
        h5 {
            color: #341413;
        }

        .hero {
            margin-top: 3rem;
            margin-bottom: 5rem;
        }

        .text-label,
        .text-hero-bold,
        .text-hero-regular {
            margin: 24px 0;
        }

        .text-label {
            color: #ffc107;
            font-size: 16px;
            font-weight: 400;
            line-height: 20px;
        }

        .text-hero-bold {
            color: #341413;
            font-size: 54px;
            font-weight: 700;
            line-height: 74px;
        }

        .text-hero-regular {
            color: #798092;
            font-size: 16px;
            font-weight: 400;
            line-height: 31px;
        }

        .hero-btn {
            color: #341413;
            padding: 10px 35px;
            border-radius: 6px;
            font-size: 18px;
            font-weight: 500;
        }

        .accordion-item {
            color: #341413;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .accordion-button {
            color: #341413;
            background-color: #FBC257;
        }

        .accordion-button:focus,
        .accordion-button:hover {
            color: #341413;
            background-color: #FBC257;
        }

        .accordion-body {
            background-color: #fff;
            border-radius: 5px;
            color: #000;
        }

        .accordion-button:not(.collapsed) {
            background-color: #FBC257;
            color: #341413;
        }

        .swiper-client-msg {
            height: 200px;
            overflow: auto;
        }

        .swiper-client-msg::-webkit-scrollbar {
            width: 6px;
        }
    </style>
</head>

<body>
    <?php
    require 'components/nav.php'
    ?>
    <!-- HERO SECTION STARTS -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copy" data-aos="fade-up">
                        <div class="text-label">
                            Smiles Included!
                        </div>

                        <div class="text-hero-bold">
                            Elevate Your Travel Experience, Ignite Joy in Every Mile.
                        </div>
                        <div class="text-hero-regular">
                            Unlock Your Journey: Embark on Unforgettable Adventures with Our Premium Car Rental Services – Where Quality Meets Comfort, and Every Mile is a Memory
                        </div>
                        <div class="cta">
                            <a href="customer-login-form.php" class="btn btn-warning shadow-none hero-btn">Let us take you to the places you've never been before!</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex align-items-center" data-aos="fade-up">
                    <img src="imgs/hero.jpg" alt="hero-img" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- HERO SECTION ENDS -->

    <!-- BRAND SECTION STARTS -->
    <section class="testimonial-brand mb-5" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5 mb-5 text-center">
                    <img src="imgs/hero-brands.svg" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- BRAND SECTION ENDS -->

    <!-- about section starts -->
    <!-- </div> -->
    <section class="about section-padding" id="about" data-aos="fade-up">
        <div class="container">
            <h2 class="common-heading mb-5">About Us</h2>

            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="about-img mt-4">
                        <img alt="" class="img-fluid rounded" src="imgs/about-pic.jpg">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-4">
                    <div class="about-text">
                        <h2 class="mb-3">Nurturing Joyful Travels with Every Ride.</h2>
                        <p>Explore the joy of the open road with DriveJoy Car Rentals. From weekend getaways to extended vacations, our diverse fleet awaits your next adventure. Enjoy hassle-free rentals, exceptional service, and create memories that last a lifetime. Experience the DriveJoy difference – where satisfaction meets the road. Your partner in joyful travel awaits to make every journey unforgettable.</p>
                        <a class="btn btn-warning" href="customer-login-form.php">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section Ends -->
    <!-- Card section starts -->

    <div class="container section-padding mb-5" id="card-section" data-aos="fade-up">
        <h2 class="common-heading mb-5">Available Cars</h2>
        <div class="menu-content row">
            <?php
            $sql = "SELECT * FROM cars LIMIT 3"; 
            $result = mysqli_query($conn, $sql);

            $displayedCars = 0; 

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

                    $badgeClass = $rented ? 'bg-secondary' : 'bg-dark';
                    $rentedStatus = $rented ? 'On Rent' : 'Available';

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
                                <?php
                                if ($rented) {
                                    echo '<button type="button" class="btn btn-secondary w-100" disabled>Car Rented</button>';
                                } else {
                                    echo '<a href="booking-page.php?car_id=' . $car_id . '" class="btn btn-warning w-100">Rent Car</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                    $displayedCars++;

                    if ($displayedCars >= 3) {
                        break; 
                    }
                }

                ?>
                <div class="col-md-12 text-center">
                    <a href="customer-index-all-cars.php" style="text-decoration: none; color: #341413;">See More Cars &rarr;</a>
                </div>
            <?php
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

    <!-- card section Ends -->
    <!-- testimonials section starts -->

    <section class="section section-testimonial container" id="testimonials-section" style="margin-bottom: 6rem;" data-aos="fade-up">
        <div class="mb-5">
            <h2 class="common-heading">Happy Client Works</h2>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Section Start -->
                <div class="swiper-slide">
                    <div class="client-container p-2">
                        <div class="swiper-client-msg mb-4">
                            <p>What a fantastic experience with DriveJoy Car Rentals! The website is user-friendly, and I found exactly the car I needed at a competitive rate. The pick-up and drop-off were seamless, and the customer support was responsive. I'll be recommending DriveJoy to my friends and family.</p>
                        </div>

                        <div class="swiper-client-data row justify-content-between">
                            <div class="col-sm-6 d-flex justify-content-end">
                                <figure class="m-0">
                                    <img src="imgs/testimonials-photos/testimonial-photo-1.jpg" alt="client One Photo">
                                </figure>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-start">
                                <div class="client-data-details p-0">
                                    <p style="margin: 0;"><strong>M. Fahim</strong></p>
                                    <p style="margin: 0; font-size: 14px;">Software Engineer</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Section End -->

                <!-- Section Start -->
                <div class="swiper-slide">
                    <div class="client-container p-2">
                        <div class="swiper-client-msg mb-4">
                            <p>DriveJoy Car Rentals made my trip so much smoother. The online reservation was quick, and I appreciated the transparent pricing. The car was in great condition, and the return process was a breeze. I'll definitely be using their services again.</p>
                        </div>

                        <div class="swiper-client-data row justify-content-between">
                            <div class="col-sm-6 d-flex justify-content-end">
                                <figure class="m-0">
                                    <img src="imgs/testimonials-photos/testimonial-photo-2.jpg" alt="client One Photo">
                                </figure>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-start">
                                <div class="client-data-details p-0">
                                    <p style="margin: 0;"><strong>Hamid Azimy</strong></p>
                                    <p style="margin: 0; font-size: 14px;">IT Expert</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Section End -->

                <!-- Section Start -->
                <div class="swiper-slide">
                    <div class="client-container p-2">
                        <div class="swiper-client-msg mb-4">
                            <p>I had an excellent experience with DriveJoy Car Rentals! The booking process was straightforward, and the selection of vehicles was impressive. The car was clean and well-maintained. The staff was friendly and helpful. I highly recommend DriveJoy for hassle-free car rentals!</p>
                        </div>

                        <div class="swiper-client-data row justify-content-between">
                            <div class="col-sm-6 d-flex justify-content-end">
                                <figure class="m-0">
                                    <img src="imgs/testimonials-photos/testimonial-photo-3.jpg" alt="client One Photo">
                                </figure>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-start">
                                <div class="client-data-details p-0">
                                    <p style="margin: 0;"><strong>Rose Lee</strong></p>
                                    <p style="margin: 0; font-size: 14px;">Doctor</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Section End -->


                <!-- Section Start -->
                <div class="swiper-slide">
                    <div class="client-container p-2">
                        <div class="swiper-client-msg mb-4">
                            <p>What a fantastic experience with DriveJoy Car Rentals! The website is user-friendly, and I found exactly the car I needed at a competitive rate. The pick-up and drop-off were seamless, and the customer support was responsive. I'll be recommending DriveJoy to my friends and family.</p>
                        </div>

                        <div class="swiper-client-data row justify-content-between">
                            <div class="col-sm-6 d-flex justify-content-end">
                                <figure class="m-0">
                                    <img src="imgs/testimonials-photos/testimonial-photo-4.jpg" alt="client One Photo">
                                </figure>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-start">
                                <div class="client-data-details p-0">
                                    <p style="margin: 0;"><strong>Isabella</strong></p>
                                    <p style="margin: 0; font-size: 14px;">Developer</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Section End -->

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- testimonials section Ends -->
    <!-- faq section starts -->

    <section class="container mb-5" data-aos="fade-up" id="faq-section">
        <div class="mb-5">
            <h2 class="common-heading">Frequently Asked Questions</h2>
        </div>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Which payment methods are supported?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Our online transaction is currently underway. In the meanwhile, please be aware that we exclusively accept cash, and upon delivery, we will collect your Identity Card.
                        <br>We appreciate your inquiry! &#128522;
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How to place an order?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>In order to place an order, </strong> you will have to sign up <em>or sign in if you already have an account</em> and then rent the car you want. <br>
                        More importantly, while choosing to pay the rent for each kilometer, remember that the car will stop once it has reached the desired number of kilometers.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        What are the charges on late returns?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Please be informed that for late car returns, a 1000 PKR charge (per day) will be added beyond the base fee, and this is applicable upon return.
                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php
    require 'components/footer.php'
    ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <?php
    require 'components/scripts-links.php'
    ?>
</body>

</html>