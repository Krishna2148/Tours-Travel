<?php
require_once '../Config/config.php';

    if(isset($_POST['upload'])){

        $pid = $_POST['package-name'];
        $images = $_FILES['images'];
        $num_of_imgs = count($images['name']);
        for($i=0;$i<$num_of_imgs;$i++){

            //get image info
            $image_name = $images['name'][$i];
            $tmp_name = $images['tmp_name'][$i];
            $error = $images['error'][$i];

            //if there is not error occurred while uploading
            if($error == 0){
                //get image extension
                $img_ex = pathinfo($image_name ,PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                //array of images extensions allowed to be uploaded
                $allowed_exs = array('jpg', 'jpeg', 'png');

                //check image extension
                if(in_array($img_ex_lc,$allowed_exs)){
                        $new_img_name = uniqid('IMG-' , true ).'.'.$img_ex_lc;
                        $img_upload_path = '../Images/Gallery/'.$new_img_name;
                        //inserting image into database
                        $sql = "INSERT INTO `gallery` (packageid, image)  VALUES (:pid, :image)";
                        $handle = $pdo->prepare($sql);
                        $params = [
                            ':pid'=>$pid,
                            ':image'=>$new_img_name
                        ];
                        $result = $handle->execute($params);
                        if(!$result){
                            echo '<script>alert("failed");
                            window.location.href="./imagegallery.php";
                            </script>';
                        }
                        
                        //move uploaded image to another folder
                        move_uploaded_file($tmp_name, $img_upload_path);
                        //redirect back 
                        echo '<script>alert("Images added to gallery successfully");
                            window.location.href="./dashboard.php";
                            </script>';

                }
                else{
                    //error message
                    echo '<script>alert("You cannot upload files of this type");
                    window.location.href="./imagegallery.php";
                    </script>';
                }
            }
            else{
                //error message
                echo '<script>alert("Unknown error occurred while uploading");
                window.location.href="./imagegallery.php";
                </script>';
            }


        }
    }
?>