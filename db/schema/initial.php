-- this script creates the initial structure for the 'hotel' database

CREATE DATABASE IF NOT EXISTS hotel;

USE hotel;

-- create the 'news' table
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    text TEXT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    image_url VARCHAR(255) NOT NULL
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

-- create the 'rooms' table
CREATE TABLE IF NOT EXISTS rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    text VARCHAR(255) NOT NULL,
    price FLOAT(10, 2) NOT NULL,
    image_url VARCHAR(255) NOT NULL
);


-- test data for the 'news' table
INSERT INTO news (title, text, image_url) VALUES
(
    'Local Culinary Delights: Exploring the Best Eateries Near Our Hotel', 
    'Discover the gastronomic pleasures that await you just steps from our hotel. Our neighborhood is a treasure trove of culinary delights, featuring a diverse range of cuisines that cater to every palate. 
    From the aromatic street food stalls offering local specialties to high-end restaurants serving international delicacies, there''s something for everyone.
    One can''t-miss spot is Ristorante Tricolore renowned for its Classic Italian Pizza''s that perfectly encapsulates the local flavors. 
    For those looking for a more global taste, Brasserie Julio offers an exquisite fusion menu that combines elements of Spanish and Mexican. 
    Not only does our location offer a variety of dining options, but many of these eateries also offer exclusive discounts to our guests. 
    So, whether you''re craving a quick bite or a luxurious dining experience, our hotel is the perfect base for your culinary adventures. 
    Don''t forget to ask our front desk for personalized recommendations and the latest foodie tips!', 'Content/Culinary.jpg'
),
(
    'Unwind and Rejuvenate: Introducing Our New Spa and Wellness Center',
    'We are thrilled to announce the opening of our new Spa and Wellness Center, a sanctuary designed for your ultimate relaxation and rejuvenation. 
    Our state-of-the-art facility offers a wide range of services, from traditional massages and facials to innovative therapies that blend ancient techniques with modern wellness practices. 
    Our skilled therapists are trained in a variety of modalities, ensuring a personalized experience that caters to your specific needs. The highlight of our spa is the Thai Massage, an exclusive treatment that promises to transport you to a state of blissful tranquility.
    In addition to spa services, our wellness center also features a fully equipped gym, a serene yoga studio, and a relaxing sauna.
    Guests can also participate in our wellness programs, which include guided meditation sessions, fitness classes, and health workshops.
    Whether you''re seeking to de-stress, improve your fitness, or simply indulge in some pampering, our Spa and Wellness Center is your haven of tranquility. Book your appointment today and embark on a journey of wellness and relaxation.',
    'Content/Spa.jpg'
    
),
(
    'Experience Local Culture: Upcoming Events and Festivals Near Our Hotel',
    'Immerse yourself in the vibrant local culture by participating in the exciting events and festivals happening near our hotel. Our city is a hub of cultural activities, offering a rich tapestry of experiences that showcase the local heritage, arts, and community spirit.
    This month, don''t miss the Pumpkin Festival, a colorful celebration featuring parades, live music, and traditional dance performances. The festival is a fantastic opportunity to experience the local customs and enjoy the lively atmosphere.
    Art enthusiasts will be delighted by the Modern Light Arts, showcasing the works of local artists and craftsmen. It''s a perfect occasion to appreciate the creativity of our community and perhaps find a unique souvenir to take home.
    For those interested in more contemporary entertainment, the Phantom of the Opera Musical is a must-see. Featuring renowned performers and exciting new talents, it promises an evening of unforgettable entertainment.
    Our hotel concierge is always ready to provide you with more information on these events, assist with tickets, and offer recommendations for other local attractions. Stay with us and be at the heart of all the cultural excitement!',
    'Content/Festival.jpg'
);

-- test data for the 'rooms' table
INSERT INTO rooms (title, text, price, image_url) VALUES
('Serenity Skyline Suite', 'Perched high above the city, the Serenity Skyline Suite offers breathtaking panoramic views. The suite features a spacious living area with floor-to-ceiling windows, a plush king-sized bed, and a state-of-the-art entertainment system.',
'399.99', 'Content/room1.jpg'),
('Ocean Whisper Bungalow', 'Experience the ultimate in luxury and privacy in our Ocean Whisper Bungalow. The bungalow is nestled in a secluded area of the resort, offering direct access to the beach and a private pool. The spacious interior features a king-sized bed, a luxurious bathroom, and a private terrace with a jacuzzi.',
'499.99', 'Content/room2.jpg'),
('Sunset Serenade Studio', 'Enjoy the stunning views of the sunset from the comfort of your own private terrace. The Sunset Serenade Studio features a spacious living area with a king-sized bed, a fully equipped kitchenette, and a luxurious bathroom with a jacuzzi.',
'599.99', 'Content/room3.jpg');

-- admin data for the 'userdata' table (TODO: maybe dont save admin login here?)
INSERT INTO userdata (firstname, lastname, email, hashedPassword, city, street, zipCode, is_admin) VALUES
    ('admin', 'admin', 'admin', '$2y$10$pi6h3bVdRIk330RxCOwbDuVEwuRuUwX0XQ4Yg4AV.JbkYoF84CJO6', 'City', 'Street', 1234, 1);
