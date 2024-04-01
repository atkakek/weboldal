<?php
session_start();
require_once "connectdb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $pw = $_POST['password'];

    $pw_hash = password_hash($pw, PASSWORD_DEFAULT);
    try {
        $conn = new PDO("mysql:host=$servername;dbname=userinfo", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Select COUNT(userId) as nr from users where userName = '{$name}'";
        $stmt = $conn ->query($sql);
        $row = $stmt->fetch();
         if ($row[0] == 0) {
            $sql = "INSERT INTO users (userName, pw) VALUES ('$name', '$pw_hash')";
            $conn->exec($sql);
        }
        $_SESSION['name']=$name;
        
        echo json_encode(["msg" => "COUNT: {$row[0]}"]);

    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}
?>
