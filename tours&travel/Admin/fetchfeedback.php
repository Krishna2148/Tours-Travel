<?php
    require_once('../Config/config.php');
    //fetch user feedback
    if(isset($_GET['feedback_id'])){
        $feedback_id = trim($_GET['feedback_id']);
        $sql = "SELECT usersreview.username as username, usersreview.rating as packagerating, usersreview.date as reviewdate, usersreview.review as reviewmessage, packages.name as packagename FROM `usersreview` JOIN `packages` ON usersreview.packageid = packages.id  WHERE usersreview.id = :id"; 
        $handle = $pdo->prepare($sql);
        $params = [
            ':id' => $feedback_id
        ];
        $result = $handle->execute($params);
        if($result){
            $package = $handle->fetch(PDO::FETCH_ASSOC);
            $res = [
                'status' => 200,
                'message' => 'Query fetched successfully',
                'data'=>$package
            ];
            echo json_encode($res);
            return false;
        }
        else{
            $res = [
                'status' => 404,
                'messsage'=> 'Query id not found'

            ];
            echo json_encode($res);
            return false;
        }
    }