<?php 
// Include the database config file 
session_start();
include '../../connections/connect.php';

// Check if the prod_id parameter was passed in the request
if (!isset($_POST['prod_id'])) {
    // If the prod_id parameter was not passed, return an error message
    $result = ['error' => 'prod_id parameter was not provided'];
} else {
    $prod_id = $_POST['prod_id'];

    // Execute the database query to fetch the data
    $query = "SELECT * FROM product where prod_id= '$prod_id'";
    $result = $con->query($query);
  
    // Check if the query was successful
    if (!$result) {
        // If the query was not successful, return an error message
        $result = ['error' => 'Error executing query: ' . $con->error];
    } else {
        // Fetch the data from the result set
        $rowList = mysqli_fetch_array($result);
  
        // Extract the cost and price values from the row
        $cost = $rowList['cost'] ?? '';
        $price = $rowList['price'] ?? '';
  
        // Store the data in an array
        $result = ["cost" => "$cost", "price" => "$price"];
    }
}
  
// Encode the result as a JSON object
$myJSON = json_encode($result);
  
// Return the JSON object
echo $myJSON;