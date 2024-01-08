<?php
include 'dbaccess.php'; // Adjust the path as necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Added password field
    $city = $_POST['city'];
    $street = $_POST['street'];
    $zipCode = $_POST['zipCode'];

    if (!empty($password)) {
        // Hash the new password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Include password in the update
        $sql = "UPDATE userdata SET firstname=?, lastname=?, email=?, hashedPassword=?, city=?, street=?, zipCode=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssssssi", $firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode, $id);
    } else {
        // If no password is provided, update without changing the password
        $sql = "UPDATE userdata SET firstname=?, lastname=?, email=?, city=?, street=?, zipCode=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $city, $street, $zipCode, $id);
    }

    if ($stmt->execute()) {
        echo "User updated successfully";
    } else {
        echo "Error updating record: " . $db->error;
    }

    $stmt->close();
}

// Redirect back to the usermanagement.php or handle the response as needed
header("Location: usermanagement.php");
exit();
?>
