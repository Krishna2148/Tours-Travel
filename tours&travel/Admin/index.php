
<?php
session_start();
require_once '../Config/config.php';
if(isset($_POST['submit']))
{
	if(isset($_POST['username'],$_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']))
	{
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		
			$sql = "SELECT * FROM `admin` WHERE `name` = :uname";
			$handle = $pdo->prepare($sql);
			$params = [':uname'=>$username];
			$handle->execute($params);
			if($handle->rowCount() > 0)
			{
				$getRow = $handle->fetch(PDO::FETCH_ASSOC);
				if($password == $getRow['password'])
				{
					unset($getRow['password']);
					$_SESSION['login'] = 'loggedin';
					
					header('location:./dashboard.php');
					exit();
				}
				else
				{
					$errors[] = "Wrong Username or Password";
				}
			}
			else
			{
				$errors[] = "Wrong Email or Password";
			}
			
		
		

	}
	else
	{
		$errors[] = "Email and Password are required";	
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
		<div class="col-md-5 mt-5 pt-2 pb-5 align-self-center border bg-light">
			<h1 class="mx-auto w-25" >Admin Login</h1>
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
				}
			?>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" name="username" placeholder="Enter username" class="form-control">
				</div>
				<div class="form-group">
				<label for="email">Password:</label>
					<input type="password" name="password" placeholder="Enter Password" class="form-control">
				</div>

				<button type="submit" name="submit" class="btn btn-primary">Submit</button>	
			</form>
		</div>
	</div>
</div>
</body>
</html>
