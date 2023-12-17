<?php

  //session_start();
  require_once('../Config/config.php');

  if(isset($_POST['submit'])){
    if(isset($_POST['name'] , $_POST['email'] , $_POST['message']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
      $name = trim($_POST['name']);
      $email = trim($_POST['email']);
      $message = trim($_POST['message']);
      $date = date('Y-m-d H:i:s');

      if(filter_var($email , FILTER_VALIDATE_EMAIL)){
        $sql = "INSERT INTO `contact`(`name`, `email`, `message`, `contact_date`) VALUES (:name, :email, :message, :date)";
        try{
          $handle = $pdo->prepare($sql);
          $params = [
            ':name' => $name,
            ':email' => $email,
            ':message' => $message,
            ':date' => $date,
          ];
          $result = $handle->execute($params);
          if(!$result){
            echo '<script>alert("Failed to sent message")</script>';
          }

          echo '<script>alert("Message has been successfully sent");window.location.href="./index.php";</script>';
        }
        catch(PDOException $e){
          echo '<script>alert("Failed to sent message due to PDOException")</script>';
        }
      
      }
      else{
        echo '<script>alert("Email address is not valid");window.location.href="./index.php";</</script>';
      }
  }
  else{
    if(!isset($_POST['name']) || empty($_POST['nam'])){
        echo '<script>alert("Name is required");window.location.href="./index.php";</</script>';
    }
    

    if(!isset($_POST['email']) || empty($_POST['email'])){
        echo '<script>alert("Email address is required");window.location.href="./index.php";</</script>';    
    }
    

    if(!isset($_POST['message']) || empty($_POST['message'])){
        echo '<script>alert("Message is required");window.location.href="./index.php";</</script>';    
    }
    
  }
}