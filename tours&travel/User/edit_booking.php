<?php
session_start();
require_once('../Config/config.php');

// Check if the user is logged in
if (isset($_SESSION['login']) && $_SESSION['login']) {
    $userId = $_SESSION['uid']; // Get the user's ID
    
    // Get data from the AJAX request
    $bookingId = $_POST['bookingId'];
    $editedArrivalDate = $_POST['arrivalDate'];
    $editedAdults = $_POST['adults'];
    $editedChildren = $_POST['children'];
    $editedMessage = $_POST['message'];

    // Update booking details in the database
    $sql = "UPDATE booking SET  arrivaldate = ?, adults = ?, children = ?,message = ? WHERE id = ?";
    $statement = $pdo->prepare($sql);
    $success = $statement->execute([$editedArrivalDate, $editedAdults, $editedChildren, $editedMessage, $bookingId]);

    if ($success) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'not_logged_in';
}
?>
