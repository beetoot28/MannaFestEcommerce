<?php

session_start();
 include('../connections/connect.php');
if(isset($_POST["rating_data"]))
{

	// $data = array(
	// 	':prod_id'		=>	$_POST["prod_id"],
	// 	':user_id'		=>	$_POST["user_id"],
	// 	':user_rating'		=>	$_POST["rating_data"],
	// 	':user_review'		=>	$_POST["user_review"],
	// 	':datetime'			=>	time()
	// );

	// $query = "
	// INSERT INTO review_table 
	// (prod_id,user_id, user_rating, user_review, datetime) 
	// VALUES (:prod_id, :user_id, :user_rating, :user_review, :datetime)
	// ";

	// $statement = $con->prepare($query);

	// $statement->execute($data);

	$prod_id =$_POST["prod_id"];
	$user_id = $_POST["user_id"];
	$user_rating = $_POST["rating_data"];
	$user_review = $_POST["user_review"];
	$trans_id = $_POST["trans_id"];
	
	$datetime = time();

	$query = "INSERT INTO review_table (prod_id,user_id,user_rating,user_review,datetime,transaction_id) 
	VALUES ('$prod_id','$user_id','$user_rating','$user_review','$datetime','$trans_id')";
	$results = mysqli_query($con, $query);


	echo "Your Review & Rating Successfully Submitted";

}

if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$prod_id = $_POST["prod_id"];

	$query = "
	SELECT * FROM review_table 
	LEFT JOIN accounts on review_table.user_id = accounts.user_id
	where prod_id='$prod_id'
	ORDER BY review_id DESC
	";


	$result = mysqli_query($con, $query);
	foreach($result as $row)
	{
		$review_content[] = array(
			'user_name'		=>	$row["name"].' '.$row["lastname"],
			'user_review'	=>	$row["user_review"],
			'rating'		=>	$row["user_rating"],
			'datetime'		=>	date('l jS, F Y h:i:s A', $row["datetime"])
		);

		if($row["user_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["user_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["user_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["user_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["user_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>