<?php

// if (!isset($_SESSION['username'])) {
//     header("location: login.php");
// }
$username = $_GET['id'];

$connection = new mysqli("localhost", "root", "", "blog");


$user = $connection->query("select * from user1 where id = '$username'")
    ->fetch_assoc();

$avatar = $user['avatar'] ?? "https://api.oyyi.xyz/v1/avatar";
$username = $user['username'];
$userId = $user['id'];
$lastFivePost = $connection->query(
    "select * from post where user_id= '$userId' order by created_at desc");
$allPost = [];

while ($row = $lastFivePost->fetch_assoc()) {
    $allPost[] = $row;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once "partials/meta.php"; ?>
    <title>Document</title>
</head>
<body>
<?php include "components/header.php"; ?>
<section>
    <div class="row">
        <div class="col-md-6 offset-2">
            <div class="card text-center">
                <div class="card-body">
                    <img src="<?php echo $avatar ?>" alt="avatar" width="100" height="100">
                    <div class="d-flex flex-column">
                        <h3><?php echo $username; ?></h3>
                    </div>
                </div>
            </div>

            <?php
            foreach ($allPost as $post) {
                ?>
                <div class="card my-3">
                    <div class="card-header">
                        <h4><?php echo $post['title'] ?></h4>
                    </div>
                    <div class="card-body">
                        <img src="<?php echo $post['banner'] ?>" alt="blog banner" height="100">
                        <p><?php echo substr($post['content'], 0, 150) ?></p>
                        <a href="?route=blog&id=<?php echo $post['id'] ?>" class="btn btn-primary">Read More</a>
                        <a href="?route=edit&id=<?php echo $post['id'] ?>" class="btn btn-info">Edit</a>
                        <a href="?route=delete&id=<?php echo $post['id'] ?>" class="btn btn-danger">Delete</a>
                    </div>
                    <div class="card-footer">
                        <h6><?php echo $post['created_at'] ?></h6>
                    </div>
                </div>
            <?php } ?>


        </div>
    </div>
</section>

</body>
</html>
