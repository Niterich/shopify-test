<?php 

// Function to extract the values nested within the json response
function printValues($arr) {
    global $count;
    global $values;
    
    // Check input is an array
    if(!is_array($arr)){
        die("ERROR: Input is not an array");
    }

    // Loop through array, if value is itself an array recursively call the function else add the value found to the output items array, and increment counter by 1 for each value found
    foreach($arr as $key=>$value){
        if(is_array($value)){
            printValues($value);
        } else{
            $values[] = $value;
            $count++;
        }
    }
    // Return total count and values found in array
    return array('total' => $count, 'values' => $values);
}

// Stores the products json response as a variable
$response = file_get_contents('https://1a761bc607e7c5f8f9318994d7b842ce:3ed0d424f43cba2d2921b1cf3cb9da4b@cord-bazaar-1.myshopify.com/admin/api/2020-01/products.json');

// Decode JSON data into PHP associative array format
$arr = json_decode($response, true);

// Call the function and print all the values
// $result = printValues($arr);
// echo "<h3>" . $result["total"] . " value(s) found: </h3>";
// echo implode("<br>", $result["values"]);
 
// echo "<hr>";

$title1 = $arr['products'][0]['title'];
$title2 = $arr['products'][1]['title'];
$title3 = $arr['products'][2]['title'];

$descript1 = $arr['products'][0]['body_html'];
$descript2 = $arr['products'][1]['body_html'];
$descript3 = $arr['products'][2]['body_html'];

$price1 = +$arr['products'][0]['variants'][0]['price'];
$price2 = +$arr['products'][1]['variants'][0]['price'];
$price3 = +$arr['products'][2]['variants'][0]['price'];

// Create the connection to the MySQL server, db was created in sep schema folder
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Drop Database
$query = "DROP DATABASE cord";
if ($conn->query($query) === TRUE) {
    echo "Database dropped successfuly.";
} else {
    echo "Unable to drop database " . $connection->error;
}

// Create database
$sql = "CREATE DATABASE cord";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$db = 'cord';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table
$table = "CREATE TABLE products
(
	id int NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    descript TEXT NOT NULL,
    price DECIMAL(6,2),
    PRIMARY KEY (id)
)";

if ($conn->query($table) === TRUE) {
    echo "Table products created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//Insert the data into the table
$sqlInsert1 = "INSERT INTO products (title, descript, price)
VALUES ('$title1', '$descript1', $price1)";
$sqlInsert2 = "INSERT INTO products (title, descript, price)
VALUES ('$title2', '$descript2', $price2)";
$sqlInsert3 = "INSERT INTO products (title, descript, price)
VALUES ('$title3', '$descript3', $price3)";

if ($conn->query($sqlInsert1) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlInsert1 . "<br>" . $conn->error;
}

if ($conn->query($sqlInsert2) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlInsert2 . "<br>" . $conn->error;
}

if ($conn->query($sqlInsert3) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlInsert3 . "<br>" . $conn->error;
}

// display the data on the page
$query = 'SELECT * FROM products ORDER BY price DESC';

echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <strong><font face="Arial">Title</font></strong> </td> 
          <td> <strong><font face="Arial">Description</font></strong> </td> 
          <td> <strong><font face="Arial">Price</font></strong> </td> 
      </tr>';
 
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["title"];
        $field2name = $row["descript"];
        $field3name = $row["price"];
 
        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
              </tr>';
    }
    $result->free();
} 

$conn->close();


?>