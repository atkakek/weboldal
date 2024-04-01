<?php
session_start();
require_once "connectdb.php";
extract($_GET);
$name = $_SESSION['name'];
$sql = "DELETE FROM likedmovies WHERE likedmovies.userName = '{$name}' AND likedmovies.movieId ={$idk}";
$stmt = $conn -> query( $sql );
echo json_encode($stmt -> fetchAll());
?>