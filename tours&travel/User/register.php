<?php
session_start();
require_once('../Config/config.php');

if (isset($_POST['submit'])) {
    
    if (isset($_POST['name'], $_POST['address'], $_POST['email'], $_POST['contact'], $_FILES['image'], $_POST['pass']) && !empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['email']) && !empty($_POST['contact']) && !empty($_FILES['image']) && !empty($_POST['pass'])){
        $name = trim($_POST['name']);
        $contact = trim($_POST['contact']);
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);
        $password = trim($_POST['pass']);
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $tempname = $_FILES['image']['tmp_name'];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $filename);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            $errors[] = 'Invalid image extension';
        }
        else if($filesize >1000000){
            $errors[] = 'File size is too large';
        }
        else{
            $newImageName =  uniqid();
            $newImageName .= '.' . $imageExtension;
            move_uploaded_file($tempname, '../Images/User Images/'.$newImageName);
            $_SESSION['img'] = $newImageName;


        }
        $options = array("cost" => 4);
        $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        $date = date('Y-m-d H:i:s');

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if(preg_match('/9[678]\d{8}/', $contact)){

            $sql = 'SELECT * FROM `users` WHERE `email` = :email';
            $stmt = $pdo->prepare($sql);
            $p = ['email' => $email];
            $stmt->execute($p);

            if ($stmt->rowCount() == 0) {
                $sql = "INSERT INTO `users` (`name`, `contact`, `email`, `address`, `image`, `password`, `created_at`, `updated_at`) VALUES (:name, :contact, :email, :address, :image, :pass, :created_at, :updated_at)";

                try {
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':name' => $name,
                        ':contact' => $contact,
                        ':email' => $email,
                        ':address' => $address,
                        ':image'=>$newImageName,
                        ':pass' => $hashPassword,
                        ':created_at' => $date,
                        ':updated_at' => $date
                    ];
                    $result = $handle->execute($params);
                    if(!$result){
                        $errors[] = "Failed to register user";
                    }

                    $success = 'User has been created successfully';
                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $valName = $name;
                $valEmail = '';
                $valPassword = $password;
                $valContact = $contact;
                $valAddress = $address;

                $errors[] = 'Email address already registered';
            }
        } 
        else{
            $errors[] = 'Invalid mobile number';       
        }
            
        } 
        
        
        else {
            $errors[] = "Email address is not valid";
        }
    } else {
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            $errors[] = 'Name is required';
        } 

        if (!isset($_POST['email']) || empty($_POST['email'])) {
            $errors[] = 'Email is required';
        } 
        if (!isset($_POST['address']) || empty($_POST['address'])) {
            $errors[] = 'Address is required';
        } else {
            $valAddress= $_POST['address'];
        }
        if (!isset($_POST['contact']) || empty($_POST['contact'])) {
            $errors[] = 'Contact Number is required';
        } 

        if (!isset($_POST['pass']) || empty($_POST['pass'])) {
            $errors[] = 'Password is required';
        } 
        if(!isset($_FILES['image']) || empty($_FILES['image'])){
            $errors[] = "Image is required";
        }
    }
}
?>


<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body class="bg-dark">

    <div class="container h-100">
        <div class="row h-100 mt-5 justify-content-center align-items-center">
            <div class="col-md-5 mt-3 pt-2 pb-5 align-self-center border bg-light">
                <h1 class="mx-auto w-25">Register</h1>
                <?php
                if (isset($errors) && count($errors) > 0) {
                    foreach ($errors as $error_msg) {
                        echo '<div class="alert alert-danger">' . $error_msg . '</div>';
                    }
                }

                if (isset($success)) {

                    echo '<div class="alert alert-success">' . $success . '</div>';
                }
                ?>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" placeholder="Enter Full Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text"  name="address" placeholder="Enter Address" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" placeholder="Enter Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="contact">Mobile number:</label>
                        <input type="tel" name="contact" placeholder="Enter Mobile Number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Image:</label>
                        <input type="file" name="image"  id= "image" accept=".jpg, .jpeg, .png" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="pass" minlength="8" placeholder="Enter Password" class="form-control" autocomplete="new-password">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <p class="pt-2"> Back to <a href="./login.php">Login</a></p>

                </form>
            </div>
        </div>
    </div>
</body>

</html>