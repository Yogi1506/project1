<?php


$id = $_GET['id'];
$connection = new mysqli("localhost", "root", "", "blog");

$sql1="SELECT p.user_id from post p where id = $id";
$result = $connection->query($sql1);
while ($row = mysqli_fetch_assoc($result)) {
$user_id=$row["user_id"];

}


$sql = "DELETE FROM `post` WHERE id=$id";
$result = $connection->query($sql);
if($result){
    header("Location: profile.php?id=$user_id");
}



?>
