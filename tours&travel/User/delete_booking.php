<?php
session_start();
require_once('../Config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingId'])) {
    $bookingId = $_POST['bookingId'];
    // Perform the deletion operation using $bookingId

    // Example: Delete the booking from the database
    $sql = "DELETE FROM booking WHERE id = ?";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute([$bookingId]);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'Invalid request';
}
?>
