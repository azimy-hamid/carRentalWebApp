CREATE TABLE
    cars (
        car_id INT AUTO_INCREMENT PRIMARY KEY,
        car_name VARCHAR(255) NOT NULL,
        car_price_per_day DECIMAL(10, 2) NOT NULL,
        car_img VARCHAR(255) NOT NULL,
        year_of_registration VARCHAR(255),
        number_plate VARCHAR(50),
        mileage DECIMAL(10, 2),
        car_color VARCHAR(50),
        fuel_type VARCHAR(50),
        body_type VARCHAR(50),
        number_of_seats INT,
        number_of_doors INT,
        engine_type VARCHAR(50),
        tank_capacity DECIMAL(10, 2),
        horse_power VARCHAR(50),
        transmission_type VARCHAR(50),
        price_per_km DECIMAL(10, 2),
        rented BOOLEAN DEFAULT 0
    );

INSERT INTO
    cars (
        car_name,
        year_of_registration,
        car_price_per_day,
        price_per_km,
        mileage,
        car_color,
        number_of_seats,
        number_of_doors,
        engine_type,
        tank_capacity,
        horse_power,
        transmission_type,
        fuel_type,
        body_type,
        number_plate,
        car_img
    )
VALUES
    (
        'Toyota Tacoma TRD pro',
        '2023',
        7000.00,
        300.00,
        15677.00,
        'Sand',
        4,
        4,
        'Turbocharged 2.4-liter Four-Cylinder',
        21.10,
        '278 horsepower - 317 lb-ft Torque',
        'Semi-Automatic',
        'Diesel',
        'Pickup Truck',
        'CX-5501',
        'imgs/cars/toyota-tacoma.jpg'
    ),
    (
        'Land Rover Range Rover',
        '2012',
        10000.00,
        500.00,
        10000.00,
        'White',
        7,
        5,
        '5.0L V8 375 lb-ft',
        84.00,
        '375 hp',
        'Automatic',
        'Gasoline',
        'SUV',
        'KU-4101',
        'imgs/cars/Land Rover Range Rover.jpg'
    ),
    (
        'Toyota GT86',
        '2019',
        5000.00,
        200.00,
        13555.00,
        'Red',
        2,
        2,
        '2.0-liter flat-four 156 lb-ft',
        13.20,
        '200hp',
        'Manual',
        'Gasoline',
        'Sedan',
        'JQ-1001',
        'imgs/cars/toyota-gt86.jpg'
    ),
    (
        'Toyota Camry',
        '2023',
        4000.00,
        300.00,
        21765.00,
        'Space Black',
        4,
        4,
        '2.5-liter Dynamic Force four-cylinder',
        14.40,
        '203hp',
        'Automatic',
        'Hybrid',
        'Sedan',
        'JB-2001',
        'imgs/cars/toyota-camry.jpg'
    );

CREATE TABLE
    employees (
        employee_id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
    );

INSERT INTO
    employees (first_name, last_name, email, password)
VALUES
    (
        'Hamid',
        'Azimy',
        'hamidazimy875@gmail.com',
        PASSWORD ('password', PASSWORD_DEFAULT)
    );

CREATE TABLE
    customers (
        customer_id INT AUTO_INCREMENT PRIMARY KEY,
        customer_username VARCHAR(255),
        customer_name VARCHAR(255),
        customer_phone VARCHAR(20),
        customer_email VARCHAR(255),
        customer_address VARCHAR(255),
        customer_password VARCHAR(255)
    );

INSERT INTO
    customers (
        customer_username,
        customer_name,
        customer_phone,
        customer_email,
        customer_address,
        customer_password
    )
VALUES
    (
        'ethanhunt',
        'Ethan Hunt',
        '03158867556',
        'ethanhunt@gmail.com',
        '98 Shirley Street PIMPAMA QLD 4209',
        PASSWORD ('password', PASSWORD_DEFAULT)
    ),
    (
        'shahinazimy',
        'Shahin Azimy',
        '03158867556',
        'shahinazimy875@gmail.com',
        '98 Shirley Street PIMPAMA QLD 4209',
        PASSWORD ('password', PASSWORD_DEFAULT)
    );

CREATE TABLE
    orders (
        order_id INT AUTO_INCREMENT PRIMARY KEY,
        car_id INT NOT NULL,
        customer_id INT NOT NULL,
        pickup_date DATE NOT NULL,
        return_date DATE NOT NULL,
        payment_type VARCHAR(255) NOT NULL,
        kilometers DECIMAL(10, 2),
        price DECIMAL(10, 2) NOT NULL,
        payment_method VARCHAR(255) NOT NULL,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (car_id) REFERENCES cars (car_id),
        FOREIGN KEY (customer_id) REFERENCES customers (customer_id)
    );

CREATE TABLE
    all_orders (
        order_id INT AUTO_INCREMENT PRIMARY KEY,
        car_id INT NOT NULL,
        customer_id INT NOT NULL,
        pickup_date DATE NOT NULL,
        return_date DATE NOT NULL,
        payment_type VARCHAR(255) NOT NULL,
        kilometers DECIMAL(10, 2),
        price DECIMAL(10, 2) NOT NULL,
        payment_method VARCHAR(255) NOT NULL,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (car_id) REFERENCES cars (car_id),
        FOREIGN KEY (customer_id) REFERENCES customers (customer_id),
        is_returned BOOLEAN DEFAULT FALSE,
        brought_back_date DATE
    );