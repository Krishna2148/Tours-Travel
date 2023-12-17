<?php 

    require_once('../Config/config.php');
    //fetch package data
    if(isset($_GET['package_id'])){
        $package_id = trim($_GET['package_id']);
        $sql = "SELECT * FROM `packages` WHERE `id` = :id"; 
        $handle = $pdo->prepare($sql);
        $params = [
            ':id' => $package_id
        ];
        $result = $handle->execute($params);
        if($result){
            $package = $handle->fetch(PDO::FETCH_ASSOC);
            $res = [
                'status' => 200,
                'message' => 'Package fetched successfully',
                'data'=>$package
            ];
            echo json_encode($res);
            return false;
        }
        else{
            $res = [
                'status' => 404,
                'messsage'=> 'Package id not found'

            ];
            echo json_encode($res);
            return false;
        }
    }

    // save package
    if(isset($_POST['save_package'])){

        $name = trim($_POST['name']);
        $location = trim($_POST['location']);
        $route = trim($_POST['route']);
        $duration = trim($_POST['duration']);
        $estdcost = trim($_POST['estd_cost']);
        $childcost = trim($_POST['child_cost']);
        $description = trim($_POST['description']);
        $included = trim($_POST['included']);
        $notincluded = trim($_POST['notincluded']);
        $itinerary = trim($_POST['itinerary']);
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $tempname = $_FILES['image']['tmp_name'];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $filename);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            $res = [
                'status' => 420,
                'message' => 'Image type not supported. Try different image file'
            ];
            echo json_encode($res);
            return false;
        }
        else if($filesize >1000000){
            $res = [
                'status' => 421,
                'message' => 'Image size is too large'
            ];
            echo json_encode($res);
            return false;
        }
        else{
            $newImageName =  uniqid();
            $newImageName .= '.' . $imageExtension;
            move_uploaded_file($tempname, '../Images/LocationImages/'.$newImageName);
            
        }
        if($name == NULL || $location == NULL || $route == NULL || $duration == NULL ||$estdcost == NULL || $childcost == NULL || $description == NULL || $newImageName == NULL || $included == NULL || $notincluded == NULL || $itinerary == NULL){
            $res = [
                'status' => 422,
                'message' => 'All fields are mandatory'
            ];
            echo json_encode($res);
            return false;
        } 	

        $sql = "INSERT INTO `packages`(`name`, `location`, `route`, `duration`, `overview`, `estimatedcost`, `childaddons`, `included`, `notincluded`, `itinerary`,  `image`) VALUES (:name, :location, :route, :duration, :description, :estimatedcost, :childaddons, :included, :notincluded, :itinerary, :image)";
        
        $handle = $pdo->prepare($sql);
        $params = [
            ':name' => $name,
            ':location' => $location,
            ':route' => $route,
            ':duration' => $duration,
            ':description' => $description,
            ':estimatedcost' => $estdcost,
            ':childaddons' => $childcost,
            ':included' => $included,
            'notincluded' =>$notincluded,
            ':itinerary' => $itinerary,
            ':image' => $newImageName
        ];
        $result = $handle->execute($params);
        if(!$result){
            $res = [
                'status' => 423,
                'message' => 'Package not added'
            ];
            
            echo json_encode($res);
            return false;
        }
        else{
            $res = [
                'status' => 200,
                'message' => 'New package added successfully'
            ];
            echo json_encode($res);
            return false;
        }
    }
        
    //update package

    if(isset($_POST['update_package'])){
        $id = trim($_POST['package_id']);
        $name = trim($_POST['name']);
        $location = trim($_POST['location']);
        $route = trim($_POST['route']);
        $duration = trim($_POST['duration']);
        $estdcost = trim($_POST['estd_cost']);
        $childcost = trim($_POST['child_cost']);
        $included = trim($_POST['included']);
        $notincluded = trim($_POST['notincluded']);
        $itinerary = trim($_POST['itinerary']);
        $description = trim($_POST['description']);
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $tempname = $_FILES['image']['tmp_name'];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $filename);
        $imageExtension = strtolower(end($imageExtension));
        $newImageName = NULL;
        //CHECK if image is selected or nots


    if($filename != NULL || $filename != ''){

            if (!in_array($imageExtension, $validImageExtension)) {
                $res = [
                    'status' => 420,
                    'message' => 'Image type not supported. Try different image file'
                ];
                echo json_encode($res);
                return false;
            }
            else if($filesize >1000000){
                $res = [
                    'status' => 421,
                    'message' => 'Image size is too large'
                ];
                echo json_encode($res);
                return false;
            }
            else{
                $newImageName =  uniqid();
                $newImageName .= '.' . $imageExtension;
                move_uploaded_file($tempname, '../Images/LocationImages/'.$newImageName);
                
            }

            if($name == NULL || $location == NULL || $route == NULL || $duration == NULL || $description == NULL || $estdcost == NULL || $childcost == NULL || $included == NULL || $notincluded == NULL || $itinerary == NULL){
                $res = [
                    'status' => 422,
                    'message' => 'All fields are mandatory'
                ];
                echo json_encode($res);
                return false;
            }
            $sql = "UPDATE `packages` SET `name`=:name, `location`=:location, `route`=:route, `duration`=:duration, `estimatedcost`=:estimatedcost, `childaddons`=:childaddons, `overview`=:description, `included`=:included, `notincluded`=:notincluded, `itinerary`=:itinerary, `image`=:image WHERE `id` = :id";

        }
        else{
            $sql = "UPDATE `packages` SET `name`=:name, `location`=:location, `route`=:route, `duration`=:duration, `estimatedcost`=:estimatedcost, `childaddons`=:childaddons, `overview`=:description  `included`=:included, `notincluded`=:notincluded, `itinerary`=:itinerary WHERE `id` = :id";
        }

        $handle = $pdo->prepare($sql);
        $params = [
            ':id'=>$id,
            ':name' => $name,
            ':location' => $location,
            ':route' => $route,
            ':duration' => $duration,
            ':estimatedcost' => $estdcost,
            ':childaddons' => $childcost,
            ':description' => $description,
            ':image' => $newImageName,
            ':included' => $included,
            ':notincluded' => $notincluded,
            ':itinerary' => $itinerary
        ];
        $result = $handle->execute($params);
        if(!$result){
            $res = [
                'status' => 423,
                'message' => 'Package not added'
            ];
            
            echo json_encode($res);
            return false;
        }
        else{
            $res = [
                'status' => 200,
                'message' => 'New package updated successfully'
            ];
            echo json_encode($res);
            return false;
        }
    }


    //delete package

    if(isset($_POST['delete_package'])){
        $id = trim($_POST['deletepackage_id']);
        if($id == NULL){
            $res = [
                'status' => 422,
                'message' => 'Package not found'
            ];
            echo json_encode($res);
            return false;
        }
        $sql = "DELETE FROM `packages` WHERE `id` = :id";
        
        $handle = $pdo->prepare($sql);
        $params = [
            ':id'=>$id
        ];
        $result = $handle->execute($params);
        if(!$result){
            $res = [
                'status' => 423,
                'message' => 'Package not deleted'
            ];
            
            echo json_encode($res);
            return false;
        }
        else{
            $res = [
                'status' => 200,
                'message' => 'Package deleted successfully'
            ];
            echo json_encode($res);
            return false;
        }
    }


    //update package booking status
    if(isset($_GET['id']) && isset($_GET['status'])){
        $id = $_GET['id'];
        $status = $_GET['status'];
        $sql = "UPDATE `booking` SET status = :status WHERE id = :id";
        $handle = $pdo->prepare($sql);
        $params = [
            ':id' => $id,
            ':status' => $status
        ];
        $result = $handle->execute($params);
        header("Location:./managebookings.php");
        die();
    }

    //fetch booking details
    if(isset($_GET['booking_id'])){
        $booking_id = trim($_GET['booking_id']);
        $sql = "SELECT users.name as username, users.email as useremail, users.address as useraddress, users.contact as usercontact, packages.name as packagename, booking.contactmethod as contactmethod, booking.bookingdate as bookeddate , booking.arrivaldate as arrivingdate, booking.status as bookingstatus, booking.adults as noofadults, booking.children as noofchildren, booking.message as bookingmessage FROM booking JOIN users ON booking.userid = users.id JOIN packages ON booking.packageid= packages.id WHERE booking.id = :id";
        $handle = $pdo->prepare($sql);
        $params = [
            ':id' => $booking_id
        ];
        $result = $handle->execute($params);
        if($result){
            $booking = $handle->fetch(PDO::FETCH_ASSOC);
            $res = [
                'status' => 200,
                'message' => 'Package fetched successfully',
                'data'=>$booking
            ];
            echo json_encode($res);
            return false;
        }
        else{
            $res = [
                'status' => 404,
                'messsage'=> 'Package id not found'

            ];
            echo json_encode($res);
            return false;
        }
    }

?>