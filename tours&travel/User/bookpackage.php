<?php
session_start();
require_once '../Config/config.php';

if (isset($_POST['book_package'])) {
    if(isset($_POST['arrival_date'] , $_POST['adults'] , $_POST['children'] , $_POST['contactmethod']) && !empty($_POST['arrival_date']) && !empty($_POST['adults']) && !empty($_POST['children']) && !empty($_POST['contactmethod'])){

    $pid = $_POST['packageid'];
    $arrival_date = trim($_POST['arrival_date']);
    $adults = trim($_POST['adults']);
    $children = trim($_POST['children']);
    $contactmethod = trim($_POST['contactmethod']);
    $message = trim($_POST['message']);
    $status = "pending";
    $bookingdate = date("Y-m-d H:i:s");
    $uid = $_SESSION['uid'];
    if ($arrival_date == NULL || $adults == NULL || $children == NULL || $contactmethod == NULL || $message == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    } else {

        $sql = "INSERT INTO `booking`(`userid`, `packageid`, `arrivaldate`, `adults`, `children`, `bookingdate`, `contactmethod`, `status`, `message`) VALUES (:uid, :pid, :arrivaldate, :adults, :children, :bookdate, :contactmethod, :status, :message)";

        $handle = $pdo->prepare($sql);
        $params = [
            ':uid' => $uid,
            ':pid' => $pid,
            ':arrivaldate' => $arrival_date,
            ':adults' => $adults,
            ':children' => $children,
            ':bookdate' => $bookingdate,
            ':contactmethod' => $contactmethod,
            ':status' => $status,
            ':message' => $message
        ];
        
        if($handle->execute($params)) {
                        $res = [
                            'status' => 200,
                            'message' => 'Package booked successfully'
                        ];
            
                        echo json_encode($res);
                        return false;
                    } else {
                        $res = [
                            'status' => 423,
                            'message' => 'Package booking failed'
                        ];
                        echo json_encode($res);
                        return false;
                    }
    }
    }
    else{
        $res = [
            'status' => 423,
            'message' => 'Fill all the require fields'
        ];

        echo json_encode($res);
        return false;
    }
}
?>