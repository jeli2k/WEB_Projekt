-- this script creates the initial structure for the 'hotel' database

CREATE DATABASE IF NOT EXISTS hotel;

USE hotel;

-- create the 'news' table
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    text TEXT NOT NULL,
    date DATE DEFAULT CURRENT_TIMESTAMP()
);

-- create the 'userdata' table
CREATE TABLE IF NOT EXISTS userdata (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hashedPassword VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    street VARCHAR(255) NOT NULL,
    zipCode INT(4) ZEROFILL NOT NULL,
    is_admin BOOLEAN DEFAULT 0
);

-- test data for the 'news' table
INSERT INTO news (title, text) VALUES
    ('News Title 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
    ('Local Culinary Delights: Exploring the Best Eateries Near Our Hotel', 'Discover the gastronomic pleasures that await you just steps from our hotel. Our neighborhood is a treasure trove of culinary delights, featuring a diverse range of cuisines that cater to every palate..'),
    ('News Title 2', 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');

-- admin data for the 'userdata' table (TODO: maybe dont save admin login here?)
INSERT INTO userdata (firstname, lastname, email, hashedPassword, city, street, zipCode, is_admin) VALUES
    ('admin', 'admin', 'admin', '$2y$10$pi6h3bVdRIk330RxCOwbDuVEwuRuUwX0XQ4Yg4AV.JbkYoF84CJO6', 'City', 'Street', 1234, 1);
