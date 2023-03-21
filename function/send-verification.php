<?php
// include('connections/connect.php');
// Required if your environment does not handle autoloading
require '../vendor/autoload.php';


$client = new GuzzleHttp\Client(); 

$response = $client->request("POST", "https://api.sms.fortres.net/v1/messages", [
    "headers" => [
        "Content-type" => "application/json"
    ],
    "auth" => ["ea74cab6-4f29-4ca5-92a8-3ff758aaa9cf", "X0qRewwoT8f36lAPDucrICHbQgQVCenCuD7wbwEB"],
    "json" => [
        "recipient" => "09123456789",
        "message" => "Sample text message"
    ]
]);

if ($response->getStatusCode() == 200) {
    echo $response->getBody();
}
?>