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

$stmt = $conn->prepare("INSERT INTO Employee (lastname, firstname, office_id, address) VALUES (?, ?, ?, ?)");
for ($i = 0; $i < 200; $i++) {
    $lastname = $faker->lastName;
    $firstname = $faker->firstName;
    $office_id = $faker->numberBetween(1, 50);          // FK
    $address = $faker->address;

    $stmt->bind_param("ssis", $lastname, $firstname, $office_id, $address);
    $stmt->execute();
}
echo "Employee table is filled with 200 rows<br>";

$stmt = $conn->prepare("INSERT INTO Transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES (?, ?, ?, ?, ?, ?)");
for ($i = 0; $i < 500; $i++) {
    $employee_id = $faker->numberBetween(1, 200);       
    $office_id = $faker->numberBetween(1, 50);          
    $datelog = $faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d H:i:s');  
    $action = $faker->word;
    $remarks = $faker->words(3, true);  
    $documentcode = $faker->uuid;

    $stmt->bind_param("iissss", $employee_id, $office_id, $datelog, $action, $remarks, $documentcode);
    $stmt->execute();
}
echo "Transaction table filled with 500 rows<br>";


// Close Connection
$stmt->close();
$conn->close();

?>