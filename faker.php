<?php 
require ('vendor'/autoload.php);

$host = 'localhost';
$dbname = 'philippinelocale';
$user = 'root';
$password = 'root';

$connection = new mysqli($host, $user, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "Connected successfully<br>";
}

$faker = Faker\Factory::create('en_PH');


?>