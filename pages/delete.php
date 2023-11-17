<?php
require "middleware/auth.php";
$id = $_GET['id']; // post Id
$connection = new mysqli("localhost", "root", "", "blog");
$username = $_SESSION['name']; // Currently logged username
$userId = $connection->query("select * from user1 where username = '$username' limit 1")->fetch_assoc()['id']; // user id
$result = $connection->query("delete from post where id = '$id' and user_id = '$userId'");
if($result){
    header("location: home.php");
}else{
    echo "Error Occurred";
}