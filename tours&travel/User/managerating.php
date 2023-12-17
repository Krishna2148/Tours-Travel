<?php 
require_once '../Config/config.php';

//submit rating 
if(isset($_POST["rating_data"]))
{

	$params = array(
		':package_id' => $_POST["package_id"],
		':user_name'		=>	$_POST["user_name"],
		':user_rating'		=>	$_POST["rating_data"],
		':user_review'		=>	$_POST["user_review"],
		':datetime'			=>  date("Y-m-d H:i:s")
	);

	$sql = "
	INSERT INTO usersreview 
	(packageid,username, rating, review, date) 
	VALUES (:package_id,:user_name, :user_rating, :user_review, :datetime)
	";

	$statement = $pdo->prepare($sql);

	$statement->execute($params);

	echo "Your Review & Rating Successfully Submitted";

}

?>