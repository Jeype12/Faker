<?php 
require 'vendor/autoload.php';

$host = 'localhost';
$dbname = 'philippinelocale';
$user = 'root';
$password = 'root';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

$faker = Faker\Factory::create('en_PH');

$stmt = $conn->prepare("INSERT INTO Office (name, contactnum, email, address, city, country, postal) VALUES (?, ?, ?, ?, ?, ?, ?)");
for ($i = 0; $i < 50; $i++) {
    $name = $faker->company;
    $contactnum = $faker->phoneNumber;
    $email = $faker->companyEmail;
    $address = $faker->address;
    $city = $faker->city;
    $country = 'Philippines';
    $postal = $faker->postcode;

    $stmt->bind_param("sssssss", $name, $contactnum, $email, $address, $city, $country, $postal);
    $stmt->execute();
}
echo "Office table is filled with 50 rows<br>";


?>