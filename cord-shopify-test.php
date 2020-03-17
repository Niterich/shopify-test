<?php 

$response = file_get_contents('https://1a761bc607e7c5f8f9318994d7b842ce:3ed0d424f43cba2d2921b1cf3cb9da4b@cord-bazaar-1.myshopify.com/admin/api/2020-01/products.json');

echo $response;

// Create the connection to the MySQL server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cord";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO products (sku, title, descript, price)
VALUES ('', '', '', '')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>