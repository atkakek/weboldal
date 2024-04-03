<?php
session_start();
require_once "connectdb.php";
extract($_GET);
$name = $_SESSION['name'];
$sql = "SELECT likedmovies.userName, COUNT(likedmovies.movieId) as darab FROM likedmovies WHERE likedmovies.userName ='{$name}'";
$stmt = $conn -> query( $sql );
$data = $stmt -> fetchAll();
$darab = $data[0]['darab'];
echo json_encode($data);
?>