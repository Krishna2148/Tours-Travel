<?php
    require_once('../Config/config.php');

    //fetch user
    if(isset($_GET['user_id'])){
        $user_id = trim($_GET['user_id']);
        $sql = "SELECT * FROM `users` WHERE `id` = :id"; 
        $handle = $pdo->prepare($sql);
        $params = [
            ':id' => $user_id
        ];
        $result = $handle->execute($params);
        if($result){
            $package = $handle->fetch(PDO::FETCH_ASSOC);
            $res = [
                'status' => 200,
                'message' => 'User fetched successfully',
                'data'=>$package
            ];
            echo json_encode($res);
            return false;
        }
        else{
            $res = [
                'status' => 404,
                'messsage'=> 'User id not found'

            ];
            echo json_encode($res);
            return false;
        }
    }
    //delete user
    if(isset($_POST['delete_user'])){
        $id = trim($_POST['deleteuser_id']);
        if($id == NULL){
            $res = [
                'status' => 422,
                'message' => 'User not found'
            ];
            echo json_encode($res);
            return false;
        }
        $sql = "DELETE FROM `users` WHERE `id` = :id";
        
        $handle = $pdo->prepare($sql);
        $params = [
            ':id'=>$id
        ];
        $result = $handle->execute($params);
        if(!$result){
            $res = [
                'status' => 423,
                'message' => 'User not deleted'
            ];
            
            echo json_encode($res);
            return false;
        }
        else{
            $res = [
                'status' => 200,
                'message' => 'User deleted successfully'
            ];
            echo json_encode($res);
            return false;
        }
    }

?>