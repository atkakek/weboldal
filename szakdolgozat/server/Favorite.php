<?php
session_start();
require_once "connectdb.php";
$sessionName = $_SESSION['name'];
$sql = "SELECT users.userName, likedmovies.movieId, likedmovies.title, likedmovies.overview, likedmovies.poster_path FROM users LEFT JOIN likedmovies ON likedmovies.userName = users.userName WHERE users.userName ='{$sessionName}'";
$stmt = $conn -> query($sql);
echo json_encode($stmt -> fetchAll());
?>