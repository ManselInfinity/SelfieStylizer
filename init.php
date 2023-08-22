<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SelfieStylizer";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE SelfieStylizer";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


$sql = "CREATE TABLE users (email varchar(50) PRIMARY KEY, password varchar(250), credits int(5) ) ";

if ($conn->query($sql) === TRUE) {
    echo "Database table 'users' created successfully";
} else {
    echo "Error creating database table 'users': " . $conn->error;
}

$sql = "CREATE TABLE images (email varchar(50) PRIMARY KEY, image LONGBLOB ) ";

if ($conn->query($sql) === TRUE) {
    echo "Database table 'images' created successfully";
} else {
    echo "Error creating database table 'images': " . $conn->error;
}

?>