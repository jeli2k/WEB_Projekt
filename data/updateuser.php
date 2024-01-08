<?php
require_once("dbaccess.php");
require_once("dbfunctions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $zipCode = $_POST['zipCode'];

    if (!empty($password)) {
        // hash the new password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // include password in the update
        $sql = "UPDATE userdata SET firstname=?, lastname=?, email=?, hashedPassword=?, city=?, street=?, zipCode=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssssssi", $firstname, $lastname, $email, $hashedPassword, $city, $street, $zipCode, $id);
    } else {
        // if no password is provided, update without changing the password
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

header("Location: ../usermanagement.php");
exit();
?>
