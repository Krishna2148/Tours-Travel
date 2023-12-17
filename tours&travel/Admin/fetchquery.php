<?php
    require_once('../Config/config.php');

    //fetch query
    if(isset($_GET['query_id'])){
        $query_id = trim($_GET['query_id']);
        $sql = "SELECT * FROM `contact` WHERE `id` = :id"; 
        $handle = $pdo->prepare($sql);
        $params = [
            ':id' => $query_id
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
    //delete query
    if(isset($_POST['delete_query'])){
        $id = trim($_POST['deletequery_id']);
        if($id == NULL){
            $res = [
                'status' => 422,
                'message' => 'Query not found'
            ];
            echo json_encode($res);
            return false;
        }
        $sql = "DELETE FROM `contact` WHERE `id` = :id";
        
        $handle = $pdo->prepare($sql);
        $params = [
            ':id'=>$id
        ];
        $result = $handle->execute($params);
        if(!$result){
            $res = [
                'status' => 423,
                'message' => 'Query not deleted'
            ];
            
            echo json_encode($res);
            return false;
        }
        else{
            $res = [
                'status' => 200,
                'message' => 'Query deleted successfully'
            ];
            echo json_encode($res);
            return false;
        }
    }

?>