<?php
require_once 'dbaccess.php';
require_once 'dbfunctions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['id'];

    // query to check the current status
    $query = "SELECT status FROM userdata WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // determine the new status
    $newStatus = ($row['status'] == 0) ? 1 : 0;

    // update the status in the database
    $updateQuery = "UPDATE userdata SET status = ? WHERE id = ?";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bind_param("ii", $newStatus, $userId);
    $updateStmt->execute();

    // redirect back to the user management page
    header("Location: ../usermanagement.php");
}
?>
