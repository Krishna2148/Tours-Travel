<?php

if(!isset($_SESSION['login'])){
header("Location:./index.php");
}   
    require_once ('../Config/config.php');
    if(isset($_POST['submit'])){
        if(isset($_POST['privacypolicy']) && !empty($_POST['privacypolicy'])){
            $privacypolicy = $_POST['privacypolicy'];
        }
        else{
            $contentError = '<div class = "alert alert-danger"> 
            <strong>Error</strong> Please input privacy policy
        </div>';
        }
        if(isset($privacypolicy) && !empty($privacypolicy)){
            $sql = "INSERT INTO `pages`(privacypolicy) VALUES (:privacypolicy)";
            $handle = $pdo->prepare($sql);
            $params = [
                ':privacypolicy' => $privacypolicy
            ];
            $result = $handle->execute($params);
            if($result){
                echo '<script>alert("Privacy policy added successfully");
                    window.location.href = ./dashboard.php;
                </script>';
            }
        }
    }
?>

    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
  <script src="https://cdn.tiny.cloud/1/dzog42e7y15vivcmss5kvdfxlmf279p8afpt27ipib6nxegg/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

  <form method="POST">
    <?php
        if(isset($contentError)){
            echo $contentError;
        }
    ?>
    <h5>
        Add Privacy Policy
    </h5>
    <div class="form-group">
    <textarea id="privacypolicy" name="privacypolicy">
    
    </textarea>
    <button class="btn btn-success" name="submit">Save</button>
    </div>
  </form>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
