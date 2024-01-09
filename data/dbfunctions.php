<?php
function findAllNews () {
    global $db;
    $sql = "SELECT * FROM `news` ORDER BY `date` DESC";
    $result = $db->query($sql);

    $news = [];
    while ($row = $result->fetch_array()) {
        $news[] = $row;
    }
    return $news;
}



// '?' = placeholder against SQL Injection // prepared Statement

function saveNews($title, $text, $imagePath) {
    global $db;

    $sql = "INSERT INTO `news` (`title`, `text`, `image_url`) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sss", $title, $text, $imagePath);  // s = string

    $stmt->execute();
}


function findAllRooms() {
    global $db;
    $sql = "SELECT * FROM `rooms`";
    $result = $db->query($sql);

    $rooms = [];
    while ($row = $result->fetch_array()) {
        $rooms[] = $row;
    }
    return $rooms;
}

function saveRoom($title, $text, $price, $imageUrl = null) {
    global $db;

    $sql = "INSERT INTO `rooms` (`title`, `text`, `price`, `image_url`) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);

    // check for a successful prepare
    if ($stmt === false) {
        die('Error preparing statement.');
    }

    // bind parameters
    if ($imageUrl === null) {
        // if $imageUrl is null, set a default value
        $defaultImageUrl = "uploads/rooms/default_room_image.png";
        $stmt->bind_param("ssds", $title, $text, $price, $defaultImageUrl);
    } else {
        $stmt->bind_param("ssds", $title, $text, $price, $imageUrl);
    }

    $stmt->execute();

    $stmt->close();
}


function saveEmail($email, $hashedPassword) {
    global $db;
    if ($email != NULL && $hashedPassword != NULL) {
        $sql = "INSERT INTO `userdata` (`email`, `hashedPassword`) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $email, $hashedPassword);

    $stmt->execute(); 
    }
}

function saveRegister($firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode) {
    global $db;

    if ($firstname != NULL && $lastname != NULL && $email != NULL && $hashedPassword != NULL && $city != NULL && $street != NULL && $zipCode != NULL) {
        $sql = "INSERT INTO `userdata` (`firstname`, `lastname`, `email`, `hashedPassword`, `city`, `street`, `zipCode`) VALUES (?, ?, ?, ?, ?, ?, ?)"; 
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode);
    
        $stmt->execute(); 
    }
}

function updateRegister($name, $lastname, $email, $hashedPassword, $city, $street, $zipCode) {
    global $db;

    if ($name != NULL && $lastname != NULL && $email != NULL && $hashedPassword != NULL && $city != NULL && $street != NULL && $zipCode != NULL) {
        $sql = "UPDATE `userdata` SET `firstname`=?, `lastname`=?, `hashedPassword`=?, `city`=?, `street`=?, `zipCode`=? WHERE `email`=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssssss", $name, $lastname, $hashedPassword, $city, $street, $zipCode, $email);
        $stmt->execute(); 
    }
}


function findRegister($email) {
    global $db;

    $sql = "SELECT `firstname`, `lastname`, `email`, `hashedPassword`, `city`, `street`, `zipCode` FROM `userdata` WHERE `email` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_array();
}

function findUserByEmail($email) {
    global $db;

    $sql = "SELECT * FROM `userdata` WHERE `email` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}


function findAdminLogin($email) {
    global $db;

    $sql = "SELECT * FROM `userdata` WHERE `email` = ? AND `is_admin` = 1";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // ensure the user, hashed password, and is_admin field are retrieved
    return ($user && isset($user['hashedPassword']) && isset($user['is_admin']) && $user['is_admin'] == 1) ? $user : null;
}

function findRoom($roomId) {
    global $db;

    $sql = "SELECT * FROM `rooms` WHERE `id` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $roomId);

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

function saveBooking($room_id, $arrival_date, $departure_date, $with_breakfast, $with_parking, $with_pets, $user_id, $total_price) {
    global $db;

    $sql = "INSERT INTO `bookings` (`user_id`, `room_id`, `arrival_date`, `departure_date`, `with_breakfast`, `with_parking`, `with_pets`, `total_price`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("iissssid", $user_id, $room_id, $arrival_date, $departure_date, $with_breakfast, $with_parking, $with_pets, $total_price);
    $stmt->execute();
    // get the last inserted ID
    $lastInsertId = mysqli_insert_id($db);

    return $lastInsertId;
}

function getBookingInfo($bookingId) {
    global $db;

    $sql = "SELECT b.id, b.room_id, b.arrival_date, b.departure_date, b.with_breakfast, b.with_parking, b.with_pets, b.status, b.total_price, r.title as room_title
            FROM bookings b
            INNER JOIN rooms r ON b.room_id = r.id
            WHERE b.id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}
 
function getUserBookings($userEmail) {
    global $db;

    $sql = "SELECT b.id, b.room_id, b.arrival_date, b.departure_date, b.with_breakfast, b.with_parking, b.with_pets, b.status, r.title as room_title
            FROM bookings b
            INNER JOIN rooms r ON b.room_id = r.id
            INNER JOIN userdata u ON b.user_id = u.id
            WHERE u.email = ?";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();

    $result = $stmt->get_result();
    $bookings = [];

    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }

    return $bookings;
}

function getCurrentRoomPrice($roomId) {
    global $db;

    $sql = "SELECT `price` FROM `rooms` WHERE `id` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $roomId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $roomData = $result->fetch_assoc();
        return $roomData['price'];
    } else {
        // default to a fallback value if room is not found
        return 0;
    }
}

function calculateTotalPrice($basePrice, $withBreakfast, $withParking, $withPets) {
    // start with base room price
    $totalPrice = $basePrice;

    // add additional fees (selected options)
    if ($withBreakfast) {
        $totalPrice += 40;
    }

    if ($withParking) {
        $totalPrice += 50;
    }

    if ($withPets) {
        $totalPrice += 30;
    }

    return $totalPrice;
}

function findAllBookingsWithRoomNames() {
    global $db;

    $sql = "SELECT bookings.*, userdata.firstname, userdata.lastname, userdata.email, rooms.title AS room_title 
            FROM bookings 
            JOIN userdata ON bookings.user_id = userdata.id
            JOIN rooms ON bookings.room_id = rooms.id";
    $result = $db->query($sql);

    $bookings = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    }

    return $bookings;
}

function findBookingsByUserId($userId) {
    global $db;

    $sql = "SELECT bookings.*, rooms.title AS room_title, userdata.firstname AS user_firstname, userdata.lastname AS user_lastname, userdata.email AS user_email
            FROM bookings 
            JOIN rooms ON bookings.room_id = rooms.id
            JOIN userdata ON bookings.user_id = userdata.id
            WHERE bookings.user_id = $userId";

    $result = $db->query($sql);

    $bookings = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
    }

    return $bookings;
}

?>

