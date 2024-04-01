<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userinfo";


$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];     

try {
  $conn = new PDO("mysql:host=$servername;dbname=userinfo", $username, $password, $options);

  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
